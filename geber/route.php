<?php

function get_route($origin,$location) {
  $url="http://maps.googleapis.com/maps/api/directions/json?origin=".urlencode($origin).",DE&destination=".urlencode($location).",DE&language=de";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $json=curl_exec($ch);
  curl_close($ch);
  $a = json_decode($json,true);
  $route="";
  foreach ($a['routes'][0]['legs'][0]['steps'] as $k => $v) {
    $instructions=str_replace('Das Ziel',"\nDas Ziel",$v['html_instructions']);
    $route.=$v['distance']['text'].' '.htmlspecialchars_decode(strip_tags($instructions))."\n";
  }
  return $route;
}
?>
