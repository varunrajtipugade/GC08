<?php 
session_start();
$user=$_SESSION["userid"];
$song=$_POST["song_number"];

$_SESSION["song"]=$_POST["song_number"];
$_SESSION["curgenre"]=$_POST["curgenre"];

$rows = array();
$file = fopen("users_songs.csv", "r");
while (($data = fgetcsv($file)) !== FALSE) {
    $rows[] = $data;
}
fclose($file);

for ($i = 0; $i < count($rows); $i++) {
    if ($rows[$i][0] == $user and $rows[$i][1] == $song) 
    {
        $listencount=(int)$rows[$i][2];
        $rows[$i][2] = $listencount+1;
        break;
    }
}

if ($i == count($rows)) {
    $rows[] = array($user, $song, "1");
}

$file = fopen("users_songs.csv", "w");
foreach ($rows as $row) {
    fputcsv($file, $row);
}
fclose($file);
header("Location:cf.php");
?>