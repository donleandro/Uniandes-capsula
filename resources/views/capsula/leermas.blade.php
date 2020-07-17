@extends('layouts.appmin', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<main>
			<!-- <div class="frame">

				<div class="frame__demos">
					<a href="index4.html" class="frame__demo">La cápsula del tiempo es una aplicación digital para enviar un mensaje a tu yo del futuro. Este mensaje te llegará en dos años-s</a>
				</div>
			</div>
			<div class="content">
				<div id="app"></div>
				<div class="content__title-wrap"> -->
					<!-- <span class="content__pretitle">Ingresa tu correo institucional sin @uniandes</span>
					<span class="content__pretitle">Ingresa tu correo Uniandes</span>
					<h2 class="content__title"><input type="text" class="text" name="foo" /></h2>
					<a class="content__link" href="#">Join us</a> -->
					<form action="{{url('upload')}}" method="POST" enctype="multipart/form-data">
						@csrf
						<!-- @method('PUT') -->
						<input type="file" name="thing" >
						<input type="submit" value="Subir" >
					</form>
				<!-- </div>
			</div> -->
		</main>
@endsection
