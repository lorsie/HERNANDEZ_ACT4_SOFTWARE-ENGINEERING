<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<?php $getBakerByID = getBakerByID($pdo, $_GET['bakerID']); ?>
	<h1>Edit the Baker!</h1>
	<form action="core/handleForms.php?bakerID=<?php echo $_GET['bakerID']; ?>" method="POST">
		<p>
			<label for="firstName">First Name: </label> 
			<input type="text" name="firstName" value="<?php echo $getBakerByID['firstName']; ?>">
		</p>
		<p>
			<label for="lastName">Last Name: </label> 
			<input type="text" name="lastName" value="<?php echo $getBakerByID['lastName']; ?>">
		</p>
		<p>
			<label for="bakeshopLocation">Bakeshop Location: </label> 
			<input type="text" name="bakeshopLocation" value="<?php echo $getBakerByID['bakeshopLocation']; ?>">
		</p>
        <p>
			<label for="emailAddress">Email: </label> 
			<input type="email" name="emailAddress" value="<?php echo $getBakerByID['emailAddress']; ?>">
			<input type="submit" name="editBakerBtn">
		</p>
	</form>
</body>
</html>
