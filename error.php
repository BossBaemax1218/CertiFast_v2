<?php
    if (isset($_SESSION['fullname'])) {
      header('Location: login.php');
  }
?>
<head>
    <title>404 Error</title>
    <link rel="icon" href="../assets/img/CFLogo2.ico" type="image/x-icon"/>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Arvo'>
</head>
<style>
  .page_404{ 
    padding:40px 0; 
    background:#fff; 
    font-family: 'Arvo', serif;
}
.page_404  img{ 
    width:100%;
}
.four_zero_four_bg{
 background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);
    height: 500px;
    background-position: center;
 }
 .four_zero_four_bg h1{
 font-size:90px;
 }
.four_zero_four_bg h3{
    font-size:100px;
}
.link_404{      
  color: #fff!important;
    padding: 10px 20px;
    border: 5px;
    background: #D32D41;
    margin: 20px 0;
    display: inline-block;
}
.contant_box_404{ 
    margin-top:-50px;
}
</style>
<section class="page_404">
  <div class="container">
    <div class="row"> 
    <div class="col-sm-12 ">
    <div class="col-sm-10 col-sm-offset-1  text-center">
    <div class="four_zero_four_bg">
      <h1 class="text-center">Oops!</h1>
    </div>
        <div class="contant_box_404">
            <h3 class="h2">Look like you're account has been deactivate!</h3>
            <p style="font-size: 14px;">We apologize for the inconvenience, but please visit Barangay Los Amigos Office for this matter, in order to clarify and confirm your account status. Thank you!</p>
            <a href="index.php" class="link_404">Go to Home</a>
        </div>
    </div>
    </div>
    </div>
  </div>
</section>
