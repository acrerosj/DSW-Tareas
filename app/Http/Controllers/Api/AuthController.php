<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // 1. Validar los datos de entrada (email y password)
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:4',
        ]);

        // 2. Buscar al usuario
        $user = User::where('email', $credentials['email'])->first();

        // 3. Verificar la contraseña
        if ($user && Hash::check($credentials['password'], $user->password))
        {
            // 4. Crear un token de acceso
            $token = $user->createToken('auth-token')->plainTextToken;

            // 5. Devolver el token al cliente
            return response()->json([
                'token' => $token,
                'token_type' => 'Bearer',
                ], 200);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function logout(Request $request)
    {
        // Revoke the token that was used to authenticate the current request
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
