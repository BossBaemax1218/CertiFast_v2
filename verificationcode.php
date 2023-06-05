<!Doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Certifast-Verification Code</title>    
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
            position:relative;
            background-color: whitesmoke;
          }

          span{
            margin-bottom: 10px;
          }

          .header [class="title"]{
              font-size: 22px;
              text-align: center;
              color: #313030;
              margin-bottom: 2%;
          }
          .header [class="description"]{
            font-size: 14px;
          }
          .wrapper {
            width: 400px;
            overflow: hidden;
            padding: 28px;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 10px 25px rgba(0,0,0,0.06);
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
          }
          .pass-field input:focus {
            padding: 0 16px;
            border: 1px solid #999;
          }
          .wrapper .content {
            margin: 20px 0 10px;
          }
          .content p {
            color: #333;
            font-size: 1.0rem;
          }
          button{
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
            
          }

          a{
            text-decoration:none;
            color: white;
          }

          button:hover{
            background: #02b502;
          }
          footer {
            margin-top: 30px;
            text-align: center;
          }

          /* Media query for small screens */
          @media (max-width: 767px) {
            .wrapper {
              max-width: 300px;
              padding: 20px;
            }

            .verify-code {
              font-size: 14px;
            }
          }

          @media screen and (max-width: 400px) {
            body, .wrapper, .header {
              padding: 15px;
            }
            .wrapper .pass-field {
              height: 40px;
            }
            .pass-field input, .content p  {
              font-size: 1.1rem;
            }
            .pass-field i, .requirement-list li {
              font-size: 1.1rem;
            }
            .requirement-list li span {
              margin-left: 7px;
            }
          }
        </style>
    </head>  
    <body>
        <main>
        <div class="wrapper">
            <div class="header">              
              <h2 class="title">Verification Code</h2>
            </div>
              <span class="description">To reset your password, type the code we sent to your email address here.</span>
                <div class="pass-field">
                  <input class="verify-code mt-2" type="text" id="verify-code" name="verify-code" placeholder="Enter your code">
                </div>
              <div class="content">
                <button><a href="password-validation.php">Confirm</a></button>
              </div>
        </div>
        </main>
    </body>
</html>