<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Smart Sketcher</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
		<link type="text/css" rel="stylesheet" href="main.css">
		<style>
			body {
				background-color: #f0f0f0;
				color: #444;
			}
		</style>
	</head>
	<body>

        <?php session_start(); ?>

		<div id="info"> <?php echo $_SESSION["result"];  ?> </div>

		<!-- Import maps polyfill -->
		<!-- Remove this when import maps will be widely supported -->
		<script async src="https://unpkg.com/es-module-shims@1.3.6/dist/es-module-shims.js"></script>

		<script type="importmap">
			{
				"imports": {
					"three": "./three.module.js"
				}
			}
		</script>

		<script type="module">

			import * as THREE from 'three';

			let container;

			let camera, scene, renderer;

			let group;

			let targetRotation = 0;
			let targetRotationOnPointerDown = 0;

			let pointerX = 0;
			let pointerXOnPointerDown = 0;

			let windowHalfX = window.innerWidth / 2;

			init();
			animate();

			function init() {

				container = document.createElement( 'div' );
				document.body.appendChild( container );

				scene = new THREE.Scene();
				scene.background = new THREE.Color( 0xf0f0f0 );

				camera = new THREE.PerspectiveCamera( 50, window.innerWidth / window.innerHeight, 1, 1000 );
				camera.position.set( 0, 100, 400 );
				scene.add( camera );

				const light = new THREE.PointLight( 0xffffff, 0.8 );
				camera.add( light );

				group = new THREE.Group();
				group.position.y = 50;
				scene.add( group );

				const loader = new THREE.TextureLoader();
				const texture = loader.load( "./brick_roughness.jpg" );

				texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
				texture.repeat.set( 0.008, 0.008 );

				function addShape( shape, extrudeSettings, color, x, y, z, rx, ry, rz, s ) {

					// flat shape with texture
					// note: default UVs generated by THREE.ShapeGeometry are simply the x- and y-coordinates of the vertices

					// flat shape
					let geometry = new THREE.ShapeGeometry( shape );
					let mesh = new THREE.Mesh( geometry, new THREE.MeshPhongMaterial( { color: color, side: THREE.DoubleSide } ) );
					mesh.position.set( x, y, z - 200 );
					mesh.rotation.set( rx, ry, rz );
					mesh.scale.set( s, s, s );
					group.add( mesh );

					for (var vc = 199; vc >= 126; vc--){
					geometry = new THREE.ShapeGeometry( shape );
					mesh = new THREE.Mesh( geometry, new THREE.MeshPhongMaterial( { color: color, side: THREE.DoubleSide } ) );
					mesh.position.set( x, y, z - vc );
					mesh.rotation.set( rx, ry, rz );
					mesh.scale.set( s, s, s );
					group.add( mesh );
				}

					 geometry = new THREE.ShapeGeometry( shape );
					mesh = new THREE.Mesh( geometry, new THREE.MeshPhongMaterial( { side: THREE.DoubleSide, map: texture } ) );
					mesh.position.set( x, y, z - 125 );
					mesh.rotation.set( rx, ry, rz );
					mesh.scale.set( s, s, s );
					group.add( mesh );
				}

				// Array
				const items =[
[74,98],
[73,99],
[72,99],
[71,100],
[71,101],
[70,102],
[70,103],
[69,104],
[70,105],
[70,106],
[71,107],
[71,216],
[70,217],
[71,218],
[71,245],
[70,246],
[70,252],
[71,253],
[71,260],
[70,261],
[70,267],
[71,268],
[71,271],
[70,272],
[70,276],
[71,277],
[71,283],
[70,284],
[70,285],
[71,286],
[71,291],
[70,292],
[70,340],
[69,341],
[69,343],
[70,344],
[70,368],
[69,369],
[69,389],
[70,390],
[70,394],
[69,395],
[69,398],
[70,399],
[70,400],
[69,401],
[69,407],
[70,408],
[70,409],
[69,410],
[70,411],
[70,415],
[69,416],
[69,421],
[70,422],
[70,423],
[69,424],
[69,432],
[70,433],
[70,436],
[69,437],
[69,440],
[70,441],
[70,445],
[69,446],
[69,451],
[70,452],
[70,455],
[69,456],
[69,749],
[68,750],
[68,752],
[69,753],
[69,885],
[68,886],
[68,887],
[69,888],
[69,966],
[71,968],
[76,968],
[77,969],
[78,969],
[79,968],
[80,968],
[81,969],
[82,969],
[83,968],
[99,968],
[100,967],
[101,967],
[102,968],
[117,968],
[118,967],
[124,967],
[125,968],
[126,968],
[127,967],
[129,967],
[130,968],
[136,968],
[137,967],
[139,967],
[140,968],
[157,968],
[158,969],
[159,969],
[160,968],
[194,968],
[195,967],
[199,967],
[200,968],
[205,968],
[206,967],
[207,967],
[208,968],
[212,968],
[213,967],
[214,967],
[215,968],
[217,968],
[218,967],
[221,967],
[223,969],
[226,969],
[227,968],
[242,968],
[243,967],
[252,967],
[253,968],
[266,968],
[269,971],
[280,971],
[282,969],
[286,969],
[288,971],
[293,971],
[294,970],
[294,956],
[295,955],
[300,955],
[301,956],
[301,959],
[302,960],
[301,961],
[301,965],
[302,966],
[301,967],
[301,968],
[302,969],
[302,970],
[303,971],
[316,971],
[317,970],
[317,967],
[316,966],
[317,965],
[317,963],
[318,962],
[319,962],
[318,962],
[317,961],
[317,957],
[319,955],
[321,955],
[322,956],
[324,956],
[325,955],
[326,955],
[327,956],
[335,956],
[336,957],
[337,957],
[338,958],
[338,959],
[339,959],
[341,961],
[341,962],
[347,968],
[347,969],
[348,970],
[349,970],
[350,971],
[354,971],
[355,970],
[356,970],
[356,969],
[352,965],
[352,963],
[347,958],
[349,956],
[356,956],
[357,957],
[358,957],
[359,956],
[381,956],
[383,958],
[383,959],
[385,961],
[385,962],
[386,963],
[386,965],
[388,967],
[388,968],
[389,969],
[389,970],
[390,971],
[394,971],
[395,970],
[395,969],
[394,968],
[394,966],
[392,964],
[392,962],
[390,960],
[390,959],
[389,958],
[389,957],
[391,955],
[395,955],
[396,956],
[399,956],
[400,955],
[401,955],
[402,956],
[419,956],
[420,957],
[421,957],
[422,956],
[425,959],
[425,962],
[426,963],
[426,970],
[427,971],
[432,971],
[433,970],
[433,966],
[432,965],
[432,962],
[431,961],
[431,958],
[433,956],
[434,957],
[460,957],
[461,958],
[461,970],
[462,971],
[467,971],
[468,970],
[468,952],
[469,951],
[472,951],
[473,950],
[474,950],
[475,951],
[495,951],
[496,950],
[497,950],
[498,951],
[498,954],
[499,955],
[499,960],
[500,961],
[500,965],
[501,966],
[501,967],
[502,968],
[502,971],
[503,972],
[503,973],
[504,974],
[504,976],
[505,977],
[505,981],
[507,983],
[507,985],
[510,988],
[510,989],
[512,991],
[512,994],
[513,994],
[515,996],
[515,997],
[519,1001],
[519,1002],
[523,1006],
[523,1007],
[524,1008],
[525,1008],
[530,1013],
[531,1013],
[535,1017],
[537,1017],
[540,1020],
[541,1020],
[543,1022],
[544,1022],
[545,1023],
[546,1023],
[547,1024],
[549,1024],
[550,1025],
[551,1025],
[552,1026],
[554,1026],
[555,1027],
[558,1027],
[559,1028],
[560,1028],
[561,1029],
[562,1029],
[563,1030],
[568,1030],
[569,1031],
[588,1031],
[591,1028],
[592,1029],
[592,1042],
[591,1043],
[591,1047],
[592,1048],
[592,1049],
[593,1050],
[612,1050],
[613,1049],
[614,1049],
[615,1050],
[619,1050],
[621,1048],
[621,1045],
[618,1042],
[618,1041],
[619,1040],
[620,1040],
[621,1039],
[621,1036],
[618,1033],
[617,1033],
[616,1034],
[615,1034],
[613,1032],
[615,1030],
[616,1031],
[618,1031],
[619,1030],
[620,1030],
[620,1029],
[621,1028],
[621,1021],
[622,1020],
[622,1002],
[621,1001],
[615,1001],
[614,1000],
[614,999],
[613,998],
[613,997],
[614,996],
[614,990],
[615,989],
[616,989],
[616,988],
[615,988],
[614,987],
[614,977],
[613,976],
[613,972],
[614,971],
[614,966],
[613,965],
[613,959],
[614,958],
[614,913],
[615,912],
[615,910],
[614,909],
[614,877],
[615,876],
[615,873],
[614,872],
[614,821],
[615,820],
[615,817],
[614,816],
[614,805],
[615,804],
[615,803],
[614,802],
[614,791],
[615,790],
[615,788],
[614,787],
[614,783],
[615,782],
[615,777],
[614,776],
[614,770],
[615,769],
[615,766],
[616,765],
[616,764],
[617,763],
[617,762],
[619,760],
[623,760],
[624,761],
[625,761],
[626,760],
[643,760],
[644,761],
[645,760],
[665,760],
[666,761],
[671,761],
[672,760],
[681,760],
[682,761],
[683,761],
[684,760],
[715,760],
[716,761],
[718,761],
[719,760],
[762,760],
[763,761],
[765,761],
[766,762],
[768,760],
[776,760],
[777,761],
[780,761],
[781,760],
[788,760],
[789,761],
[792,761],
[793,760],
[797,760],
[798,761],
[803,761],
[804,760],
[811,760],
[812,761],
[815,761],
[816,760],
[817,760],
[818,761],
[819,760],
[824,760],
[825,761],
[828,761],
[829,760],
[855,760],
[856,761],
[857,761],
[858,760],
[865,760],
[866,761],
[866,762],
[867,763],
[869,763],
[869,762],
[870,761],
[871,761],
[872,762],
[873,762],
[874,761],
[875,761],
[876,760],
[971,760],
[972,761],
[974,761],
[975,760],
[994,760],
[995,761],
[997,761],
[998,760],
[1002,760],
[1003,761],
[1005,761],
[1006,760],
[1021,760],
[1022,761],
[1023,760],
[1038,760],
[1039,761],
[1040,761],
[1041,760],
[1044,760],
[1045,761],
[1046,760],
[1048,760],
[1049,761],
[1052,761],
[1053,760],
[1054,760],
[1055,761],
[1058,761],
[1060,763],
[1062,763],
[1063,762],
[1064,762],
[1065,761],
[1067,761],
[1068,762],
[1073,762],
[1074,761],
[1081,761],
[1082,762],
[1089,762],
[1090,761],
[1096,761],
[1097,762],
[1099,762],
[1100,761],
[1102,761],
[1103,762],
[1106,762],
[1107,761],
[1110,761],
[1111,762],
[1112,762],
[1113,763],
[1113,765],
[1114,766],
[1114,768],
[1115,769],
[1145,769],
[1146,768],
[1146,763],
[1147,762],
[1148,762],
[1150,760],
[1151,761],
[1153,761],
[1154,760],
[1177,760],
[1178,761],
[1180,761],
[1181,760],
[1310,760],
[1311,761],
[1311,763],
[1312,764],
[1312,768],
[1313,769],
[1316,769],
[1317,768],
[1317,762],
[1319,760],
[1320,761],
[1320,766],
[1321,767],
[1321,768],
[1322,769],
[1325,769],
[1326,768],
[1326,762],
[1327,761],
[1328,761],
[1329,760],
[1330,760],
[1331,759],
[1331,758],
[1332,757],
[1332,746],
[1333,745],
[1333,741],
[1332,740],
[1332,739],
[1330,739],
[1328,737],
[1328,735],
[1327,734],
[1327,712],
[1328,711],
[1327,710],
[1327,498],
[1328,497],
[1328,496],
[1327,495],
[1327,487],
[1328,486],
[1328,485],
[1329,484],
[1331,484],
[1332,483],
[1333,483],
[1333,482],
[1334,481],
[1334,478],
[1333,477],
[1333,469],
[1330,466],
[1329,466],
[1328,465],
[1328,464],
[1327,463],
[1327,438],
[1328,437],
[1328,436],
[1327,435],
[1327,433],
[1328,432],
[1328,420],
[1327,419],
[1327,414],
[1328,413],
[1328,149],
[1330,147],
[1331,147],
[1332,146],
[1333,146],
[1333,145],
[1335,143],
[1335,127],
[1332,124],
[1268,124],
[1267,125],
[1266,125],
[1265,124],
[1195,124],
[1194,123],
[1189,123],
[1188,124],
[1164,124],
[1163,123],
[1162,123],
[1161,124],
[1154,124],
[1151,121],
[1151,109],
[1150,108],
[1150,105],
[1149,104],
[1149,103],
[1147,101],
[1139,101],
[1138,102],
[1137,101],
[1135,101],
[1134,102],
[1125,102],
[1122,99],
[1121,100],
[1120,100],
[1119,101],
[1114,101],
[1113,102],
[1110,102],
[1109,101],
[1104,101],
[1103,102],
[1102,101],
[1099,101],
[1098,102],
[1092,102],
[1091,101],
[1090,101],
[1089,102],
[1086,102],
[1085,101],
[1066,101],
[1065,102],
[1064,101],
[1055,101],
[1054,102],
[1053,101],
[1043,101],
[1042,102],
[1041,102],
[1040,101],
[1034,101],
[1033,102],
[1032,101],
[1027,101],
[1026,100],
[1023,100],
[1022,101],
[1001,101],
[1000,102],
[997,102],
[996,101],
[979,101],
[977,99],
[976,99],
[974,101],
[946,101],
[945,100],
[944,101],
[904,101],
[903,100],
[902,100],
[901,101],
[900,101],
[899,100],
[898,101],
[877,101],
[875,99],
[874,100],
[868,100],
[867,101],
[853,101],
[852,100],
[848,100],
[847,101],
[835,101],
[834,100],
[816,100],
[815,99],
[814,99],
[813,100],
[776,100],
[775,99],
[773,99],
[772,100],
[746,100],
[745,99],
[742,99],
[741,100],
[738,100],
[737,99],
[736,99],
[735,100],
[684,100],
[683,99],
[682,99],
[681,100],
[673,100],
[672,99],
[670,99],
[669,100],
[665,100],
[664,99],
[663,99],
[662,100],
[661,100],
[660,99],
[658,99],
[657,100],
[656,100],
[655,99],
[652,99],
[651,100],
[647,100],
[646,99],
[645,99],
[644,100],
[641,100],
[640,99],
[634,99],
[633,100],
[628,100],
[627,99],
[622,99],
[621,100],
[620,100],
[619,99],
[612,99],
[611,100],
[610,100],
[609,99],
[600,99],
[599,100],
[597,100],
[596,99],
[591,99],
[590,100],
[589,100],
[588,99],
[584,99],
[583,100],
[582,100],
[581,99],
[579,99],
[578,100],
[577,100],
[576,99],
[549,99],
[548,100],
[545,100],
[544,99],
[543,99],
[542,100],
[540,100],
[539,99],
[534,99],
[533,100],
[532,99],
[531,99],
[530,100],
[529,99],
[515,99],
[514,100],
[513,100],
[512,99],
[493,99],
[492,100],
[491,100],
[490,99],
[483,99],
[482,100],
[480,100],
[479,99],
[466,99],
[465,100],
[453,100],
[452,99],
[451,100],
[445,100],
[444,99],
[443,99],
[442,100],
[433,100],
[432,99],
[429,99],
[428,100],
[419,100],
[418,99],
[417,99],
[416,100],
[415,100],
[414,99],
[413,99],
[412,100],
[387,100],
[386,99],
[385,99],
[384,100],
[383,100],
[382,99],
[381,99],
[380,100],
[362,100],
[361,99],
[353,99],
[352,100],
[351,99],
[341,99],
[340,100],
[339,100],
[338,99],
[331,99],
[330,100],
[327,100],
[326,99],
[324,99],
[323,100],
[318,100],
[317,99],
[315,99],
[314,100],
[290,100],
[289,99],
[288,100],
[258,100],
[257,99],
[256,99],
[255,100],
[236,100],
[235,99],
[234,99],
[233,98],
[232,98],
[231,99],
[230,99],
[229,100],
[202,100],
[201,99],
[200,99],
[199,100],
[188,100],
[187,99],
[186,99],
[185,100],
[178,100],
[177,99],
[176,99],
[175,100],
[174,100],
[173,99],
[166,99],
[165,100],
[164,99],
[154,99],
[153,100],
[152,99],
[149,99],
[148,100],
[146,100],
[145,99],
[122,99],
[121,98],
[116,98],
[115,99],
[111,99],
[110,98],
[107,98],
[106,99],
[105,98],
[104,98],
[103,99],
[97,99],
[96,98],
[95,98],
[94,99],
[93,99],
[92,98],
[91,98],
[90,99],
[78,99],
[77,98]];
				const californiaPts = [];

				for(var index = 0; index < items.length; index++)
				{
					californiaPts.push( new THREE.Vector3( items[index][0], items[index][1],20 ) );	
				}
				for ( let i = 0; i < californiaPts.length; i ++ ) californiaPts[ i ].multiplyScalar( 0.25);

				const californiaShape = new THREE.Shape( californiaPts );

				const x = 0, y = 0;

				const extrudeSettings = { depth: 8, bevelEnabled: true, bevelSegments: 2, steps: 2, bevelSize: 1, bevelThickness: 1 };

				addShape( californiaShape, extrudeSettings, 0xE5E1E0, - 200, - 150, 0, 0, 0,1, 1 );
				

				renderer = new THREE.WebGLRenderer( { antialias: true } );
				renderer.setPixelRatio( window.devicePixelRatio );
				renderer.setSize( window.innerWidth, window.innerHeight );
				container.appendChild( renderer.domElement );

				container.style.touchAction = 'none';
				container.addEventListener( 'pointerdown', onPointerDown );

				window.addEventListener( 'resize', onWindowResize );

			}

			function onWindowResize() {

				windowHalfX = window.innerWidth / 2;

				camera.aspect = window.innerWidth / window.innerHeight;
				camera.updateProjectionMatrix();

				renderer.setSize( window.innerWidth, window.innerHeight );

			}

			//

			function onPointerDown( event ) {

				if ( event.isPrimary === false ) return;

				pointerXOnPointerDown = event.clientX - windowHalfX;
				targetRotationOnPointerDown = targetRotation;

				document.addEventListener( 'pointermove', onPointerMove );
				document.addEventListener( 'pointerup', onPointerUp );

			}

			function onPointerMove( event ) {

				if ( event.isPrimary === false ) return;

				pointerX = event.clientX - windowHalfX;

				targetRotation = targetRotationOnPointerDown + ( pointerX - pointerXOnPointerDown ) * 0.02;

			}

			function onPointerUp() {

				if ( event.isPrimary === false ) return;

				document.removeEventListener( 'pointermove', onPointerMove );
				document.removeEventListener( 'pointerup', onPointerUp );

			}

			//

			function animate() {

				requestAnimationFrame( animate );

				render();

			}

			function render() {

				group.rotation.y += ( targetRotation - group.rotation.y ) * 0.05;
				renderer.render( scene, camera );

			}

		</script>

	</body>
</html>
