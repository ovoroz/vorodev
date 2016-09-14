<?php 
require_once 'include/db_cfg.php';

if($user->is_loggedin()!="")
{
  $user->redirect('home.php');
}

if(isset($_POST['loginSubmit']))
{
  $usernameEmail = $_POST['usernameEmail'];
  $upassword = $_POST['password'];
  
  if($user->userLogin($usernameEmail,$upassword))
  {
    $user->redirect('home.php');
  }
  else
  {
    $errorMsgLogin = $lang['LOGIN_WRONG_DETAILS'];
  }
}

?>

<html>

<head>
  <link rel="stylesheet" type="text/css" href="css/main.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?familiy=Baloo+Paaji" />
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>

<body>
  <div id="header"><?php include 'include/header.php' ; ?></div>
  <div id="login">
    <h3><?php echo $lang['LOGIN_LOGIN'] ?></h3>
    <form method="post" action="" name="login">
      <label><?php echo $lang['LOGIN_USERNAME_OR_EMAIL'] ?></label>
      <input type="text" name="usernameEmail" autocomplete="off" />
      <label><?php echo $lang['LOGIN_PASSWORD'] ?></label>
      <input type="password" name="password" autocomplete="off" />
      <div class="errorMsg">
        <?php echo $errorMsgLogin; ?>
      </div>
      <input type="submit" class="button" name="loginSubmit" value="<?php $submit_txt = $lang['LOGIN_BUTTON_LOGIN']; echo htmlspecialchars($submit_txt); ?>" /><br>
      <label><?php echo $lang['LOGIN_NOT_REG_YET'] ?>
        <a href="register.php"><?php echo $lang['LOGIN_SIGNUP_NOW'] ?></a>
      </label>
    </form>
  </div>

</body>

</html>