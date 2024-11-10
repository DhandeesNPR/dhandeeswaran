// config.php
<?php
  // Database configuration
  $db_host = 'localhost';
  $db_username = 'root';
  $db_password = '';
  $db_name = 'facebook_app';

  // Create a connection to the database
  $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
?>

// users.php
<?php
  // User registration
  if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into the database
    $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password_hash')";
    $conn->query($query);
  }

  // User login
  if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Retrieve user from the database
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
      $user = $result->fetch_assoc();
      if (password_verify($password, $user['password'])) {
        // Login successful, set session variables
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $user['email'];
      } else {
        echo "Invalid password";
      }
    } else {
      echo "User not found";
    }
  }
?>

// posts.php
<?php
  // Create a new post
  if (isset($_POST['create_post'])) {
    $post_content = $_POST['post_content'];
    $user_id = $_SESSION['user_id'];

    // Insert post into the database
    $query = "INSERT INTO posts (user_id, post_content) VALUES ('$user_id', '$post_content')";
    $conn->query($query);
  }

  // Retrieve posts from the database
  $query = "SELECT * FROM posts";
  $result = $conn->query($query);

  while ($post = $result->fetch_assoc()) {
    echo "<p>" . $post['post_content'] . "</p>";
  }
?>