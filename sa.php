<html>
<body background="img/00.png">
  <script>
        function submit() {
            let form = document.getElementById("played");
            form.submit();
        }
    </script>
  <head>
      <title>Recommendation on Mood</title>
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

  <link rel="stylesheet" type="text/css" href="css/sa.css">
  </head>
<?php 
session_start();
?>
<div class="title">
    <div class="heading">
      <img src="img/logo1.png" width="330px" height="90px">
      <h4 style="padding-left: 70px; margin-top: -10px;">Recommendation based on your mood</h4>
    </div>
    <div class="info">
      <img src="img/usericon.png" height="80" width="80" id="user">
      <label>USER ID: <?php echo $_SESSION["userid"]; ?></label><br>
      <label><span style="text-transform:uppercase"><?php echo $_SESSION["name"]; ?></span></label><br>
      <a id="logout" href="index.html">LOGOUT</a>
    </div>
  </div>
  <div class="bg1">
    <div class="slideshow-container">
      <div class="mySlides">
        <a href="https://www.instagram.com/" target="_blank">
          <img src="img/b3.png" alt="instagram" style="width:100%">
        </a>
      </div>
      <div class="mySlides">
        <a href="https://www.boat-lifestyle.com/" target="_blank">
          <img src="img/b2.png" alt="boat" style="width:100%">
        </a>
      </div>
      <div class="mySlides">
        <a href="https://www.dream11.com/" target="_blank">
          <img src="img/b4.png" alt="dream11" style="width:100%">
        </a>
      </div>
      <div class="mySlides">
        <a href="https://www.royalenfield.com/" target="_blank">
          <img src="img/b5.png" alt="royalenfield" style="width:100%">
        </a>
      </div>
    </div>
    <br>
    <div class="dotdotdot" style="text-align:center">
      <span class="dot"></span> 
      <span class="dot"></span> 
      <span class="dot"></span> 
      <span class="dot"></span> 
    </div>
  </div>
  <div class="grp">
<?php
include("dbconfig.php");

$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
$txt = $_POST["ans1"]."\n";
fwrite($myfile, $txt);
$txt = $_POST["ans2"]."\n";
fwrite($myfile, $txt);
$txt = $_POST["ans3"]."\n";
fwrite($myfile, $txt);
$txt = $_POST["ans4"]."\n";
fwrite($myfile, $txt);
$txt = $_POST["ans5"]."\n";
fwrite($myfile, $txt);
if (!empty($_POST["ans6"])) {
  $txt = $_POST["ans5"]."\n";
  fwrite($myfile, $txt);
} 
if (!empty($_POST["ans7"])) {
  $txt = $_POST["ans5"]."\n";
  fwrite($myfile, $txt);
} 
fclose($myfile);

$command = "python sa.py";
$output = shell_exec($command);
$lines = explode("\n", $output);
$count=1;
foreach ($lines as $line) {
  if($count==1)
  {
    $_SESSION['mood1']=trim($line);
  }
  else if($count==2)
  {
    $_SESSION['mood2']=trim($line);
  }
  else if($count<=22)
  {
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
    }
  }
  $count++;
}
unlink("newfile.txt");

?>
</div>
<script>
let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 5000); // Change image every n seconds
}
</script>
</body>
</html>