<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>{{ __('Capsula del Tiempo - DSIT') }}</title>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('material') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('material') }}/img/favicon.png">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <!-- CSS Files -->
    <link href="{{ asset('/css/motion-ui.css') }}" rel="stylesheet" />
    <!-- <link href="{{ asset('/css/material-dashboard.css') }}" rel="stylesheet" /> -->
    </head>
    <body class="{{ $class ?? '' }}">

      <div class="content">
				<div class="frame">
				</div>
				<div class="content__title-wrap">
					<h1 class="content__titled" style="font-size: 1.6em; color:var(--color-uniandes);">Un mensaje de tu 'yo' del pasado...</h2>
          <h2 class="content__titled" style="font-size: 1.6em; color:var(--color-uniandes);">Ha viajado en el tiempo y llega a ti un año después...</h3>
          <div class="frame__row">
            <div class="frame__mensaje">
              <img class="frame__imagen" src="{{ asset('storage/'.$imagen) }}" />
            </div>
            <div class="frame__mensaje">
              <p>{{$datos->mensaje}}</p>
            </div>
          </div>

          <img class="logo-Uniandes" style="padding-top:20px; padding-bottom:20px; clear:both; display:block; margin:auto auto;" src="{{ asset('img') }}/logoUniandes.svg" width="20%" />
          <h3 class="content__titled" style="">Gracias</h3>
				</div>
			</div>
              @stack('js')
    </body>
</html>
