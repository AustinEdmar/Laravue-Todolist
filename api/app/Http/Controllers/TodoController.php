<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoStoreRequest;
use App\Http\Requests\TodoUpdateRequest;
use App\Http\Requests\TodoTaskStoreRequest;
use App\Http\Resources\TodoResource;
use App\Http\Resources\TodoTaskResource;
use App\Todo;
use Illuminate\Http\Request;
use TodoSeeder;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function index()
    {
        //retornar todas as todos que pertencem ao usuario logado
        return TodoResource::collection(auth()->user()->todos);
    }

    public function show(Todo $todo)
    {
        /* forcando o carregamento da relacao e passando na Todoresource
        automaticamente
        */
        $todo->load('tasks');
        return new TodoResource($todo);
    }

    public function store(TodoStoreRequest $request)
    {
        $input = $request->validated();
        // aqui nao precisamos criar um service
        // a todo ficara atrelado ao user actual
        $todo = auth()->user()->todos()->create($input);
       

        return new TodoResource($todo); // nao passei colection prk e apenas um registro
    }

    public function update(Todo $todo, TodoUpdateRequest $request)
    {
            $input = $request->validated();
            //nao preciso de service
            $todo->fill($input);
            $todo->save();

            return new TodoResource($todo->fresh()); // para pegar os dados actuais
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
    }

    public function addTask(Todo $todo, TodoTaskStoreRequest $request)
    {
            $input = $request->validated();
            /* chamei tasks que e a relacao e passe o metodo create que recebe os dados do input */
            $todoTask = $todo->tasks()->create($input);

            return new TodoTaskResource($todoTask);
    }
}
