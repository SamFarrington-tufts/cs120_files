<?php

    //Gets the query value
    $n = $_GET['n'];

    //Creates an array to hold the fib sequence
    $fib = [];

    // Base case if n = 1  or n = 2, if n = 0 the fib array will remain empty
    if($n >= 1){ $fib[] = 0;}
    if($n >= 2){ $fib[] = 1;}

    // If n >= 2, uses the for loop to create the fibonacci sequence and appends it to the
    // fib array
    for($i = 2; $i < $n; $i++){
        $fib[] = $fib[$i - 1] + $fib[$i - 2];
    }

    $data = array("length" => $n, "fibSequence" => $fib);

    echo json_encode($data);

?>