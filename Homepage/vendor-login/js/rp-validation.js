document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector("#resetpassword-form");
  
    const showError = (field, errorText) => {
      field.classList.add("error");
      const errorElement = document.createElement("small");
      errorElement.classList.add("error-text");
      errorElement.innerText = errorText;
      field.parentNode.appendChild(errorElement);
    };
  
    const handleFormData = (e) => {
      e.preventDefault();
  
      const newPasswordInput = document.querySelector("#new_password");
      const confirmPasswordInput = document.querySelector("#confirm_password");
  
      const newPassword = newPasswordInput.value.trim();
      const confirmPassword = confirmPasswordInput.value.trim();
  
      const passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
  
      document.querySelectorAll(".field .error").forEach((field) => field.classList.remove("error"));
      document.querySelectorAll(".error-text").forEach((errorText) => errorText.remove());
  
      if (!passwordPattern.test(newPassword)) {
        showError(newPasswordInput, "Enter a valid password");
      }

      if (!passwordPattern.test(confirmPassword)) {
        showError(confirmPasswordInput, "Enter a valid password");
      }
  
      if (newPassword !== confirmPassword) {
        showError(confirmPasswordInput, "Passwords do not match");
      }
  
      const errorInputs = document.querySelectorAll(".field .error");
      if (errorInputs.length > 0) return;
  
      form.submit();
    };
  
    form.addEventListener("submit", handleFormData);
  });
  