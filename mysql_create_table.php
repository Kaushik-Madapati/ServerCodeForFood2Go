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
    if(mysql_select_db("dish_desc", $link) === TRUE)
        {
        /*** sql to create a new table ***/
        $sql = "CREATE TABLE elements (
        item_id INT NOT NULL AUTO_INCREMENT ,
        what_is_cooked  varchar(20) NOT NULL default '',
        when_it_cooked  datetime NOT NULL default 0,
        where_latitude DECIMAL (10,6) NOT NULL default '0.0',
        where_longitude DECIMAL (10,6) NOT NULL default '0.0',
        how_many_items TINYINT NOT NULL default '0',
        how_am_i_doing TINYINT NOT NULL default '0',
        PRIMARY KEY (item_id)
        )";

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
