function navigateTo(page) {
    window.location.href = page;
  }

  function logout() {
    alert("You have logged out.");
    window.location.href = '/frontend/pages/public/landing-page/index.html'; // Redirect to login page
  }