<!DOCTYPE html>
<html lang="es" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>{{ __('Capsula del Tiempo - DSIT') }}</title>
		<meta name="description" content="A Three.js powered animation that resembles the nightly view of fast cars on a road." />
		<meta name="keywords" content="webgl, three.js, cars, road, highway, lights, speed, web development, demo, javascript" />
		<meta name="author" content="Codrops" />
		<link rel="shortcut icon" href="favicon.ico">
		<link rel="stylesheet" href="https://use.typekit.net/uok8swb.css">
		<link rel="stylesheet" type="text/css" href="css/motion-ui.css" />
		<script>
		document.documentElement.className = "js";
		var supportsCssVars = function() { var e, t = document.createElement("style"); return t.innerHTML = "root: { --tmp-var: bold; }", document.head.appendChild(t), e = !!(window.CSS && window.CSS.supports && window.CSS.supports("font-weight", "var(--tmp-var)")), t.parentNode.removeChild(t), e };
		supportsCssVars() || alert("Please view this demo in a modern browser that supports CSS Variables.");
		</script>
	</head>
	<body class="capsula">
		<main>
			<div class="content">
				<div id="apps"></div>
				<div class="frame">
					<div class="frame__demos">
						<div class="frame__demo">La cápsula del tiempo es una aplicación para enviar un mensaje a tu yo del futuro. Este mensaje te llegará en dos años.</div>
					</div>
				</div>
				<div class="content__title-wrap">
					<img class="logo-Uniandes" style="padding-bottom:20px;" src="{{ asset('img') }}/logoUniandes.svg" width="20%" />
					<span class="content__pretitle">Presiona para acelerar</span>
					<h2 class="content__title">Cápsula del Tiempo</h2>
					<a class="content__link" href="{{ url('/capsula') }}">Ingresar</a>
				</div>
			</div>
		</main>
		<script src="lights/js/three.min.js"></script>
		<script src="lights/js/postprocessing.min.js"></script>
		<script src="lights/js/InfiniteLights.js"></script>
		<script src="lights/js/Distortions.js"></script>
    <script>
		(function() {

			const container = document.getElementById('app');

			const options = {
				onSpeedUp: (ev) => {
				},
				onSlowDown: (ev) => {
				},
				// mountainDistortion || LongRaceDistortion || xyDistortion || turbulentDistortion || turbulentDistortionStill || deepDistortionStill || deepDistortion
				distortion: LongRaceDistortion,

				length: 500,
				roadWidth: 15,
				islandWidth: 2,
				lanesPerRoad: 4,

				fov: 90,
				fovSpeedUp: 150,
				speedUp: 4,
				carLightsFade: 0.3,

				totalSideLightSticks: 1,
				lightPairsPerRoadWay: 100,

				// Percentage of the lane's width
				shoulderLinesWidthPercentage: 0.5,
				brokenLinesWidthPercentage: 0.1,
				brokenLinesLengthPercentage: 0.5,

				/*** These ones have to be arrays of [min,max].  ***/
				lightStickWidth: [0.12, 0.5],
				lightStickHeight: [1.3, 5],

				movingCloserSpeed: [60, 80],
				movingAwaySpeed: [120, 160],

				/****  Anything below can be either a number or an array of [min,max] ****/

				// Length of the lights. Best to be less than total length
				carLightsLength: [400 * 0.05, 400 * 0.55],
				// Radius of the tubes
				carLightsRadius: [0.01, 0.34],
				// Width is percentage of a lane. Numbers from 0 to 1
				carWidthPercentage: [0.3, 0.5],
				// How drunk the driver is.
				// carWidthPercentage's max + carShiftX's max -> Cannot go over 1.
				// Or cars start going into other lanes
				carShiftX: [-0.2, 5],
				// Self Explanatory
				carFloorSeparation: [0.05, 50],

				colors: {
					roadColor: 0xFFFFFF,
					islandColor: 0xFFFFFF,
					background: 0xE5E6ED,
					shoulderLines: 0x131318,
					brokenLines: 0x131318,
					// /***  Only these colors can be an array ***/
					// leftCars: [0xDC5B20, 0xDCA320, 0xDC2020],
					// rightCars: [0x334BF7, 0xE5E6ED, 0xBFC6F3],

					leftCars: [0xE5E6ED, 0xBFC6F3, 0xE5E6ED],
					rightCars: [0xE5E6ED, 0xE5E6ED, 0xBFC6F3],
					sticks: 0xffff00,
				}
			};

			const myApp = new App(container, options);
			myApp.loadAssets().then(myApp.init)
		})()
		</script>
	</body>
</html>
