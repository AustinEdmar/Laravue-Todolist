<?php

namespace App\Http\Controllers;

use App\Http\Requests\MeUpdateRequest;
use App\User;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeController extends Controller
{

    public function __construct()
    {
        //aqui ele bloqueia tudo, podemos colocar except ou only ->only();
        $this->middleware('auth:api'); 
    }

    public function index (Request $request) {

     
       return new UserResource( auth()->user() );
    }

    public function update(MeUpdateRequest $request)
    {
        
        $input = $request->validated();
            //precisamos pegar o usuario logado e passar ai
       $user = (new UserService())->update(auth()->user(), $input);

       return new UserResource($user);
            
    }
}
