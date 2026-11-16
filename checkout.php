<?php
// Include database connection
include 'db.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $card_name = $_POST['cardholder'];
    $card_number = $_POST['cardNumber'];
    $expiry_date = $_POST['exp_date'];
    $cvv = $_POST['cvv'];

    $user_id = 1; 
    $total = 50.00; 
    $stmt = $conn->prepare("INSERT INTO checkout (user_id, total, card_name, card_number, expiry_date, cvv) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("idssss", $user_id, $total, $card_name, $card_number, $expiry_date, $cvv);

    if ($stmt->execute()) {
        header("Location: pickup.php"); 
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Checkout</title>
  <link rel="stylesheet" href="style.css" />
  <!-- Preconnect to improve loading performance for Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Italianno&display=swap" rel="stylesheet">
</head>
<body>

<!-- Website header displaying the brand name -->
<header>Blossom & Bloom</header>

<!-- Navigation bar with links to different pages -->
<nav>
  <ul>
    <li><a href="homepage.html">ABOUT</a></li>
    <li><a href="cart.html">SHOPPING CART</a></li>
    <li><a href="Message.html">MESSAGE</a></li>
    <li><a href="occasions.html">GIFTS</a></li>
    <li><a href="boquet.html">BOQUETS</a></li>
  </ul>
</nav>

<!-- Checkout Form -->
<div class="container">
  <h2>Payment information</h2>
  <form method="POST" onsubmit="return validateForm();">
    <!-- Card Number Field -->
    <label>Card number:</label>
    <input type="text" id="cardNumber" name="cardNumber" placeholder="1234 5678 9012 3456" required 
      inputmode="numeric" pattern="\d{4} \d{4} \d{4} \d{4}" maxlength="19" 
      title="Please enter a 16-digit card number" />

    <!-- Cardholder Name Field -->
    <label>Cardholder's name:</label>
    <input type="text" id="cardholder" name="cardholder" placeholder="e.g. Sarah Mohammed" required 
      pattern="[A-Za-z\s]+" title="Only English letters and spaces are allowed" />

    <!-- Exp date Field -->
    <label>Exp date:</label>
    <input type="month" id="exp_date" name="exp_date" required />

    <!-- CVV Field -->
    <label>CVV:</label>
    <input type="text" id="cvv" name="cvv" placeholder="123" required 
      inputmode="numeric" pattern="\d{3}" maxlength="3" 
      title="Please enter a 3-digit CVV" />

    <button type="submit">Submit</button>
  </form>
</div>

<!-- JavaScript -->
<script>
  // Format card number input
  const cardInput = document.getElementById('cardNumber');
  cardInput.addEventListener('input', function (e) {
    let value = e.target.value.replace(/\D/g, ''); // Remove non-digits
    value = value.substring(0, 16); // Limit to 16 digits
    const formatted = value.match(/.{1,4}/g)?.join(' ') || '';
    e.target.value = formatted;
  });

  // Prevent non-digit input in CVV
  const cvvInput = document.getElementById('cvv');
  cvvInput.addEventListener('input', function (e) {
    e.target.value = e.target.value.replace(/\D/g, ''); // Remove non-digits
  });

  // Prevent non-letter input in cardholder name
  const nameInput = document.getElementById('cardholder');
  nameInput.addEventListener('input', function (e) {
    e.target.value = e.target.value.replace(/[^A-Za-z\s]/g, '');
  });

  // Custom form validation
  function validateForm() {
    const cardNumber = document.getElementById('cardNumber').value.replace(/\s/g, '');
    const cvv = document.getElementById('cvv').value;

    if (!/^\d{16}$/.test(cardNumber)) {
      alert('Please enter a valid 16-digit card number.');
      return false;
    }

    if (!/^\d{3}$/.test(cvv)) {
      alert('Please enter a valid 3-digit CVV.');
      return false;
    }

    return true;
  }
</script>

</body>
</html>
