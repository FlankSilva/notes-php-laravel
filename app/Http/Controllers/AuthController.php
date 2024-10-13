<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login() {
       return view('login');
    }

    public function loginSubmit (Request $request) {
        // form validation
        $request->validate(
            [
                'text_username' => 'required|email',
                'text_password' => 'required|min:6|max:16'
            ],
            [
                'text_username.required' => 'Usuario obrigatório',
                'text_username.email' => 'Formato de email inválido',
                'text_password.required' => 'Senha obrigatória',
                'text_password.min' => 'Senha deve ter pelo menos 6 caracteres',
                'text_password.max' => 'Senha deve ter no máximo 16 caracteres'
            ]
        );

        // get user input
        $username = $request->input('text_username');
        $password = $request->input('text_password');

        // test database connection
        try {
            DB::connection()->getPdo();
            echo 'Connection successful!';
        } catch (\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        echo 'FIM';
    }

    public function logout() {
        echo "logout";
    }
}
