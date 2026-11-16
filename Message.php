<?php
// Database connection setup

include 'db.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $message = $_POST['message'];
    $user_id = $_POST['user_id'];

    $stmt = $conn->prepare("INSERT INTO messages (user_id, message) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $message);
    $stmt->execute();
    $stmt->close();

    // Success alert after sending
    echo "<script>alert('Message Sent!');</script>";
}

// Retrieve all messages from the database
$result = $conn->query("SELECT * FROM messages ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Pickup Page</title>
  <link href="https://fonts.googleapis.com/css2?family=Italianno&display=swap" rel="stylesheet">

  <style>
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
      text-align: center;
      font-family: "Italianno", cursive;
      font-size: 38px;
      color: #f4a896;
      margin-bottom: 20px;
    }

    label {
      font-weight: bold;
      display: block;
      margin-top: 15px;
    }

    textarea {
      width: 100%;
      padding: 15px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 10px;
      background-color: #fffaf8;
      resize: none;
      margin-top: 10px;
    }

    button {
      background-color: #f4a896;
      color: white;
      padding: 12px 25px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 16px;
      margin-top: 15px;
    }

    button:hover {
      background-color: #e88c7a;
    }

    .quote {
      text-align: center;
      font-style: italic;
      color: #7b1f45;
      margin-bottom: 25px;
    }

    .messages {
      margin-top: 40px;
    }

    .message-box {
      background-color: #fdf0ec;
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 15px;
      box-shadow: 0 1px 4px rgba(0,0,0,0.05);
    }

    .message-box time {
      font-size: 13px;
      color: #999;
      display: block;
      margin-bottom: 5px;
    }
  </style>
</head>
<body>

  <header>Blossom & Bloom</header>

  <nav>
    <ul>
      <li><a href="homepage.html">ABOUT</a></li>
      <li><a href="cart.html">SHOPPING CART</a></li>
      <li><a href="Message.php">MESSAGE</a></li>
      <li><a href="occasions.html">GIFTS</a></li>
      <li><a href="boquet.html">BOQUETS</a></li>
    </ul>
  </nav>

  <div class="container">
    <h2>Your Flower Message</h2>
    <p class="quote">"A flower is a silent note of love."</p>

    <!-- Message Form -->
    <form method="POST" class="message-form">
      <label for="message">Write your message on the card:</label>
      <textarea name="message" id="message" rows="6" placeholder="Type your message here..." required></textarea>
      <input type="hidden" name="user_id" value="1">
      <button type="submit">Send</button>
    </form>
    <!-- Display previous messages -->
    <div class="messages">
      <h3 style="margin-top: 40px; color: #d9836e;">Previous Messages:</h3>

      <?php while($row = $result->fetch_assoc()): ?>
        <div class="message-box">
          <time><?php echo date('Y-m-d H:i', strtotime($row['created_at'])); ?></time>
          <p><?php echo htmlspecialchars($row['message']); ?></p>
        </div>
      <?php endwhile; ?>
    </div>
  </div>

</body>
</html>

<?php
$conn->close();
?>