<?php

require_once 'sendEmails.php';
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





$error = "";
if(array_key_exists("submit", $_POST)){
//if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors=array('email'=>'','password'=>'','name'=>'');


    if(empty($_POST['email'])){
      $errors['email']='Email is required <br />';
    }else{
      $email= $_POST['email'];
      if(!preg_match('/^[a-zA-Z0-9]([a-zA-Z0-9][\.\+\-\_\!\#\$\%\&\'\*\+\-\/\=\?\^\_\`\{\|]{0,1}){0,62}([a-zA-Z0-9][\@])([\a-zA-Z0-9\-]{1,6}[\.]){1,3}([a-zA-Z]){2,4}$/',$email))
      {
        $errors['email']='Email must be the valid email address <br />';
      }
    }

      if(empty($_POST['name'])){
          $errors['name']='Name is required <br />';
        }else{
          $name=$_POST['name'];
          if(!preg_match('/^[a-zA-Z\s]+$/',$name)){
            $errors['name']= 'Name must be letters and spaces only <br/>';
          }
        }


    if(empty($_POST['password'])){
        $errors['password']= "A Password is Required <br/>";
    }

    else if(empty($_POST['confirmpassword'])){
        $errors['password']= "Confirm your Password <br>";
    }

    else if($_POST['confirmpassword']!= $_POST['password'])
    {
        $errors['password']="Passwords do not match <br>";
    }
    else{
        $password=$_POST['password'];
    }

    if(array_filter($errors)){
      echo '<div class="alert alert-warning alert-dismissible fade show">
      <strong>Warning!</strong> Please enter a valid value in all the required fields before proceeding.
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      </div>';
    }
    else{
            $token = bin2hex(random_bytes(50)); // generate unique token
            $user='customer';
            
            $name = $_POST['name'];
            $email = mysqli_real_escape_string($link, $_POST['email']);
            $password = mysqli_real_escape_string($link, $_POST['password']);

            $query = "INSERT INTO customeruser (name,mail,password,token) VALUES
            ('$name','$email','$password','$token')";

          
            if(mysqli_query($link, $query)){
                    //echo "Records added successfully.";
                    session_start();
                            $userid =  mysqli_insert_id($link);
                            $_SESSION['uid'] = $userid;
                            $_SESSION['u_is_auth']=false;
                            $_SESSION['verified'] = false;
                            sendVerificationEmail($email, $token,$user,$userid);
                            echo '<div class="alert alert-success alert-dismissible fade show">
                            <strong>Success!</strong> Email has been sent to your email id for verification. Please verify to continue and then login!
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>';
                    //header("Location: customerhome.php");
                } 
            else{
                echo "ERROR: Could not able to execute <br>$query. <br>" . mysqli_error($link);
            }
    
    }

}

if(array_key_exists("lsubmit", $_POST)){
    //if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(!$_POST['lmail'] && !$_POST['lpassword'])
    {
    echo '<div class="alert alert-danger alert-dismissible fade show">
      <strong>Warning!</strong> Please enter an email and a password.
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      </div>';
    }
    else if(!$_POST['lmail'] )
    {
    echo '<div class="alert alert-danger alert-dismissible fade show">
      <strong>Warning!</strong> Please enter an email.
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      </div>';
    }
    else if(!$_POST['lpassword'])
    {
        echo '<div class="alert alert-warning alert-dismissible fade show">
      <strong>Warning!</strong> Please enter password
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      </div>';
    }
        else{
            
                $email = mysqli_real_escape_string($link, $_POST['lmail']);
                $password = $_POST['lpassword'] ;
                
                $sql = "SELECT * from customeruser WHERE mail = '$email'";
                
            $result=mysqli_query($link,$sql);
            
            if($result){
            if(mysqli_num_rows($result)==1)
            {
                $row =mysqli_fetch_array($result);
                if($row['password']==$password)
                {
                    //not done yet
                    //$_SESSION['id']=??;
                    session_start();
                    $_SESSION['uid']=$row['uid'];
                    $_SESSION['u_is_auth']=true;
                    $_SESSION['verified']=$row['verified'];
                    header("Location: customerhome.php");
    
                }
                else
                {
                    echo "Incorrect password!<br>";
                } 
            }
                else{
                    echo "ERROR: Could not able to execute <br>$query. <br>" . mysqli_error($link);
                }
            }
        }
    
    }
    


?>

<!-- To Display Error(s) in HTML ,if generated -->

<?php if ($error != "") { ?>
 <div id="error" class="p-3 mb-2 bg-danger text-white">
    
        <?php 
        echo "$error"; 
        ?>

    
    </div>   
<?php } else { ?>
    <div id="error">
    
        <?php 
        echo "$error"; 
        ?>

    
    </div>    
<?php } ?>





<?php require('header.php'); 
?>

