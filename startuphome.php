<?php
session_start();
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
$msg = "";
if(array_key_exists("submit", $_POST)){

    if(! $_POST['briefidea']){
        $error .= "Please Describe your idea in brief";
    }
    if($error != ""){
        $error = "<p>There were error(s) in your form! </p>".$error;
    }
    else{

        $briefidea = mysqli_real_escape_string($link, $_POST['briefidea']);
        $name = $_POST['name'];
        $email = mysqli_real_escape_string($link, $_POST['email']);
        $type=$_POST['stype'];
        //echo "$briefidea";
    

    $query = "INSERT INTO postidea (name,email,briefidea,type) VALUES ('$name','$email','$briefidea','$type')";

          
            if(mysqli_query($link, $query)){
                    //echo "Idea Posted successfully.";
                $msg = "Idea Posted successfully.";
                    //header("Location: startuphome.php");
                } 
            else{
                echo "ERROR: Could not able to execute <br>$query. <br>" . mysqli_error($link);
            }
    }
}

if(array_key_exists("submit-l", $_POST)){

    if(! $_POST['name']){
        $error .= "Please write your name";
    }
    if(! $_POST['link']){
        $error .= "Please enter link";
    }
    if(! $_POST['briefidea']){
        $error .= "Please Describe your idea in brief";
    }
    if(! $_POST['stype']){
        $error .= "Please enter startup category";
    }
    if($error != ""){
        $error = "<p>There were error(s) in your form! </p>".$error;
    }
    else{

        $briefidea = mysqli_real_escape_string($link, $_POST['briefidea']);
        $name = $_POST['name'];
        $stype = $_POST['stype'];
        $url = mysqli_real_escape_string($link, $_POST['link']);
        
        //echo "$briefidea";
    

    $query = "INSERT INTO postad (name,link,info,type) VALUES ('$name','$url','$briefidea','$stype')";

          
            if(mysqli_query($link, $query)){
                    //echo "Idea Posted successfully.";
                $msg = "Idea Posted successfully.";
                    //header("Location: startuphome.php");
                } 
            else{
                echo "ERROR: Could not able to execute <br>$query. <br>" . mysqli_error($link);
            }
    }
}
?>


<?php require('header.php'); 
?>

<?php
    //if(isset($_SESSION['s_is_auth'])){
    //if($_SESSION['s_is_auth']){?>
        You are Logged IN !!!
        <h3>Startup Profile</h3>

        
        <div class="postidea">
            
            <!-- newideabtn  -->
            
            <a class="btn btn-info" href="startuphome.php?post=new" >Post New Startup Idea</a>
            <a class="btn btn-info" href="read.php" >View Ideas</a>
            <a class="btn btn-info" href="startuphome.php?post=ad" >Post Ad</a>


    <?php

    if(isset($_GET['post'])){

        if($_GET['post']=="new"){?>
            <div id="">
                <form method="POST" id="ideaform">


                <div class="form-group">

                   <!--  <label for="numberfounder" class="col-form-label col-12">Number of Founders</label>
                        <div class="col-12 col-md-5 ">
                            <input type="text" id="numberfounder"/>
                            <input type="button" value="?" onclick="generate()" />
                        </div>
                    
                    
                   
                    <div id="ch">
                        
                    </div> -->

                    <label for="firstname" class="col-form-label col-12 col-md-1 ">Name</label>
                        <div class="col-12 col-md-5 ">
                            <input type="text" class="form-control" id="firstname" name="name" placeholder="Name">
                        </div>

                    <label for="firstname" class="col-form-label col-12 col-md-1 ">Email</label>
                            <div class="col-12 col-md-5 ">
                                <input type="email" class="form-control" id="firstname" name="email" placeholder="Enter your Email">
                            </div>

                    <label for="ideatextbox" class="col-form-label col-12"> Describe your Idea </label>

                    <div class="col-12 col-md-5 ">
                        <textarea class="form-control" id="ideatextbox" rows="3" name="briefidea"></textarea>
                    </div>

                    <label for="firstname" class="col-form-label col-12 col-md-2 ">Startup Type</label>
                            <div class="col-12 col-md-5 ">
                                <input type="text" class="form-control" id="" name="stype" placeholder="Enter startup category">
                            </div>
                </div>

                <!-- Post Idea Button -->
                <input type="submit" class="btn btn-info" id="postideabtn" name="submit" value="Post Idea">
              
            </form>

            </div>
            <?php } else { ?>
                <form method="POST" id="ideaform">


                <div class="form-group">

                    <label for="firstname" class="col-form-label col-12 col-md-1 ">Name</label>
                        <div class="col-12 col-md-5 ">
                            <input type="text" class="form-control" id="firstname" name="name" placeholder="Name">
                        </div>

                    <label for="firstname" class="col-form-label col-12 col-md-1 ">Link</label>
                            <div class="col-12 col-md-5 ">
                                <input type="text" class="form-control" id="firstname" name="link" placeholder="Enter your website URL">
                            </div>

                    <label for="ideatextbox" class="col-form-label col-12"> Describe your Idea </label>

                    <div class="col-12 col-md-5 ">
                        <textarea class="form-control" id="ideatextbox" rows="3" name="briefidea"></textarea>
                    </div>

                    <label for="firstname" class="col-form-label col-12 col-md-2 ">Startup Type</label>
                            <div class="col-12 col-md-5 ">
                                <input type="text" class="form-control" id="" name="stype" placeholder="Enter startup category">
                            </div>
                </div>

                <!-- Post Idea Button -->
                <input type="submit" class="btn btn-info" id="postideabtn" name="submit-l" value="Post Idea">
              
            </form>

            


            <?php }} ?>



