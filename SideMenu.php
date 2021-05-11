<?php
require_once "session.php";

$previous = "javascript:history.go(-1)";
if(isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- For Nunito Sans font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@1,200&display=swap" rel="stylesheet">
    <title>Side Menu</title>
    <link rel="stylesheet" href="stylesForSideMenu.css" type="text/css">
    <link rel="icon" href="images/logofavicon.ico">
</head>

<body>
  <div class="title-container">
    <div class="back-button-container">
      <a href="<?= $previous ?>"><img src="images/BACKBUTTON.png" alt="back-button" class="back-btn" width="40" height="30"></a>
    </div>
    <p class="header">Settings</p>
  </div>
    <div class="container" style="text-align: center;">
        <div class="center">
            <a href="resetPassword.php" class="btn" role="button" aria-pressed="true">CHANGE PASSWORD</a>
            <a href="logout.php" class="btn" role="button" aria-pressed="true">SIGN OUT</a>
        </div>
    </div>

</body>

</html>
