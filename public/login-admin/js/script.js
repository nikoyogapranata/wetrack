document.addEventListener('DOMContentLoaded', () => {
  const loginForm = document.getElementById('email-form');
  const idInput = document.getElementById('id');
  const passwordInput = document.getElementById('password-2');
  const submitButton = loginForm.querySelector('input[type="submit"]');

  // Form validation
  function validateForm() {
    const idValue = idInput.value.trim();
    const passwordValue = passwordInput.value.trim();
    let isValid = true;

    if (idValue === '') {
      setError(idInput, 'ID is required');
      isValid = false;
    } else {
      clearError(idInput);
    }

    if (passwordValue === '') {
      setError(passwordInput, 'Password is required');
      isValid = false;
    } else {
      clearError(passwordInput);
    }

    return isValid;
  }

  function setError(input, message) {
    const errorElement = input.parentElement.querySelector('.error-message') || document.createElement('div');
    errorElement.className = 'error-message';
    errorElement.textContent = message;
    errorElement.style.color = 'red';
    errorElement.style.fontSize = '12px';
    errorElement.style.marginTop = '5px';
    input.parentElement.appendChild(errorElement);
    input.style.borderColor = 'red';
  }

  function clearError(input) {
    const errorElement = input.parentElement.querySelector('.error-message');
    if (errorElement) {
      errorElement.remove();
    }
    input.style.borderColor = '';
  }

  // Password visibility toggle
  function createPasswordToggle() {
    const toggleButton = document.createElement('button');
    toggleButton.type = 'button';
    toggleButton.className = 'password-toggle';
    toggleButton.innerHTML = '👁️';
    toggleButton.style.position = 'absolute';
    toggleButton.style.right = '10px';
    toggleButton.style.top = '50%';
    toggleButton.style.transform = 'translateY(-50%)';
    toggleButton.style.border = 'none';
    toggleButton.style.background = 'none';
    toggleButton.style.cursor = 'pointer';

    passwordInput.parentElement.style.position = 'relative';
    passwordInput.parentElement.appendChild(toggleButton);

    toggleButton.addEventListener('click', () => {
      passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
      toggleButton.innerHTML = passwordInput.type === 'password' ? '👁️' : '👁️‍🗨️';
    });
  }

  // Form submission
  loginForm.addEventListener('submit', (e) => {
    e.preventDefault();
    if (validateForm()) {
      submitButton.disabled = true;
      submitButton.value = 'Logging in...';
      loginForm.submit();
    }
  });

  // Initialize password toggle
  createPasswordToggle();

  console.log('Login page JavaScript loaded successfully.');
});

// Simulating form submission for demonstration
const simulateLogin = (id, password) => {
  console.log(`Simulating login with ID: ${id} and Password: ${password}`);
  // In a real scenario, this would be handled by the server-side PHP code
};

// Test the login simulation
simulateLogin('1234567', 'password123');