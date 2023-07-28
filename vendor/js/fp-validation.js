document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector("#forgotpassword-form");
  
    const showError = (field, errorText) => {
      field.classList.add("error");
      const errorElement = document.createElement("small");
      errorElement.classList.add("error-text");
      errorElement.innerText = errorText;
      field.parentNode.appendChild(errorElement); // Use parentNode instead of closest(".field")
    };
  
    const handleFormData = (e) => {
      e.preventDefault();
  
      const emailInput = document.querySelector("#email"); // Add 'input[type='email']' to target the email input
  
      const email = emailInput.value.trim();
  
      const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
  
      document.querySelectorAll(".field .error").forEach((field) => field.classList.remove("error"));
      document.querySelectorAll(".error-text").forEach((errorText) => errorText.remove());
  
      if (!emailPattern.test(email)) {
        showError(emailInput, "Enter a valid email address");
      }
  
      const errorInputs = document.querySelectorAll(".field .error");
      if (errorInputs.length > 0) return;
  
      form.submit();
    };
  
    form.addEventListener("submit", handleFormData);
  });
  