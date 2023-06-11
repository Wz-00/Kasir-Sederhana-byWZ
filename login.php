<?php
require 'function.php';

// Memproses form login jika ada data yang dikirim
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $username = $_POST['username'];
//     $password = $_POST['password'];

//     if (validateLogin($username, $password, $conn)) {
//         $_SESSION['username'] = $username;
//         header("Location: index.php"); // Ganti dengan halaman dashboard yang sesuai
//     } else {
//         $error = "Username atau password salah!";
//     }
// }
session_start();
if (isset($_SESSION['user'])) {
    // Redirect to index.php if already logged in
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']) ? $_POST['remember'] : false;



    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize user input
    $user = $conn->real_escape_string($user);
    $password = $conn->real_escape_string($password);

    // Hash the password using md5
    $hashedPassword = md5($password);

    // Retrieve user from the database
    $query = "SELECT * FROM `login` WHERE `user`='$user' AND `pass`='$hashedPassword'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // User found, set session variables
        $_SESSION['user'] = $user;

        if ($remember) {
            // Create a remember me cookie
            $token = md5(uniqid(rand(), true));
            $expiry = time() + (60 * 60 * 24 * 30); // 30 days

            // Store the token in the database
            $query = "UPDATE `login` SET `token`='$token', `expiry`='$expiry' WHERE `user`='$user'";
            $conn->query($query);

            // Set the token as a cookie
            setcookie("remember_token", $token, $expiry);
        }

        // Redirect to index.php
        header("Location: index.php");
        exit;
    } else {
        // Invalid username or password
        $error = "Invalid username or password.";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Document</title>
</head>



<body style="background-color: #17a2b8;">
    <div id="login">
        <h3 class="text-center text-white pt-5">Login form</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">Login</h3>
                            <?php if (isset($error)) { ?>
                                <div>
                                    <script>
                                        alert("<?php echo $error; ?>");
                                    </script>
                                </div>
                            <?php } ?>
                            <div class="form-group">
                                <label for="username" class="text-info">Username:</label><br>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="remember-me" class="text-info"><span>Remember me</span> <span><input
                                            id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Login">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>