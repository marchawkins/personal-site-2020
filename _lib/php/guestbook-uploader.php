<?php
  date_default_timezone_set("America/New_York");

  if($_POST['photo']) {
    $imgData = str_replace(' ','+',$_POST['photo']);
    $imgData =  substr($imgData,strpos($imgData,",")+1);
    $imgData = base64_decode($imgData);
    $fileName = date("Y-m-d_H-i-s").'.jpg';
    $filePath = $_SERVER['DOCUMENT_ROOT'].'/_uploads/guestbook/'.$fileName; // path where the image is going to be saved
    $file = fopen($filePath, 'w'); // write $imgData into the image file
    fwrite($file, $imgData);
    fclose($file);
    echo('/_uploads/guestbook/'.$fileName);
  } else {
    echo('error');
  }

?>