<html>
   
   <head>
      <title>PHP Form Validation</title>
   </head>
   
   <body>
      <?php
         
        include('../dbConfig.php');
         $name = $email = $phn = $add = $pwrd = "";
         
         if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = ($_POST["name"]);
            $email = ($_POST["email"]);
            $phn = ($_POST["phone"]);
            $add = ($_POST["address"]);
            $pwrd = ($_POST["password"]);
         }
         
        
      ?>
   
      <h2>login form</h2>
      
      <form method = "post" action = "log.php">
         <table>
            <tr>
               <td>Name:</td> 
               <td><input type = "text" name = "name"></td>
            </tr>
            
            <tr>
               <td>E-mail:</td>
               <td><input type = "text" name = "email"></td>
            </tr>
            
            <tr>
               <td>Phone no.:</td>
               <td><input type = "text" name = "phone"></td>
            </tr>
            
            <tr>
               <td>Address:</td>
               <td><textarea name = "address" rows = "5" cols = "40"></textarea></td>
            </tr>
            
			<tr>
               <td>password:</td>
               <td><textarea name = "password rows = "5" cols = "40"></textarea></td>
            </tr>
            
           
            <tr>
               <td>
                  <input type = "submit" name = "submit" value = "Submit"> 
               </td>
            </tr>
         </table>
      </form>
      
      <?php
       $query1 = $db->query("INSERT INTO loginjagriti(uname,email,phone,address,password)VALUES('$name','$email','$phn','$add','md5($pwrd)'"); 
      ?>
      
   </body>
</html>