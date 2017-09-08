<?php

/*funciones PHP*/

function obtenerIP() {
  if (isset($_SERVER["HTTP_CLIENT_IP"])) {
    return $_SERVER["HTTP_CLIENT_IP"];
  } elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
   return $_SERVER["HTTP_X_FORWARDED_FOR"];
 } elseif (isset($_SERVER["HTTP_X_FORWARDED"])) {
  return $_SERVER["HTTP_X_FORWARDED"];
} elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])) {
  return $_SERVER["HTTP_FORWARDED_FOR"];
} elseif (isset($_SERVER["HTTP_FORWARDED"])) {
  return $_SERVER["HTTP_FORWARDED"];
} else   {
  return $_SERVER["REMOTE_ADDR"];
}
}

function url_get_contents ($url) {
  if (function_exists('curl_exec')){ 
    $conn = curl_init($url);
    curl_setopt($conn, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($conn, CURLOPT_FRESH_CONNECT,  true);
    curl_setopt($conn, CURLOPT_RETURNTRANSFER, 1);
    $url_get_contents_data = (curl_exec($conn));
    curl_close($conn);
  }elseif(function_exists('file_get_contents')){
    $url_get_contents_data = file_get_contents($url);
  }elseif(function_exists('fopen') && function_exists('stream_get_contents')){
    $handle = fopen ($url, "r");
    $url_get_contents_data = stream_get_contents($handle);
  }else{
    $url_get_contents_data = false;
  }
  return $url_get_contents_data;
}


?>