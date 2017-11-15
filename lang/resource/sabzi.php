<?php

require_once("dbConfig.php");

//$test = new sabzi();
// echo $test->sabziPrice(24,5);
//echo json_encode($test->sabziDetail("","Potato (आलू)"));

class sabzi
{

  function sabziPrice($id,$place_code)    //takes sabzi id and place code and returns its price
  {
    GLOBAL $db_con;
    GLOBAL $db;

    $query = "SELECT * FROM sabzi_price WHERE sabzi_id=:id AND place_code=:place_code";
    $stmt = $db_con->prepare($query);
    $stmt->bindParam(":id",$id);
    $stmt->bindParam(":place_code",$place_code);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();

    if( $count > 0 )
    {
      return $row["price_per_kg"];
    }
    else {      //sabzi doesnt not exist
      return 0;
    }

  }

  function sabziDetail($id,$sname)               //takes sabzi id and returns array of details in JSON
  {
    GLOBAL $db_con;
    GLOBAL $db;

    if( $sname == "" || $sname == null )
      $query = "SELECT * FROM sabziz WHERE sabzi_id='$id'";
    else
      $query = "SELECT * FROM sabziz WHERE sabzi_name='$sname'";

    $sabziDetail = $db->query($query);
    $count = $sabziDetail->num_rows;
    if( $count > 0 )
    {
      $row = $sabziDetail->fetch_assoc();
      $id = $row['sabzi_id'];
      $sabzi_name = $row['sabzi_name'];
      $category = $row['sabzi_category'];
      $pic = $row['sabzi_pic'];
      $rate = $row['rate'];

      $sabzi = array(
        "id" => "$id",
        "name" => "$sabzi_name",
        "category" => "$category",
        "pic" => "$pic",
        "rate" => "$rate"
      );

      return $sabzi;

    }
    else {
      return 0;
    }
  }

}   //class sabzi closed

?>
