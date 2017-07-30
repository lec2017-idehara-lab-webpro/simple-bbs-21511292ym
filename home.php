<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Home</title>
      <style type="text/css">
          
      body {background-color: #87CEFA;}
          
      
      </style>  
      
  </head>
  <body>

<?php
  include_once('database.php');

  if( isset($_POST['id']) && strlen($_POST['id']) != 0 )
  {
    $query = $db->prepare("select password, name from users where uid=?");
    $query->bind_param("s", $_POST['id']);
    $query->bind_result($pass, $name);
    $query->execute();
    if( $query->fetch() ) // 見つかった
    {
      if($pass == $_POST['pass'])
      {
        // SESSION['login'] でいつでもユーザ ID を参照できるように
        $_SESSION['login'] = $_POST['id'];
        $_SESSION['name'] = $name;
        print ("$name でログインに成功しました。<hr />");
      }
      else
        print ("ログイン失敗 <hr />");
    }
    else
      print ("ログイン失敗 <hr />");
   
  }
 ?>

  <a href='index.php'>掲示板へ</a>

  </body>
</html>
