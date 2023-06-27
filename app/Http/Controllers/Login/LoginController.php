<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Mail\NotificationMaster;
use App\Models\Area;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /* Login Principal */
    public function index()
    {
        if (Auth::check()) {
            return redirect('home');
        } else {
            return view('Login.login');
        }
    }
    /* Formulario para registro */
    public function register()
    {
        $areas = Area::select('id', 'description')->where([
            ['active', '=', 1],
        ])->get();

        return view('Login.register', compact('areas'));
    }

    /* Guardado del usuario */
    public function save(Request $request)
    {
        $validar = Validator::make($request->all(), [
            'email' => 'unique:users,email', //Valido que el correo no sea repetido
        ]);
        //Si retorna error redireccionar a la vista de alta con el mensaje de error
        if ($validar->fails()) {
            return redirect()->back()->with('error', 'El correo ingresado ya está en uso.')->withInput();
        }
        $name = $request->nombre . " " . $request->apellido;
        $user = new User;
        $user->name = trim($name);
        $user->email = trim($request->email);
        $user->image_us = "/assets/user/user.png"; //  Le asigno una imagen standart
        $user->password = bcrypt(trim($request->password)); //Encripto con Bcrypt
        $user->area_id = trim($request->area);
        if ($user->save()) {
            $data = array(
                'name' => $name,
                'email' => $request->email,
                'image' => 'public/assets/img/user.png',
            );
            FacadesMail::to('kcastillo@consorcionova.com')->send(new NotificationMaster($data));
            return redirect('/')->with('status', 'El usuario ha sido creado correctamente, espera la autorización del administrador.');
        } else {
            return redirect('/')->with('error', 'Ocurrio un error, contacta al administrador.');
        }
    }
    /* Funcion que muestra el formulario para resetear contraseña*/
    public function reset()
    {
        return view('Login.reset');
    }
}
