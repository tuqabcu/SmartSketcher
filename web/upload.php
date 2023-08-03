<!DOCTYPE html>
<?php
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
?>
<!-- saved from url=(0057)https://fiddle.jshell.net/dhoyazan/zgb67yov/1/show/light/ -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <title>Smart Sketcher</title>

  <meta name="robots" content="noindex, nofollow">
  <meta name="googlebot" content="noindex, nofollow">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <script type="text/javascript" src="./dummy.js.download"></script>

    <link rel="stylesheet" type="text/css" href="./result-light.css">

      <link rel="stylesheet" type="text/css" href="./bootstrap.min.css">
      <script type="text/javascript" src="./jquery-3.3.1.slim.min.js.download"></script>
      <script type="text/javascript" src="./bootstrap.bundle.min.js.download"></script>
      <link rel="stylesheet" type="text/css" href="./font-awesome.min.css">


  <style id="compiled-css" type="text/css">
      /*
*
* ==========================================
* CUSTOM UTIL CLASSES
* ==========================================
*
*/
#upload {
  opacity: 0;
}

#upload-label {
  position: absolute;
  top: 50%;
  left: 1rem;
  transform: translateY(-50%);
}

.image-area {
  border: 2px dashed rgba(255, 255, 255, 0.7);
  padding: 1rem;
  position: relative;
}

.image-area::before {
  content: 'Uploaded image result';
  color: #fff;
  font-weight: bold;
  text-transform: uppercase;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size: 0.8rem;
  z-index: 1;
}

.image-area img {
  z-index: 2;
  position: relative;
}

/*
*
* ==========================================
* FOR DEMO PURPOSES
* ==========================================
*
*/
body {
  min-height: 100vh;
  background-color: #757f9a;
  background-image: linear-gradient(147deg, #757f9a 0%, #d7dde8 100%);
}

/*


    /* EOS */
  </style>

  <script id="insert"></script>


</head>
<body>
    <div class="container py-5">

    <!-- For demo purpose -->
    <header class="text-white text-center">
    <img src="./logo.png" alt=""  class="mb-4">
        <h1 class="display-4">Smart Sketcher</h1>
        <p class="lead mb-0">AI tool to detect a floor plan elements</p>

        <img src="./image.svg" alt="" width="150" class="mb-4">
    </header>

    <?php

$target_dir = "../yolov5/data/images/";
$target_file = $target_dir . 'test.png';

if(move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file))
{
    $curl = curl_init("http://localhost:5000/predict");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POST, 1);
    $response = curl_exec($curl);
    curl_close($curl);

    //$_SESSION["result"] = $response;
    echo '<center><img src="../result.png" />';
    echo $response;
}
?>
<br/><br/>
<form action="http://localhost/threejs-exercize-main/house/" method="post">
      <!--<input type="submit" value="Generate 3D" name="submit" class="btn btn-primary">-->
</form>
</center>
</div>


    <script type="text/javascript">//<![CDATA[



/*  ==========================================
    SHOW UPLOADED IMAGE
* ========================================== */
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imageResult')
                .attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

$(function () {
    $('#upload').on('change', function () {
        readURL(input);
    });
});

/*  ==========================================
    SHOW UPLOADED IMAGE NAME
* ========================================== */
var input = document.getElementById( 'upload' );
var infoArea = document.getElementById( 'upload-label' );

input.addEventListener( 'change', showFileName );
function showFileName( event ) {
  var input = event.srcElement;
  var fileName = input.files[0].name;
  infoArea.textContent = 'File name: ' + fileName;
}



  //]]></script>

  <script>
    // tell the embed parent frame the height of the content
    if (window.parent && window.parent.parent){
      window.parent.parent.postMessage(["resultsFrame", {
        height: document.body.getBoundingClientRect().height,
        slug: "zgb67yov"
      }], "*")
    }

    // always overwrite window.name, in case users try to set it manually
    window.name = "result"
  </script>




</body></html>
