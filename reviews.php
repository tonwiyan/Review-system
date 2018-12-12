<!DOCTYPE html>
<html>
	<head>
		<title>Reviews</title>
		<link rel='stylesheet' href='css/main.css'>
	</head>
	<body>
		<?php
			include('database.php');

			include('enforce_login.php');

			include('menu.php');
		?>
		<div class="container">
			<?php include("search.php"); ?>
			<div id='reviews'>
				<h1 class="title">
					<center>Reviews</center>
				</h1>

				<?php
					show_all_reviews($dbc);
				?>
			</div>
		</div>
	</body>
</html>