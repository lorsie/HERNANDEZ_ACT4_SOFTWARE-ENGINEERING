<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<a href="index.php">Return to home</a>
	<?php $getAllInfoByBakerID = getAllInfoByBakerID($pdo, $_GET['bakerID']); ?>
	<h1>Baker: <?php $getAllInfoByBakerID = getAllInfoByBakerID($pdo, $_GET['bakerID']);
    if ($getAllInfoByBakerID) {
         echo $getAllInfoByBakerID['Baker'];
    } else {
        echo "No baker found or query failed.";}?>
</h1>
	<h1>Add New Pastry!</h1>
	<form action="core/handleForms.php?bakerID=<?php echo $_GET['bakerID']; ?>" method="POST">

		<p>
			<label for="pastryName">Pastry Name: </label> 
			<input type="text" name="pastryName">
		</p>
        <p>
			<label for="doughType">Dough Type: </label> 
			<input type="text" name="doughType">
		</p>
        <p>
			<label for="sweetnessLevel">Sweetness Level: </label> 
			<input type="text" name="sweetnessLevel">
		</p>
		<p>
			<label for="price">Price: </label> 
			<input type="number" name="price">
			<input type="submit" name="insertNewPastryBtn">
		</p>
	</form>

	<table style="width:100%; margin-top: 50px;">
	  <tr>
	    <th>Pastry ID</th>
	    <th>Pastry Name</th>
	    <th>Baker</th>
	    <th>Dough Type</th>
        <th>Sweetness Level</th>
	    <th>Price</th>
	    <th>Action</th>
	  </tr>
	  <?php $getPastryByBaker = getPastryByBaker($pdo, $_GET['bakerID']); ?>
      <?php 
	    if (empty($getPastryByBaker)) {
    	    echo "<tr><td colspan='8'>No Pastries found for this Baker.</td></tr>";
    	} 
		?>
	  <?php foreach ($getPastryByBaker as $row) { ?>
	  <tr>
	  	<td><?php echo $row['pastriesID']; ?></td>	  	
	  	<td><?php echo $row['pastryName']; ?></td>	  	
	  	<td><?php echo $row['Baker']; ?></td>	  	
	  	<td><?php echo $row['doughType']; ?></td>
        <td><?php echo $row['sweetnessLevel']; ?></td>	  	
	  	<td><?php echo $row['price']; ?></td>
	  	<td>
	  		<a href="editpastries.php?pastriesID=<?php echo $row['pastriesID']; ?>&bakerID=<?php echo $_GET['bakerID']; ?>">Edit</a>

	  		<a href="deletepastries.php?pastriesID=<?php echo $row['pastriesID']; ?>&bakerID=<?php echo $_GET['bakerID']; ?>">Delete</a>
	  	</td>	  	
	  </tr>
	<?php } ?>
	</table>

	
</body>
</html>