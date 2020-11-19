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


?>

<?php require('header.php'); 
?>

<!-- UPDATE operation of CRUD -->

<?php

if(count($_POST)>0) {
    $sql = "UPDATE postidea set briefidea='" . $_POST["briefidea"] . "' WHERE ideaid='" . $_POST["ideaid"] . "'";
    mysqli_query($link,$sql);
    echo '<div class="alert alert-info alert-dismissible fade show">
                    <strong>Success!</strong> Idea updated successfully!
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>';
}



?>



<!-- To Display Error(s) in HTML ,if generated -->

    
        <?php 
        echo "$error";
        
        ?>

    


<form method="POST" id="ideaform">


                
               <!-- <h6>Number of Founders </h6>
                <input type="text" id="numberfounder" />
                <input type="button" value="?" onclick="generate()" />
                <br><br>
                <div id="ch">
                    
                </div> -->
                
                
                <div class="form-group">
                    <label for="ideaid" class="col-form-label "><h6>Idea</h6></label>
                    <input type="text" class="form-control" id="ideaid" name="ideaid" value='<?php echo $_GET['ideaid'];?>' readonly>
                            

                    <label for="exampleFormControlTextarea1"><h6> Edit your Idea </h6></label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="briefidea"></textarea>
                </div>

                <input type="submit" class="btn btn-info" name="submit" value="Update Idea">
              
</form>
<button onclick="location.href = 'read.php';" id="myButton" class="btn btn-info">View Updated Idea</button>
<div class="row">
    <br><br><br><br>
</div>


<!-- END of container class -->
    </div>
       
<?php require('footer.php'); 
?>