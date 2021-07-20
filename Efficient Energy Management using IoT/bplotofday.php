<?php
include "connect.php";

$i=1;
$c=array(array("date","inenergy","outenergy"));
$datee=date("Y-m-d") ;
$c[$i][0]=0;
$c[$i][1]=0;
$c[$i][2]=0;
$date1=date_create($datee);
date_add($date1,date_interval_create_from_date_string("-7 days"));
$date2=date_format($date1,"Y-m-d");
$sql="SELECT date_,inenergy,outenergy FROM dayenergy WHERE date_>='$date2'";
 $result = mysqli_query($conn, $sql);
 if (mysqli_num_rows($result) > 0) {
   while($row = mysqli_fetch_assoc($result))
  {
    $dt=$row["date_"];
    $ie=$row["inenergy"];
    $oe=$row["outenergy"];
    

    $c[$i][0]=$dt;
    $c[$i][1]=(int)$ie;
    $c[$i][2]=(int)$oe;
    $i++;
  }
 }

 
  
 echo json_encode($c);
  
 

?>