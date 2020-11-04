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


//login page

if(array_key_exists("l-submit", $_POST))
{
    $error = "";
    if(!$_POST['email'])
    {
        $error .= "An email Address is required <br>";
    }
    if(!$_POST['password'])
    {
        $error.= "Please enter your password! <br>";
    }
    else
    {
        $email=$_POST['email'];
        $password=$_POST['password'];
        $sql = "SELECT password from startupusers WHERE email = '$email'";
        $result=mysqli_query($link,$sql);
        if(mysqli_num_rows($result)==1)
        {
            $row =mysqli_fetch_array($result);
            if($row['password']==$password)
            {
                //not done yet
                //$_SESSION['id']=??;
                session_start();
                $_SESSION['sid']=$row['sid'];
                $_SESSION['s_is_auth']=true;
                header("Location: startuphome.php");

            }
        }
       
    }
}


$error = "";
if(array_key_exists("submit", $_POST)){
//if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //$flag=validateform();
    if(1){
    $error = "";
    //name
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $startupname=$_POST['startupname'];
    $startuptype=$_POST['startuptype'];
    $location=$_POST['location'];
    $sdescription=$_POST['sdescription'];
    $password=$_POST['password'];

    echo "please tell about error";
        //header("Location: home.php");
            $name = $_POST['name'];
            $email = mysqli_real_escape_string($link, $_POST['email']);
            $phone = $_POST['phone'];
            $password = mysqli_real_escape_string($link, $_POST['password']);

            $query = "INSERT INTO startupusers (name,email,phone,password,startupname,startuptype,location,sdescription) VALUES
            ('$name','$email','$phone','$password','$startupname','$startuptype','$location','$sdescription')";

          
            if(mysqli_query($link, $query)){
                    //echo "Records added successfully.";
                    header("Location: startuphome.php");
                } 
            else{
                echo "ERROR: Could not able to execute <br>$query. <br>" . mysqli_error($link);
            }
    
        }
        else{
            echo "Error, not submitted";
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



   <!--  <div id="error" class="p-3 mb-2 bg-danger text-white">
    
        <?php 
        //echo "$error"; 
        ?>

    
    </div>     -->


<?php require('header.php'); 
?>



<?php
    if(isset($_GET['reg'])){
    if($_GET['reg']=='signup'){?>
    <div class="row" id="signupdiv">
            <div class="col-12 ">
                <form id="mysform" method="POST" style="margin-top: 1em;">
                    
                    <h3 style="text-align: center;">Startup Registration</h3>
                    <hr style="border-top: 1px solid #9900cc;">
                    
                    <br>
                    <h5>Basic Details</h5>
                    <hr style="border-top: 1px solid #9900cc;">
                    <div class="form-group row ">
<!-- NAME -->                       
                            <label for="firstname" class="col-form-label col-12 col-md-1 ">Name</label>
                            <div class="col-12 col-md-5 ">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
                                <span id="nameresult"></span>
                            </div>
<!-- EMAIL -->                      
                            <label for="firstname" class="col-form-label col-12 col-md-1 ">Email</label>
                            <div class="col-12 col-md-5 ">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your Email">
                                <span id="emailresult"></span>
                            </div>
                        
                    </div>
                    
                    <div class="form-group row ">
<!-- PHONE -->
                            <label for="firstname" class="col-form-label col-12 col-md-1 ">Phone</label>
                            
                            <div class="col-8 col-md-3 ">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Contact number">
                                <span id="phoneresult"></span>
                                
                            </div>
                        
                           
                    </div>
                    <br>
                    <h5>StartUp Details</h5>
                    <hr style="border-top: 1px solid #9900cc;">
                    <div class="form-group row ">
                        
                            <label for="firstname" class="col-form-label col-12 col-md-1 ">Startup Name</label>
                            <div class="col-12 col-md-5 ">
                                <input type="text" class="form-control" id="startupname" name="startupname" placeholder="Enter your Startup name">
                                <span id="startupnameresult"></span>
                            </div>
                            
                            <label for="firstname" class="col-form-label col-12 col-md-1 ">Type of Startup</label>
                            <div class="col-12 col-md-5 ">
                                <input type="text" class="form-control" id="startuptype" name="startuptype" placeholder="Startup type">
                                <span id="startuptyperesult"></span>
                            </div>
                            
                    </div>
                    
                    <div class="form-group row ">
                        
                            <label for="firstname" class="col-form-label col-12 col-md-1 ">Location</label>
                            <div class="col-12 col-md-5 ">
                                <input type="text" class="form-control" id="location" name="location" placeholder="Location">
                                <span id="locationresult"></span>
                            </div>
                        
                            <label for="sdescription" class="col-12 col-md-1">Description</label>
                            <div class="form-group purple-border  col-12 col-md-5">
                                <textarea class="form-control" id="sdescription" name="sdescription" rows="3"></textarea>
                                <span id="sdescriptionresult"></span>
                            </div>                        

                    </div>
                    <br>
                    <h5>Create Password</h5>
                    <hr style="border-top: 1px solid #9900cc;">
                    <div class="form-group row ">
                        
                            <label for="password" class="col-form-label col-12 col-md-1 ">Enter Password</label>
                            <div class="col-12 col-md-5 ">
                                <input type="text" class="form-control" id="password" name="password" placeholder="Enter Password" minlength = "8" maxlength = "16">
                                <span id="result"></span>
                            </div>
                        
                            <label for="confirmpassword" class="col-form-label col-12 col-md-1 ">Confirm Password</label>
                            <div class="col-12 col-md-5 ">
                                <input type="text" class="form-control" id="confirmpassword" minlength = "8" maxlength = "16"
                                name="confirmpassword" placeholder="Confirm Password">
                                <span id="confirmpasswordresult"></span>
                            </div>
                        
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="offset-1 offset-md-2">
                            <input type="submit" class="btn btn-primary" name="submit" value="Sign Up">
                        </div>

                        <div class="offset-1 offset-md-2">
                        <input type='button' class="btn btn-warning" name="submit" id='validate' onclick="validateform()" value="Validate FORM" />
                    </div>
                        <div class="offset-1 offset-md-2">
                            <button class="btn btn-danger" name="reset" onclick="reset()" value="Clear" >Clear</button>
                        </div>
                    </div>
                    
                    
                </form>
                
            </div>
            
        </div>
        <div class="row">
        <div class="offset-md-4">
            <h4><a href="startup.php?reg=login">Already have an account? Login Here</a></h4>
        </div>
        </div>


    </div>
    </div>
    </div>

</div>


<?php } else { ?>
<!-- LOGIN division -->

        <div class="row">
            <h2></h2>
            
        </div>
        <div class="row">
            <div class="col-12 ">
                <form method="POST" id="mysform" style="margin-top: 1em;">
                    
                    <h3 style="text-align: center;">StartUp Log In</h3>
                    <hr style="border-top: 1px solid #9900cc;">
                    <br>
                    <h5>Enter Credentials</h5>
                    <hr style="border-top: 1px solid #9900cc;">
                    <div class="form-group row ">
                        
                            <label for="email" class="col-form-label col-12 col-md-1 ">Email</label>
                            <div class="col-12 col-md-5 ">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
                            </div>
                        
                            <label for="password" class="col-form-label col-12 col-md-1 ">Password</label>
                            <div class="col-12 col-md-5 ">
                                <input type="text" class="form-control" id="password" name="password" placeholder="Enter Password">
                            </div>
                        
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="offset-1 offset-md-6">
                            <button type="submit" class="btn btn-primary" name="l-submit" style="background-color: #9900cc;">Log In</button>
                        </div>
                        
                    </div>
                    
                    
                </form>
                
            </div>
        </div>
        <div class="row">
        <div class="offset-md-4">
            <h4><a href="startup.php?reg=signup">Dont have an account? SignUp Here</a></h4>
            <h4><a href="test.php?reg=startup">Forgot password</a></h4>
        </div>
        </div>
        </div>
<?php }} ?>

    <script type="text/javascript">
        


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

function reset()
{
    nameresult.innerHTML="";
    startupnameresult.innerHTML ="";
    startuptyperesult.innerHTML ="";
    locationresult.innerHTML="";
    sdescriptionresult.innerHTML ="";
    phoneresult.innerHTML ="";
    emailresult.innerHTML ="";
    result.innerHTML ="Your Password is Too weak";
    confirmpasswordresult.innerHTML ="";

}

function validateform() {
 reset();
  var regexphone = /^(\+91)?[6|7|8|9]{1}[0-9]{9}$/;
  var regexemail = /^[a-zA-Z0-9]([a-zA-Z0-9][\.\+\-\_\!\#\$\%\&\'\*\+\-\/\=\?\^\_\`\{\|]{0,1}){0,62}([a-zA-Z0-9][\@])([\a-zA-Z0-9\-]{1,6}[\.]){1,3}([a-zA-Z]){2,4}$/;

  

  var regname = /^[a-zA-Z\s]{2,40}$/;

  //const phone = $("#phone").val();
var phone = document.getElementById("phone").value;
var email = document.getElementById("email").value;
var password = document.getElementById("password").value;

var confirmpassword = document.getElementById("confirmpassword").value; 
var name = document.getElementById("name").value;
var startupname = document.getElementById("startupname").value;
var startuptype = document.getElementById("startuptype").value;
var location = document.getElementById("location").value;
var sdescription = document.getElementById("sdescription").value;

var emailresult = document.getElementById("emailresult");
var phoneresult = document.getElementById("phoneresult");
var nameresult = document.getElementById("nameresult");
var passwordresult = document.getElementById("result");
var startupnameresult = document.getElementById("startupnameresult");
var startuptyperesult = document.getElementById("startuptyperesult");
var locationresult = document.getElementById("locationresult");
var sdescriptionresult = document.getElementById("sdescriptionresult");

var flag=true;

/* EMPTY FIELD Validation  */
/*NAME Validation*/

    if(name.length == 0){
        nameresult.innerHTML = "NAME is Required";
        nameresult.style.color = "red";
        flag=false;
    }

    if(!regname.test(name)) {
        nameresult.innerHTML = "Please enter proper NAME format";
        nameresult.style.color = "red";
        flag=false;
    }
/*STARTUP NAME Validation*/
    if(startupname.length == 0){
        startupnameresult.innerHTML = "STARTUP NAME is Required";
        startupnameresult.style.color = "red";
        flag=false;
    }

/*STARTUP TYPE Validation*/
    if(startuptype.length == 0){
        startuptyperesult.innerHTML = "STARTUP TYPE is Required";
        startuptyperesult.style.color = "red";
        flag=false;
    }

/*LOCATION Validation*/
    if(location.length == 0){
        locationresult.innerHTML = "LOCATION is Required";
        locationresult.style.color = "red";
        flag=false;
    }

/*SDESCRIPTION Validation*/

    if(sdescription.length == 0){
        sdescriptionresult.innerHTML = "Startup Description is Required";
        sdescriptionresult.style.color = "red";
        flag=false;
    }

  



/*PHONE Validation*/
    if(phone.length == 0){
        phoneresult.innerHTML = "PHONE NUMBER is Required";
        phoneresult.style.color = "red";
        flag=false;
    }
    else if(regexphone.test(phone)){
        console.log("This is a VALID Phone Number");
        phoneresult.innerHTML = "Your Phone Number is Valid";
        phoneresult.style.color = "green";
       
    }
    else{
        console.log("This is NOT a VALID Phone Number");
        phoneresult.innerHTML = "This is NOT a VALID Phone Number";
        phoneresult.style.color = "red";
        flag=false;
    }

/*EMAIL Validation*/
    if(email.length == 0){
        emailresult.innerHTML = "EMAIL is Required";
        emailresult.style.color = "red";
        flag=false;
    }
    else if(regexemail.test(email)){
        console.log("This is a VALID EMAIL Address");
        emailresult.innerHTML = "Your Email Address is Valid";
        emailresult.style.color = "green"; 
    }
    else{
        console.log("This is NOT a VALID EMAIL Address");
        emailresult.innerHTML = "This is NOT a VALID EMAIL Address";
        emailresult.style.color = "red";
        flag=false;
    }

/*PASSWORD Validation*/
    if(password.length == 0){
        passwordresult.innerHTML = "PASSWORD is Required";
        passwordresult.style.color = "red";
        flag=false;
    }
    else if(password.length < 8){
        passwordresult.innerHTML = "PASSWORD should be of min. 8 characters";
        result.style.color = "red";
        flag=false;
    }
    else if(password != confirmpassword)
    {
        confirmpasswordresult.innerHTML = "PASSWORDs do not match";
        confirmpasswordresult.style.color = "red";
        flag=false;
    }
    else
    {
        passwordresult.innerHTML = "PASSWORD validation done";
        passwordresult.style.color = "green";

    }

    if(flag==true)
    {
        alert("Validation successfull!");
        
        return true;
        
    }
    else{
        alert("Validation failed!");
        return false;
    }
  

  
}


 //validate('+918989898989');



    </script>

<?php require('footer.php'); 
?>    
