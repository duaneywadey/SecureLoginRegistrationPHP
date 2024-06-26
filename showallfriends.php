<?php 
session_start();

require_once('dbConfig.php');
require_once('functions.php');

if(!isset($_SESSION['username'])) {
	header('Location: login.php');
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		body {
			font-family: 'Arial';
			font-size: 2em;
		}

		table, th, td{
			border: 1px solid black;
		}

		.fields input {
			display: block;
			height: auto;
			width: 500px;
			margin-top: 10px;
			font-size: 2em;
		}
		#submitBtn {
			margin-top: 10px;
			height: auto;
			width: 300px;
			font-size: 2em;
		}
		#greeting {
			font-family: Arial, Helvetica, sans-serif;
		}

	</style>
</head>
<body>
	<div id="greeting">
		<h1>Hello there,
			<?php if(isset($_SESSION['username'])) { 
				echo $_SESSION['username'];
			}?>
		</h1>
	</div>
	<?php include('links.php'); ?>
	<div class="showAllFriends">
		<h1>Find friends</h1>
		<table>
			<tr>
				<th>Username</th>
				<th>Friend Request Accepted</th>
				<th>Unfriend</th>
			</tr>
			<?php $seeAllFriends = seeAllFriends($conn, $_SESSION['user_id']); ?>
			<?php foreach ($seeAllFriends as $row) { ?>
				<tr>
					<td><?php echo $row['username']; ?></td>
					<td><?php echo $row['dateFriendRequestAccepted']; ?></td>
					<td>
						<form action="handleForm.php" method="POST">
							<input type="hidden" value="<?php echo $row['friend_id']; ?>" name="friend_id">
							<input type="submit" name="unfriendUserBtn" value="Unfriend">
						</form>
					</td>
				</tr>
			<?php } ?>
		</table>
	</div>
</body>
</html>