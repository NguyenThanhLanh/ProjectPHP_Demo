<?php
    define('host', 'localhost');
    define('user', 'root');
    define('pass', '');
    define('Db', 'qlbangiay');
    define('port', '3307');
    
    $conn = mysqli_connect(host, user, pass, Db, port);
    if ($conn) {
        mysqli_query($conn, 'SET NAME "UTF8"');
    }
    else {
        echo "Kết nối thất bại!";
    }
?>