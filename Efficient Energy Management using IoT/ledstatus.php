<?php
include "connect.php";

if (($_SERVER["REQUEST_METHOD"] == "POST") )
  
{   
  if(isset($_POST['led1']))
  {
    if($_POST['led1']=='1')
    {
       mysqli_query($conn,"UPDATE statusofled SET led1=1 WHERE id=1");
             
    }
        
    if($_POST['led1']=='0')
    {
         mysqli_query($conn,"UPDATE statusofled SET led1 = 0 WHERE id=1");
             
    }
  }
  if(isset($_POST['led2']))
  {
    if($_POST['led2']=='1')
     {
         mysqli_query($conn,"UPDATE statusofled SET led2 = 1 WHERE id=1");
         
     }
         
     if($_POST['led2']=='0')
     {
         mysqli_query($conn,"UPDATE statusofled SET led2 = 0 WHERE id=1");
         
     }
}
}
 
 
 $sql1 = "SELECT led1,led2 FROM statusofled WHERE id='1'";
       $result = $conn->query($sql1);

if ($result->num_rows > 0)
{
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $led1=(int)$row["led1"];
    $led2=(int)$row["led2"];
  }
  
  $output=array($led1,$led2);
  echo json_encode($output);
  
}


?>