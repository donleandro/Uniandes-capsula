<?php

namespace App\Console;

use App\User;
use App\Correo;

use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Notifications\Notifiable;
use App\Notifications\EnviarPod;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Collection;


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
        $hoy = Carbon::now();
        $hoy->subDays(230);
        // dd($hoy->year);
        $pods = Correo::whereYear('created_at',$hoy->year)
                        ->whereMonth('created_at',$hoy->month)
                        ->whereDay('created_at','>',$hoy->day)
                        ->get();
        // dd($pods);
        $podsHoy = $pods->filter(function ($pod){
          $hoy = Carbon::now();
          $hoy->subDays(216);
          $fecha  = new Carbon($pod->created_at);
          return $fecha->diffInDays($hoy)<1;
        });
        // download('home/Aplicaciones/CapsulaDelTiempoUniandes/lea_1579029427.png'
        // dd(Storage::disk('dropbox')->get('https://www.dropbox.com/s/xn6ms6y9li82kl1/lea_1579029427.png?dl=0'));
        dd(Storage::disk('dropbox')->get('/lea_1579029427.png'));
        foreach ($podsHoy as $pod) {
          $usuario = User::where('id', $pod->usuario_id)->first();
          Notification::send($usuario, new EnviarPod( $pod ));
        }
        // $date = Carbon::now();
        // print_r($date);
        // $fecha  = new Carbon($pods->created_at);
        // $fecha->addDays(215);
        // print_r($fecha);
        // dd($fecha->diffInDays($date));

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
