<?php

session_start();
require_once 'dbConfig.php';
require '../../smtp.php';

if($_POST)
{
  $uid = $_SESSION['uid'];
  $order_id = $_POST['order-list'];
  $complaint = $_POST['complaint-text'];
  $prefix = substr(str_shuffle(str_repeat("ABCDEFGHIJKLMNOPQRSTUWXYZ", 2)), 0, 2);
  $suffix = substr(str_shuffle(str_repeat("0123456789", 5)), 0, 5);

  $token = "VV-".$prefix.$suffix;

  #finding username and email of the user & also Phone number

  $find = $db->query("SELECT * FROM registered_users WHERE uid='$uid'");

  $usr_row = $find->fetch_assoc();

  $email = $usr_row['email'];
  $name = $usr_row['user_name'];
  $phone = $usr_row['contact'];

  #upload code

  try {

    $stmt = $db_con->prepare("INSERT INTO complain(`uid`, `order_id`, `complain`, `token`, `date`) VALUES(:uid, :order_id, :complaint, :token,:time)");
    $stmt->bindParam(":uid", $uid);
    $stmt->bindParam(":order_id", $order_id);
    $stmt->bindParam(":complaint", $complaint);
    $stmt->bindParam(":token", $token);
    $stmt->bindParam(":time", date('Y-m-d H:i:s'));



    if($stmt->execute())
    {
      completeSubmit();
    }

    else {
      echo "Failed";
    }

  } catch (PDOException $e) {
    echo $e->getMessage();
  }

}

#To send Email and SMS...

function completeSubmit()
{
  echo $tt = $GLOBALS['token'];

  $order = $GLOBALS['order_id'];
  $user_email = $GLOBALS['email'];
  $user_name = $GLOBALS['name'];
  $contact = $GLOBALS['phone'];

  $subject = "Complaint Register";
  $body = "<p>Hello <b>$user_name</b>, <br><br>
            Your complaint regarding the Order Id: #$order on Veg Vendors has been registered. We will solve your issue within the next 24-48 hours. Thank you for your patience. <br>
            Your complaint token: <b><u>$tt</u></b> <br>
            You can check the status of your complaint on this link: http://www.vegvendors.in/complaint-status

            <br><br>
            Sincerely<br>
            Veg Vendors Team
          </p>";

  #sending Mail

  send_mail($user_email, $user_name, $body, $subject);


}


?>
