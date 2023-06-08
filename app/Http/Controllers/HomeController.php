<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // para guardar la imagen
use Illuminate\Support\Facades\Storage; // agregar el facade de validator
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

     /* Funcion que actualiza la contraseña*/
     public function changepass(Request $request, $id)
     {
         $user = User::where('id', '=', $id)->first();
         //Valido que la contraseña que ingreso sea la misma que la que esta en la base de datos antes de ser remplazada
         if (Hash::check($request->password_act, $user->password)) {
             $user = User::findOrFail($id);
             $user->password = bcrypt(trim($request->password));
             if ($user->save()) {
                 return redirect()->back()->with('status', 'Contraseña Actualizada');
             } else {
                 return redirect()->back()->with('error', 'La contraseña no ha sido actualizada correctamente, contacta al administrador.');
             }
         } else {
             return redirect()->back()->with('error', 'Tu contraseña no coincide con la contraseña actual.');
         }

     }

     /* Funcion que actualiza la imagen del usuario */
     public function image(Request $request)
     {
         $user = User::findOrFail($request->id_usuario);
         //Valido que el archivo sea diferente de vacio
         if ($request->hasFile('imagen')) {
             $validate = Validator::make($request->all(), [
                 'imagen' => 'mimes:jpeg,bmp,png,jpg|', //Genero las extensiones validas para una imagen de perfil
             ]);
             if ($validate->fails()) {
                 return redirect()->back()->with('error', 'No es una extensión de imagen correcta.');
             } else {
                 if ($user->image_us != 'public/default.png') {
                     Storage::delete($user->image_us);
                 }
                 $user->image_us = $request->file('imagen')->store('public');
                 if ($user->save()) {
                     return redirect()->back()->with('status', 'La imagen de perfil se ha actualizado correctamente.');
                 } else {
                     return redirect()->back()->with('error', 'La imagen de perfil no ha sido actualizado correctamente, contacta al administrador.');
                 }
             }
         }
     }
}
