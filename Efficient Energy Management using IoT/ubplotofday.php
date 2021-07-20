<?php
include "connect.php";
if (($_SERVER["REQUEST_METHOD"] == "POST") )
{
    if(isset($_POST['sdate']) and isset($_POST['edate']))
    {
        $sdate=$_POST['sdate'];
        $edate=$_POST['edate'];
        $i=1;
        $c=array(array("date","inenergy","outenergy"));
        $datee=date("Y-m-d") ;
        $c[$i][0]=0;
        $c[$i][1]=0;
        $c[$i][2]=0;
        $sql="SELECT date_,inenergy,outenergy FROM dayenergy WHERE date_ >='$sdate' and date_<='$edate'";
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
}
}

 
  
  echo json_encode($c);
  
 

?>