<?php
$UnixTimestamp=time();
 $latitude=13.0037;
 $longitude=77.9383;
// This function from sunpath.php http://www.weather-watch.com/smf/index.php/topic,39197.0.html - Thanks Jozef (Pinto)
$year = date("Y",$UnixTimestamp);
$month = date("n",$UnixTimestamp);
$day = date("j",$UnixTimestamp);
$UT = gmdate("H",$UnixTimestamp)+gmdate("i",$UnixTimestamp)/60+gmdate("s",$UnixTimestamp)/3600;
$d = round(367 * $year - (7 * ($year + (($month + 9)/12)))/4 + (275 * $month)/9 + $day - 730530);
$w = 282.9404 + 0.0000470935 * $d;
$e = 0.016709 - 0.000000001151 * $d;
$M = 356.0470 + 0.9856002585 * $d;
$M = fmod($M , 360);
if ($M < 0){$M = $M+360;}
$L = $w + $M;
$L = fmod($L , 360);
$oblecl = 23.4393 - 0.0000003563 * $d ;
$E = rad2deg(deg2rad($M) + (180/M_PI) * deg2rad($e) * sin(deg2rad($M)) * (1 + $e * cos(deg2rad($M))));
$x = cos(deg2rad($E)) - $e;
$y = sin(deg2rad($E)) * sqrt(1 - $e*$e);
$r = sqrt($x*$x + $y*$y);
$v = rad2deg(atan2( deg2rad($y), deg2rad($x)) );
$lon = $v + $w;
$lon = fmod($lon, 360);
$x_rect = $r * cos(deg2rad($lon));
$y_rect = $r * sin(deg2rad($lon));
$z_rect = 0.0;
$x_equat = $x_rect;
$y_equat = $y_rect * cos(deg2rad($oblecl)) + $z * sin(deg2rad($oblecl));
$z_equat = $y_rect * sin(deg2rad($oblecl)) + $z * cos(deg2rad($oblecl));
$r    = sqrt( $x_equat*$x_equat + $y_equat*$y_equat + $z_equat*$z_equat );
$RA   = rad2deg(atan2( deg2rad($y_equat), deg2rad($x_equat) ));
$Decl = rad2deg(atan2( deg2rad($z_equat), deg2rad(sqrt( $x_equat*$x_equat + $y_equat*$y_equat ))) );
$GMST0 = $L/15 + 12;
$SIDTIME = $GMST0 + $UT + $longitude/15;
$HA = $SIDTIME*15 - $RA;
$x = cos(deg2rad($HA)) * cos(deg2rad($Decl));
$y = sin(deg2rad($HA)) * cos(deg2rad($Decl));
$z = sin(deg2rad($Decl));
$xhor = $x * cos(deg2rad(90) - deg2rad($latitude)) - $z * sin(deg2rad(90) - deg2rad($latitude));
$yhor = $y;
$zhor = $x * sin(deg2rad(90) - deg2rad($latitude)) + $z * cos(deg2rad(90) - deg2rad($latitude));
$azimuth  = round(rad2deg(atan2($yhor, $xhor)) + 180,2);
$altitude = round(rad2deg(asin($zhor )),2);      //
$pos = array($azimuth, $altitude);
	echo($pos)

//$Sun = sun_pos(time(),$Lat,$Lon);
//$SunElev = $Sun[1];
?>