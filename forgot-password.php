<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CertiFast-Forgot Password</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>  
  <link rel="icon" href="homepage/images/CFLogo2.ico" type="image/x-icon"/>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      background-image: url("homepage/images/3.svg");
      background-size: cover;
      background-color: whitesmoke;
    }

    span {
      margin-bottom: 10px;
    }

    .header .title {
      font-size: 22px;
      text-align: center;
      color: #313030;
      margin-bottom: 2%;
    }

    .header .description {
      font-size: 14px;
    }

    .wrapper {
      width: 400px;
      overflow: hidden;
      padding: 28px;
      border-radius: 8px;
      background: #fff;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
    }

    .wrapper .pass-field {
      height: 50px;
      width: 100%;
      position: relative;
    }

    .pass-field input {
      width: 100%;
      height: 100%;
      outline: none;
      padding: 0 17px;
      font-size: 1.0rem;
      border-radius: 5px;
      border: 1px solid #999;
      margin-top: 10px;
      margin-bottom: 40px;
      outline: none;
    }

    .pass-field input:focus {
      padding: 0 16px;
      border: 2px solid #fa5a5a;
    }

    .pass-field .icons span {
      right: 20px;
      top: 70%;
      font-size: 1.0rem;
      border-radius: 50%;
      display: none;
      color: #999;
      cursor: pointer;
      position: absolute;
      transform: translateY(-50%);
    }

    .wrapper .content {
      margin: 20px 0 10px;
    }

    .content p {
      color: #333;
      font-size: 1.0rem;
    }

    .pass-field .icons span.invalid{
      color: #e74c3c;
      border-color: #e74c3c;
    }  

    .pass-field .icons span.valid{
      color: #5da8ee;
      border-color: #5da8ee;
    }

    .error-text{
      position: relative;
      margin: 22px 0 -5px 0;
      background: #e74c3c;
      color: #fceae8;
      font-size: 16px;
      padding: 8px;
      border-radius: 2px;
      user-select: none;
      display: none;
    }
   
    .error-text:before{
      position: absolute;
      content: '';
      height: 15px;
      width: 15px;
      background: #e74c3c;
      right: 20px;
      top: -7px;
      transform: rotate(45deg);
    }

    button {
      margin-top: 20px;
      width: 100%;
      height: 45px;
      border: none;
      outline: none;
      border-radius: 5px;
      background: #2090fa;
      color: #f2f2f2;
      font-size: 18px;
      font-weight: 500;
      letter-spacing: 1px;
      cursor: pointer;
      transition: 0.3s;
      display:none;
    }

    button:hover {
      background: #02b502;
    }

    footer {
      margin-top: 30px;
      text-align: center;
    }

    @media (max-width: 767px) {
      .wrapper {
        max-width: 300px;
        padding: 20px;
      }

      .verify-code {
        font-size: 14px;
      }
    }

    @media screen and (max-width: 467px) {
      body,
      .wrapper,
      .header {
        padding: 15px;
      }

      .wrapper .pass-field {
        height: 40px;
      }

      .pass-field input,
      .content p {
        font-size: 1.1rem;
      }

      .pass-field .icons,
      .requirement-list li {
        font-size: 1.1rem;
      }

      .requirement-list li span {
        margin-left: 7px;
      }
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <div class="header">
      <h2 class="title">Forgot Password</h2>
    </div>
    <form action="#">
      <span class="description">Please enter your email and we'll send you a verification code.</span>
      <div class="pass-field">
        <input onkeyup="check()" id="email" type="text" autocomplete="off" placeholder="Enter Email Address">
        <div class="icons">
            <span class="invalid"></span>
            <span class="valid"></span>
         </div>
      </div>
      <div class="error-text">
        Please Enter Valid Email Address
      </div>
      <button type="submit"><a href="verificationcode.php">Submit</a></button>
    </form>
  </div>
  <script src="homepage/js/forgot-password.js"></script>
</body>
</html>
