<html>
<body background="img/00.png">
  <script>
        function submit() {
            let form = document.getElementById("played");
            form.submit();
        }
        window.addEventListener('beforeunload', function() {
        var audio = document.getElementById('audio');
        localStorage.setItem('audioTime', audio.currentTime);
      });
      window.addEventListener('load', function() {
        var audio = document.getElementById('audio');
          var audioTime = localStorage.getItem('audioTime');
          if (audioTime) {
              audio.currentTime = audioTime;
          }
        audio.play();
      });
    </script>
  <head>
      <title>About</title>
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="img/webicon.ico"/>
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
  <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
  <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
  <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">

  <link rel="stylesheet" type="text/css" href="css/cf.css">
  <style type="text/css">
    .grp{
      padding: 10px;
      padding-top: 15px;
      width: 58%;
      height: 550px;
      overflow: auto;
      float: right;
      background-color: white;
      margin-right: 20px;
      border-radius: 20px;
    }
    #abimg{
      background-color: white;
      width: 360px;
      height: 100px;
      display: block;
      margin-left: auto;
      margin-right: auto;
      margin-top: 30px;
      margin-bottom: 10px;
    }
    p{
      text-align: justify;
      padding: 20px;
    }
    #v7{
      background-color: white;
      width: 100px;
      height: 100px;
      margin-right: 50px;
      display: block;
      float: right;
    }
    #copy{
      padding: 30px;
      float: left;
    }
  </style>
  </head>
<?php 
session_start();
$user=(int)$_SESSION["userid"];
$prevsong=(int)$_SESSION["song"];
$curgenre=$_SESSION["curgenre"];
include("dbconfig.php");
$sql = "select * from songs where song_id='".(int)$prevsong."';";
    $result =$conn->query($sql);
    if ($result->num_rows > 0)
    {
      $row =$result->fetch_assoc();
      $playertitle=$row["title"];
      $playerartist=$row["artist_name"];
    }
?>
<div class="title">
    <div class="heading">
      <img src="img/logo1.png" width="220px" height="60px">
      <h5>About</h5>
    </div>
  <div class="info">
      <img src="img/usericon.png" height="50" width="50" id="user">
      <label id="usernum">USER ID: <?php echo $_SESSION["userid"]; ?></label><br>
      <label><span style="text-transform:uppercase"><?php echo $_SESSION["name"]; ?></span></label><br>
    </div>
  <div class="searchbar">
    <form action="search.php" method="post">
      <input type="text" placeholder="Search.." name="search" id="searchtext">
      <button id="searchbut" type="submit"><i class="fa fa-search"></i></button>
    </form>
  </div>
  </div>
<div id="mySidenav" class="sidenav">
  <a href="home.php">Home</a>
  <a href="recent.php">Recently Played</a>
  <a href="pop.php">Popular 20</a>
  <a id="active" href="#">About</a>
  <a href="index.html">Logout</a>
</div>
<div class="bg1">
  <div class="player">
    <img src="posters/<?php echo $prevsong ?>.png" id="playerimg">
    <label id="playedsong"><?php echo $playertitle ?></label><br>
    <label id="playedartist"><?php echo $playerartist ?></label>
    <audio  id="audio" controls autoplay>
      <source src="songs/<?php echo $prevsong ?>.mp3" type="audio/ogg">
    </audio>
  </div>
</div>
<div class="grp">
    <img src="img/mm.png" id="abimg">
    <p>
      With SunnoDilKi by v7, it’s easy to find the right music for every moment – on your computer. There are 2420 of tracks. So whether you’re behind the wheel, working out, partying or relaxing, the right music is always at your fingertips. Choose what you want to listen to, or let SunnoDilKi surprise you. You can also browse through the track name, artists or album. Soundtrack your life with SunnoDilKi. listen for free.
      <br><br>
      Developers- Varunraj Tipugade, Pranav Kulkarni, Aditi Shinde, Ashootosh Pawar
      <br>
      Guide- Deepali Naik
      <br>
      PCET's Pimpri Chinchwad College of Engineering, Pune (PCCOE)
    </p>
    <hr>
    <img src="img/v7.png" id="v7"><br>
    <div id="copy">&copy; Copyright 2023 V7. All rights reserved.</div>
</div>
</body>
</html>