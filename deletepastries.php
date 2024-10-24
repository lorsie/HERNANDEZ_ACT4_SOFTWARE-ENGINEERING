<?php require_once 'core/dbConfig.php'; ?>
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
	<?php 
	$getPastryByID = getPastryByID($pdo, $_GET['pastriesID']); 
	if ($getPastryByID): // Check if a valid book is returned
	?>
	<h1>Are you sure you want to delete this Pastry?</h1>
	<div class="container" style="border-style: solid; height: 400px;">
	    <h2>Baker: <?php echo $getPastryByID['Baker'] ?></h2>
		<h2>Pastry Name: <?php echo $getPastryByID['pastryName'] ?></h2>
		<h2>Dough Type: <?php echo $getPastryByID['doughType'] ?></h2>
		<h2>Sweetness Level: <?php echo $getPastryByID['sweetnessLevel'] ?></h2>
        <h2>Price: <?php echo $getPastryByID['price'] ?></h2>
		
		<div class="deleteBtn" style="float: right; margin-right: 10px;">
			<form action="core/handleForms.php?pastriesID=<?php echo $_GET['pastriesID']; ?>&bakerID=<?php echo $_GET['bakerID']; ?>" method="POST">
				<input type="submit" name="deletePastryBtn" value="Delete">
			</form>			
		</div>	
	</div>
	<?php else: ?>
		<h1>Pastry not found or query failed.</h1>
	<?php endif; ?>
</body>
</html>
