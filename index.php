<?php
  include('config.php');
  include('alarmdata.php');
?>
<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=<?php echo $viewport_width;?>">
    <title><?php echo $title;?></title>
    <link rel="stylesheet" href="stylesheet.css">
    <script src="javascript.js" charset="utf-8"></script>
    <meta http-equiv="refresh" content="<?php echo $refresh;?>">
  </head>
  <body>
<?php
  if ((time()-$alarmtimestamp) < ($refresh)) {
    echo '<audio id="gong" src="'.$gong.'" autoplay></audio>';
  }
  if ((time()-$alarmtimestamp) < ($display_time)) {
    switch ($alarmtype) {
      case "red":
        echo '<div id="kreisr1"></div><div id="kreisr2"></div>';
        echo '<div id="fahrzeuge">'.implode(', ',$alarmvehicles).'</div>';
        echo '<div id="stichwort">'.$alarmcode.'</div>';
        echo '<div id="einsatzort">'.$alarmlocation.'</div>';
        break;
      case "blue":
        echo '<div id="kreisb1"></div><div id="kreisb2"></div>';
        echo '<div id="fahrzeuge">'.implode(', ',$alarmvehicles).'</div>';
        echo '<div id="stichwort">'.$alarmcode.'</div>';
        echo '<div id="einsatzort">'.$alarmlocation.'</div>';
        break;
      default:
        echo '<div id="kreisg1"></div>';
        break;
    }
  }
  else {
    echo '<div id="kreisg1"></div>';
  }
?>
  </body>
</html>

