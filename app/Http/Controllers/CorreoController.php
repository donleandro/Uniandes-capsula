<?php

namespace App\Http\Controllers;

use App\Correo;
use App\User;
use Illuminate\Http\File;
use Spatie\Dropbox\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class CorreoController extends Controller
{

    public function __construct()
    {
        // Necesitamos obtener una instancia de la clase Client la cual tiene algunos métodos
        // que serán necesarios.
        $this->dropbox = Storage::disk('dropbox')->getDriver()->getAdapter()->getClient();
    }

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
            'mensaje' => 'required|max:2000',
        ]);
        $user_id  = Auth::id();
        $file_data = $request->input('imagen');
        $image = $request->input('imagen'); // image base64 encoded
        preg_match("/data:image\/(.*?);/", $image, $image_extension); // extract the image extension
        $image = preg_replace('/data:image\/(.*?);base64,/', '', $image); // remove the type part
        $image = str_replace(' ', '+', $image);
        $imageName = 'Usuario-'. $user_id . '_' . time() . '.' . $image_extension[1]; //generating unique file name;
        Storage::disk('dropbox')->put($imageName, base64_decode($image));

        $response = $this->dropbox->createSharedLinkWithSettings(
            $imageName,
            ["requested_visibility" => "public"]
        );

        $mensaje = $request->input('mensaje');
        $estado = $request->input('estado');
        //TODO: agregar response path
        $model->create(
            [
                'fecha_creacion' => time(),
                'mensaje' => $mensaje,
                'usuario_id' => $user_id,
                'imagen' => $response['url'],
                'estado' => $estado
            ]
        );
        return response()->json([
          $model
      ]);
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
    public function show( $id )
    {
      $rutaImg;
      $user_id  = Auth::id();
      $capsula = Correo::where('id', $id)->first();
      if( $user_id  == $capsula->usuario_id ){
        $rutaImg  = $capsula->darRutaImagen();
        if( ! Storage::disk('local') -> exists('public/'.$rutaImg) ){
          echo(".i.");
          die();
          $image = Storage::disk('dropbox')->get($rutaImg);
          Storage::disk('local')->put('public/'.$rutaImg, $image);
        }
        return view('capsula.show', ['datos' => $capsula, 'imagen' => $rutaImg]);
      }
      return redirect('/');
     }
}
