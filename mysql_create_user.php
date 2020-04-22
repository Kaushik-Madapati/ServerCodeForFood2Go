<?php
$hostname = 'localhost';

/*** mysql username ***/
$username = 'root';

/*** mysql password ***/
$password = 'relax..';

try {
    $dbh = new PDO("mysql:host=$hostname;dbname=mysql", $username, $password);
    /*** echo a message saying we have connected ***/
    echo 'Connected to database<br />';

    /*** set the PDO error mode to exception ***/
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    /*** sql to create a user ***/
    $sql = "GRANT ALL ON dish_desc.* TO naveen@localhost IDENTIFIED BY 'relax..'";

    /*** we use PDO::exec because no results are returned ***/
    $dbh->exec($sql);

    /*** echo a message to say the database was created ***/
    echo 'Database created successfully<br />';
    }
catch(PDOException $e)
    {
    /*** echo the sql statement and error message ***/
    echo $sql . '<br />' . $e->getMessage();
    }
?>
