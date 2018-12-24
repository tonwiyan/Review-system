<!DOCTYPE html>
<html>
	<head>
		<title>Search Results</title>
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
					<center>Search Results</center>
				</h1>

				<?php
					if (isset($_POST['search'])) {
						$search = $_POST['search'];
						show_search_results($dbc, $search);
					}
					// show_all_reviews($dbc);
				?>
			</div>
		</div>
	</body>
</html>