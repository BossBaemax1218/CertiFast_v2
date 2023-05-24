<!Doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Certifast - Reset Password  </title>

        <!-- CSS FILES -->        

        <link rel="icon" href="Homepage/images/CFLogo2.ico" type="image/x-icon"/>

        <link href="Homepage/css/forgot-password.css" rel="stylesheet">

        <link href="Homepage/css/bootstrap.min.css" rel="stylesheet">


    </head>
    
    <body>

        <main>
                <div class="card">
                    <div class="card-header">
                        <img class="lock-icon" src="Homepage\images\icons\reset-password.png">                  
                        <h6 class="mt-1">Create a new password</h6>
                    </div>
                    <div class="card-body">
                        <form id="my-form">
                                <span class="mt-1" style="font-size: 14px;">Create a new password that is at least 8 characters long. A strong password is combination of letters, numbers, and symbols.</span>
                                <input class="password mt-2" type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="New password" onClick="clearInput()">
                                <label class="toggle-password" onclick="togglePasswordVisibility()" id="show-hide-password">
                                    <i id="show-hide-icon" class="fa fa-eye-slash"></i>
                                </label>
                            <div class="mt-0">
                                <div id="strength-wrapper">
                                    <div id="strength-text">Password strength: <span id="strength-value"></span></div>
                                        <div id="strength-bar">
                                            <div id="strength-bar-inner"></div>
                                        </div>
                                    </div>
                                </div>  
                                <button class="mt-2" type="submit"><a href="forgotpassword.php">Reset Password</a></button>
                            </div>
                        </form>
                    </div>
                </div>
              <footer>
                <p>
                    Created by <a href="index.php">CertiFast Team</a> 2023           
                </p>
              </footer>
        </main>
<script>
const passwordInput = document.getElementById('password');
const strengthBar = document.getElementById('strength-bar-inner');
const strengthValue = document.getElementById('strength-value');

passwordInput.addEventListener('input', () => {
  const password = passwordInput.value;
  const strength = calculatePasswordStrength(password);
  strengthBar.style.width = `${strength}%`;
  strengthBar.className = '';
  if (strength < 33) {
    strengthBar.classList.add('weak');
    strengthValue.innerText = 'Weak';
    strengthValue.className = 'weak';
  } else if (strength < 66) {
    strengthBar.classList.add('medium');
    strengthValue.innerText = 'Medium';
    strengthValue.className = 'medium';
  } else {
    strengthBar.classList.add('strong');
    strengthValue.innerText = 'Strong';
    strengthValue.className = 'strong';
  }
});

function calculatePasswordStrength(password) {
  let strength = 0;
  if (password.length >= 8) {
    strength += 30;
  }
  if (/[a-z]/.test(password)) {
    strength += 10;
  }
  if (/[A-Z]/.test(password)) {
    strength += 20;
  }
  if (/[0-9]/.test(password)) {
    strength += 20;
  }
  if (/[\W_]/.test(password)) {
    strength += 20;
  }
  return strength;
}
</script>

<script>
    function togglePasswordVisibility() {
    const passwordInput = document.getElementById("password");
    const showHideButton = document.getElementById("show-hide-password");
    const showHideIcon = document.getElementById("show-hide-icon");
    const isPasswordVisible = passwordInput.type === "text";
    passwordInput.type = isPasswordVisible ? "password" : "text";
    showHideButton.classList.toggle("visible");
    showHideIcon.classList.toggle("fa-eye");
    showHideIcon.classList.toggle("fa-eye-slash");
    }
</script>
</body>
</html>