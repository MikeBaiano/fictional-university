<?php

    /*$names = ['Alice', 'Bob', 'Charlie', 'Diana', 'Ethan'];
    foreach ($names as $name) {
        echo "Hello, $name!<br>";
    }*/

    $namesA = array('Alice', 'Bob', 'Charlie', 'Diana', 'Ethan');

    $count = 0;

    while ($count < count($namesA)) {
        echo "Hello, my name is " . $namesA[$count] . "!<br>";
        $count++;
    }


    

?>

<p> Hi, my name is <?php echo $namesA[1]; ?>.</p>