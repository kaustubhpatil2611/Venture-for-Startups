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
$msg = "";


?>

<?php require('header.php'); 
?>

<!-- UPDATE operation of CRUD -->

<?php

if(count($_POST)>0) {
    $sql = "UPDATE postidea set briefidea='" . $_POST["briefidea"] . "' WHERE id='" . $_GET["id"] . "'";
    mysqli_query($link,$sql);
    $msg = "Record Updated Successfully";
}
$select_query = "SELECT * FROM postidea WHERE id='" . $_GET["id"] . "'";
$result = mysqli_query($link,$select_query);
$row = mysqli_fetch_array($result);
?>



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

<form method="POST" id="ideaform">


                
               <!-- <h6>Number of Founders </h6>
                <input type="text" id="numberfounder" />
                <input type="button" value="?" onclick="generate()" />
                <br><br>
                <div id="ch">
                    
                </div> -->
                
                
                <div class="form-group">
                    <label for="exampleFormControlTextarea1"><h6> Edit your Idea </h6></label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="briefidea"></textarea>
                </div>

                <input type="submit" class="btn btn-info" name="submit" value="Update Idea">
              
</form>
<button onclick="location.href = 'read.php';" id="myButton" class="btn btn-info">View Updated Idea</button>



<!-- END of container class -->
    </div>
       
<?php require('footer.php'); 
?>