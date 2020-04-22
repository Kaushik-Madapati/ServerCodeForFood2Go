<?php
$hostname = 'localhost';

/*** mysql username ***/
$username = 'naveen';

/*** mysql password ***/
$password = 'relax..';

/*** connect to the database ***/
$link = @mysql_connect($hostname, $username, $password);

/*** check if the link is a valid resource ***/
if(is_resource($link))
    {
    /*** if we are successful ***/
    echo 'Connected successfully<br />';

    /*** select the database we wish to use ***/
    if(mysql_select_db("food_item_desc", $link) === TRUE)
        {
        /*** sql to create a new table ***/
        $sql = "ALTER TABLE elements MODIFY item_id INT NOT NULL AUTO_INCREMENT ";
     

        /*** run the sql query ***/
        if(mysql_query($sql, $link))
            {
            echo 'New table created successfully<br />';
            }
        else
            {
            echo 'Unable to create table: <br />' . $sql .'<br />' . mysql_error();
            }
        }
    /*** if we are unable to select the database show an error ***/
    else
        {
        echo 'Unable to select database';
        }
    /*** close the connection ***/
    mysql_close($link);
    }
else
    {
    /*** if we fail to connect ***/
    echo 'Unable to connect';
    }
?>
