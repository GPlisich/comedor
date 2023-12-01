<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\permisos;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    // /**
    //  * Where to redirect users after login.
    //  *
    //  * @var string
    //  */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function show()
    {
        return view('auth.login');
    }


    
    public function loguearse(Request $request){
        try {
            /*Elimino la sesion de Laravel*/
            Auth::logout();

            $redirect_to=Session::get('redirect_to');
            /*Elimino las sesiones de PHP*/
            Session::flush();

            //Create Client object to deal with
            $client = new Client();

            $url = 'http://127.0.0.1:8001/api/login';

            $headers = [
                'Content-Type' => 'application/json',
            ];

            $data = [
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ];
            // POST request using the created object
            $postResponse = $client->request('POST',$url, [
                'headers' => $headers,
                'json' => $data,
            ]);
            // Get the response code
            $responseCode = json_decode($postResponse->getBody());
            
            
            if($postResponse->getStatusCode()===200){
                $query=permisos::where('permisos.user_id',$responseCode->user_id)
                        ->join('rol', 'permisos.rol_id', '=', 'rol.id')
                        ->join('sector', 'rol.sector_id', '=', 'sector.id')
                        ->join('users','permisos.user_id','=','users.id')
                        ->select('rol.id AS rol_id', 'rol.nombre AS rol', 'sector.id AS sector_id', 'sector.nombre AS sector','users.email')->first();
                
                if($query->rol!='Invitado'){
                    $partes = explode("@", $query->email);
                    $login = $partes[0];
                    $login_formateado = ucwords($login);
                    $primera_letra = substr($login_formateado, 0, 1);
                    $resto_nombre = ucwords(substr($login_formateado, 1));
                    $nombre =$primera_letra.' '.$resto_nombre;
                    
                    Auth::loginUsingId($responseCode->user_id);
                    Session::put(['userLogin'=>True]);
                    Session::put(['sector'=>$query->sector]);
                    Session::put(['rol'=>$query->rol]);
                    Session::put(['id'=>$responseCode->user_id]);
                    Session::put(['nameUser'=>$nombre]);

                    return response()->json([
                        "redirectTo"=>$redirect_to,
                        "message"=>'',
                    ]);
                }else{

                    Auth::loginUsingId($responseCode->user_id);
                    Session::put(['userLogin'=>True]);
                    Session::put(['sector'=>$query->sector]);
                    Session::put(['rol'=>$query->rol]);
                    Session::put(['id'=>$responseCode->user_id]);
                    Session::put(['nameUser'=>$query->rol]);

                    return response()->json([
                        "redirectTo"=>null,
                        "message"=>'',
                    ]);

                }
                
            }

        } catch (Exception $e) {
            
            $err=$e->getCode();
            if($err>=400 && $err<=499){
                return response()->json([
                    "redirectTo"=>$redirect_to,
                    "message"=>'Las credenciales no son correctas',
                ]);
            }else if($err>=500 && $err<=599){
                return response()->json([
                    "redirectTo"=>$redirect_to,
                    "message"=>'Lo sentimos hubo un error en el servidor',
                ]);
            }
        }
            
    }

    public function logout(Request $request){
        /*Elimino la sesion de Laravel*/
        Auth::logout();

        /*Elimino las sesiones de PHP*/
        Session::flush();

        return Redirect::to('/');
    }
}
