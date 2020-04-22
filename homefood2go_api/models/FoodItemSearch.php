<?php
class FoodItemSearch
{
    public $food_item_id;
    public $item_name;
    public $min_latitude;
    public $max_latitude;
    public $min_longitude;
    public $max_longitude;
     
    public function searchWithInBoundingBox()
    {
        $username = 'naveen';

        /*** mysql password ***/
        $password = 'relax..';

        /*** database name ***/
        $dbname = 'dish_details';

        try {
           $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);

          /*** set the PDO error mode to exception ***/
          $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         // $stmt = $dbh->prepare('SELECT * FROM elements WHERE item_id != 0');
          // $stmt = $dbh->prepare('SELECT * FROM element WHERE  where_latitude >= min_latitude AND where_latitude <= max_latitude AND where_longitude >= min_longitude AND where_longitude <= max_longitude');

          echo 'before sql statement';
          $stmt = $dbh->prepare('SELECT * FROM element WHERE  item_id != 0 ');
          echo 'after sql statement';



          /*** exceute the query ***/
          $stmt->execute();

          /* by setting the FETCH mode we can set
          *the resulting arrays to numerical or associative
          */
          //$result = $stmt->fetch(PDO::FETCH_ASSOC);
          //print_r($result);
           $emparray = array();

          $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_LAST);
          do {
             //$data = $row[0] . "\t" . $row[1] . "\t" . $row[2] . "\n";
             $emparray[] = $row;
            // print $data;
          } while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_PRIOR));
             echo json_encode($emparray);
          $dbh = null;
        }
        catch (PDOException $e)
        {
           print "Error!: " . $e->getMessage() . '<br />';
        }
    }

}
?>

   


