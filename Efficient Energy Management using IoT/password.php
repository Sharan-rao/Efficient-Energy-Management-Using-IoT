<?php
include "connect.php";
if (($_SERVER["REQUEST_METHOD"] == "POST") )  
{ 
    
    if($_POST['password']=='hi')
    {
        echo "1";
    }
    else{
        echo "0";
    }

}

?>