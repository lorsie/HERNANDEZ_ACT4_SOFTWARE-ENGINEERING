<?php 

require_once 'dbConfig.php'; 
require_once 'models.php';

if (isset($_POST['insertBakerBtn'])) {

	$query = insertBaker($pdo, $_POST['firstName'], $_POST['lastName'], 
		$_POST['bakeshopLocation'], $_POST['emailAddress']);

	if ($query) {
		header("Location: ../index.php");
	}
	else {
		echo "Insertion failed";
	}

}

if (isset($_POST['editBakerBtn'])) {
	$query = updateBaker($pdo, $_POST['firstName'], $_POST['lastName'], 
		$_POST['bakeshopLocation'], $_POST['emailAddress'], $_GET['bakerID']);

	if ($query) {
		header("Location: ../index.php");
	}

	else {
		echo "Edit failed";;
	}

}

if (isset($_POST['deleteBakerBtn'])) {
    // Debugging: Print out the bakerID
    $bakerID = $_GET['bakerID'];
    echo "Attempting to delete Baker ID: $bakerID<br>";
    
    $query = deleteBaker($pdo, $bakerID);

    if ($query) {
        echo "Baker deleted successfully.";
        header("Location: ../index.php");
        exit();  // Ensure the script stops after redirection
    } else {
        echo "Deletion failed.";
    }
}



if (isset($_POST['insertNewPastryBtn'])) {

    if (isset($_GET['bakerID'])) {
        $bakerID = $_GET['bakerID'];
    } else {
        echo "Error: Author ID not found!";
        exit;
    }

    $query = insertPastry($pdo, $bakerID, $_POST['pastryName'], 
              $_POST['doughType'], $_POST['sweetnessLevel'], $_POST['price']);

    if ($query) {
        header ("Location: ../viewpastries.php?bakerID=" . $bakerID);
    } else {
        echo "Insertion failed";
    }
}



if (isset($_POST['editPastryBtn'])) {
    // Ensure bakerID is set from the GET array
    $bakerID = $_GET['bakerID'];  // Fetch bakerID from the GET parameters
    
    // Now call the updatePastry function with the correct $bakerID
    $query = updatePastry($pdo, $bakerID, $_POST['pastryName'], 
        $_POST['doughType'], $_POST['sweetnessLevel'], $_POST['price'], $_GET['pastriesID']);

    if ($query) {
        echo "Update successful";
        header("Location: ../viewpastries.php?bakerID=" . $_GET['bakerID']);
        exit();
    } else {
        echo "Update failed";
    }
}



if (isset($_POST['deletePastryBtn'])) {
    if (isset($_GET['pastriesID']) && isset($_GET['bakerID'])) {
        $pastriesID = $_GET['pastriesID'];
        $bakerID = $_GET['bakerID'];

        // Debugging
        echo "Attempting to delete Pastries ID: $pastriesID for Baker ID: $bakerID<br>";

        // Call the delete function
        $query = deletePastry($pdo, $pastriesID);

        if ($query) {
            echo "Pastry deleted successfully.";
            header("Location: ../viewpastries.php?bakerID=" . $bakerID);
            exit();
        } else {
            echo "Deletion failed.";
        }
    } else {
        echo "Pastries ID or Baker ID not set.";
    }
}




?>
