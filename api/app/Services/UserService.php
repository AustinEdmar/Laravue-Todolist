<?php

namespace App\Services;

use App\Exceptions\UserHasBeenTaken;
use App\User;

class UserService
{
     public function update(User $user, array $input){
        /*  //vamos fazer alogica se o usuer alterar o email que ja existe n dar duplicado, porque na migration esta unico
        e ignorando o email do usuario actual
        */
        // 

        $checkEmailUser = User::where('email', $input['email'])->where('email', '!=', $user->email)->exists();
        if(!empty($input['email']) && $checkEmailUser ){
                //se isso acontecer jogo um erro
                throw new UserHasBeenTaken();

        }
            

        //chegar se estou passando a senha, se nao for vazio encripta
        if(!empty($input['password'])){
            $input['password'] = bcrypt($input['password']);
        }
        $user->fill($input);
        $user->save();

        return $user->fresh();
        
    } 
}