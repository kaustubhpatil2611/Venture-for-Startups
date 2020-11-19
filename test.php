<?php


$servername = "localhost";
$username = "root";
$password = "";
$database = "venture";

// Create connection
$link = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$link) {
  die("Connection failed: " . mysqli_connect_error());
}
//echo "Database Connected!!!";

function keygen($length)
{
	$key = '';
	list($usec, $sec) = explode(' ', microtime());
	mt_srand((float) $sec + ((float) $usec * 100000));
	
   	$inputs = array_merge(range('z','a'),range(0,9),range('A','Z'));

   	for($i=0; $i<$length; $i++)
	{
   	    $key .= $inputs{mt_rand(0,61)};
	}
	return $key;
}


?>
<?php require('header.php'); 
    
    ?>  
<?php

require 'vendor/autoload.php';
use Mailgun\Mailgun;


if(isset($_POST['forgot']) ){
    $errors=array('lmail'=>'');


    if(empty($_POST['lmail'])){
      $errors['lmail']='Email is required <br />';
    }else{
      $email= $_POST['lmail'];
      if(!preg_match('/^[a-zA-Z0-9]([a-zA-Z0-9][\.\+\-\_\!\#\$\%\&\'\*\+\-\/\=\?\^\_\`\{\|]{0,1}){0,62}([a-zA-Z0-9][\@])([\a-zA-Z0-9\-]{1,6}[\.]){1,3}([a-zA-Z]){2,4}$/',$email))
      {
        $errors['lmail']='Email must be the valid email address <br />';
      }
    }
    if(array_filter($errors)){
        echo '<div class="alert alert-warning alert-dismissible fade show">
        <strong>Warning!</strong> Please enter a valid value in all the required fields before proceeding.
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>';
      }
      else{

        $pkey=bin2hex(random_bytes(50));
        
        $query = "INSERT INTO resetpassword (pkey) VALUES ('$pkey')";
        if (mysqli_query($link,$query)) {
            $pid = mysqli_insert_id($link);
          } else {
            echo "Error: " . $query . "<br>" . mysqli_error($link);
          }
          //echo $_POST['luser'];
        if($_POST['luser']=='investor')
        {
            $email = mysqli_real_escape_string($link, $_POST['lmail']);
                    $sql = "SELECT * from investor WHERE mail = '$email'";
                    
                $result=mysqli_query($link,$sql);
                
                if($result){
                if(mysqli_num_rows($result)==1)
                {
                    $row =mysqli_fetch_array($result);
                    $id=$row['id'];
                    $mg = Mailgun::create('xxxxxxxxxxxxxxxxxx'); 
    
                    $domain = "xxxxxxxxxxxxxxxxxx.mailgun.org"; 
    
                    $mg->messages()->send($domain , [
                    'from' => 'xxxxxxxxxxxxxxxxxx.mailgun.org',
                    'to' => ''.$email.'',
                    'subject' => 'Forgot Password!',
                    'text'=> "Use the following link for password reset:http://localhost/wt/Venture-for-Startups/resetpassword.php?user=investor&id='.$id.'&pid='.$pid.'&pkey='.$pkey.'",
                    'html' => '<!DOCTYPE html>
                                <html lang="en">

                                <head>
                                <meta charset="UTF-8">
                                <title>Test mail</title>
                                <style>
                                    .wrapper {
                                    padding: 20px;
                                    color: #444;
                                    font-size: 1.3em;
                                    }
                                    a {
                                    background: #592f80;
                                    text-decoration: none;
                                    padding: 8px 15px;
                                    border-radius: 5px;
                                    color: #fff;
                                    }
                                </style>
                                </head>

                                <body>
                                <div class="wrapper">
                                    <p>Use the following link for password reset:.</p>
                        
                                    <a href="http://localhost/wt/Venture-for-Startups/resetpassword.php?user=investor&id='.$id.'&pid='.$pid.'&pkey='.$pkey.'">Reset password!</a>
                                

                                </div>
                                </body>

                                </html>'
                    ]); 
                    echo '<div class="alert alert-success alert-dismissible fade show">
                            <strong>Success!</strong> Password reset mail has been sent to you!
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>';
                }
                    else{
                        echo '<div class="alert alert-danger alert-dismissible fade show">
                            <strong>Alert!</strong> No such email exists!
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>';
                    }
                }
    
        }
        if($_POST['luser']=='customer')
        {
            
            $email = mysqli_real_escape_string($link, $_POST['lmail']);
                    $sql = "SELECT * from customeruser WHERE mail = '$email'";
                    
                $result=mysqli_query($link,$sql);
                
                if($result){
                if(mysqli_num_rows($result)==1)
                {
                    $row =mysqli_fetch_array($result);
                    $id=$row['uid'];
                    $mg = Mailgun::create('xxxxxxxxxxxxxxxxxx'); 
    
                    $domain = "xxxxxxxxxxxxxxxxxx.mailgun.org"; 
    
                    $mg->messages()->send($domain , [
                    'from' => 'xxxxxxxxxxxxxxxxxx.mailgun.org',
                    'to' => ''.$email.'',
                    'subject' => 'Forgot/Reset Password!',
                    'text'=> "Use the following link for password reset:http://localhost/wt/Venture-for-Startups/resetpassword.php?user=customer&id=$id&pid=$pid&pkey=$pkey",
                    
                    ]); 
                    echo '<div class="alert alert-success alert-dismissible fade show">
                            <strong>Success!</strong> Password reset mail has been sent to you!
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>';
                }
                    else{
                        echo '<div class="alert alert-danger alert-dismissible fade show">
                            <strong>Alert!</strong> No such email exists!
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>';
                    }
                }
    
        }
        if($_POST['luser']=='startup')
        {
            $email = mysqli_real_escape_string($link, $_POST['lmail']);
                    $sql = "SELECT * from startupusers WHERE email = '$email'";
                    
                $result=mysqli_query($link,$sql);
                
                if($result){
                if(mysqli_num_rows($result)==1)
                {
                    $row =mysqli_fetch_array($result);
                    $id=$row['id'];
                    $mg = Mailgun::create('xxxxxxxxxxxxxxxxxx'); 
    
                    $domain = "xxxxxxxxxxxxxxxxxx.mailgun.org"; 
    
                    $mg->messages()->send($domain , [
                    'from' => 'xxxxxxxxxxxxxxxxxx.mailgun.org',
                    'to' => ''.$email.'',
                    'subject' => 'Forgot Password!',
                    'text'=> "Use the following link for password reset:http://localhost/wt/Venture-for-Startups/resetpassword.php?user=startup&id='.$id.'&pid='.$pid.'&pkey='.$pkey.'",
                    'html' => '<!DOCTYPE html>
                                <html lang="en">

                                <head>
                                <meta charset="UTF-8">
                                <title>Test mail</title>
                                <style>
                                    .wrapper {
                                    padding: 20px;
                                    color: #444;
                                    font-size: 1.3em;
                                    }
                                    a {
                                    background: #592f80;
                                    text-decoration: none;
                                    padding: 8px 15px;
                                    border-radius: 5px;
                                    color: #fff;
                                    }
                                </style>
                                </head>

                                <body>
                                <div class="wrapper">
                                    <p>Use the following link for password reset:.</p>
                        
                                    <a href="http://localhost/wt/Venture-for-Startups/resetpassword.php?user=startup&id='.$id.'&pid='.$pid.'&pkey='.$pkey.'">Reset Password!</a>
                                

                                </div>
                                </body>

                                </html>'
                    ]); 
                    echo '<div class="alert alert-success alert-dismissible fade show">
                            <strong>Success!</strong> Password reset mail has been sent to you!
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>';
                }
                    else{
                        echo '<div class="alert alert-danger alert-dismissible fade show">
                            <strong>Alert!</strong> No such email exists!
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>';
                    }
                }
    
            }
    }
}
?>
 

