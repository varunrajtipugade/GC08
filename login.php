<?php
session_start();
function fx_alert_and_redirect($msg, $page)
{
    echo "<!DOCTYPE html><html><head>Login...</head><body><script type='text/javascript'>alert(\"" .$msg . "\");window.location.href=\"$page\";</script></body></html>";
}
include("dbconfig.php");
$_SESSION["userid"]=$_POST["userid"];
$sql = "select * from user where user_num='".$_POST["userid"]."' and password='".$_POST["pass"]."';";
$result =$conn->query($sql);
if ($result->num_rows > 0)
{
    $row =$result->fetch_assoc();
    $_SESSION["name"]=$row["name"];
		echo "Welcome";
    #header("Location:question.php");
    header("Location:question.php");
}
else
{  
  fx_alert_and_redirect("Incorrect UserID or Password!", "index.html");
  exit();
}
$conn->close();
?>