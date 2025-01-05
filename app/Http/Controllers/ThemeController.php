<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ThemeController extends Controller
{
    public function getTheme()
    {
        if (Auth::check()) {
            $theme = Auth::user()->theme ?? 'light';
            return response()->json(['theme' => $theme]);
        }
        
        return response()->json(['theme' => 'light']);
    }

    public function saveTheme(Request $request)
    {
        $request->validate([
            'theme' => 'required|string|max:255'
        ]);

        if (Auth::check()) {
            $user = Auth::user();
            $user->theme = $request->theme;
            $user->save();

            return response()->json(['message' => 'Theme saved successfully']);
        }

        return response()->json(['message' => 'User not authenticated'], 401);
    }
}