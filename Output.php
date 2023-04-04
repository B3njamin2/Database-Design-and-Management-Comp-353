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
	<title>Outputs</title>
</head>

<body>
	<nav class="navbar">
		<a class="navbar-link top" href="Input.php">
			<img src="home.png" alt="Home-logo">
			<div>Input</div>
		</a>

		<a class="navbar-link bottom" id="current">
			<img src="admin.png" alt="Admin-logo">
			<div>Outputs</div>
		</a>
	</nav>

	<header class="title-container">
		<div class="title">Ouput</div>
		<hr>
	</header>

	<main>
		<div class="container2">
			<div class="inner-container">
				<div id="content">
					<?php
					// Print the query output
					if (isset($_SESSION['query_output'])) {
						echo "<h2>Query History</h2>";
						echo implode("", $_SESSION['query_output']);
					} else {
						echo "<p>No queries have been executed yet.</p>";
					}
					?>
				</div>
				<form method="post">
					<input type="submit" name="clear_session" value="Clear Session" class="thebutton clear_session">
				</form>
			</div>
		</div>
	</main>

	<div class="bottom-line"></div>
</body>

</html>