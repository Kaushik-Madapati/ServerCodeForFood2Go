<?php
class FoodItem
{
    public $food_item_id;
    public $item_name;
    public $time;
    public $how_many;
    public $latitude;
    public $longitude;
    public $rating;
     
    public function save($username, $userpass)
    {
        //get the username/password hash
        $userhash = sha1("{$username}_{$userpass}");
        if( is_dir(DATA_PATH."/{$userhash}") === false ) {
            mkdir(DATA_PATH."/{$userhash}");
        }
         
        //if the $todo_id isn't set yet, it means we need to create a food new  item
        if( is_null($this->food_item_id) || !is_numeric($this->food_item_id) ) {
            //the food id is the current time
            $this->food_item_id = time();
        }
         
        //get the array version of this food item
        $food_item_array = $this->toArray();
         
        //save the serialized array version into a file
        $success = file_put_contents(DATA_PATH."/{$userhash}/{$this->food_item_id}.txt", serialize($food_item_array));
         
        //if saving was not successful, throw an exception
        if( $success === false ) {
            throw new Exception('Failed to save todo item');
        }
         
        //return the array version
        return $food_item_array;
    }
     
    public function toArray()
    {
        //return an array version of the food item
        return array(
            'food_item_id' => $this->food_item_id,
            'item_name' => $this->item_name,
            'time' => $this->time,
            'how_many' => $this->how_many,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'rating' => $this->rating
        );
    }
    public function saveToDB()
    {
       $dish_item_array = $this->toArray();
       
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
        //echo 'Connected to database<br />';
        echo $this->item_name . "\n" ;
        echo $dish_item_array->item_name ; 

    /*** set the PDO error mode to exception ***/
       $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    /*** sql to INSERT a new record ***/
        $sql = "INSERT INTO elements ( what_is_cooked, when_it_cooked, where_latitude, where_longitude, how_many_items, how_am_i_doing)  VALUES ( '$this->item_name', '$this->time', '$this->latitude', '$this->longitude', '$this->how_many', '$this->rating' )";


    /*** we use PDO::exec because no results are returned ***/
       $dbh->exec($sql);

    /*** echo a message to say the database was created ***/
       // echo 'Recored created successfully<br />';
      } 
      catch(PDOException $e)
      { 
    /*** echo the sql statement and error message ***/
       echo $sql . '<br />' . $e->getMessage();
      }
    }
     public function readDataFromDB()
     {
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
                  
                 $emparray = array();

    		$row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_LAST);
    		do {
      			$data = $row[0] . "\t" . $row[1] . "\t" . $row[2] . "\n";
      			print $data; 
                         
                       $emparray[] = $row;
    		} while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_PRIOR));
                  
                 echo json_encode($emparray);
    		$dsn = null;
 	}   		
        catch (PDOException $e)
        {
           print "Error!: " . $e->getMessage() . '<br />';
         }  
   }
     public function retriveDataFromDB()
    {
     
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
    		$stmt = $dbh->prepare('SELECT * FROM elements WHERE item_id  > 0 ');

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
      	//		$data = $row[0] . "\t" . $row[1] . "\t" . $row[2] . "\n";
      	//		print $data; 
                         
                       $emparray[] = $row;
    		} while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_PRIOR));
                  
                 echo json_encode($emparray);
    		$dsn = null;
 	}   		
        catch (PDOException $e)
        {
           print "Error!: " . $e->getMessage() . '<br />';
        }
    }
    public  function nearestSearch($min_latitude, $max_latitude, $min_longitude,$max_longitude)
   {

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
                
    		 $query_string = " SELECT * FROM elements WHERE  where_latitude BETWEEN $min_latitude AND $max_latitude  AND where_longitude BETWEEN $min_longitude AND $max_longitude "; 
                
    		//$query_string = " SELECT * FROM elements WHERE  where_latitude BETWEEN $min_latitude AND $max_latitude "; 

              //  echo $query_string;

              //  echo $query_string;

    		/*** exceute the query ***/
                
                 
    		$stmt = $dbh->prepare($query_string);

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
      	//		$data = $row[0] . "\t" . $row[1] . "\t" . $row[2] . "\n";
      	//		print $data; 
                         
                       $emparray[] = $row;
    		} while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_PRIOR));
                  
                 echo json_encode($emparray);
    		$dsn = null;
 	}   		
        catch (PDOException $e)
        {
           print "Error!: " . $e->getMessage() . '<br />';
        }
    }
    public function stringSearch($searchString)
    {
         /*** mysql hostname ***/
	$hostname = 'localhost';

	/*** mysql username ***/
	$username = 'naveen';

	/*** mysql password ***/
	$password = 'relax..';

	/*** database name ***/
	$dbname = 'dish_desc';

        $finalSearchString = "'%";
        $finalSearchString .= $searchString;
        $finalSearchString .= "%'";
       
	try {
    		$dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
               
    		/*** set the PDO error mode to exception ***/
    		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               // echo $searchString;
                
    		$query_string = " SELECT * FROM elements WHERE  what_is_cooked LIKE $finalSearchString ";

               // echo $query_string;

    		/*** exceute the query ***/
                
                 
    		$stmt = $dbh->prepare($query_string);

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
                         
                       $emparray[] = $row;
    		} while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_PRIOR));
                  
                 echo json_encode($emparray);
    		$dsn = null;
 	}   		
        catch (PDOException $e)
        {
           print "Error!: " . $e->getMessage() . '<br />';
        }
    }
}
?>

   
   


