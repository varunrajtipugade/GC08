<?php
session_start();
$_SESSION["name"]=$_POST["name"];
function fx_alert_and_redirect($msg, $page)
{
    echo "<!DOCTYPE html><html><head>Login...</head><body><script type='text/javascript'>alert(\"" .$msg . "\");window.location.href=\"$page\";</script></body></html>";
}
include("dbconfig.php");
$sql = "insert into user(user_num,name,password) values(NULL,'".$_POST["name"]."','".$_POST["pass"]."')";
if ($conn->query($sql) === TRUE) 
{
    $sql2 = "select max(user_num) as max from user;";
    $result =$conn->query($sql2);
    if ($result->num_rows > 0)
    {
        $row =$result->fetch_assoc();
        $_SESSION["userid"]=$row["max"];
    }
    fx_alert_and_redirect("User Created Successfully!", "question.php");
} 
else 
{
  header("Location:index.html");
  exit();
}
$conn->close();
?>