<div class="row">
            <div class="col-12 ">
                <form id="mysform" method="POST" style="margin-top: 1em;">
                    
                    <h3 style="text-align: center;">Forgot Password</h3>
                    <hr style="border-top: 1px solid #9900cc;">
                    <br>
                    <h5>Enter Your Email</h5>
                    <hr style="border-top: 1px solid #9900cc;">
                    <div class="form-group row ">
                        
                            <label for="firstname" class="col-form-label col-12 col-md-1 ">User</label>
                            <div class="col-12 col-md-5 ">
                                <input type="text" class="form-control" id="firstname" name="luser" value='<?php echo $_GET['reg'];?>' readonly>
                            </div>

                            <label for="firstname" class="col-form-label col-12 col-md-1 ">Email</label>
                            <div class="col-12 col-md-5 ">
                                <input type="text" class="form-control" id="firstname" name="lmail" placeholder="Enter Email">
                                <span class="errorresult" style="color:red;"><?php if(isset($errors['lmail'])){echo $errors['lmail'];}?></span>
                            </div>
                        
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="offset-1 offset-md-6">
                        <button type='submit' name="forgot" value="login" class="btn btn-primary" style="background-color: #9900cc;">Send Email</button>
                        </div>
                        
                    </div>
                    
                    
                </form>
                
            </div>
        </div>
        <div class="row">
        <div class="offset-md-4">
            <br><br><br><br><br>
        </div>
        </div>
</div>
<?php require('footer.php'); 
?>   
