<?php
include('route.php');
$alarmmail=file_get_contents('alarmmail.tpl');
$alarmmail=str_replace('%date%',date('d.m.Y'),$alarmmail);
$alarmmail=str_replace('%time%',date('H:i:s'),$alarmmail);
switch ($_POST['type']) {
  case 'red':
    $type='Brand';
    break;
  case 'blue':
    $type='Hilfeleistung';
    break;
  default:
    $type='Unbekannt';
    break;
}
$alarmmail=str_replace('%type%',$type,$alarmmail);
$alarmmail=str_replace('%code%',$_POST['code'],$alarmmail);
$alarmmail=str_replace('%location%',$_POST['location'],$alarmmail);
if ($request_route) {
  $alarmmail=str_replace('%route%',get_route($origin_location,$destination_location_base.$_POST['location']),$alarmmail);
}
else {
  $alarmmail=str_replace('%route%','',$alarmmail);
}

//echo $alarmmail;

$mime_boundary="-----=" . md5(uniqid(mt_rand(), 1));
$header = "From:".$from."<".$from_mail.">\n";
$header.= "Bcc:".$bcc."\n";
$header.= "Return-Path:".$reply."\n";
$header.= "MIME-Version: 1.0\r\n";
$header.= "Content-type: text/plain; charset=\"UTF-8\"\r\n";
$header.= "Content-Transfer-Encoding: QUOTED-PRINTABLE\r\n\r\n";
$content.= quoted_printable_encode($alarmmail)."\r\n";
mail($mailto, "Alarmmail der Leitstelle", $content, $header);
?>
