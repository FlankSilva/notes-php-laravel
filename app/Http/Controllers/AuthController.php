<?php

namespace App\Http\Controllers;

use App\Models\User;
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

       // check if user exists
       $user = User::where('username', $username)
       ->where('deleted_at', NULL)
       ->first();

       if(!$user) {
        return redirect()
            ->back()
            ->withInput()
            ->with('loginError', 'Usuário ou senha inválidos.');
       }

       // check if password is correct
       if(!password_verify($password, $user->password)) {
        return redirect()
            ->back()
            ->withInput()
            ->with('loginError', 'Usuário ou senha inválidos.');
       }

       // update last login
       $user->last_login = date('Y-m-d H:i:s');
       $user->save();

       // login user
       session([
        'user' => [
            'id' => $user->id,
            'username' => $user->username
        ]
        ]);

       echo 'Login com sucesso!';
    }

    public function logout() {
        // logout from the session
        session()->forget('user');
        return redirect()->to('/login');
    }
}
