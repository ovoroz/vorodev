<?php
include_once 'include/db_cfg.php';
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
$LoggedUserID = ($userRow['user_id']);

if(isset($_POST['addComment']))
{ 
  $datepost = date('Y-m-d H:i:s');
  $commentText = $_POST['commenttxt'];
  if($user->addComment($commentText,$LoggedUserID,$datepost))
  {
    $user->redirect('home.php');
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/main.css" />
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
   
</head>

<body>
    <div id="header"><?php include 'include/header.php' ; ?></div>
  
  <div id="commentsArea">
    <?php 
    $stmt = $dbConnection->prepare("SELECT comment_text, username, comment_date, comment_id FROM users, comments WHERE users.user_id = comments.user_id ORDER BY comment_id");
    $stmt->execute();
    $comment = $stmt->fetchAll(PDO::FETCH_ASSOC);
       
      foreach($comment as $row )
      {
        echo $row['comment_text']."<br>By ".'<a href="user/'.$row['username'].'/">'.$row['username']."</a>   ".$row['comment_date']. "<br><br>" ;
      }
    ?>
    <br><br>
    <form method="POST" action="" name="addcommentform">
      <label>Add Comment</label>
      <input type="text" name="commenttxt" autocomplete=off />
      <input type="submit" name="addComment">
    </form>
    
    
  </div>

</body>
</html>