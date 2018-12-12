<!DOCTYPE html>
<html>
	<head>
		<title>Add Review</title>
		<link rel='stylesheet' href='css/main.css'>
	</head>
	<body>
		<?php
			include('database.php');

			include('enforce_login.php');

			include('menu.php');

			if (isset($_POST['author'])) {
				$author = $_POST['author'];
				$initials = $_POST['initials'];
				$good_side = $_POST['good_side'];
				$bad_side = $_POST['bad_side'];

				add_review($dbc, $author, $initials, $good_side, $bad_side);

				echo "Review added successfully.";
			}
		?>
		<div class="container">
			<?php include("search.php"); ?>
			
			<div id='add_review'>
				<form action='' method="POST">
					<input type='hidden' name='author'value='<?php echo $_SESSION['user_id']; ?>'>
					<input type="text" name='initials' placeholder='Instructor Initiails'>
					<textarea name='good_side' placeholder="Good side"></textarea>
					<textarea name='bad_side' placeholder="Bad side"></textarea>
					<input class='button' type='submit' value='Add Review'>
				</form>
			</div>
		</div>
	</body>
</html>