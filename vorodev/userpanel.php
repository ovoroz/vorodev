<?php
    require_once 'include/db_cfg.php';
  if(!$user->is_loggedin())
{
  $user->redirect('login.php');
}
      $user_id = $_SESSION['user_session'];
      $stmt = $dbConnection->prepare("SELECT * FROM users WHERE user_id=:user_id");
      $stmt->bindparam(":user_id",$user_id);
      $stmt->execute();
      $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
      $LoggedUserName = ($userRow['username']); 
      $LoggedUserRank = ($userRow['user_rank']); ?>
<!DOCTYPE html>
<head>
  <link rel="stylesheet" href="css/main.css" />
  <link rel="stylesheet" href="css/upan.css" />

  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
   
</head>

<body>
    <div id="header"><?php include 'include/header.php' ; ?></div>
  
    <div id="upanelcont">
      <div id="userpic">
        
      </div>
      <div id="upanmain">
       <?php echo $LoggedUserName; ?> <br>
          <p id="prank"> <?php echo $LoggedUserRank; ?> </p>
      </div>
  </div>
  
</body>
</html>