<!-- To Display Error(s) in HTML ,if generated -->
<?php if ($error != "" || $msg != "") { ?>
 <div id="error" class="p-3 mb-2 bg-danger text-white">
    
        <?php 
        echo "$error";
        echo "$msg"; 
        ?>

    
    </div>   
<?php } else { ?>
    <div id="error">
    
        <?php 
        echo "$error"; 
        ?>

    
    </div>    
<?php } ?>

 
        
 

</div>




         <div class="investorlist">

            <h2 class="text-primary f-w-100">Do you want to Raise Funds?</h2>
            <p>
                Here The list of investors will be displayed from investor table database
            </p>
            <?php
            if(1){
            // Attempt select query execution
                    $sql = "SELECT * FROM investor WHERE 1";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            
                            while($row = mysqli_fetch_array($result)){
                                echo "<div class='col-md-12'>";
                                echo "<div class='card'>";
                                echo "<h3 class='card-header text-white' style='background-color: #0059b3;'>". $row['cname']."</h3>";
                                echo "<div class='card-body'style='background-color: #e6f2ff;'>";
                                    echo "<div class='card-body'>";
                                    echo "<dl class='row'>";
                                    echo "<dt class='col-6'>Investor<dt>";
                                    echo "<dd class='col-6'>" . $row['cname'] . "</dd>";
                                    echo "<dt class='col-6'>Email<dt>";
                                    echo "<dd class='col-6'>" . $row['mail'] . "</dd>";
                                    echo "<dt class='col-6'>Phone<dt>";
                                    echo "<dd class='col-6'>" . $row['phone'] . "</dd>";
                                    echo "<dt class='col-6'>Location<dt>";
                                    echo "<dd class='col-6'>" . $row['location'] . "</dd>";
                                    echo "<dt class='col-6'>Contact<dt>";
                                    echo "<dd class='col-6'>" . '<a class="btn btn-danger" href="mailto:"'.$row['mail'].'>Mail</a>' . "</dd>";
                                    echo "</dl>";                            
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "<div class='col-12'><br></div>";
                            }
                        // Free result set
                        mysqli_free_result($result);
                    }
                        
                        
                        else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }


                }
            ?>
        </div> 

<!-- END of container class -->
    
<?php /*}
            else{
                echo "<h2>Please Login as Startup To Continue!!</h2><hr>";
                echo '<a href="startup.php?reg=login" class="btn btn-warning">Log In</a><br><br>';
            }}
            else{
                echo "<h2>Please Login as Startup To Continue!!</h2><hr>";
                echo '<a href="startup.php?reg=login" class="btn btn-warning">Log In</a><br><br>';
            }*/
            ?>
            </div>
<?php require('footer.php'); 
?>