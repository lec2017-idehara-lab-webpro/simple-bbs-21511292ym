<?php session_start(); ?>
<!DOCTYPE html>


<html>
  <head>
    <meta charset="utf-8">
    <title>21511292の掲示板</title>
      
      <style type="text/css">
          
      body {background-color: #87CEFA;}
          
      
      </style>  
  </head>
  <body>

<h1>掲示板へようこそ！</h1>

<?php
  if( isset($_SESSION['login']) && strlen($_SESSION['login'])>0 )
    print "{$_SESSION['name']} でログイン中です。";
  print "<a href='login.php'>LOGIN</a>";
?>

<hr />

<?php
  include_once('database.php');

  $result = $db->query("select mid, uid, body, parent, timestamp, name from messages left join users using (uid) order by mid asc");
      

  while ( $mes = $result->fetch_assoc()) {
    $reslink = "res.php?res={$mes['mid']}";
      
      
    print("<table><tr><td><a href='$reslink'>{$mes['mid']}</a></td></tr></table> ");

    print( $mes['name'] . " : ");
    if( $mes['parent'] != 0 )
      print ">" . $mes['parent'] . " ";
    print( $mes['body'] . $mes['timestamp']);

    print( "<a href='eval.php?mid={$mes['mid']}'>評価</a>");
    
    print ("<br />");
   

  }
        
  $result->close();
 ?>

  <form action='res.php' method='GET'>
    <input type=hidden name=res value='0'>
    <input type=submit value='新規書き込みはここをクリック'>
  </form>


  </body>
</html>
