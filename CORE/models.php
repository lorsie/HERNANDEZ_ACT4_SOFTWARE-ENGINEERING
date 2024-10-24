<?php  

function insertBaker($pdo, $firstName, $lastName, $bakeshopLocation, 
	$emailAddress) {

	$sql = "INSERT INTO baker (firstName, lastName, 
		bakeshopLocation, emailAddress) VALUES(?,?,?,?)";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$firstName, $lastName, 
		$bakeshopLocation, $emailAddress]);

	if ($executeQuery) {
		return true;
	}
}

function getAllBakers($pdo) {
	$sql = "SELECT * FROM baker";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getBakerByID($pdo, $bakerID) {
	$sql = "SELECT * FROM baker WHERE bakerID = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$bakerID]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}


function updateBaker($pdo, $firstName, $lastName, 
	$bakeshopLocation, $emailAddress, $bakerID) {

	$sql = "UPDATE baker
			SET firstName = ?,
				lastName = ?,
				bakeshopLocation = ?, 
				emailAddress = ?
			WHERE bakerID = ?";
	
	$stmt = $pdo->prepare($sql);

	$executeQuery = $stmt->execute([$firstName, $lastName, 
		$bakeshopLocation, $emailAddress, $bakerID]);
	
	if ($executeQuery) {
		return true;
	}

}

function deleteBaker($pdo, $bakerID) {
	$deleteBakerPastries = "DELETE FROM pastries WHERE bakerID = ?";
	$deleteStmt = $pdo->prepare($deleteBakerPastries);
	$executeDeleteQuery = $deleteStmt->execute([$bakerID]);

	if ($executeDeleteQuery) {
		$sql = "DELETE FROM baker WHERE bakerID = ?";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$bakerID]);

		if ($executeQuery) {
			return true;
		}

	}
	
}

function getAllInfoByBakerID($pdo, $bakerID) {
    $sql = "SELECT CONCAT(baker.firstName,' ',baker.lastName) AS Baker
            FROM baker
            WHERE bakerID = ?";
    
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$bakerID]);
    
    if ($executeQuery) {
        $result = $stmt->fetch();
        if ($result) {
            return $result;
        } else {
            return false; // No record found
        }
    }

    return false; // Query execution failed
}
	

function getPastryByBaker($pdo, $bakerID) {
	
	$sql = "SELECT 
				pastries.pastriesID AS pastriesID,
                CONCAT(baker.firstName,' ',baker.lastName) AS Baker,
				pastries.pastryName AS pastryName,
				pastries.doughType AS doughType,
                pastries.sweetnessLevel AS sweetnessLevel,
				pastries.price AS price
			FROM pastries
			JOIN baker ON pastries.bakerID = baker.bakerID
			WHERE pastries.bakerID = ? 
			GROUP BY pastries.pastryName;
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$bakerID]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}


function insertPastry($pdo, $bakerID, $pastryName, $doughType, $sweetnessLevel, $price) {
    $sql = "INSERT INTO pastries (bakerID, pastryName, doughType, sweetnessLevel, price) 
            VALUES (?,?,?,?,?)";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$bakerID, $pastryName, $doughType, $sweetnessLevel, $price]);
    
    if ($executeQuery) {
        return true;
    } else {
        // Check for SQL errors
        $errorInfo = $stmt->errorInfo();
        echo "SQL error: " . $errorInfo[2];
        return false;
    }
}


function getPastryByID($pdo, $pastriesID) {
    $sql = "SELECT 
                pastries.pastriesID AS pastriesID,
                CONCAT(baker.firstName,' ',baker.lastName) AS Baker,
                pastries.pastryName AS pastryName,
                pastries.doughType AS doughType,
                pastries.sweetnessLevel AS sweetnessLevel,
                pastries.price AS price
            FROM pastries
            JOIN baker ON pastries.bakerID = baker.bakerID
            WHERE pastries.pastriesID = ? 
            GROUP BY pastries.pastryName;
";

    
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$pastriesID]);
    
    if ($executeQuery) {
        $result = $stmt->fetch();
        if ($result) {
            return $result;  // Return the result if found
        } else {
            return false;  // No result found
        }
    } else {
        // Log SQL errors
        $errorInfo = $stmt->errorInfo();
        echo "SQL error: " . $errorInfo[2];
        return false;
    }
}


function updatePastry($pdo, $bakerID, $pastryName, $doughType, $sweetnessLevel, $price, $pastriesID) {
    $sql = "UPDATE pastries
            SET pastryName = ?,
                doughType = ?,
                sweetnessLevel = ?,
                price = ?
            WHERE pastriesID = ? AND bakerID = ?;";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$pastryName, $doughType, $sweetnessLevel, $price, $pastriesID, $bakerID]);

    if ($stmt->rowCount() > 0) {  // Check if any rows were affected
        return true;
    } else {
        echo "No rows updated.";  // Add this to catch if no rows were updated
        return false;
    }
}



function deletePastry($pdo, $pastriesID) {
    $sql = "DELETE FROM pastries WHERE pastriesID = ?";
    $stmt = $pdo->prepare($sql);
    
    $executeQuery = $stmt->execute([$pastriesID]);
    
    if ($executeQuery) {
        return true;  // Return true if deletion is successful
    } else {
        // Log any SQL errors for debugging
        $errorInfo = $stmt->errorInfo();
        echo "SQL error: " . $errorInfo[2];
        return false;
    }
}


?> 