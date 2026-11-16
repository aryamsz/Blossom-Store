<?php
// Include the database connection
include 'db.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $city = $_POST['city'];
    $location = $_POST['location'];
    $receiver = $_POST['receiver'];

    $pickup_date = date('Y-m-d');
    $pickup_time = date('H:i:s');
    $user_id = 1; // Static user ID for now

    $stmt = $conn->prepare("INSERT INTO pickup (user_id, city, location, receiver, pickup_date, pickup_time) VALUES (?, ?, ?, ?, ?, ?)");
    
    if ($stmt) {
        $stmt->bind_param("isssss", $user_id, $city, $location, $receiver, $pickup_date, $pickup_time);

        if ($stmt->execute()) {
            // Redirect to thank you page after successful insert
            header("Location: thankyou.html");
            exit();
        } else {
            // Optional: handle insertion error
            // echo "Error: " . $stmt->error;
        }
    } else {
        // Optional: handle prepare error
        // echo "Prepare failed: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Pickup Page</title>

  <!-- Link to an external Google font (Italianno) for header styling -->
  <link href="https://fonts.googleapis.com/css2?family=Italianno&display=swap" rel="stylesheet">

  <style>
    /* Your styles (unchanged) */
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #fffaf8;
    }
    header {
      background: linear-gradient(to right, #f4c2b5, #f7d9c4);
      padding: 20px;
      text-align: center;
      font-size: 65px;
      color: white;
      font-family: "Italianno", cursive;
      font-weight: bold;
    }
    nav ul {
      display: flex;
      list-style: none;
      gap: 2rem;
      justify-content: center;
      padding: 8px 0;
      margin: 0;
      background-color: rgba(154, 185, 128, 0.9);
    }
    nav ul li a {
      text-decoration: none;
      color: #fff;
      font-weight: bold;
      transition: color 0.3s ease;
    }
    nav ul li a:hover {
      color: #ffe5e5f0;
    }
    .container {
      max-width: 800px;
      margin: 40px auto;
      background-color: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    h2 {
      color: #444;
      margin-bottom: 20px;
    }
    label {
      font-weight: bold;
      display: block;
      margin-top: 15px;
    }
    input[type="text"], select {
      width: 100%;
      padding: 10px;
      margin-top: 6px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }
    .radio-group {
      margin: 10px 0;
    }
    .radio-group label {
      display: inline-block;
      margin-right: 20px;
      font-weight: normal;
    }
    button {
      background-color: #f4a896;
      color: white;
      padding: 12px 25px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 16px;
    }
    button:hover {
      background-color: #e88c7a;
    }
  </style>
</head>

<body>

  <!-- Website header -->
  <header>Blossom & Bloom</header>

  <!-- Navigation menu -->
  <nav>
    <ul>
      <li><a href="homepage.html">ABOUT</a></li>
      <li><a href="cart.php">SHOPPING CART</a></li>
      <li><a href="Message.html">MESSAGE</a></li>
      <li><a href="occasions.html">GIFTS</a></li>
      <li><a href="boquet.html">BOQUETS</a></li>
    </ul>
  </nav>

  <!-- Main container with the pickup form -->
  <div class="container">
    <h2>Pickup Information</h2>

    <!-- Pickup form -->
    <form action="pickup.php" method="POST" onsubmit="return validatePickupForm();">
      <!-- Dropdown to select city -->
      <label for="city">Select your city:</label>
      <select id="city" name="city" required>
        <option value="">-- Please choose a city --</option>
        <option>Qassim</option>
        <option>Riyadh</option>
        <option>Jeddah</option>
        <option>Mecca</option>
        <option>Medina</option>
        <option>Dammam</option>
        <option>Abha</option>
        <option>Tabuk</option>
        <option>Hail</option>
        <option>Najran</option>
      </select>

      <!-- Input for location description -->
      <label for="location">Location description:</label>
      <input type="text" id="location" name="location" placeholder="Describe your pickup location" required>

      <!-- Radio buttons to select who will pick up the order -->
      <label>Who will pick up the order?</label>
      <div class="radio-group">
        <label><input type="radio" name="receiver" value="self"> I will pick it up</label>
        <label><input type="radio" name="receiver" value="someone"> Someone else will pick it up</label>
      </div><br><br>

      <!-- Submit button -->
      <button type="submit">Submit</button>
    </form>
  </div>

  <!-- JavaScript for form validation -->
  <script>
    function validatePickupForm() {
      const city = document.getElementById('city').value;
      const location = document.getElementById('location').value;
      const receiver = document.querySelector('input[name="receiver"]:checked');

      if (!city || !location || !receiver) {
        alert("Please fill all fields!");
        return false;
      }
      return true;
    }
  </script>

</body>
</html>
