<?php 
error_reporting(1);
$conn = new mysqli("localhost","root","","techsolv");
   if(isset($_POST['submit'])){
    $fname = $_POST['fname'];
    $pnumber = $_POST['pnumber'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $msg = $_POST['msg'];
     $IP_Address = $_SERVER['REMOTE_ADDR'];
     
         
        $sql = "insert into contact_form(full_name,phone_number,email,subject,message,IP_Address) values ('$fname','$pnumber','$email','$subject','$msg','$IP_Address')";
        $data=mysqli_query($conn,$sql);
        echo "registeration successful";
   }elseif ($fname='' || $pnumber='' || $email='' || $subject='' || $msg='') {
       echo "Please insert data first";
   }    
            

?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <div>
            <h1>Register Here</h1>
            <form action="" method="post">
                <label for="fname">Full Name</label>
                    <input type="text" name="fname" placeholder="Full Name" ><br>
                    
                    <label for="pname">Phone Number</label>
                    <input type="number" name="pnumber" placeholder="Phone Number"><br>
                    
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="email" ><br>
                    <label for="subject">Subject</label>
                    <input type="text" name="subject" placeholder="subject" ><br>

                    <label for="msg">Message</label>
                    <input type="text" name="msg" placeholder="message" ><br><br>
                   
                  
			<input type="hidden" name="IP_Address" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
          
                    Submit<input type="submit" name="submit" value="submit">

            </form>
        </div>

       
    </body>
</html>

