<?php

namespace App\Http\Controllers;

use App\Correo;
use App\User;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class CorreoController extends Controller
{
    /**
         * Muestra todos los correos.
         *
         * @param  \App\Correo  $model
         * @return \Illuminate\View\correo\index
         */
    public function index(Correo $model)
    {
        return view('correos.index', ['datos' => $model->paginate(15)]);
    }

    /**
     * Muestra el formulario para crear firmas.
     *
     * @return \Illuminate\View\firmas\create
     */
    public function create()
    {
    }


    /**
     * Almacena las firmas
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Correo  $model
     * @return mixed
     */
    public function store(Request $request, Correo $model)
    {
        $this->Validate($request, [
            'mensaje' => 'required|max:80',
            'correo' => 'required|max:20',
            'nombre' => 'required|max:20',
            'apellido' => 'required|max:20',
        ]);


        $user_id = $this->crearUsuario($request);

        $file_data = $request->input('imagen');
        $image = $request->input('imagen'); // image base64 encoded
        preg_match("/data:image\/(.*?);/", $image, $image_extension); // extract the image extension
        $image = preg_replace('/data:image\/(.*?);base64,/', '', $image); // remove the type part
        $image = str_replace(' ', '+', $image);
        $imageName = 'image_' . time() . '.' . $image_extension[1]; //generating unique file name;
        Storage::disk('public')->put($imageName, base64_decode($image));

        $mensaje = $request->input('mensaje');
        $estado = $request->input('estado');

        $model->create(
            [
                'fecha_creacion' => time(),
                'mensaje' => $mensaje,
                'usuario_id' => $user_id,
                'imagen' => $imageName,
                'estado' => $estado
            ]
        );
        return response()->json([
          $model
      ]);
    }
    public function crearUsuario(Request $request){
      $email = $request->input('correo');
      $user = User::where('email', "$email@uniandes.edu.co")->first();
      if(!$user){
        $user = new User;
        $user->name = $request->input('nombre');
        $user->surname = $request->input('apellido');
        $user->email = "$email@uniandes.edu.co";
        $user->password = '0';
        $user->save();
      }
      return $user->id;
    }
    /**
     * Muestra el formulario para editar las firmas.
     *
     * @return \Illuminate\View\firmas\edit
     */
    public function edit()
    {
    }

    /**
     * Actualiza la firma en el almacenamiento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Elimina la firma.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
