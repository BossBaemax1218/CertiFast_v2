document.addEventListener('DOMContentLoaded', () => {
  const form = document.querySelector("form");

  const handleFormData = (e) => {
    e.preventDefault();

    // Check if all fields are filled
    const verificationCodeInput = document.querySelector(".input");
    const verificationCode = verificationCodeInput.value.trim();

    if (!verificationCode) {
      showError(verificationCodeInput, "Please enter the verification code");
      return;
    }

    // Perform additional validation for other fields if needed

    form.submit();
  };

  form.addEventListener("submit", handleFormData);

  const showError = (field, errorText) => {
    field.classList.add("error");
    const errorElement = document.createElement("small");
    errorElement.classList.add("error-text");
    errorElement.innerText = errorText;
    field.parentNode.appendChild(errorElement);
  };
});
