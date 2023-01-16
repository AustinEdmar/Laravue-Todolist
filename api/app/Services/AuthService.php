<?php

namespace App\Services;

use App\Events\ForgotPassword;
use App\Events\UserRegistered;
use App\Exceptions\LoginInvalidException;
use App\Exceptions\ResetPasswordTokenInvalidException;
use App\Exceptions\UserHasBeenTaken;
use App\Exceptions\VerifyEmailTokenInvalidException;
use App\PasswordReset;
use App\User;
use Illuminate\Support\Str;

class AuthService 
{
    public function login(string $email, string $password)
    {
        $login = [
            'email' => $email,
            'password' => $password
        ];
        //se autenticado for dirente do token, se falhar retorna o token
        if(!$token = auth()->attempt($login)){
            throw new LoginInvalidException();
        }
            return [
                'access_token' => $token,
                'token_type' => 'Bearer',
            ];
    }

    public function register(string $firstName, string $lastName, string $email, string $password)
    {
        $user = User::where('email', $email)->exists();
        if(!empty($user)){
            throw new UserHasBeenTaken();
        }
        // se for verdade, se for vazia cria uma string de 10 caracterer
        $userPassword = bcrypt($password ?? Str::random(10));
        $user = User::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'password' => $userPassword,
            'confirmation_token' => Str::random(60), //ira gerar uma string pro token
        ]);
            //apos cadastar vou chamar ele
        event(new UserRegistered($user));
        

        return $user;
    }

    public function verifyEmail(string $token)
    {
        //se o token existe vai buscar o usuario
        $user = User::where('confirmation_token', $token)->first();
        //se nao existir jogue um erro
        if(empty($user)){
            throw new VerifyEmailTokenInvalidException();
        }
        // se confirma que existe vai ser null, quando acessar a url con token limpa do banco
        $user->confirmation_token = null;
        //pra saber quando o email foi verificado
        $user->email_verified_at = now();

        $user->save();

        return $user;
    }

    public function forgotPassword(string $email)
    {
            // se existe o laravel para, sem fazer checagem
        $user = User::where('email', $email)->firstOrFail();
        
        $token = Str::random(60);

        PasswordReset::create([
            'email' => $user->email,
            'token' => $token,
            'created_at' => now()
        ]);

        // nos precisamos enviar o token via email
        event(new ForgotPassword($user, $token));

        return '';
    }

    public function resetPassword(string $email, string $password, string $token)
    {
        
            //pegando a model e comparando email e token se pertencem aos mesmo registro
        $passReset = PasswordReset::where('email', $email)->where('token', $token)->first();
        
        //se der erro
        if(empty($passReset)){
            throw new ResetPasswordTokenInvalidException();

        }
            //ter a certeza que o usuario existe
        $user = User::where('email', $email)->firstOrfail();

        $user->password = bcrypt($password);

        $user->save();
        
        //depois apago da tabela resetpassord
       
        PasswordReset::where('email', $email)->delete();

        return '';


      
    }
}

