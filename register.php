<?php
// Database connection
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "pharmacy6"; // change to your DB name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = [];

if (isset($_POST['submit'])) {

    $name      = trim($_POST['name']);
    $email     = trim($_POST['email']);
    $pass      = $_POST['password'];
    $cpass     = $_POST['cpassword'];
    $user_type = $_POST['user_type'];

    // Check if user already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $message[] = 'User already exists!';
    } else {
        if ($pass !== $cpass) {
            $message[] = 'Confirm password not matched!';
        } else {
            // Hash password
            $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

            // Insert user
            $insert = $conn->prepare("INSERT INTO users (name, email, password, user_type) VALUES (?, ?, ?, ?)");
            $insert->bind_param("ssss", $name, $email, $hashed_pass, $user_type);

            if ($insert->execute()) {
                $message[] = 'Registered successfully!';
                header("Location: login.php");
                exit;
            } else {
                $message[] = 'Registration failed!';
            }
        }
    }

    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
if (!empty($message)) {
    foreach ($message as $msg) {
        echo '
        <div class="message">
            <span>' . htmlspecialchars($msg) . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>';
    }
}
?>


<div class="form-container" style="background: url('images/bg.jpeg') no-repeat center center; background-size: cover; min-height: 100vh; display: flex; align-items: center; justify-content: center;">
 >
   <form action="" method="post">
      <h3>Register Now</h3>
      <input type="text" name="name" placeholder="Enter your name" required class="box">
      <input type="email" name="email" placeholder="Enter your email" required class="box">
      <input type="password" name="password" placeholder="Enter your password" required class="box">
      <input type="password" name="cpassword" placeholder="Confirm your password" required class="box">
      <select name="user_type" class="box">
         <option value="user">User</option>
         <option value="admin">Admin</option>
      </select>
      <input type="submit" name="submit" value="Register Now" class="btn">
      <p>Already have an account? <a href="login.php">Login now</a></p>
   </form>
</div>

</body>
</html>
