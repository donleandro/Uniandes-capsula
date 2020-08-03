<?php

namespace App\Console;

use App\User;
use App\Correo;

use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use App\Mail\CapsulaMjml;

use Illuminate\Http\File;
use Spatie\Dropbox\Client;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;


class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
      $schedule->call(function () {
        $this->enviarPods();
          //
      })->everyMinute();
    }

    public function enviarPods(){
      //TODO
      //Buscar pod con correo de hace 1 año. Comparar con la fecha actual...
      //enviar esos correos
      //editar vista del capsulecorp
        // $hoy = Carbon::now();
        $hoy = Carbon::createFromFormat('Y/m/d H:i:s',  '2021/01/14 19:17:11');
        $hoy->subDays(365);
        // dd($hoy->year);
        $pods = Correo::whereYear('created_at',$hoy->year)
                        ->whereMonth('created_at',$hoy->month)
                        ->whereDay('created_at','=',$hoy->day)
                        ->get();

        foreach ($pods as $capsula) {
          $rutaImg  = $capsula->darRutaImagen();
          if( ! Storage::disk('local') -> exists('public/'.$rutaImg) ){
            $image = Storage::disk('dropbox')->get($rutaImg);
            Storage::disk('local')->put('public/'.$rutaImg, $image);
          }
          $usuario = User::where('id', $capsula->usuario_id)->first();

          Mail::to($usuario)->send(new CapsulaMjml( $rutaImg, $capsula ));
          $capsula->estado = 2;
          $capsula->save();
        }
    }
    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
