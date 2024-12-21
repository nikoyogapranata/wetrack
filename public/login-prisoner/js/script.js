document.addEventListener('DOMContentLoaded', () => {
  const loginForm = document.getElementById('email-form');
  const idInput = document.getElementById('id');
  const passwordInput = document.getElementById('password-2');
  const submitButton = loginForm.querySelector('input[type="submit"]');

  // Form validation
  function validateForm() {
    let isValid = true;
    const fields = [
      { input: idInput, name: 'ID' },
      { input: passwordInput, name: 'Password' }
    ];

    fields.forEach(field => {
      if (field.input.value.trim() === '') {
        setError(field.input, `${field.name} is required`);
        isValid = false;
      } else {
        clearError(field.input);
      }
    });

    return isValid;
  }

  function setError(input, message) {
    clearError(input);
    const errorElement = document.createElement('div');
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
      
      // Simulate API call
      setTimeout(() => {
        // Reset form state
        submitButton.disabled = false;
        submitButton.value = 'Login';
        
        // Show success message (in a real scenario, this would be handled by the server response)
        const successMessage = document.querySelector('.w-form-done');
        successMessage.style.display = 'block';
        setTimeout(() => {
          successMessage.style.display = 'none';
        }, 3000);

        // Clear form fields
        loginForm.reset();
      }, 2000);
    }
  });

  // Initialize password toggle
  createPasswordToggle();

  // Add some basic security measures
  document.addEventListener('contextmenu', (e) => e.preventDefault()); // Disable right-click
  document.addEventListener('keydown', (e) => {
    if (e.ctrlKey && (e.key === 'u' || e.key === 's')) {
      e.preventDefault(); // Disable Ctrl+U and Ctrl+S
    }
  });

  console.log('Login page JavaScript loaded successfully.');
});

// For demonstration purposes only
function simulateLogin(id, password) {
  console.log(`Login attempted with ID: ${id} and Password: ${password}`);
  // In a real scenario, this would be handled securely on the server-side
}

// Test the login simulation
simulateLogin('1234567', 'password123');