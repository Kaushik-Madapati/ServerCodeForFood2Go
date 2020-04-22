<?php
$hostname = 'localhost';

/*** mysql username ***/
$username = 'naveen';

/*** mysql password ***/
$password = 'relax..';

/*** database name ***/
$dbname = 'dish_desc';

try {
    $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    /*** echo a message saying we have connected ***/
    echo 'Connected to database<br />';

    /*** set the PDO error mode to exception ***/
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    /*** sql to INSERT a new record ***/
    $sql = "INSERT INTO elements ( what_is_cooked, when_it_cooked, where_latitude, where_longitude, how_many_items, how_am_i_doing)  VALUES ( 'Grilled cheese' ,'2016-04-21 10:10:10', '34.1224867', '-117.7843097', '5',  '3')";

    /*** we use PDO::exec because no results are returned ***/
    $dbh->exec($sql);

    /*** echo a message to say the database was created ***/
    echo 'Recored created successfully<br />';
    }
catch(PDOException $e)
    {
    /*** echo the sql statement and error message ***/
    echo $sql . '<br />' . $e->getMessage();
    }
?>
