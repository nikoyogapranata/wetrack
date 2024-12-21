// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', (event) => {
  // Smooth scrolling for navigation links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      document.querySelector(this.getAttribute('href')).scrollIntoView({
        behavior: 'smooth'
      });
    });
  });

  // FAQ accordion functionality
  const faqQuestions = document.querySelectorAll('.main-faq-question-container');
  faqQuestions.forEach(question => {
    question.addEventListener('click', () => {
      const answer = question.querySelector('.main-faq-answer-box');
      const icon = question.querySelector('.waves---expand-icon-wrap');
      
      answer.style.maxHeight = answer.style.maxHeight ? null : answer.scrollHeight + "px";
      icon.classList.toggle('active');
    });
  });

  // Mobile menu toggle
  const menuButton = document.querySelector('.nav-menu-button');
  const navMenu = document.querySelector('.nav-right-menu');
  
  menuButton.addEventListener('click', () => {
    navMenu.classList.toggle('w--open');
    menuButton.classList.toggle('w--open');
  });

  // Close mobile menu when a link is clicked
  const navLinks = document.querySelectorAll('.nav-right-link');
  navLinks.forEach(link => {
    link.addEventListener('click', () => {
      navMenu.classList.remove('w--open');
      menuButton.classList.remove('w--open');
    });
  });

  console.log('JavaScript for WETRACK landing page loaded successfully.');
});