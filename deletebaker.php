<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charseAt="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Are you sure you want to delete this Baker?</h1>
	<?php $getBakerByID = getBakerByID($pdo, $_GET['bakerID']); ?>
	<div class="container" style="border-style: solid; height: 400px;">
	    <h2>Baker ID: <?php echo $getBakerByID['bakerID']; ?></h2>
		<h2>First Name: <?php echo $getBakerByID['firstName']; ?></h2>
		<h2>Last Name: <?php echo $getBakerByID['lastName']; ?></h2>
		<h2>Bakeshop Location: <?php echo $getBakerByID['bakeshopLocation']; ?></h2>
		<h2>Email Address: <?php echo $getBakerByID['emailAddress']; ?></h2>

		<div class="deleteBtn" style="float: right; margin-right: 10px;">
		<form action="core/handleForms.php?bakerID=<?php echo $_GET['bakerID']; ?>" method="POST">
            <input type="submit" name="deleteBakerBtn" value="Delete">
        </form>
		
		</div>	

	</div>
</body>
</html>
