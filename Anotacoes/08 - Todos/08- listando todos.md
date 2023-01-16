criando rotas

  Route::prefix('todos')->group(function(){
        
        Route::get('', [TodoController::class, 'index']);

        
    });

2 - php artisan make:contr
oller TodoController

3 - vamos primeiro criar o metodo construct para poder personalizar o middleware apliquei no controller, e vamos fazer outro metodo para pegar todas as todos

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        //retornar todas as todos que pertencem ao usuario logado
        return auth()->user()->todos;
    }
    
}

4 - no postmam , iniciei o login no vue peguei o token e coloquei no postman e peguei os dados

5- agora vamos criar o resource de todos

php artisan make:resou
rce TodoResource
5.1 - a gente vai personalizar o que gente quer

public function toArray($request)
    {
        return [
            'id' => (integer)$this->id,
            'label' => (string)$this->label,
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
        ];
    }
6- agora vou no controller, substituir e usar o resource

    public function index()
    {
        //retornar todas as todos que pertencem ao usuario logado
        return TodoResource::collection(auth()->user()->todos);
    }


