<?php
    $Conn = mysqli_connect("localhost:3307","root","","ajax_research"); 
    //Check connection 
    if (mysqli_connect_error()) {
         echo "Failed to connect to MySQL: ". mysqli_connect_error(); 
        }

?>