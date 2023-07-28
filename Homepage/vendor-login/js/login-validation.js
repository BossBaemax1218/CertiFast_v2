document.addEventListener('DOMContentLoaded', () => {
    // Selecting form and input elements
    const form = document.querySelector("form");
  
    // Function to display error messages
    const showError = (field, errorText) => {
      field.classList.add("error");
      const errorElement = document.createElement("small");
      errorElement.classList.add(".error-text");
      errorElement.innerText = errorText;
      field.closest(".form-group").appendChild(errorElement);
    };
  
    // Function to handle form submission
    const handleFormData = (e) => {
      e.preventDefault();
  
      // Retrieving input elements
      const emailInput = document.querySelector('#email');
      const passwordInput = document.querySelector('#password');
  
      // Getting trimmed values from input fields
      const email = emailInput.value.trim();
      const password = passwordInput.value.trim();
  
      // Regular expression pattern for email validation
      const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
     // Regular expression pattern for password validation
     const passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
  
      // Clearing previous error messages
      document.querySelectorAll(".form-group .error").forEach(field => field.classList.remove("error"));
      document.querySelectorAll(".error-text").forEach(errorText => errorText.remove());
  
      // Performing validation checks
      if (!emailPattern.test(email)) {
        showError(emailInput, "Enter a valid email address");
      }
      if (!passwordPattern.test(password)) {
        showError(passwordInput, "Enter your password");
    }
  
      // Checking for any remaining errors before form submission
      const errorInputs = document.querySelectorAll(".form-group .error");
      if (errorInputs.length > 0) return;
  
      // Additional actions (e.g., AJAX request, form submission)
      console.log("Login form submitted!");
    };
  
    // Adding the event listener to the form submission
    form.addEventListener('submit', handleFormData);
  });
  