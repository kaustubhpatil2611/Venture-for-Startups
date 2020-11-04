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



<?php

$sql = "DELETE FROM postidea WHERE id='" . $_GET["id"] . "'";
if(mysqli_query($link,$sql)){
    $msg .= "Record Deleted Successfully !!!";
}
//header("Location:read.php");
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

<button onclick="location.href = 'read.php';" id="myButton" class="btn btn-info">View Updated Records</button>



<!-- END of container class -->
    </div>
       
<?php require('footer.php'); 
?>