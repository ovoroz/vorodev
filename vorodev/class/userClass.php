<?php
class userClass
{
  
  private $db;
  
  function __construct($dbConnection)
  {
    $this->db = $dbConnection;
  }
  
  /* User Login */
  
  public function userLogin($usernameEmail,$upassword)
  {
    try{
      /*$db = getDB();*/
      $stmt = $this->db->prepare("SELECT * FROM users WHERE username=:usernameEmail OR user_email=:usernameEmail LIMIT 1" );
      $stmt->bindparam(":usernameEmail", $usernameEmail);
      $stmt->execute();
      $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
      if($stmt->rowCount() > 0)
      {
        if(password_verify($upassword,$userRow['user_pass']))
        {
          $_SESSION['user_session'] = $userRow['user_id'];
          return true;
        }
        else
        {
          return false;
        }
      }
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
    }
  }
  
  /* User Register */
  
  public function userRegister($uname,$umail,$upass)
  {
    try{
      /*$db = getDB();*/
      $h_password = password_hash($upass, PASSWORD_BCRYPT);
      $stmt = $this->db->prepare("INSERT INTO
      users (username, user_email, user_pass)
      VALUES (:uname, :umail, :upass)");
      $stmt->bindparam(":uname", $uname);
      $stmt->bindparam(":umail", $umail);
      $stmt->bindparam(":upass", $h_password);
      $stmt->execute();
      
      return $stmt;
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
    }
  }
  
  /* User Login Check */
  
  public function is_loggedin()
  {
    if(isset($_SESSION['user_session']))
    {
      return true;
    }
  }
  
  /* User Logout */
  
  public function logout()
  {
    session_destroy();
    unset($_SESSION['user_session']);
    return true;
  }
  
  /* Redirect */
  
  public function redirect($url)
  {
    header("Location: $url");
  }
 
  
/* Add Comment */
  
  public function addComment($commentText,$LoggedUserID,$datepost)
  {
  try {
    $stmt = $this->db->prepare("INSERT INTO
    comments (comment_text, user_id, comment_date)
    VALUES (:commentt,:userid,:cdate)"); 
    $stmt->bindparam(":commentt", $commentText);
    $stmt->bindparam(":userid", $LoggedUserID);
    $stmt->bindparam(":cdate", $datepost);
    $stmt->execute();
      return $stmt;
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
    }
  }
  
  
/* USER CLASS END */
  

}
?>
  