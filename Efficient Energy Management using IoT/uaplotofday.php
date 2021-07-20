<?php
include "connect.php";
if (($_SERVER["REQUEST_METHOD"] == "POST") )
{
    if(isset($_POST['sdate']) and isset($_POST['edate']))
    {
        $sdate=$_POST['sdate'];
        $edate=$_POST['edate'];

    $i=1;
    $c=array(array("dtime","involtage","outvoltage","incurrent","outcurrent","inpower","outpower"));
    $datee=date("Y-m-d") ;
    $c[$i][0]=$datee;
        $c[$i][1]=0;
        $c[$i][2]=0;
        $c[$i][3]=0;
        $c[$i][4]=0;
        $c[$i][5]=0;
        $c[$i][6]=0;
        $i++;
    $sql="SELECT dtime,involtage,incurrent,inenergy,outvoltage,outcurrent,outenergy FROM energy WHERE dtime >='$sdate' and dtime<='$edate'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result))
    {
        $dt=$row["dtime"];
        $iv=$row["involtage"];
        $ov=$row["outvoltage"];
        $ii=$row["incurrent"];
        $oi=$row["outcurrent"];
        $ip=$row["inenergy"];
        $op=$row["outenergy"];
        

        $c[$i][0]=$dt;
        $c[$i][1]=floatval($iv)*10;
        $c[$i][2]=floatval($ov)*10;
        $c[$i][3]=(int)$ii;
        $c[$i][4]=(int)$oi;
        $c[$i][5]=(int)$ip;
        $c[$i][6]=(int)$op;
        $i++;
    }
    }
  echo json_encode($c);
  
}
}

?>