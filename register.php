<?php
require_once "config.php";

// Define username and password as well as errors
$firstName = $lastName = $username = $password = $confirm_password = "";
$firstName_err = $lastName_err = $username_err = $password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    //Validate First Name
    if(empty(trim($_POST["firstName"]))){
        $firstName_err = "Please enter your first name.";
    }
    else {
        $firstName = trim($_POST["firstName"]);

    }

    //Validate Last Name
    if(empty(trim($_POST["lastName"]))) {
        $lastName_err = "Please enter your last name.";
    }
    else {
        $lastName = trim($_POST["lastName"]);

    }

    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        $sql = "SELECT instructor_id FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = trim($_POST["username"]);

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have at least 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Passwords did not match.";
        }
    }

    // Check input errors before inserting in database
    if(empty($firstName_err) && empty($lastName_err) && empty($username_err) && empty($password_err) && empty($confirm_password_err)){

        $sql = "INSERT INTO users (firstName, lastName, username, password) VALUES (?,?,?,?)";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ssss", $param_firstName, $param_lastName, $param_username, $param_password);

            $param_firstName = $firstName;
            $param_lastName = $lastName;
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location:login.php");
            } else{
                echo "Something went wrong. Please try again later.";
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
    <title>Sign Up</title>
    <link rel="stylesheet" href="stylesForSignUp.css?v=<?php echo time(); ?>">
    <link rel="icon" href="images/logofavicon.ico">
</head>

<body>
  <div class="main-container">
    <div class="back-button">
      <a href="login.php" class="returnButton">
          <img border="0" alt="return" src="images/BACKBUTTON.png" width="40" height="30">
      </a>
    </div>
    <div class="container">
        <h2>Create Account</h2>
        <form class="row" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($firstName_err)) ? 'has-error' : ''; ?>">
                <input type="text" name="firstName" placeholder="First Name" class="form-control" value="<?php echo $firstName; ?>">
                <span class="help-block"><?php echo $firstName_err;?></span>
            </div>
            <div class="form-group <?php echo (!empty($lastName_err)) ? 'has-error' : ''; ?>">
                <input type="text" name="lastName" placeholder="Last Name" class="form-control" value="<?php echo $lastName; ?>">
                <span class="help-block"><?php echo $lastName_err;?></span>
            </div>
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <input type="text" name="username" placeholder="Username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="password" placeholder="Password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="buttons">
                <div class="form-group">
                    <input type="submit" class="btn" value="Submit">
                    <input type="reset" class="btn" value="Reset">
                </div>
            </div>
        </form>
    </div>
  </div>

</body>
</html>
