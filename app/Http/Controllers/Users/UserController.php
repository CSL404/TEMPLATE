<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

// agregar el facade de validator

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth"); // Protegemos las rutas solo si estan logeados
        $this->middleware("check_banned"); //Middleware que valida que el usuario esta activo
    }
    public function index()
    {
        $data = User::select('users.id', 'name', 'email', 'users.active', 'admin', 'areas.id as area_id', 'areas.description as area')
            ->join('areas', 'users.area_id', '=', 'areas.id')
            ->get();
        return view('Users.list', compact('data'));
    }

    public function create()
    {
        $data = User::select('users.id', 'name', 'email', 'users.active', 'admin', 'areas.id as area_id', 'areas.description as area')
            ->join('areas', 'users.area_id', '=', 'areas.id')
            ->get();
        $areas = Area::select('id', 'description')->get();

        return view('Users.create', compact('data', 'areas'));
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'correo' => 'unique:users,email', //Valido que el correo no sea repetido
        ]);
        //Si retorna error redireccionar a la vista de alta con el mensaje de error
        if ($validate->fails()) {
            return redirect()->back()->with('error', 'El correo ingresado ya está en uso');
        }
        $user = new User;
        $user->name = trim($request->nombre);
        $user->email = trim($request->correo);
        $user->password = bcrypt(trim($request->password)); //Encripto con Bcryp
        $user->area_id = trim($request->area_id);
        $user->admin = $request->tipo;
        $user->image_us = 'public/assets/img/user.png'; //  Le asigno una imagen standart
        if ($user->save()) {
            return redirect('users')->with('success', 'El usuario ha sido creado correctamente');
        } else {
            return redirect('users')->with('error', 'El usuario no ha sido creado correctamente, contacta al administrador.');
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        try
        {
            decrypt($id, false); // se pone en false porque solo permitia 8 bytes: https://stackoverflow.com/questions/51763473/laravel-decrypt-errorexception-unserialize-error-at-offset-0-of-2-bytes
        } catch (DecryptException $e) {
            return view('Errors.404');
        }

        $data = User::select('users.id', 'name', 'email', 'users.active', 'admin', 'areas.id as area_id', 'areas.description as area')
            ->join('areas', 'users.area_id', '=', 'areas.id')
            ->where('users.id', Crypt::decryptString($id))
            ->first();

        $areas = Area::select('id', 'description')->get();

        return view('Users.update', compact('data', 'areas'));
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'correo' => 'unique:users,email,' . $id . ',id',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('error', 'El correo ya está en uso');
        }

        $user = User::findOrFail($id);
        $user->name = trim($request->nombre);
        $user->email = trim($request->correo);
        $user->area_id = trim($request->area_id);
        $user->admin = $request->tipo;
        if (!empty($request->password) && isset($request->cambio)) {
            $user->password = bcrypt(trim($request->password));
        }
        $user->area_id = trim($request->area_id);
        if ($user->image_us != 'public/assets/img/user.png') {
            $user->image_us = $user->image_us;
        } else {
            $user->image_us = "public/assets/img/user.png";
        }
        if ($user->save()) {
            return redirect('users')->with('success', 'El usuario se ha actualizado correctamente');
        } else {
            return redirect('users')->with('error', 'El usuario no ha sido actualizado correctamente, contacta al administrador.');
        }
    }

    public function destroy($id)
    {
        $data = User::where('id', $id)->first();
        if ($data->active == 1) {
            $data->active = 0;
            $message = "Usuario Desactivado";
        } else {
            $data->active = 1;
            $message = "Usuario Activado";
        }
        $data->save();
        return redirect()->back()->with('success', $message);
    }
}
