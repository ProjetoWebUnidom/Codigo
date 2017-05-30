 
<!--<meta http-equiv="content-type" content="text/html;charset=utf-8">-->
<?php
$conn = new mysqli("localhost:3306", "root","", "karina");
$conn->set_charset('utf8');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn1->connect_error);
    }
    