<?php
    if(isset($_GET['reg'])){
    if($_GET['reg']=='signup'){?>
        <div class="row">
            <div class="col-12 ">
                <form method="POST" id="mysform" style="margin-top: 1em;">
                    
                    <h3 style="text-align: center;">Customer Registration</h3>
                    <hr style="border-top: 1px solid #9900cc;">
                    <br>
                    <h5>Basic Details</h5>
                    <hr style="border-top: 1px solid #9900cc;">
                    <div class="form-group row ">
                        
                            <label for="firstname" class="col-form-label col-12 col-md-1 ">Name</label>
                            <div class="col-12 col-md-5 ">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your Name">
                                <span class="errorresult" style="color:red;"><?php if(isset($errors['name'])){echo $errors['name'];}?></span>
                            </div>
                        
                            <label for="firstname" class="col-form-label col-12 col-md-1 ">Email</label>
                            <div class="col-12 col-md-5 ">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your Email">
                                <span class="errorresult" style="color:red;"><?php if(isset($errors['email'])){echo $errors['email'];}?></span>
                            </div>
                        
                    </div>
                    <br>
                    <h5>Create Password</h5>
                    <hr style="border-top: 1px solid #9900cc;">
                    <div class="form-group row ">
                        
                            <label for="firstname" class="col-form-label col-12 col-md-1 ">Enter Password</label>
                            <div class="col-12 col-md-5 ">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                                <span id="result" style="color:red;"><?php if(isset($errors['password'])){echo $errors['password'];}?></span>
                            </div>
                        
                            <label for="firstname" class="col-form-label col-12 col-md-1 ">Confirm Password</label>
                            <div class="col-12 col-md-5 ">
                                <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password">
                            </div>
                        
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="offset-1 offset-md-6">
                            <input type="submit" class="btn btn-primary" name="submit" value="Sign Up" style="background-color: #9900cc;" >
                        </div>
                        
                    </div>
                    
                    
                </form>
                
            </div>
        </div>
        <div class="row">
        <div class="offset-md-4">
            <h4><a href="customer.php?reg=login">Already have an account? Login Here</a></h4>
        </div>
        </div>
        <div class="row">
            <h2></h2>
            
        </div>
<?php } else { ?>
        <div class="row">
            <div class="col-12 ">
                <form id="mysform" method="POST" style="margin-top: 1em;">
                    
                    <h3 style="text-align: center;">Customer Log In</h3>
                    <hr style="border-top: 1px solid #9900cc;">
                    <br>
                    <h5>Enter Credentials</h5>
                    <hr style="border-top: 1px solid #9900cc;">
                    <div class="form-group row ">
                        
                            <label for="firstname" class="col-form-label col-12 col-md-1 ">Email</label>
                            <div class="col-12 col-md-5 ">
                                <input type="text" class="form-control" id="lmail" name="lmail" placeholder="Enter Email">
                            </div>
                        
                            <label for="firstname" class="col-form-label col-12 col-md-1 ">Password</label>
                            <div class="col-12 col-md-5 ">
                                <input type="password" class="form-control" id="lpassword" name="lpassword" placeholder="Enter Password">
                            </div>
                        
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="offset-1 offset-md-6">
                        <button type='submit' name="lsubmit" value="login" class="btn btn-primary" style="background-color: #9900cc;">Log In</button>
                        </div>
                        
                    </div>
                    
                    
                </form>
                
            </div>
        </div>
        <div class="row">
        <div class="offset-md-4">
            <h5 align="center"><a href="customer.php?reg=signup">Dont have an account? You can signup here!</a></h5>
            <h5 align="center"><a href="test.php?reg=customer">    Forgot password</a></h5>
            <br><br><br><br><br>
        </div>
        </div>
    </div>
    </div>
    <?php } }?>
</div>
<script>
$(document).ready(function() {
        $('#password').keyup(function() {
            $('#result').html(checkStrength($('#password').val()))
            })
            var regexpwtooweak = /^(((?=.*[a-z])|(?=.*[0-9])|(?=.*[A-Z]))([a-z0-9A-Z]{8,16}))$/;
            var regexpweak = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9]{8,16}$/; 
            var regexpwmod = /^((?=.*[a-z])|(?=.*[A-Z])|(?=.*[0-9]))(?=.*[-@.+_!#$%&'\/=?^`{|])([a-zA-Z0-9-.+_!#$%&'@*\/=?^`{|]{8,16})$/;
            var regexpwstrong = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[-@.+_!#$%&'\/=?^`{|])([a-zA-Z0-9-.+_!#$%&'@*\/=?^`{|]{8,16})$/;
            var regexpwtoostrong = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[-@.+_!#$%&'\/=?^`{|].*[-@.+_!#$%&'\/=?^`{|].*[-@.+_!#$%&'\/=?^`{|].*[-@.+_!#$%&'\/=?^`{|].*)([a-zA-Z0-9-.+_!#$%&'@*\/=?^`{|]{8,16})$/;
            function checkStrength(password) {
                

            if(regexpwtoostrong.test(password)) {
                $('#result').removeClass()
                $('#result').css("color","#003300");
                return 'Your password is Too Strong'
            }
            else if (regexpwstrong.test(password)) {
                $('#result').removeClass()
                $('#result').css("color","green");
                return 'Your password is Strong'
            }
            else if (regexpwmod.test(password)) {
                $('#result').removeClass()
                $('#result').css("color","orange");
                return 'Your password is Moderate'
            }
            else if (regexpweak.test(password)) {
                $('#result').removeClass()
                $('#result').css("color","red");
                return 'Your password is Weak'
            }
            else{
                $('#result').removeClass()
                $('#result').css('color','maroon');
                return 'Your password is Too weak'
            }
        }
    });
</script>


<?php require('footer.php'); 
?>