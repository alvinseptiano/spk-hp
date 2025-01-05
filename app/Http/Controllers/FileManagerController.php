<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class FileManagerController extends Controller
{
    private $basePath = 'encrypted';

    private function getFullPath($path = '')
    {
        $fullPath = trim($this->basePath . '/' . $path, '/');
        return $fullPath;
    }

    private function validatePath($path)
    {
        $normalizedPath = $this->getFullPath($path);
        return str_starts_with($normalizedPath, $this->basePath);
    }

    public function index(Request $request)
    {
        $relativePath = $request->query('path', '');
        
        if (!$this->validatePath($relativePath)) {
            return response()->json(['error' => 'Invalid path'], 403);
        }

        $fullPath = $this->getFullPath($relativePath);
        $files = [];
        $directories = [];

        // Ensure the encrypted directory exists
        if (!Storage::exists($this->basePath)) {
            Storage::makeDirectory($this->basePath);
        }

        foreach (Storage::files($fullPath) as $file) {
            $files[] = [
                'name' => basename($file),
                'path' => $this->getRelativePath($file),
                'size' => Storage::size($file),
                'last_modified' => Storage::lastModified($file),
                'type' => File::extension($file),
                'is_file' => true
            ];
        }

        foreach (Storage::directories($fullPath) as $directory) {
            $directories[] = [
                'name' => basename($directory),
                'path' => $this->getRelativePath($directory),
                'is_file' => false
            ];
        }

        return response()->json([
            'current_path' => $relativePath,
            'items' => array_merge($directories, $files)
        ]);
    }

    private function getRelativePath($path)
    {
        return substr($path, strlen($this->basePath) + 1);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
            'path' => 'required|string'
        ]);

        if (!$this->validatePath($request->path)) {
            return response()->json(['error' => 'Invalid path'], 403);
        }

        $fullPath = $this->getFullPath($request->path);
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        
        Storage::putFileAs($fullPath, $file, $filename);

        return response()->json([
            'message' => 'File uploaded successfully',
            'path' => $this->getRelativePath($fullPath . '/' . $filename)
        ]);
    }

    public function createDirectory(Request $request)
    {
        $request->validate([
            'path' => 'required|string',
            'name' => 'required|string|regex:/^[a-zA-Z0-9-_\s]+$/'
        ]);

        $newPath = trim($request->path . '/' . $request->name, '/');
        
        if (!$this->validatePath($newPath)) {
            return response()->json(['error' => 'Invalid path'], 403);
        }

        $fullPath = $this->getFullPath($newPath);
        Storage::makeDirectory($fullPath);

        return response()->json([
            'message' => 'Directory created successfully',
            'path' => $this->getRelativePath($fullPath)
        ]);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'path' => 'required|string',
            'is_file' => 'required|boolean'
        ]);

        if (!$this->validatePath($request->path)) {
            return response()->json(['error' => 'Invalid path'], 403);
        }

        $fullPath = $this->getFullPath($request->path);

        if ($request->is_file) {
            Storage::delete($fullPath);
        } else {
            Storage::deleteDirectory($fullPath);
        }

        return response()->json([
            'message' => 'Item deleted successfully'
        ]);
    }

    public function download($path)
    {
        if (!$this->validatePath($path)) {
            abort(403);
        }

        $fullPath = $this->getFullPath($path);

        if (!Storage::exists($fullPath)) {
            abort(404);
        }

        return Storage::download($fullPath);
    }
}