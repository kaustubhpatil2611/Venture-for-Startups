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


<?php

// Attempt select query execution
        echo '<div class="row"><br/><br/><br/><h3>Your Posted Ideas</h3><hr style="border-top: 1px solid #9900cc;"/></div>';
        $id=$_SESSION['sid'];
        $sql = "SELECT * FROM postidea WHERE startupid = '$id'";
        if($result = mysqli_query($link, $sql)){
            if(mysqli_num_rows($result) > 0){
                echo "<table class='table table-bordered table-striped'>";
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th>Idea ID</th>";
                            echo "<th>Name</th>";
                            echo "<th>Email</th>";
                            echo "<th>Idea</th>";
                            echo "<th>Action</th>";


                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    while($row = mysqli_fetch_array($result)){
                        echo "<tr>";
                            echo "<td>" . $row['ideaid'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['briefidea'] . "</td>";
                           
                            echo "<td>";
                                
                                echo "<a href='edit.php?ideaid=". $row['ideaid'] ."' title='Update Record' data-toggle='tooltip' class='btn btn-primary'>Edit</a>";


                              echo "<a href='delete.php?ideaid=". $row['ideaid'] ."' title='Delete Record' data-toggle='tooltip' class='btn btn-danger''>Delete</a>";
                   

                            echo "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";                            
                echo "</table>";
                // Free result set
                mysqli_free_result($result);
            } else{
                echo "<p class='lead'><em>No records were found.</em></p>";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }



?>


<button onclick="location.href = 'startuphome.php';" id="myButton" class="btn btn-info">Back</button>
<div class="row">
        <br><br><br>
</div>

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





<!-- END of container class -->
    </div>
       
<?php require('footer.php'); 
?>