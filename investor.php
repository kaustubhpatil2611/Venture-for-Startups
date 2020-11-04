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
if(array_key_exists("investsubmit", $_POST)){
//if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<button>ERROR</button>";
    $error = "";

    if(! $_POST['email']){
        $error .= "An Email Address is Required <br>";
        echo "<button>ERROR1</button>";
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
        echo "<p>".$error."</p>";
    }
    else{
        
            $compname = $_POST['compname'];
            $email = mysqli_real_escape_string($link, $_POST['email']);
            $phone = $_POST['phone'];
            $location = $_POST['location'];
            $password = mysqli_real_escape_string($link, $_POST['password']);

            $query = "INSERT INTO investor (cname,mail,phone,location,password) VALUES
            ('$compname','$email','$phone','$location','$password')";

          
            if(mysqli_query($link, $query)){
                    //echo "Records added successfully.";
                    header("Location: investorhome.php");
                } 
            else{
                echo "ERROR: Could not able to execute <br>$query. <br>" . mysqli_error($link);
            }
    
    }

}

$error = "";
if(array_key_exists("lsubmit", $_POST)){
//if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
        echo "<button>12345</button>";
            $email = mysqli_real_escape_string($link, $_POST['lmail']);
            $password = $_POST['lpassword'] ;
            
            $sql = "SELECT * from investor WHERE mail = '$email'";
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
                $_SESSION['cid']=$row['id'];
                $_SESSION['investor_is_auth']=1;
                header("Location: investorhome.php");

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
                    
                    <h3 style="text-align: center;">Investor Registration</h3>
                    <hr style="border-top: 1px solid #9900cc;">
                    <br>
                    <h5>Basic Details</h5>
                    <hr style="border-top: 1px solid #9900cc;">
                    <div class="form-group row ">
                        
                            <label for="firstname" class="col-form-label col-12 col-md-1 ">Company Name</label>
                            <div class="col-12 col-md-5 ">
                                <input type="text" class="form-control" id="firstname" name="compname" placeholder="Enter Company name">
                            </div>
                        
                            <label for="firstname" class="col-form-label col-12 col-md-1 ">Email</label>
                            <div class="col-12 col-md-5 ">
                                <input type="text" class="form-control" id="firstname" name="email" placeholder="Enter your Email">
                            </div>
                        
                    </div>
                    
                    <div class="form-group row ">

                            <label for="firstname" class="col-form-label col-12 col-md-1 ">Phone</label>
                            <div class="col-4 col-md-2 ">
                                <select class="form-control " id="dept" name="dept">
                                    <option>+91</option>
                                    <option>+92</option>
                                </select>
                            </div>
                            <div class="col-8 col-md-3 ">
                                <input type="text" class="form-control" id="firstname" name="phone" placeholder="Contact number">
                            </div>
                        
                            <label for="firstname" class="col-form-label col-12 col-md-1 ">Location</label>
                            <div class="col-12 col-md-5 ">
                                <input type="text" class="form-control" id="firstname" name="location" placeholder="Location">
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
                        <input type="submit" class="btn btn-primary" name="investsubmit" value="Sign Up">
                        </div>
                        
                    </div>
                    
                    
                </form>
                
            </div>
        </div>
        <div class="row">
        <div class="offset-md-4">
            <h4><a href="investor.php?reg=login">Already have an account? Login Here</a></h4>
        </div>
        </div>
    <?php } else{?>
        <div class="row">
            <h2></h2>
            
        </div>
        <div class="row">
            <div class="col-12 ">
                <form id="mysform" method="POST" style="margin-top: 1em;">
                    
                    <h3 style="text-align: center;">Investor Log In</h3>
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
            <h4><a href="investor.php?reg=signup">Dont have an account? Signup Here</a></h4>
            <h4><a href="test.php?reg=investor">Forgot password</a></h4>
        </div>
        </div>
    <?php }} ?>
    </div>
    </div>

</div>
<footer class="footer">
        <div class="container">
            <div class="row">             
                <div class="col-4 offset-1 col-sm-2">
                    <h5>Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="home.html" id="home1">Home</a></li>
                        <li><a href="startup.html" id="register1">StartUp</a></li>
                        <li><a href="investor.html" id="show1">Investor</a></li>
                        <li><a href="customer.html" id="show1">Customer</a></li>
                    </ul>
                </div>
                <div class="col-7 col-sm-5">
                    <h5>Our Address</h5>
                    <address>
                      MIT Academy Of Engineering<br>
                      Alandi, Pune <br>
                      Pin code:412105<br>
                      <i class="fa fa-phone"></i>: +857 234 5678<br>
                      <i class="fa fa-envelope"></i>: <a href="mailto:kkpatil@mitaoe.ac.in">startups@gmail.com</a>
                   </address>
                </div>
                <div class="col-12 col-sm-4 align-self-center">
                    <div class="text-center">
                        <a class="btn btn-social-icon btn-google" href="http://google.com/+"><span class="fa fa-google-plus"></span></a>
                        <a class="btn btn-social-icon btn-facebook" href="http://www.facebook.com/profile.php?id="><span class="fa fa-facebook"></span></a>
                        <a class="btn btn-social-icon btn-linkedin" href="http://www.linkedin.com/in/"><span class="fa fa-linkedin"></span></a>
                        <a class="btn btn-social-icon btn-twitter" href="http://twitter.com/"><span class="fa fa-twitter"></span></a>
                        <a class="btn btn-social-icon btn-google" href="http://youtube.com/"><span class="fa fa-youtube"></span></a>
                        <a class="btn btn-social-icon btn-google" href="mailto:"><span class="fa fa-envelope"></span></a>
                    </div>
                </div>
           </div>
           <div class="row justify-content-center">             
                <div class="col-auto">
                    <p>© Copyright 2020 </p>
                </div>
           </div>
        </div>
    </footer>
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

</body>
</html>