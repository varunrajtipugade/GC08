<html>
<body background="img/00.png">
  <script type="text/javascript">
    var flag=0;
    
      window.addEventListener('beforeunload', function() {
        var audio = document.getElementById('audio');
        localStorage.setItem('audioTime', audio.currentTime);
      });
      window.addEventListener('load', function() {
        localStorage.setItem('audioTime', 0);
        audio.play();
      });
        function submit() {
            let form = document.getElementById("played");
            flag=1;
            form.submit();
        }
    </script>
  <head>
      <title>Home</title>
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
      <h5>Home</h5>
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
  <a id="active" href="home.php">Home</a>
  <a href="recent.php">Recently Played</a>
  <a  href="pop.php">Popular 20</a>
  <a href="about.php">About</a>
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
<?php
include("dbconfig.php");
$user=(int)$_SESSION["userid"];
$mood1=$_SESSION['mood1'];
$mood2=$_SESSION['mood2'];
$command = "python cfr.py $user $mood1 $mood2 $curgenre";
$output = shell_exec($command);
$lines = explode("\n", $output);
$count=1;
foreach ($lines as $line) {
    $songid=trim($line);
    $sql = "select * from songs where song_id='".(int)$songid."';";
    $result =$conn->query($sql);
    if ($result->num_rows > 0)
    {
      $row =$result->fetch_assoc();
      $title=$row["title"];
      $genre=$row["Genre"];
      $song_id=$row["song_id"];
      $album=$row["album"];
      $artist=$row["artist_name"];
      if($count<=20)
      {
    ?>
       <form class="form" id="played" method="post" action="addcount.php">
        <input type="hidden" id="song_number" name="song_number" value="<?php echo $song_id; ?>">
        <input type="hidden" id="curgenre" name="curgenre" value="<?php echo $genre; ?>">     
        <button class="play" onclick="submit()">
          <div class="playbox">
            <img id="playbox" src="posters/<?php echo $song_id; ?>.png" alt="<?php echo $song_id; ?>">
          </div>
          <div class="songinfo">
            <label id="songname"><?php echo $title ?></label><br>
            <label id="artist"><?php echo $artist ?></label>
          </div>
          <div class="albuminfo">
            <label id="album"><?php echo $album ?></label>
        </button>
      </form>
    <?php
        $count++;
      }
    }
  ##
}
?>
</div>
</body>
</html>