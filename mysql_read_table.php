<?php 

/*** mysql hostname ***/
$hostname = 'localhost';

/*** mysql username ***/
$username = 'naveen';

/*** mysql password ***/
$password = 'relax..';

/*** database name ***/
$dbname = 'dish_desc';

try {
    $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);

    /*** set the PDO error mode to exception ***/
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $dbh->prepare('SELECT * FROM elements WHERE item_id != 0'); 

    /*** exceute the query ***/
    $stmt->execute(); 

    /* by setting the FETCH mode we can set
     *the resulting arrays to numerical or associative
    */
    //$result = $stmt->fetch(PDO::FETCH_ASSOC);
    //print_r($result);

    $row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);
    do {
      $data = $row[0] . "\t" . $row[1] . "\t" . $row[2] . "\t" . $row[3] . "\t". $row[4] . "\t" . $row[5].  "\n";
      print $data;
    } while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_PRIOR));
    $dsn = null;
    }  
    catch (PDOException $e) 
    { 
    print "Error!: " . $e->getMessage() . '<br />'; 
    } 
?>  
