<?php
//error_reporting(0);
//Only these origins are allowed to upload images *
  $accepted_origins = array("https://desk.ukcardiscount.uk", "https://www.ukcardiscount.uk");

  // Set the destination folder for image
	//$month = strtolower(date('M'));
	//$month = 'sep';
  //$year = date('Y');
  $newspath = "../../../public_html/img/pages/";
  //$newspath = "../../img/news/";

  if (!is_dir("$newspath")) {
    mkdir("$newspath", 0777, true);
}
  $imageFolder = "$newspath/";

  reset ($_FILES);
  $temp = current($_FILES);
  if (is_uploaded_file($temp['tmp_name'])){
    if (isset($_SERVER['HTTP_ORIGIN'])) {
      // same-origin requests won't set an origin. If the origin is set, it must be valid.
      if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
        header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
      } else {
        header("HTTP/1.1 403 Origin Denied");
        return;
      }
    }

    /*
      If your script needs to receive cookies, set images_upload_credentials : true in
      the configuration and enable the following two headers.
    */
    // header('Access-Control-Allow-Credentials: true');
    // header('P3P: CP="There is no P3P policy."');

    // Rewrite bad filenames
    $temp['name'] = preg_replace(array('/\s+/', '/[^a-zA-Z0-9\-\._]/', '/\.(?=.*\.)/', '/[\-]+/', '/[_]+/'), array('_', '', '_', '_', '_'), strtolower($temp['name']));

    // Verify extension
    if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "jpeg", "png"))) {

        header("HTTP/1.1 400 Invalid extension.");
        return;
    }

    // Accept upload if there was no origin, or if it is an accepted origin
    $tempname = $temp['name'];
    $filetowrite = $imageFolder . $tempname;
    $randompin = mt_rand(1000, 9999);
    $ext   = pathinfo($tempname, PATHINFO_EXTENSION);
    // If file name already exists rename
    if (file_exists($filetowrite)) {
    $tempname = basename($tempname, ".$ext") . '_' . $randompin . '.' . $ext;
    $filetowrite = $imageFolder . $tempname;
    }

    // If EXIF Orientation data exists, rotate image as required
    $savetmpname = $temp['tmp_name'];
    function correctImageOrientation($savetmpname) {
      if (function_exists('exif_read_data')) {
        $exif = exif_read_data($savetmpname);
        if($exif && isset($exif['Orientation'])) {
          $orientation = $exif['Orientation'];
          if($orientation != 1){
            $img = imagecreatefromjpeg($savetmpname);
            $deg = 0;
            switch ($orientation) {
              case 3:
                $deg = 180;
                break;
              case 6:
                $deg = 270;
                break;
              case 8:
                $deg = 90;
                break;
            }
            if ($deg) {
              $img = imagerotate($img, $deg, 0);
            }
            // then rewrite the rotated image back to the disk as $filename
            imagejpeg($img,$savetmpname,75);
          } // if there is some rotation necessary
        } // if have the exif orientation info
      } // if function exists
    }

        //Compress JPEGs without EXIF orientation
      function compressJPG($savetmpname) {
      //	$exif = exif_read_data($savetmpname);
      //	if(empty($exif) || empty($exif['Orientation'])) {
        if (exif_imagetype($savetmpname) == IMAGETYPE_JPEG) {
          $img = imagecreatefromjpeg($savetmpname);
          //unlink($savetmpname);
          imagejpeg($img,$savetmpname,75);
          }
        }

    // Move uploaded files and rotate if require
    move_uploaded_file($savetmpname, $filetowrite);
    correctImageOrientation($filetowrite);
    compressJPG($filetowrite);

    //}
    // Respond to the successful upload with JSON.
    // Use a location key to specify the path to the saved image resource.
    // { location : '/your/uploaded/image/file'}
    // echo json_encode(array('location' => $filetowrite));
    $domainpath = 'https://www.ukcardiscount.uk';
    $basenewspath = 'img/pages';
    $passpath = '/'.$basenewspath .'/'.$tempname;

    echo json_encode(array('location' => $passpath));
  } else {
    // Notify editor that the upload failed
    header("HTTP/1.1 500 Server Error");
  }
?>
