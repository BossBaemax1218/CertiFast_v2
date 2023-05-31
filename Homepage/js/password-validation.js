
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



const eyeIcon = document.querySelector(".pass-field i");

eyeIcon.addEventListener("click", () => {
    // Toggle the password input type between "password" and "text"
    passwordInput.type = passwordInput.type === "password" ? "text" : "password";

    // Update the eye icon class based on the password input type
    eyeIcon.className = `fa-solid fa-eye${passwordInput.type === "password" ? "" : "-slash"}`;
});
