<?php
    if(isset($_GET['name']) && isset($_GET['email'])){
        $name = $_GET['name'];
        $email = $_GET['email'];
        
        // display the name and email
        echo "Name: $name <br>Email: $email";
    }else{
        echo "No data was received.";
    }
?>
