<?php
session_start();

//Check if user is logged in, then redirect
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("Location: ClassSelection.php");
  exit;
}

require_once "config.php";

// Define username and password
$username = $password = "";
$username_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT instructor_id, firstName, lastName, username, password FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $firstName, $lastName, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["firstName"] = $firstName;
                            $_SESSION["lastName"] = $lastName;

                            //create session variable to hold class currently being looked at, and set to defaultClass
                            /*$sql2 = "SELECT defaultClass
                                FROM users
                                WHERE instructor_id = $id";
                            $result = mysqli_query($link, $sql2) or die("Bad Query: $sql2");
                            $_SESSION["currentClass"] = $result;*/

                            //Timeout variables
                            $_SESSION['start'] = time();
                            $_SESSION['expire'] = $_SESSION['start'] + (120 * 60);

                            // Redirect user to welcome page
                            header("Location: ClassSelection.php");//<----Change
                        } else{
                            // Error if password entered incorrectly
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // No account error message
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- For Nunito Sans font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@1,200&display=swap" rel="stylesheet">
    <title>SeatDeetz</title>
    <link rel="stylesheet" href="stylesForLogin.css?v=<?php echo time(); ?>">
    <link rel="icon" href="images/logofavicon.ico">
</head>

<body>
    <div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <form class="fields" action="" method="post">
            <div class="row">
                <div class="inputs  <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $username; ?>">
                    <span class="help-block"><?php echo $username_err; ?></span>
                </div>
                <div class="inputs <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <span class="help-block"><?php echo $password_err; ?></span>
                </div>

                <div class="nonTextField">
                    <div class="inputs">
                        <input type="submit" name="submit" class="btn" value="Login">
                    </div>
                </div>
                <div class="createAndforgot">
                    <div class="inputs">
                        <a href="register.php">Create Account</a>
                    </div>
                </div>
            </div>
        </form>
    </form>
    </div>
</body>

</html>
