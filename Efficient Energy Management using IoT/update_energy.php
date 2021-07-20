<?php
include "connect.php";
$ic=0;
$iv=0;
$oc=0;
$ov=0;
$ie=0;
$oe=0;

if ($_SERVER["REQUEST_METHOD"] == "POST")
{   $sqll=mysqli_query($conn,"SELECT dtime FROM energy ORDER BY id DESC LIMIT 1");
    $ldate=mysqli_fetch_row($sqll);
    $ldate=implode($ldate);
    $ldate=date_create($ldate);
    $pdate=date_create(date("Y-m-d H:i:s"));
    $diff=date_diff($ldate,$pdate);
    $diffmin=(int)$diff->format("%i");
    $diffhour=(int)$diff->format("%H");
    $diffday=(int)$diff->format("%a");
    $diffsec=(int)$diff->format("%s");
    $nday=date_diff(date_create(date_format($ldate,"Y-m-d")),date_create(date("Y-m-d")));
    $nextday=(int)$nday->format("%a");
    $ic=$_REQUEST['ic'];
    $iv=$_REQUEST['iv'];
    $oc=$_REQUEST['oc'];
    $ov=$_REQUEST['ov'];
    $date=date("Y-m-d H:i:s");
    $ie=$ic*$iv;
    $oe=$oc*$ov;
    $datee=date("Y-m-d");
    $sql=mysqli_query($conn,"INSERT INTO energy(dtime,involtage,incurrent,inenergy,outvoltage,outcurrent,outenergy) VALUES('$date',$iv,$ic,$ie,$ov,$oc,$oe)");
    if($nextday==0 and $diffday==0 and $diffhour==0 and $diffmin<=1)
    {
        $sqlll=mysqli_query($conn,"SELECT id,inenergy,outenergy FROM dayenergy ORDER BY id DESC LIMIT 1");
        $eday=mysqli_fetch_row($sqlll);
        $inenergy=(int)$eday[1]+$ie*($diffsec+$diffmin*60)/1000;
        $outenergy=(int)$eday[2]+$oe*($diffsec+$diffmin*60)/1000;
   $id=(int)$eday[0];
        $sqln=mysqli_query($conn,"UPDATE dayenergy set date_='$datee',inenergy=$inenergy,outenergy=$outenergy where id=$id");
        
    }
    if($nextday>0)
    {
        $sqln=mysqli_query($conn,"INSERT INTO dayenergy(date_,inenergy,outenergy) VALUES('$datee',0,0)");
    }


} 








?>