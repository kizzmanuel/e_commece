<?php

    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "earlymarket";


    // $server = "localhost";
    // $username = "u162278070_earlymarket";
    // $password = "0[lruXz~WNYg";
    // $dbname = "u162278070_earlymarket";
    $connectDb = mysqli_connect($server,$username,$password,$dbname);

    if (!$connectDb) {
        // echo "Failed to Connect"; or use this one below to show that an error occurred
        die ("Failed to Connect").mysqli_connect_error();
    }
