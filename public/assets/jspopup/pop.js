// script.js
document.getElementById('addToCartButton').addEventListener('click', function() {
    // Add the item to the cart (this part depends on your specific implementation)
  
    // Show the pop-up message
    document.getElementById('cartPopup').style.display = 'block';
  
    // Hide the pop-up message after 3 seconds
    setTimeout(function() {
      document.getElementById('cartPopup').style.display = 'none';
    }, 3000);
  });
  
  document.getElementsByClassName('close')[0].addEventListener('click', function() {
    document.getElementById('cartPopup').style.display = 'none';
  });
  