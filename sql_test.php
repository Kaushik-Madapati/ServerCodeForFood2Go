<?php
$hostname = 'localhost';

/*** mysql username ***/
$username = 'root';

/*** mysql password ***/
$password = 'relax..';

/*** connect to the database ***/
$link = @mysql_connect($hostname, $username, $password);

/*** check if the link is a valid resource ***/
if(is_resource($link))
    {
    /*** if we are successful ***/
    echo 'Connected successfully';

    /*** close the connection ***/
    mysql_close($link);
    }
else
    {
    /*** if we fail to connect ***/
    echo 'Unable to connect';
    }
?>
