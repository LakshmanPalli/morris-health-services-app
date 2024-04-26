<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Insurance Company</title>
<style>
    /* CSS styles here */
</style>
</head>
<body>

<h2>Add Insurance Company</h2>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" required><br><br>
    
    <label for="street">Street:</label><br>
    <input type="text" id="street" name="street" required><br><br>
    
    <label for="city">City:</label><br>
    <input type="text" id="city" name="city" required><br><br>
    
    <label for="state">State:</label><br>
    <input type="text" id="state" name="state" required><br><br>
    
    <label for="zip">ZIP Code:</label><br>
    <input type="text" id="zip" name="zip" required><br><br>
    
    <button type="submit" name="submit">Submit</button>
    <button type="button" onclick="window.location.href = 'insurance_companies.php';">Back</button>
</form>

<?php
// Include the database connection file
include("config.php");

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];

    // Prepare and execute SQL insert statement
    $sql = "INSERT INTO `Insurance Company` (Name, Street, City, State, Zip) VALUES ('$name', '$street', '$city', '$state', '$zip')";
    if (mysqli_query($con, $sql)) {
        // Insert successful, redirect back to insurance companies page
        header("Location: insurance_companies.php");
    } else {
        // Error occurred, display error message
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    // Close connection
    mysqli_close($con);
}
?>

</body>
</html>
