<?php
class FoodItems
{
    private $_params;
     
    public function __construct($params)
    {
        $this->_params = $params;
    }
     
    public function createAction()
    {
        //create a new todo item
        $cook_item = new FoodItem();
        $cook_item->item_name = $this->_params['item_name'];
        $cook_item->time = $this->_params['time'];
	$cook_item->how_many = $this->_params['how_many'];
        $cook_item->latitude = $this->_params['latitude'] ;
        $cook_item->longitude = $this->_params['longitude'];
        $cook_item->rating = $this->_params['rating'];
     
        //pass the user's username and password to authenticate the user
        // $cook_item->save($this->_params['username'], $this->_params['userpass']);
        $cook_item->saveToDB();
        //return the todo item in array format
        return $cook_item->toArray();
    }
     
    public function readAction()
    {
        //read all the todo items
        $foodItem = array();
        if ($handle = opendir(DATA_PATH)) {
        while (false !== ($entry = readdir($handle))) {
        if ($entry == '..' or $entry == '.'){
           continue;
         }
        if ($handle2 = opendir(DATA_PATH . '/' . $entry)) {
        while (false !== ($entry2 = readdir($handle2))) {
        if ($entry2 == '..' or $entry2 == '.'){
        continue;
        }
        $foodItem[] = unserialize(file_get_contents(DATA_PATH . '/' . $entry.'/'.$entry2));
        }     
        closedir($handle2);
        }
        }
        closedir($handle);
      }
       return $foodItem;
    }
    public function searchAction() 
    {
        $result = new FoodItem();
        $result->retriveDataFromDB();
    }
    
    public function nearestAction()
    {

         $foodItemSearch = new FoodItem();
         $foodItemSearch->nearestSearch($this->_params['min_latitude'], $this->_params['max_latitude'], $this->_params['min_longitude'], $this->_params['max_longitude']);
         
        //echo $foodItemSearch; 
    }

     
    public function stringAction()
    {

         $foodItemSearch = new FoodItem();
         $foodItemSearch->stringSearch($this->_params['string_search']);         
        //echo $foodItemSearch; 
    } 
    public function updateAction()
    {
        //update a todo item
    }
     
    public function deleteAction()
    {
        //delete a todo item
    }
}
