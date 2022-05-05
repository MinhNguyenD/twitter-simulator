<?php
    $db = new mysqli("localhost", "root", "root", "2170-w22"); 
    if($db->connect_error){
        die("Not connected ". $db->connect_error); 
    }
?>