document.addEventListener('DOMContentLoaded', function() {
    const loaderOverlay = document.getElementById('loaderOverlay');
    const mainContent = document.querySelector('body');
  
    setTimeout(function() {
      loaderOverlay.style.display = 'none';
      mainContent.style.display = 'block';
    }, 4000); // Display the loader for 4 seconds (4000ms)
  });
  