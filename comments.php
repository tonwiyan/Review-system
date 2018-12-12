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

			if (isset($_POST['review_id'])) {
				$review_id = $_POST['review_id'];
				$user_id = $_POST['user_id'];
				$body = $_POST['body'];
				post_comment($dbc, $review_id, $user_id, $body);

				echo "Comment posted successfully.";
			}
		?>
		<div id="comments">
			<h3>Comments</h3>

			<form method='POST' action=''>
				<div class='comment-submit'>
					<input type='hidden' name='review_id' value='<?php echo $_GET['review_id']; ?>'>
					<input type='hidden' name='user_id' value='<?php echo $_SESSION['user_id']; ?>'>
					<textarea name='body'></textarea>
					<div>
						<input type='submit' id='comment-send' class="button" value='Submit'/>
					</div>
				</div>
			</form>

			<?php show_comments($dbc, $_GET['review_id']); ?>
		</div>
	</body>
</html>