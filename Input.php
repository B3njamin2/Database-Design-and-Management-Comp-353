<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto:ital,wght@0,400;0,700;0,900;1,700&display=swap"
		rel="stylesheet">
	<link rel="stylesheet" href="general.css">
	<link rel="stylesheet" href="navbar.css">
	<link rel="stylesheet" href="style.css">
	<?php include 'SqlQuery.php'; ?>
	<script src="session.js"></script>
	<title>Input</title>
</head>

<body>
	<nav class="navbar">
		<a class="navbar-link top" id="current">
			<img src="home.png" alt="Home-logo">
			<div>Input</div>
		</a>

		</a>
		<a class="navbar-link bottom" href="Output.php">
			<img src="admin.png" alt="Admin-logo">
			<div>Outputs</div>
		</a>
	</nav>

	<header class="title-container">
		<div class="title">Home</div>
		<hr>
	</header>

	<main>
		<div class="container">
			<div class="inner-container">
				<div class="subtitle">
					Enter Information Here
				</div>

				Enter a Custom Query:
				<form method="post">
					<label for="query"></label>
					<textarea id="query" name="query" rows="6"></textarea>
					<input type="submit" value="Submit" class="thebutton" id="clearButton1">
				</form>


				Execute an Insert, Create, or Delete Query:
				<form method="post">
					<label for="query_input"></label>
					<textarea id="query_input" name="query" rows="6"></textarea>
					<input type="submit" name="submit" value="Submit" class="thebutton" id="clearButton2">
				</form>

				Toggle clear after sumbit:
				<button id="toggleButton" class="thebutton">Off</button>
			</div>

	</main>
	<div class="bottom-line"></div>
</body>

</html>