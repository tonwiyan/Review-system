<?php

session_start();

// print_r($_SESSION);
try {
    $dbc = new PDO('mysql:dbname=project;host=127.0.0.1', 'root', 'towni');

    date_default_timezone_set('Asia/Dhaka');
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

function register($dbc, $nie, $password) {
	try {
		$password = password_hash($password, PASSWORD_DEFAULT);
		$sql = "insert into users(nie,pass) values(?, ?)";
		$statement = $dbc->prepare($sql);
		$statement->execute(array($nie, $password));

		echo "User created successfully.";
	} catch (PDOException $e) {
	    echo 'Connection failed: ' . $e->getMessage();
	} 
}

function login ($dbc, $nie, $password) {
	// select id, pass from users where nie = '' OR 1'
	$sql = "select id, pass from users where nie = ?";
	$statement = $dbc->prepare($sql);
	$statement->execute(array($nie));
	$result = $statement->fetch();
	
	$password_hashed = $result['pass'];

	if (password_verify($password, $password_hashed)) {
		$_SESSION['user_id'] = $result['id'];
		redirect("reviews.php");
		echo "You're logged in.";
	} else {
		echo "Password incorrect.";
	}
}

function logged_in () {
	return isset($_SESSION['user_id']);
}

function redirect ($url) {
	header("Location: " . $url);
}

function show_all_reviews ($dbc) {
	$sql = "SELECT * FROM reviews";

	$statement = $dbc->query($sql);

	while ($result = $statement->fetch()) {
		$good_part = $result['good_part'];
		$bad_part = $result['bad_part'];
		$initials = $result['instructor_initials'];
		$review_id = $result['id'];

		include('review.php');
	}

}

function num_comments ($dbc, $review_id) {
	$sql = "SELECT COUNT(*) AS comments FROM comments WHERE review_id = ?";

	$statement = $dbc->prepare($sql);
	$statement->execute(array($review_id));
	$result = $statement->fetch();
	return $result['comments'];
}

function show_comments ($dbc, $review_id) {
	$sql = "SELECT users.nie, comments.body, comments.creation_timestamp FROM users, comments WHERE comments.user_id = users.id AND comments.review_id = ?";

	$statement = $dbc->prepare($sql);
	$statement->execute(array($review_id));

	$i = 0;
	while ($result = $statement->fetch()){
		$body = $result['body'];
		$nie = $result['nie'];
		$timestamp = $result['creation_timestamp'];
		include 'comment.php';

		$i++;
	}

	if ($i == 0)
		echo "No comments posted yet.";
}

function post_comment ($dbc, $review_id, $user_id, $body) {
	$sql = "INSERT INTO comments (review_id, user_id, body, creation_timestamp) VALUES(?, ?, ?, ?)";
	$statement = $dbc->prepare($sql);
	$statement->execute(array($review_id, $user_id, $body, time()));
}

function add_review($dbc, $author, $initials, $good_side, $bad_side) {
	$sql = "INSERT INTO reviews (author, instructor_initials, good_part, bad_part, created_timestamp) VALUES(?, ?, ?, ?, ?)";

	$statement = $dbc->prepare($sql);
	$statement->execute(array($author, $initials, $good_side, $bad_side, time()));	
}

function show_search_results($dbc, $search) {
	$search = '%' . $search . '%';
	$sql = "SELECT * FROM reviews WHERE instructor_initials LIKE ?";

	$statement = $dbc->prepare($sql);
	$statement->execute(array($search));

	while ($result = $statement->fetch()){
		$good_part = $result['good_part'];
		$bad_part = $result['bad_part'];
		$initials = $result['instructor_initials'];
		$review_id = $result['id'];

		include('review.php');
	}	
}