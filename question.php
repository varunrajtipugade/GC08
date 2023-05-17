<?php 
session_start();
?>
<html>
<head>
	<title>Mood Anaysis</title>
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

	<link rel="stylesheet" type="text/css" href="css/qb.css">
</head>
<body background="img/bg00.png">
	<div class="title">
		<div class="heading">
			<img src="img/logo1.png" width="330px" height="90px">
      		<h4 style="padding-left: 70px; margin-top: -10px;">Mood Analysis</h4>
		</div>
		<div class="info">
			<img src="img/usericon.png" height="80" width="80" id="user">
			<label>USER ID: <?php echo $_SESSION["userid"]; ?></label><br>
			<label><span style="text-transform:uppercase"><?php echo $_SESSION["name"]; ?></span></label><br>
			<a id="logout" href="index.html">LOGOUT</a>
		</div>
	</div>
	<div class="form">
		<form method="post" action="sa.php">			
			<div class="qb">
				<label>How was your day ? <font color='red'>*</font></label>
				<input type="text" name="ans1" pattern="^(\w+\s){2,49}\w+$" required oninvalid="setCustomValidity('Please enter a text between 3 and 50 words')" oninput="setCustomValidity('')">
				<span class="focus-input100-1"></span>
				<span class="focus-input100-2"></span>
			</div>
			<div class="qb">
				<label>Did you get enough sleep last night ? <font color='red'>*</font></label>
				<input type="text" name="ans2" pattern="^(\w+\s){2,49}\w+$" required oninvalid="setCustomValidity('Please enter a text between 3 and 50 words')" oninput="setCustomValidity('')">
				<span class="focus-input100-1"></span>
				<span class="focus-input100-2"></span>
			</div>
			<div class="qb">
				<label>How are you feeling after completing your todays tasks ? <font color='red'>*</font></label>
				<input type="text" name="ans3" pattern="^(\w+\s){2,49}\w+$" required oninvalid="setCustomValidity('Please enter a text between 3 and 50 words')" oninput="setCustomValidity('')">
				<span class="focus-input100-1"></span>
				<span class="focus-input100-2"></span>
			</div>
			<div class="qb">
				<label>Have you spent some time with your loved ones? How was it ? <font color='red'>*</font></label>
				<input type="text" name="ans4" pattern="^(\w+\s){2,49}\w+$" required oninvalid="setCustomValidity('Please enter a text between 3 and 50 words')" oninput="setCustomValidity('')">
				<span class="focus-input100-1"></span>
				<span class="focus-input100-2"></span>
			</div>
			<div class="qb">
				<label>What did you do today that made you feel good ? <font color='red'>*</font></label>
				<input type="text" name="ans5" pattern="^(\w+\s){2,49}\w+$" required oninvalid="setCustomValidity('Please enter a text between 3 and 50 words')" oninput="setCustomValidity('')">
				<span class="focus-input100-1"></span>
				<span class="focus-input100-2"></span>
			</div>
			<div class="qb">
				<label>What are you grateful for right now?</label>
				<input type="text" name="ans6" pattern="^(\w+\s){2,49}\w+$" oninvalid="setCustomValidity('Please enter a text between 3 and 50 words')" oninput="setCustomValidity('')">
				<span class="focus-input100-1"></span>
				<span class="focus-input100-2"></span>
			</div>
			<div class="qb">
				<label>what was the best/worst thing happened today?</label>
				<input type="text" name="ans7" pattern="^(\w+\s){2,49}\w+$" oninvalid="setCustomValidity('Please enter a text between 3 and 50 words')" oninput="setCustomValidity('')">
				<span class="focus-input100-1"></span>
				<span class="focus-input100-2"></span>
			</div>
			<input type="submit" name="submit" value="SUBMIT">
			<input type="reset" name="submit" value="CLEAR">
		</form>
	</div>
</body>
</html>