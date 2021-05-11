<?php
require_once "session.php";
require_once "config.php";

//New variables
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    //validate new password
    if(empty(trim($_POST["new_password"]))) {
        $new_password_err = "Please enter a new password";
    }
    elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have at least 6 characters.";
    }
    else {
        $new_password = trim($_POST["new_password"]);
    }

    //validate confirm password
    if(empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please Confirm Your Password";
    }
    else {
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)) {
            $confirm_password_err = "Passwords didn't match!";
        }
    }

    //Check for errors before update
    if(empty($new_password_err) && empty($confirm_password_err)) {
        //Update
        $sql = "UPDATE users SET password = ? WHERE instructor_id = ?";
        if($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            //Execute
            if(mysqli_stmt_execute($stmt)) {
                //Password updated, destroy session and relogin
                header("location:login.php");
                session_destroy();
                exit();
            }
            else {
                echo "Oops! Something has gone wrong, contact system administrator.";
            }

            //Close
            mysqli_stmt_close($stmt);
        }
    }

    //Close DB connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Password</title>
    <!-- For Nunito Sans font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@1,200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="stylesForForgotPass.css?v=<?php echo time(); ?>">
    <link rel="icon" href="images/logofavicon.ico">
</head>
<body>
  <div class="title-container">
    <div class="back-button-container">
      <a href="ClassSelection.php" class="returnButton">
          <img border="0" alt="return" src="images/BACKBUTTON.png" width="40" height="30">
      </a>
    </div>
    <h2>Reset Password</h2>
  </div>
    <div class="container">
        <form class = "row" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="new_password" class="form-control" placeholder="New Password" value="<?php echo $new_password; ?>">
                <span class="help-block"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="buttons">
                <input type="submit" class="btn" value="Submit">
            </div>
        </form>
    </div>
</body>
</html>
