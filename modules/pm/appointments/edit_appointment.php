<?php
// Include your database connection file (e.g., config.php)
include("config.php");

$id = $_GET['id'];

// Check if employee ID is provided in the URL
if(isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $Id = mysqli_real_escape_string($con, $_GET['id']);

    // SQL query to fetch the employee details by ID
    $sql = "SELECT * FROM appointment WHERE id = '$Id'";

    // Execute the query
    $result = mysqli_query($con, $sql);

    // Check if there is a record with the provided ID
    if(mysqli_num_rows($result) == 1) {
        // Fetch employee details
        $row = mysqli_fetch_assoc($result);

        // Initialize variables with current values
        $id = $row['id'];
        $Inv_id = $row['Inv_id'];
        $Cost = $row['Cost'];
		
        // Check if the form is submitted for updating
        if(isset($_POST['update'])) {
            // Retrieve form data
            $Inv_id = $_POST['Inv_id'];
            $Cost = $_POST['Cost'];

            // SQL query to update employee details
            $update_sql = "UPDATE appointment SET Inv_id='$Inv_id', Cost='$Cost' WHERE id='$id'";

            // Execute the query
            if(mysqli_query($con, $update_sql)) {
                echo "Invoice details successfully added to appointment";
            } else {
                echo "Error updating record: " . mysqli_error($con);
            }
        }
    } else {
        echo "Employee not found";
    }
}    
// Close connection
mysqli_close($con);

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Appointment</title>
</head>
<body>

<h2>Edit Appointment</h2>

<form method="post">

    <label for="ID">ID:</label><br>
    <input type="text" value="<?php echo $id; ?>" readonly>
	<br>

    <label for="Cost">Cost:</label><br>
    <input type="text" id="Cost" name="Cost" value="<?php echo $Cost; ?>"> 
	<br>

    <label for="Inv_id">Invoice ID:</label><br>
    <input type="text" id="Inv_id" name="Inv_id" value="<?php echo $Inv_id; ?>"><br><br>
	
    <button type="submit" name="update">Update</button>
    <a href="appointments.php" style="margin-left: 10px;">Back</a>
</form>

</body>
</html>
