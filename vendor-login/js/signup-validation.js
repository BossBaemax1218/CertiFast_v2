document.addEventListener('DOMContentLoaded', () => {
    // Selecting form and input elements
    const form = document.querySelector("#signupForm"); // Updated selector to match the form's ID

    // Function to display error messages
    const showError = (field, errorText) => {
        field.classList.add("error");
        const errorElement = document.createElement("small");
        errorElement.classList.add("error-text");
        errorElement.innerText = errorText;
        field.closest(".form-group").appendChild(errorElement);
    }

    // Function to handle form submission
    const handleFormData = (e) => {
        e.preventDefault();

        // Retrieving input elements
        const fullnameInput = document.getElementById("fullname");
        const emailInput = document.getElementById("email");
        const passwordInput = document.getElementById("password");

        // Getting trimmed values from input fields
        const fullname = fullnameInput.value.trim();
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
        if (fullname === "") {
            showError(fullnameInput, "Enter your full name");
        }
        if (!emailPattern.test(email)) {
            showError(emailInput, "Enter a valid email address");
        }
        if (!passwordPattern.test(password)) {
            showError(passwordInput, "Enter your password");
        }

        // Checking for any remaining errors before form submission
        const errorInputs = document.querySelectorAll(".form-group .error");
        if (errorInputs.length > 0) return;

        // Submitting the form
        form.submit();
    }

    // Adding the event listener to the form submission
    form.addEventListener('submit', handleFormData);
});