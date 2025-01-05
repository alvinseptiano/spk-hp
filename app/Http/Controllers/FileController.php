<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ParagonIE\Halite\KeyFactory;
use ParagonIE\Halite\Symmetric\EncryptionKey;
use ParagonIE\Halite\Symmetric\Crypto;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    private $encryptionKey;

    public function __construct()
    {
        // Generate or load your encryption key - store this securely!
        $this->encryptionKey = KeyFactory::generateEncryptionKey();
    }

    public function index()
    {
        $files = Storage::files('encrypted');

        return response()->json([
            'files' => collect($files)->map(function ($file) {
                return [
                    'name' => basename($file),
                    'path' => Storage::url($file),
                    'size' => Storage::size($file),
                    'last_modified' => Storage::lastModified($file)
                ];
            })
        ]);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'files.*' => 'required|file|max:102400', // 100MB max file size
            'passphrase' => 'nullable|string',
            'nonce' => 'nullable|string',
        ]);

        try {
            $startTime = microtime(true);
            $results = [];
            $totalSize = 0;
            $encryptionPassword = $this->getEncryptionPassword($request->input('passphrase'));

            foreach ($request->file('files') as $file) {
                $fileName = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $originalName = $file->getClientOriginalName();
                $mimeType = $file->getMimeType();
                $size = $file->getSize();
                $totalSize += $size;

                // Store the file in a secure location
                $path = $file->storeAs('encrypted', $fileName);

                // Encrypt the file using ChaCha20-Poly1305
                $encryptedPath = $this->encryptFile(
                    storage_path("app/{$path}"), 
                    $encryptionPassword,
                    $request->input('nonce')
                );

                $results[] = [
                    'originalName' => $originalName,
                    'encryptedName' => $fileName,
                    'mimeType' => $mimeType,
                    'size' => $size,
                    'path' => $encryptedPath
                ];
            }

            $endTime = microtime(true);
            $processingTime = $endTime - $startTime;

            return response()->json([
                'success' => true,
                'message' => 'Files uploaded and encrypted successfully',
                'files' => $results,
                'metrics' => [
                    'processingTime' => round($processingTime, 2),
                    'totalSize' => $totalSize,
                    'averageSpeed' => round($totalSize / $processingTime / 1024 / 1024, 2) . ' MB/s'
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error processing files: ' . $e->getMessage()
            ], 500);
        }
    }


    public function download($fileName)
    {
        // Get encrypted content
        $encrypted = Storage::get("encrypted/{$fileName}");
        
        // Decrypt the content
        $decrypted = sodium_crypto_aead_chacha20poly1305_ietf_decrypt(
            $encrypted,
            '', // additional data
            random_bytes(12), // nonce
            $this->encryptionKey->getRawKeyMaterial()
        );
        
        return response($decrypted)
            ->header('Content-Type', 'application/octet-stream')
            ->header('Content-Disposition', "attachment; filename=\"{$fileName}\"");
    }

    /**
     * Get the password to use for encryption
     * 
     * @param string|null $passphrase User-provided passphrase
     * @return string The password to use for encryption
     * @throws \Exception If no valid password is available
     */
    private function getEncryptionPassword(?string $passphrase): string
    {
        // If passphrase is provided, use it
        if (!empty($passphrase)) {
            return $passphrase;
        }

        // Get the authenticated user
        $user = Auth::user();
        if (!$user) {
            throw new \Exception('No authenticated user found');
        }

        // Get user's password hash
        // Note: We're using the hash as the encryption key since we can't access the actual password
        $accountPassword = $user->password;

        // Verify we have a password
        if (empty($accountPassword)) {
            throw new \Exception('No valid password found for encryption');
        }

        return $accountPassword;
    }

    /**
     * Encrypt the file using ChaCha20-Poly1305
     */
    private function encryptFile(string $filePath, string $passphrase, ?string $nonce = null): string
    {
        if (!extension_loaded('sodium')) {
            throw new \Exception('The sodium extension is required for ChaCha20-Poly1305 encryption.');
        }

        // Read the file content
        $content = file_get_contents($filePath);
        
        // Generate salt for key derivation (16 bytes)
        $salt = random_bytes(16);
        
        // Derive key using Argon2id (sodium's recommended KDF)
        $key = sodium_crypto_pwhash(
            32, // Key length for ChaCha20-Poly1305
            $passphrase,
            $salt,
            SODIUM_CRYPTO_PWHASH_OPSLIMIT_MODERATE,
            SODIUM_CRYPTO_PWHASH_MEMLIMIT_MODERATE,
            SODIUM_CRYPTO_PWHASH_ALG_ARGON2ID13
        );

        // Generate or use provided nonce (12 bytes for ChaCha20-Poly1305)
        if ($nonce) {
            // If nonce is provided as hex, convert to binary
            $nonce = hex2bin($nonce);
            if (strlen($nonce) !== SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_IETF_NPUBBYTES) {
                throw new \Exception('Invalid nonce length. Must be ' . 
                    SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_IETF_NPUBBYTES . ' bytes.');
            }
        } else {
            $nonce = random_bytes(SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_IETF_NPUBBYTES);
        }

        // Additional data can include file metadata or other context
        $additionalData = $filePath;

        // Encrypt the content using ChaCha20-Poly1305
        $encrypted = sodium_crypto_aead_chacha20poly1305_ietf_encrypt(
            $content,
            $additionalData,
            $nonce,
            $key
        );

        // Format: salt (16 bytes) + nonce (12 bytes) + encrypted data (rest)
        $finalData = "{$salt}{$nonce}{$encrypted}";

        // Save the encrypted content
        $encryptedPath = "{$filePath}encrypted";
        file_put_contents($encryptedPath, $finalData);

        // Clean up sensitive variables
        sodium_memzero($key);
        sodium_memzero($content);
        
        // Remove the original file
        unlink($filePath);
        
        return $encryptedPath;
    }
}