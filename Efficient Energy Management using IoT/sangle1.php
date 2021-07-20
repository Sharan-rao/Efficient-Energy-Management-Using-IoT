<?php
date_default_timezone_set("Asia/Kolkata");
function r(float $d){
   return ($d*M_PI)/180;
}
function d(float $r){
   return ($r*180)/M_PI;
}
function azi(float $lst)
{
$lat=13.0037;
$long=77.9383;
$x=date('Y');
$x=$x.'-01-01';
$date1=date_create($x);
$date2=date_create(date('Y-m-d'));//date('Y-m-d')
$diff=date_diff($date1,$date2);
$N=(int)($diff->format("%a"));
$N=$N+1;
$decangle=(23.45*sin((($N+284)/365)*M_PI*2));
$d=2*M_PI*(($N-81)/365);
$et=9.87*sin(2*$d)-7.73*cos($d)-1.5*sin($d);
$lstm=15*round($long/15);
$ast=$lst+4*($lstm-$long)+$et;
$h=($ast-720)/4;
$b1=asin((cos(r($lat))*cos(r($decangle))*cos(r($h))+sin(r($lat))*sin(r($decangle))));
$a1=acos((sin($b1)*sin(r($lat))-sin(r($decangle)))/(cos($b1)*cos(r($lat))));
$b=d($b1);
$a=d($a1);
if($h>=0)
{
   $a=180+$a;
}
else
{
   $a=180-$a;
}
return $a;
}
$startangle=round(azi(6*60));
$endangle=round(azi(19*60));
$preangle=round(azi((int)date('H')*60+((int)date('i'))));
$servoangle=round(($preangle-$startangle)*(90)/($endangle-$startangle));
if(date('H')>6 and date('H')<18)
{
   echo $servoangle;
}
else
{
   echo '55';
}



?>