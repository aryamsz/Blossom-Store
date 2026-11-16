<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <!-- Preconnecting to Google Fonts for better loading -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <!-- Importing the custom font "Italianno" from Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Italianno&display=swap" rel="stylesheet">

<style>
/* General body styles */
body {
  margin: 0;
  background-color: #f8f8f8e2; /* Light background color */
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif, "Italianno", cursive; /* Font-family setup */
}

/* Header styles */
header {
  background-color: #f5c5afe2; /* Soft pink background */
  color: white;
  padding: 20px 0;
  text-align: center;
}

/* Logo style within the header */
.logo {
  font-size: 65px;
  font-weight: bold;
  font-family: 'Italianno', serif;
}

/* Navigation bar styling */
nav ul {
  display: flex; /* Using flexbox for horizontal alignment */
  list-style: none;
  gap: 2rem; /* Adds space between navigation items */
  justify-content: center; /* Centers the navigation items */
  padding: 8px 0;
  margin: 0;
  background-color: rgba(154, 185, 128, 0.77); /* Greenish background */
}

/* Navigation links styling */
nav ul li a {
  text-decoration: none;
  color: #fff; /* White color for links */
  font-weight: bold;
  transition: color 0.3s ease; /* Smooth color change on hover */
}

/* Hover effect for navigation links */
nav ul li a:hover {
  color: #ffe5e5f0; /* Light pink color on hover */
}

/* Styling for the box container where products are displayed */
.box-container {
  display: flex;
  justify-content: space-between;
  align-items: flex-start; /* Align items at the top */
  padding: 60px 80px;
  gap: 20px; /* Adds space between the product boxes */
  flex-wrap: wrap; /* Allows products to wrap on smaller screens */
}

/* Individual product box styling */
.box {
  text-align: center;
  width: 18%; /* Controls how many items per row */
  background-color: #f4f4f4; /* Light grey background for each product box */
  padding: 10px;
  border-radius: 8px; /* Rounded corners */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Light shadow effect */
}

/* Image inside the product box */
.box img {
  width: 100%; /* Makes the image responsive */
  height: auto;
  border-radius: 8px;
}

/* Styling for the "Add to Cart" button */
.Icons a {
  display: block;
  margin: 10px 0;
  padding: 8px 12px;
  background-color: #f5c5afe2; /* Soft pink background */
  color: #fff; /* White text */
  text-decoration: none;
  border-radius: 4px; /* Rounded button corners */
  text-align: center;
}

/* Hover effect for "Add to Cart" buttons */
.Icons a:hover {
  background-color: #e7b7a2e2; /* Lighter pink background on hover */
}

/* Price text styling */
.price {
  font-size: 20px;
  color: #333; /* Darker color for price text */
  font-weight: bold;
}

/* Content styling inside the product box */
.content {
  color: rgb(152, 155, 158); /* Light grey text color for the product name */
  font-weight: lighter;
  font-size: 16px;
}

/* Adjusted price color */
.price {
  color: rgba(154, 185, 128, 0.77); /* Slightly greenish for price text */
}

</style>

</head>

<body>

<section class="Products" id="Products">
  <!-- Header section -->
  <header>
    <div class="logo">Blossom & Bloom</div>
  </header>

  <!-- Navigation bar -->
  <nav>
    <ul>
      <li><a href="homepage.html">ABOUT</a></li>
      <li><a href="cart.html">SHOPPING CART</a></li>
      <li><a href="Message.php">MESSAGE</a></li>
      <li><a href="occasions.html">GIFTS</a></li>
      <li><a href="boquet.html">BOQUETS</a></li>
    </ul>
  </nav>

  <!-- Product Display Section -->
  <div class="box-container">
    <!-- Each product box starts here -->
    <div class="box">
      <img src="B1.jpg" alt="White Roses bouquet" width="450" height="500">
      <div class="Icons">
        <!-- "Add to Cart" button -->
        <a href="#" class="f-cart" id="add1">add to cart</a>
      </div>
      <div class="content">
        <h3>White Roses bouquet</h3>
      </div>
      <div class="price">
        $20.75
      </div>
    </div>

    <!-- Repeat for other products -->
    <div class="box">
      <img src="B2.jpg" alt="Roses bouquet" width="450" height="500">
      <div class="Icons">
        <a href="#" class="f-cart" id="add2">add to cart</a>
      </div>
      <div class="content">
        <h3>Roses bouquet</h3>
      </div>
      <div class="price">
        $20.75
      </div>
    </div>

    <div class="box">
      <img src="B3.jpg" alt="Purple Tulip bouquet" width="450" height="500">
      <div class="Icons">
        <a href="#" class="f-cart" id="add3">add to cart</a>
      </div>
      <div class="content">
        <h3>Purple Tulip bouquet</h3>
      </div>
      <div class="price">
        $20.75
      </div>
    </div>

    <div class="box">
      <img src="B4.jpg" alt="Sunflower bouquet" width="450" height="500">
      <div class="Icons">
        <a href="#" class="f-cart" id="add4">add to cart</a>
      </div>
      <div class="content">
        <h3>Sunflower bouquet</h3>
      </div>
      <div class="price">
        $20.75
      </div>
    </div>

    <div class="box">
      <img src="B5.jpg" alt="Pink Roses bouquet" width="450" height="500">
      <div class="Icons">
        <a href="#" class="f-cart" id="add5">add to cart</a>
      </div>
      <div class="content">
        <h3>Pink Roses bouquet</h3>
      </div>
      <div class="price">
        $20.75
      </div>
    </div>

  </div>

</section>

<script>
// Product data for the bouquets
const products = [
  { name: "White Roses bouquet", price: 20.75 },
  { name: "Roses bouquet", price: 20.75 },
  { name: "Purple Tulip bouquet", price: 20.75 },
  { name: "Sunflower bouquet", price: 20.75 },
  { name: "Pink Roses bouquet", price: 20.75 }
];

// Add event listeners to "Add to Cart" buttons
for (let i = 0; i < products.length; i++) {
  document.getElementById("add" + (i + 1)).onclick = function () {
    // Get the cart from localStorage or initialize as an empty array
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    // Add the selected product to the cart
    cart.push(products[i]);
    // Save the updated cart back to localStorage
    localStorage.setItem("cart", JSON.stringify(cart));
    // Alert the user that the product was added to the cart
    alert(products[i].name + " added to cart!");
  };
}
</script>

</body>
</html>
