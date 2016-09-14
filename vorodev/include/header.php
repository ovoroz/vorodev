<?php require_once 'include/db_cfg.php' ?>
<!DOCTYPE html>
<html>

<head>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/css_lang/languages.min.css" />
  <link rel="stylesheet" href="css/header.css" />
</head>

<body>
  <div id="container">

    <div id="logo">

      <a href="index.php">Voro_Dev</a>

    </div>
   
    <div id="lang_select">

        <a href="?lang=en"><span class="lang-sm lang-lbl" lang="en"></span></a>
        <a href="?lang=it"><span class="lang-sm lang-lbl" lang="it"></span></a>
    </div>
    
    <div id="user_info_logout">
    <?php

      $user_id = $_SESSION['user_session'];
      $stmt = $dbConnection->prepare("SELECT * FROM users WHERE user_id=:user_id");
      $stmt->bindparam(":user_id",$user_id);
      $stmt->execute();
      $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
      $LoggedUserName = ($userRow['username']);
       echo $lang['HOME_WELCOME'] ." ".$LoggedUserName."   ".'<a href="logout.php">Logout</a> <a href="userpanel.php">User_Panel</a>';
    ?>      
    </div>
    
  </div>
</body>

</html>