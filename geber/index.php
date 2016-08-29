<?php
  include('../config.php');
  if (count($_POST)==5) {
    $output=array();
    $output[]='<?php'."\n";
    $output[]='  $alarmtimestamp='.time().";\n";
    foreach($_POST as $key => $element) {
      switch ($key) {
        case 'vehicles':
          $output[]='  $alarm'.$key.'=array("'.implode('", "',$element).'");'."\n";
          break;
        default:
        $output[]='  $alarm'.$key.'="'.$element.'";'."\n";
      }
    }
    $output[]='?>'."\n";
    file_put_contents(dirname($_SERVER["SCRIPT_FILENAME"]).'/../alarmdata.php',$output);
    $alarmiert=true;
    if ($send_mail) {
      include('mail.php');
    }
  } else
  if (count($_POST)>0) {
    $error='<h3>KEIN Alarm ausgel&ouml;st! Da hat irgendwas gefehlt!</h3>';
  }
?>
<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Alarmmonitor</title>
    <link rel="stylesheet" href="stylesheet.css">
    <?php if ($alarmiert) echo '<meta http-equiv="refresh" content="0,../index.php">'; ?>
  </head>
  <body>
    <?php if (isset($error)) echo $error; ?>
    <form action="index.php" method="POST" name="newalarm" id="newalarm">
      <h1>Alarmgeber</h1>
      <fieldset>
        <h2>Alarmtyp</h2>
        <input type="radio" id="typered" name="type" value="red">
        <label for="typered"> Brand</label>
        <input type="radio" id="typeblue" name="type" value="blue">
        <label for="typeblue"> Hilfeleistung</label>
      </fieldset>
      <fieldset>
       <h2>Fahrzeuge</h2>
       <label> 
         <input type="checkbox" name="vehicles[]" value="LF 8/6">
         LF 8/6
       </label>
       <label>
         <input type="checkbox" name="vehicles[]" value="TSF-W">
         TSF-W
       </label>
       <label>
         <input type="checkbox" name="vehicles[]" value="MTF">
         MTF
       </label>
      </fieldset>
      <fieldset>
      <h2>Stichwort</h2>
      <label>
        <input type="text" id="code" name="code" size="30" maxlength="50" list="code">
        <datalist id="code">
          <option value="Kleinbrand">
          <option value="Mittelbrand">
          <option value="Brandmeldeanlage">
          <option value="Gro&szlig;brand">
          <option value="Verkehrsunfall">
          <option value="Sturmschaden">
          <option value="Wasserschaden">
          <option value="Allgemeine Hilfeleistung">
          <option value="T&uuml;r&ouml;ffnung">
        </datalist>
      </label>
      </fieldset>
      <fieldset>
      <h2>Einsatzort</h2>
      <label>
        <input type="text" id="location" name="location" size="30" maxlength="50">
      </label>
      </fieldset>
      <input type="submit" id="alarmieren" name="alarmieren" value="Alarmieren">
    </form>    
  </body>
</html>

