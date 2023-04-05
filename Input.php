<?php session_start(); 
		echo "<script>
		// Get the textarea elements
		var textarea1 = document.getElementById("query");
		var textarea2 = document.getElementById("query_input");
		
		// Load the saved values from local storage, if any
		if (localStorage.getItem("savedText1")) {
		textarea1.value = localStorage.getItem("savedText1");
		}
		if (localStorage.getItem("savedText2")) {
		textarea2.value = localStorage.getItem("savedText2");
		}
		
		// Save the values to local storage whenever they change
		textarea1.addEventListener("input", function() {
		localStorage.setItem("savedText1", textarea1.value);
		});
		textarea2.addEventListener("input", function() {
		localStorage.setItem("savedText2", textarea2.value);
		});
		</script>"
?>
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
					<input type="submit" value="Submit" class="thebutton">
				</form>


				Execute an Insert, Create, or Delete Query:
				<form method="post">
					<label for="query_input"></label>
					<textarea id="query_input" name="query" rows="6"></textarea>
					<input type="submit" name="submit" value="Submit" class="thebutton">
				</form>
			</div>

	</main>
	<div class="bottom-line"></div>
</body>

</html>