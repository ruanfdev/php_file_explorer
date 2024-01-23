<?php
$dir_to_scan = !empty($_POST) ? $_POST['dir'] : $_SERVER['DOCUMENT_ROOT'];
$dirs = scandir($dir_to_scan);
function getFileSize($bytes) {
  $size = $bytes;
  $units = array('B', 'KB', 'MB', 'GB', 'TB');
  for ($i = 0; $size >= 1024 && $i < count($units) - 1; $i++) {
    $size /= 1024;
  }
  return round($size, 2) . ' ' . $units[$i];
}
function replaceBackSlash($str) {
  return str_replace("\\", "/", $str);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
  <title>PHP File Explorer</title>
  <style>
    button {
      background:none;
      color:#4CAF50;
      border:none; 
      padding:0;
      font:inherit;
      cursor:pointer;
    }
  </style>
</head>
<body>
<form action="" method="post">
<?php
foreach ($dirs as $dir) {
  if (is_dir($dir_to_scan.'/'.$dir)) {
    if (replaceSlash($dir_to_scan).'/'.replaceSlash($dir) != replaceSlash($_SERVER['DOCUMENT_ROOT']).'/..') {
      echo '<button name="dir" type="submit" value="'.realpath($dir_to_scan.'/'.$dir).'"><span class="fa fa-folder"></span> '.$dir.'</button><br>';
    }
  } else {
    echo '<a href="file.php?_TARGET='.realpath($dir_to_scan.'/'.$dir).'" target="_blank"><span class="fa fa-file"></span> '.$dir.' (' . getFileSize(filesize($dir_to_scan.'/'.$dir)) . ')</a><br>';
  }
}
?>
</form>
</body>
</html>
