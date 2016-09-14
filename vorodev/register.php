<?php 
require_once 'include/db_cfg.php';

if($user->is_loggedin()!="")
{
  $user->redirect('home.php');
}

if(isset($_POST['signupSubmit']))
{
  $uname = trim($_POST['usernameReg']);
  $umail = trim($_POST['emailReg']);
  $upass = trim($_POST['passwordReg']);
  
  if($uname=="") {
    $errorMsgReg[] = $lang['REGISTER_ERROR_PROVIDE_USERNAME'];
  }
  else if($umail=="") {
    $errorMsgReg[] = $lang['REGISTER_ERROR_PROVIDE_EMAIL'];
  }
  else if($upass=="") {
    $errorMsgReg[] = $lang['REGISTER_ERROR_PROVIDE_PASSWORD'];
  }
  else if(strlen($upass) < 6){
    $errorMsgReg[] = $lang['REGISTER_ERROR_PASSWORD_SHORT'];
  }
  else
  {
    try
    {
      /*$dbconn = getDB();*/
      $stmt = $dbConnection->prepare("SELECT username,user_email FROM users WHERE username=:uname OR user_email=:umail");
      $stmt->bindparam(":uname", $uname);
      $stmt->bindparam(":umail", $umail);
      $stmt->execute();
      $row=$stmt->fetchAll(PDO::FETCH_ASSOC);
      
      if(strcasecmp($row['username'], $uname) == 0 ) {
        $errorMsgReg[] = "Sorry, username already taken!";
      }
      else if(strcasecmp($row['user_email'], $uname) == 0 ) {
        $errorMsgReg[] = "Sorry, email already taken!"; 
      }
      else
      {
        if($user->userRegister($uname,$umail,$upass))
        {
          $user->redirect('login.php');
        }
      }
              }
      catch(PDOException $e)
      {
        echo $e->getMessage();
      }
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
  <div id="header">
    <?php include 'include/header.php' ; ?>
  </div>
  <div id="signup">
    <h3><?php echo $lang['REGISTER_REGISTRATION'] ?></h3>
    <form method="post" action="" name="signup">
      <label><?php echo $lang['REGISTER_USERNAME']  ?></label>
      <input type="text" name="usernameReg" autocomplete="off" maxlenght=16/>
      <label><?php echo $lang['REGISTER_EMAIL']  ?></label>
      <input type="text" name="emailReg" autocomplete="off" />
      <label><?php echo $lang['REGISTER_PASSWORD']  ?></label>
      <input type="password" name="passwordReg" autocomplete="off" maxlength=70 />
      <div class="errorMsg">

        <?php 
        if(isset($errorMsgReg))
        {
          foreach ($errorMsgReg as $errorMsgReg)
          {
             echo $errorMsgReg; 
          }
        }
        ?>

      </div>
      <input type="submit" class=" button" name="signupSubmit" value="<?php $submit_txt = $lang['REGISTER_BUTTON_REGISTER']; echo htmlspecialchars($submit_txt); ?>" /><br>
      <label><?php echo $lang['REGISTER_ALR_HAVE_ACC']  ?><a href="login.php"><?php echo  $lang['REGISTER_LOGIN_NOW'] ?></a></label>
    </form>

  </div>
</body>

</html>