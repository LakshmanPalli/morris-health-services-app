<?php
// Include your database connection file (e.g., config.php)
include("config.php");

// Check if patient ID is provided in the URL
if(isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $pid = mysqli_real_escape_string($con, $_GET['id']);

    // SQL query to fetch the patient details by ID
    $sql = "SELECT * FROM Patient WHERE Pid = '$pid'";

    // Execute the query
    $result = mysqli_query($con, $sql);

    // Check if there is a record with the provided ID
    if(mysqli_num_rows($result) == 1) {
        // Fetch patient details
        $row = mysqli_fetch_assoc($result);

        // Initialize variables with current values
        $fname = $row['FName'];
        $minit = $row['Minit'];
        $lname = $row['LName'];
        $street = $row['Street'];
        $city = $row['City'];
        $state = $row['State'];
        $zip = $row['Zip'];
        $ssn = $row['SSN'];
        $ins_id = $row['Insurance_ID'];

        // Check if the form is submitted for updating
        if(isset($_POST['update'])) {
            // Retrieve form data
            $fname = $_POST['fname'];
            $minit = $_POST['minit'];
            $lname = $_POST['lname'];
            $street = $_POST['street'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $zip = $_POST['zip'];
            $ssn = $_POST['ssn'];
            $ins_id = $_POST['ins_id'];

            // SQL query to update patient details
            $update_sql = "UPDATE Patient SET FName='$fname', Minit='$minit', LName='$lname', Street='$street', City='$city', State='$state', Zip='$zip', SSN='$ssn', Insurance_ID='$ins_id' WHERE Pid='$pid'";

            // Execute the query
            if(mysqli_query($con, $update_sql)) {
                echo "Patient details updated successfully";
            } else {
                echo "Error updating record: " . mysqli_error($con);
            }
        }
    } else {
        echo "Patient not found";
    }
}

// Close the database connection
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Patient Details</title>
</head>
<body>

<h2>Edit Patient Details</h2>

<form method="POST">
    <label for="fname">First Name:</label><br>
    <input type="text" id="fname" name="fname" value="<?php echo $fname; ?>"><br><br>
    <label for="minit">Middle Initial:</label><br>
    <input type="text" id="minit" name="minit" value="<?php echo $minit; ?>"><br><br>
    <label for="lname">Last Name:</label><br>
    <input type="text" id="lname" name="lname" value="<?php echo $lname; ?>"><br><br>
    <label for="street">Street:</label><br>
    <input type="text" id="street" name="street" value="<?php echo $street; ?>"><br><br>
    <label for="city">City:</label><br>
    <input type="text" id="city" name="city" value="<?php echo $city; ?>"><br><br>
    <label for="state">State:</label><br>
    <input type="text" id="state" name="state" value="<?php echo $state; ?>"><br><br>
    <label for="zip">Zip:</label><br>
    <input type="text" id="zip" name="zip" value="<?php echo $zip; ?>"><br><br>
    <label for="ssn">SSN:</label><br>
    <input type="text" id="ssn" name="ssn" value="<?php echo $ssn; ?>"><br><br>
    <label for="ins_id">Insurance ID:</label><br>
    <input type="text" id="ins_id" name="ins_id" value="<?php echo $ins_id; ?>"><br><br>
    <button type="submit" name="update">Update</button>
    <a href="patients.php" style="margin-left: 10px;">Back</a>
</form>

</body>
</html>
