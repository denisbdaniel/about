<?php
// Database configuration
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";

// Connect to MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if the email parameter is set in the POST request
if (isset($_POST['email'])) {
  $email = $_POST['email'];

  // Validate the email address
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email address");
  }

  // Check if the email already exists in the database
  $sql = "SELECT id FROM subscribers WHERE email='$email'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    die("Email address already subscribed");
  }

  // Insert the email address into the subscribers table
  $sql = "INSERT INTO subscribers (email) VALUES ('$email')";
  if ($conn->query($sql) === FALSE) {
    die("Error: " . $sql . "<br>" . $conn->error);
  }

  // Validate the email address
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email address");
  }

  // Delete the email address from the subscribers table
  $sql = "DELETE FROM subscribers WHERE email='$email'";
  if ($conn->query($sql) === FALSE) {
    die("Error: " . $sql . "<br>" . $conn->error);
  }

  // Display an unsubscribe confirmation message
  echo "You have successfully unsubscribed from our newsletter.";
}
elseif (isset($_GET['confirm'])) {
  $email = $_GET['email'];

  // Validate the email address
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email address");
  }

  // Update the confirmed column of the subscribers table
  $sql = "UPDATE subscribers SET confirmed=1 WHERE email='$email'";
  if ($conn->query($sql) === FALSE) {
    die("Error: " . $sql . "<br>" . $conn->error);
  }

  // Display a confirmation message
  echo "Your subscription has been confirmed. Thank you for subscribing!";
}
else {
  // Display the subscription form
  echo '
    <form method="post">
      <input type="email" name="email" placeholder="Enter your email address">
      <button type="submit">Subscribe</button>
    </form>
  ';}

 // Display a list of subscribers
$sql = "SELECT email, confirmed FROM subscribers ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  echo "<h2>Subscribers</h2>";
  echo "<ul>";
  while ($row = mysqli_fetch_assoc($result)) {
    $email = htmlspecialchars($row['email']);
    $confirmed = $row['confirmed'] ? 'Yes' : 'No';
    echo "<li>$email (Confirmed: $confirmed)</li>";
  }
  echo "</ul>";
} else {
  echo "No subscribers found.";
}

// Input Validation
$email = $_POST['email'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  die("Invalid email address");
}

$email = mysqli_real_escape_string($conn, $email);

 // Rate limiting
 $ip = $_SERVER['REMOTE_ADDR'];

 if (isset($_SESSION['last_submit']) && $_SESSION['last_submit'] > time() - 60) {
   die("Too many submissions. Please try again later.");
 }
 
 $query = "SELECT COUNT(*) FROM subscribers WHERE ip = '$ip'";
 $result = mysqli_query($conn, $query);
 $count = mysqli_fetch_array($result)[0];
 
 if ($count >= 10) {
   die("Too many submissions from this IP address.");
 }
 $_SESSION['last_submit'] = time();
 