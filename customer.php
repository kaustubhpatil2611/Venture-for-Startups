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





$error = "";
if(array_key_exists("submit", $_POST)){
//if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $error = "";

    if(! $_POST['email']){
        $error .= "An Email Address is Required <br>";
    }

    if(! $_POST['password']){
        $error .= "A Password is Required <br>";
    }

    if(! $_POST['confirmpassword']){
        $error .= "Confirm your Password <br>";
    }

    if($_POST['confirmpassword']!= $_POST['password'])
    {
        $error.="Passwords do not match <br>";
    }

    if($error != ""){
        $error = "<p>There were error(s) in your form! </p>".$error;
    }
    else{
            $name = $_POST['name'];
            $email = mysqli_real_escape_string($link, $_POST['email']);
            $password = mysqli_real_escape_string($link, $_POST['password']);

            $query = "INSERT INTO customeruser (name,mail,password) VALUES
            ('$name','$email','$password')";

          
            if(mysqli_query($link, $query)){
                    //echo "Records added successfully.";
                    header("Location: customerhome.php");
                } 
            else{
                echo "ERROR: Could not able to execute <br>$query. <br>" . mysqli_error($link);
            }
    
    }

}

if(array_key_exists("lsubmit", $_POST)){
    //if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "<button>1234</button>";
        $error = "";
        
        if(! $_POST['lmail']){
            $error .= "An Email Address is Required <br>";
        }
    
        if(! $_POST['lpassword']){
            $error .= "A Password is Required <br>";
        }
    
        if($error != ""){
            echo "<button>1234</button>";
            $error = "<p>There were error(s) in your form! </p>".$error;
        }
        else{
            
                $email = mysqli_real_escape_string($link, $_POST['lmail']);
                $password = $_POST['lpassword'] ;
                
                $sql = "SELECT * from customeruser WHERE mail = '$email'";
                echo $sql;
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
                                <input type="text" class="form-control" id="firstname" name="name" placeholder="Enter your Name">
                            </div>
                        
                            <label for="firstname" class="col-form-label col-12 col-md-1 ">Email</label>
                            <div class="col-12 col-md-5 ">
                                <input type="text" class="form-control" id="firstname" name="email" placeholder="Enter your Email">
                            </div>
                        
                    </div>
                    <br>
                    <h5>Create Password</h5>
                    <hr style="border-top: 1px solid #9900cc;">
                    <div class="form-group row ">
                        
                            <label for="firstname" class="col-form-label col-12 col-md-1 ">Enter Password</label>
                            <div class="col-12 col-md-5 ">
                                <input type="text" class="form-control" id="firstname" name="password" placeholder="Enter Password">
                            </div>
                        
                            <label for="firstname" class="col-form-label col-12 col-md-1 ">Confirm Password</label>
                            <div class="col-12 col-md-5 ">
                                <input type="text" class="form-control" id="firstname" name="confirmpassword" placeholder="Confirm Password">
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
                                <input type="text" class="form-control" id="firstname" name="lmail" placeholder="Enter Email">
                            </div>
                        
                            <label for="firstname" class="col-form-label col-12 col-md-1 ">Password</label>
                            <div class="col-12 col-md-5 ">
                                <input type="text" class="form-control" id="firstname" name="lpassword" placeholder="Enter Password">
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
            <h4><a href="customer.php?reg=signup">Dont have an account? Signup Here</a></h4>
            <h4><a href="test.php?reg=customer">Forgot password</a></h4>
        </div>
        </div>
    </div>
    </div>
    <?php } }?>
</div>


<?php require('footer.php'); 
?>