<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Correo extends Model
{
    protected $table = 'correos';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'mensaje', 'imagen', 'usuario_id', 'estado'
        ];

    public function darRutaImagen(){
      $rutaImg = explode( '/', $this->imagen );
      if( $rutaImg[0] != 'https:'){
        return null;
      }
      $rutaImg  = explode( '?' , $rutaImg[5] );
      $rutaImg = $rutaImg[0];
      return $rutaImg;
    }
}
