<?php
  session_start();
?>

var myJson = JSON.stringify(<?= $_SESSION["result"]; ?>);
var myData = JSON.parse(myJson);

// Scene
const scene = new THREE.Scene();
scene.background = new THREE.Color(0x303030);
var grid = new THREE.GridHelper(25, 30);
scene.add(grid);

let wireMaterial = new THREE.MeshLambertMaterial( {color: "black",wireframe: true,wireframeLinewidth: 2});

color = new THREE.Color( 0xffffff );

myData.forEach(function(obj) {
// Add a cube to the scene
const geometry = new THREE.BoxGeometry(Math.round(obj.width/100), 2, Math.round(obj.length/100)); // width, height, depth
const material = new THREE.MeshLambertMaterial({ color: color.setHex( Math.random() * 0xffffff ) });
const mesh = new THREE.Mesh(geometry, material);
mesh.position.set(Math.round(obj.xmin/100), Math.round(obj.ymin/100), 0);
myWireframe = new THREE.Mesh(geometry, wireMaterial );
scene.add(mesh);
});


//create a blue LineBasicMaterial
/*const matline = new THREE.LineBasicMaterial( { color: 0x0000ff } );
const points = [];
points.push( new THREE.Vector3( Math.round(1425.7120361328125/100), Math.round(889.09765625/100), 0 ) );
points.push( new THREE.Vector3( Math.round(394.5189514160156/100), Math.round(370.64300537109375/100), 0 ) );
points.push( new THREE.Vector3( Math.round(1297.172607421875/100), Math.round(371.31201171875/100), 0) );
points.push( new THREE.Vector3( Math.round(739.7385864257812/100), Math.round(903.8058471679688/100), 0 ) );
points.push( new THREE.Vector3( Math.round(405.8500671386719/100), Math.round(1017.2584838867188/100), 0 ) );

const geoline = new THREE.BufferGeometry().setFromPoints( points );
const line = new THREE.Line( geoline, matline );
scene.add( line );*/

// Set up lights
const ambientLight = new THREE.AmbientLight(0xffffff, 1);
scene.add(ambientLight);

const directionalLight = new THREE.DirectionalLight(0xffffff, 0.3);
directionalLight.position.set(10, 20, 0); // x, y, z
scene.add(directionalLight);

// Camera
const width = 50;
const height = width * (window.innerHeight / window.innerWidth);
const camera = new THREE.OrthographicCamera(
  width / -2, // left
  width / 2, // right
  height / 2, // top
  height / -2, // bottom
  0.1, // near
  1000 // far
);

camera.position.set(2, 5, 10);
//camera.lookAt(0, 0, 0);

// Renderer
const renderer = new THREE.WebGLRenderer({ antialias: true });
renderer.setSize(window.innerWidth, window.innerHeight);
renderer.setClearColor( 0x000000, 0);

// Add it to HTML
document.body.appendChild(renderer.domElement);
const controls = new THREE.OrbitControls( camera, renderer.domElement );

function animate() {
	requestAnimationFrame( animate );
	controls.update();
	renderer.render( scene, camera );
}
animate();
