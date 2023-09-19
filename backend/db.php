<?php

    function conectar()
    {
        $host="localhost";
        $dbname = 'boomerang';
        $username = 'root';
        $password = '1234';
        $con=mysqli_connect($host,$username,$password);
        mysqli_select_db($con,$dbname);
        //$con = new PDO("sqlsrv:Server=$host;Database=$dbname",$username,$password);
        
        return $con;
    }?>
