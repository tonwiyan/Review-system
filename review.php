<div class="review">
	<div class='row'>
		<div class='initials'>
			<?php echo $initials; ?>
		</div>
		<div class='num_comments'>
			<a href="comments.php?review_id=<?php echo $review_id; ?>"><?php echo num_comments($dbc, $review_id); ?> Comments</a>
		</div>
	</div>
	<div class='row'>
		<div class="good">
			<h2>Good side</h2>
			<div>
				<?php echo $good_part; ?>
			</div>
		</div>
		<div class="bad">
			<h2>Bad side</h2>
			<div>
				<?php echo $bad_part; ?>
			</div>
		</div>
	</div>
</div>