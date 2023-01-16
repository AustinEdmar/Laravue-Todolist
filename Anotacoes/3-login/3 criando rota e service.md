1- primeiro 
Route::prefix('v1')->group(function(){

    Route::post('login', [AuthController::class, 'login']);
});

2- vao criar servico pra alocar toda regra do negocio do login
### criei o directorio e class

namespace App\Services;

class AuthService 
{
    public function login()
    {
        dd('service');
    }
}

3- em authcontroller vou receber esse service
    private $authService;

 public function __construct(AuthService $authService)
    {
       $this->authService = $authService; 
    }
    ///este login vem da api
    public function login(){
        //este login vem do metodo ta class service
        $this->authService->login();
    }