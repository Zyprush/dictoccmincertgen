// Hide the loading overlay initially
var loadingOverlay = document.getElementById('loading-overlay');
loadingOverlay.style.display = 'none';

// Function to show the loading overlay
function showLoadingOverlay() {
    document.getElementById('loading-overlay').style.display = 'flex';
  }
  
  // Function to hide the loading overlay
  function hideLoadingOverlay() {
    document.getElementById('loading-overlay').style.display = 'none';
  }
  
  // Attach an event listener to the email form submit event
  var emailForm = document.getElementById('email-form');
  emailForm.addEventListener('submit', function(event) {
    showLoadingOverlay(); // Show the loading screen when the form is submitted
  });
  
