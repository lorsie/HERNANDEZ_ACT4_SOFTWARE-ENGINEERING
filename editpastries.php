<?php 
require_once 'core/models.php'; 
require_once 'core/dbConfig.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Pastry</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<a href="viewpastries.php?bakerID=<?php echo $_GET['bakerID']; ?>">View The Pastries</a>
	<h1>Edit the Pastry!</h1>

	<?php
	$pastryID = $_GET['pastriesID'];
	$getPastryByID = getPastryByID($pdo, $pastryID);
	
	if ($getPastryByID): // Check if the query was successful
	?>

	<form action="core/handleForms.php?pastriesID=<?php echo $_GET['pastriesID']; ?>&bakerID=<?php echo $_GET['bakerID']; ?>" method="POST">
		<p>
			<label for="pastryName">Pastry Name: </label> 
			<input type="text" name="pastryName" value="<?php echo htmlspecialchars($getPastryByID['pastryName']); ?>">
		</p>
        <p>
			<label for="doughType">Dough Type: </label> 
			<input type="text" name="doughType" value="<?php echo htmlspecialchars($getPastryByID['doughType']); ?>">
		</p>
        <p>
			<label for="sweetnessLevel">Sweetness Level: </label> 
			<input type="text" name="sweetnessLevel" value="<?php echo htmlspecialchars($getPastryByID['sweetnessLevel']); ?>">
		</p>
		<p>
			<label for="price">Price: </label> 
			<input type="number" name="price" value="<?php echo htmlspecialchars($getPastryByID['price']); ?>">
		</p>
		<p>
			<input type="submit" name="editPastryBtn" value="Submit">
		</p>
	</form>

	<?php else: ?>
		<p>Error: Pastry data not found.</p>
	<?php endif; ?>

</body>
</html>
