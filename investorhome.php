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


<?php require('header2.php'); 
?>
<?php
    if(isset($_SESSION['investor_is_auth'])){
    if($_SESSION['investor_is_auth']){
        if($_SESSION['verified']){?>

        <div class="alert alert-success alert-dismissible fade show">
            <strong>Success!</strong> You are logged In!
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        
        <h3 class="text-primary f-w-100">Investor Profile</h3>
        <hr style="color:purple;">
        <div class="invest">
            
        <span id="WantInvest"> <h2>Want to INVEST ? </h2> </span>
        <div class="row">
        <!--<form action='investorhome.php'>-->
            <label for="" class="col-form-label col-md-2">Select Startup Type</span></label>
            <div class="col-md-4">
            <form action="investorhome.php" method="POST">
                <select class="form-control" id="item" name="search">
                <?php 
                    $sql= "SELECT DISTINCT type FROM postidea";
                    if($result =mysqli_query($link,$sql))
                    {
                        if(mysqli_num_rows($result)>0)
                        {
                            while($row =mysqli_fetch_array($result))
                            {
                                echo "<option>". $row['type'] . "</option>";
                            }
            
                        }
                    }
                ?>
                </select>
                
            </div>
            <div class="col-md-1">
            <button class="btn btn-info"><span class="fa fa-search fa-lg"></span></button>
            </div>
        <!--</form>-->
        </div>
        <br>
        <div class="row">
            <?php
            if(isset($_POST['search'])){
            $type= $_POST['search'];
            // Attempt select query execution
                    $sql = "SELECT * FROM postidea WHERE type = '$type'";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            
                            while($row = mysqli_fetch_array($result)){
                                echo "<div class='col-md-12'>";
                                echo "<div class='card'>";
                                echo "<h3 class='card-header text-white' style='background-color: #0059b3;'>". $row['name']."</h3>";
                                echo "<div class='card-body'style='background-color: #e6f2ff;'>";
                                    echo "<div class='card-body'>";
                                    echo "<dl class='row'>";
                                    echo "<dt class='col-6'>Name<dt>";
                                    echo "<dd class='col-6'>" . $row['name'] . "</dd>";
                                    echo "<dt class='col-6'>Email<dt>";
                                    echo "<dd class='col-6'>" . $row['email'] . "</dd>";
                                    echo "<dt class='col-6'>Brief Idea<dt>";
                                    echo "<dd class='col-6'>" . $row['briefidea'] . "</dd>";
                                    echo "<dt class='col-6'>Type<dt>";
                                    echo "<dd class='col-6'>" . $row['type'] . "</dd>";
                                    echo "<dt class='col-6'>Contact<dt>";
                                    echo "<dd class='col-6'>" . '<a class="btn btn-danger" href="mailto:"'.$row['email'].'>Mail</a>' . "</dd>";
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
        </div>
        



<!-- END of container class -->

        <?php }
            else
            {
                echo '<div class="alert alert-warning alert-dismissible fade show">
                <strong>Alert!</strong> You have not verified your email ID, please verify it by using link send to your mail!
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>';
            }
            }
            else{
                echo '<div class="alert alert-warning alert-dismissible fade show">
                <strong>Alert!</strong> Please Login as an Investor To Continue!!!
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>';
                echo '<a href="investor.php?reg=login" class="btn btn-warning">Log In</a><br><br>';
            }}
            else{
                echo '<div class="alert alert-warning alert-dismissible fade show">
                <strong>Alert!</strong> Please Login as an Investor To Continue!!!
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>';
                echo '<a href="investor.php?reg=login" class="btn btn-warning">Log In</a><br><br>';
            }
        ?>
    
    <div class="row">
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>  
</div>   
<?php require('footer.php'); 
?>