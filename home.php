<?php require('header.php'); 
?>
        <br><br>
        <div class="alert alert-info alert-dismissible fade show">
            <strong>Welcome To Venture For Startups!</strong>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
<!-- STARTUP DIVISION-->
        <div class="row row-content align-items-center" style="background-color:     #bb99ff;">
                   <div class=" col-12 col-md-7">
                                <h2 class="mt-0">StartUp</h2>
                                <p>
                                <em>Have an amazing business idea?</em><br>
                                So this is the best place for you to scale your amazing ideas to another level and easily 
                                make them reach to your customers with one click.<br>
                            
                                </p>
                    </div>

                <!-- Flipcard STARTS -->
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <!-- Front Code -->
                                <!-- <div class="col-12 col-md-5"> -->
                                    <img src="img/startup.png" class="d-flex ml-3 img-thumbnail align-self-center">
                               <!--  </div> -->
                            
                        </div>

                        <div class="flip-card-back">
                            <!-- Back Code -->
                            <a href="startup.php?reg=signup" class="btn btn-primary">Sign Up</a>
                            <a href="startup.php?reg=login" class="btn btn-success">Log In</a>

                        </div>
                    </div>
                </div>
                <!-- ************************ -->
       
        </div>

<!-- INVESTOR DIVISION-->
        <div class="row row-content align-items-center"  style="background-color: #ff8080;">
            
                <div class="col-12 col-md-7 order-md-last">
                    <h2 class="mt-0">Investors/Industry</h2>
                    <p>
                        <em>Are you an Investor or from Industry?</em>
                        Looking for an amazing idea to invest OR looking for an startup which can essentially provide your company the best service you want then this is the best place for you?<br>
                        
                    </p>
                </div>  
                <!-- Flipcard STARTS -->

                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <!-- Front Code -->
                                <!-- <div class="col-12 col-md-5"> -->
                                    <img src="img/investor.jpg" class="d-flex mr-3 img-thumbnail align-self-center">
                               <!--  </div> -->
                            
                        </div>

                        <div class="flip-card-back" id="invflipback">
                            <!-- Back Code -->
                        <a href="investor.php?reg=signup" class="btn btn-primary">Sign Up</a>
                        <a href="investor.php?reg=login" class="btn btn-success">Log In</a>

                        </div>
                    </div>
                </div>

                <!-- ************************ -->
                
        </div>

<!-- CUSTOMER DIVISION-->

        <div class="row row-content align-items-center" style="background-color: #99ccff;">
            
                <div class="media-body col-12 col-md-7">
                    <h2 class="mt-0">Customer</h2>
                    <p>
                        <em>Searched many websites, But cant Find the service you want?</em><br>
                        Then this is the right place for you where you will find the new, unexplored, emerging startups which have all the capabilities to help you get your service done! <br>
                        
                    </p>
                </div>
                


                <!-- Flipcard STARTS -->

                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <!-- Front Code -->
                                <!-- <div class="col-12 col-md-5"> -->
                                    <img src="img/customer.jpg" class="d-flex ml-3 img-thumbnail align-self-center">
                               <!--  </div> -->
                            
                        </div>

                        <div class="flip-card-back" id="custflipback">
                            <!-- Back Code -->
                        <a href="customer.php?reg=signup" class="btn btn-primary">Sign Up</a>
                        <a href="customer.php?reg=login" class="btn btn-success">Log In</a>

                        </div>
                    </div>
                </div>

                <!-- ************************ -->
            
        </div>
        <br><br>

    </div>
<?php require('footer.php'); 
?>