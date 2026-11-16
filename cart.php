<?php
session_start(); // Start the session to store user data like the shopping cart

// Initialize the cart if it doesn't already exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Function to calculate the total price of all items in the cart
function calculateTotal() {
    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['quantity']; // Add (price × quantity) for each item
    }
    return $total;
}

// Handle removing an item from the cart if "remove" is set in the URL
if (isset($_GET['remove'])) {
    $index = $_GET['remove']; // Get the index of the item to remove
    unset($_SESSION['cart'][$index]); // Remove the item from the cart
    $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex the array after removing
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="style.css" /> <!-- Link to the CSS file -->
</head>
<body>
    <header>Blossom & Bloom - Shopping Cart</header> <!-- Page header -->

    <nav>
        <!-- Navigation menu -->
        <ul>
            <li><a href="homepage.html">ABOUT</a></li>
            <li><a href="cart.php">SHOPPING CART</a></li>
            <li><a href="Message.php">MESSAGE</a></li>
            <li><a href="occasions.html">GIFTS</a></li>
            <li><a href="boquet.html">BOUQUETS</a></li>
        </ul>
    </nav>

    <div class="container">
        <h2>Your Shopping Cart</h2>
        <?php if (empty($_SESSION['cart'])): ?>
            <!-- If the cart is empty -->
            <p>Your cart is empty.</p>
        <?php else: ?>
            <!-- If there are items, display them in a table -->
            <table>
                <thead>
                    <tr>
                        <th>Product</th> <!-- Product name -->
                        <th>Price</th> <!-- Price per unit -->
                        <th>Quantity</th> <!-- Quantity selected -->
                        <th>Total</th> <!-- Total price for the product (price × quantity) -->
                        <th>Action</th> <!-- Remove option -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['name']); ?></td> <!-- Securely display the product name -->
                            <td>$<?php echo number_format($item['price'], 2); ?></td> <!-- Display the price formatted with 2 decimals -->
                            <td><?php echo $item['quantity']; ?></td> <!-- Display quantity -->
                            <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td> <!-- Display total for this item -->
                            <td><a href="?remove=<?php echo $index; ?>">Remove</a></td> <!-- Link to remove this item -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p><strong>Total: $<?php echo number_format(calculateTotal(), 2); ?></strong></p> <!-- Display overall cart total -->
            <form action="checkout.php" method="POST">
    <button type="submit">Proceed to Checkout</button>
</form> <!-- Button to go to checkout page -->
            <button onclick="clearCart()">Clear Cart</button> <!-- Button to clear the cart -->
        <?php endif; ?>
    </div>

    <script>
        // JavaScript function to confirm and clear the cart
        function clearCart() {
            if (confirm('Are you sure you want to clear your cart?')) {
                window.location.href = 'clear_cart.php'; // Redirect to a PHP file that clears the cart
            }
        }
    </script>
</body>
</html>

