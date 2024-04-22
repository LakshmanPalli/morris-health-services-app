<?php
// Include your database connection file (e.g., config.php)
include("config.php");

// Check if employee ID is provided in the URL
if(isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $empID = mysqli_real_escape_string($con, $_GET['id']);

    // SQL query to fetch the employee details by ID
    $sql = "SELECT * FROM employee WHERE EmpID = '$empID'";

    // Execute the query
    $result = mysqli_query($con, $sql);

    // Check if there is a record with the provided ID
    if(mysqli_num_rows($result) == 1) {
        // Fetch employee details
        $row = mysqli_fetch_assoc($result);

        // Initialize variables with current values
        $ssn = $row['SSN'];
        $fname = $row['FName'];
        $minit = $row['Minit'];
        $lname = $row['LName'];
        $hiredate = $row['Hiredate'];
        $jobclass = $row['Jobclass'];
        $street = $row['Street'];
        $city = $row['City'];
        $state = $row['State'];
        $zip = $row['Zip'];
        $salary = $row['Salary'];

        // Check if the form is submitted for updating
        if(isset($_POST['update'])) {
            // Retrieve form data
            $ssn = $_POST['ssn'];
            $fname = $_POST['fname'];
            $minit = $_POST['minit'];
            $lname = $_POST['lname'];
            $hiredate = $_POST['hiredate'];
            $jobclass = $_POST['jobclass'];
            $street = $_POST['street'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $zip = $_POST['zip'];
            $salary = $_POST['salary'];

            // SQL query to update employee details
            $update_sql = "UPDATE employee SET SSN='$ssn', FName='$fname', Minit='$minit', LName='$lname', Hiredate='$hiredate', Jobclass='$jobclass', Street='$street', City='$city', State='$state', Zip='$zip', Salary='$salary' WHERE EmpID='$empID'";

            // Execute the query
            if(mysqli_query($con, $update_sql)) {
                echo "Employee details updated successfully";
            } else {
                echo "Error updating record: " . mysqli_error($con);
            }
        }
    } else {
        echo "Employee not found";
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
<title>Edit Employee Details</title>
</head>
<body>

<h2>Edit Employee Details</h2>

<form method="POST">
    <label for="ssn">SSN:</label><br>
    <input type="text" id="ssn" name="ssn" value="<?php echo $ssn; ?>"><br><br>
    <label for="fname">First Name:</label><br>
    <input type="text" id="fname" name="fname" value="<?php echo $fname; ?>"><br><br>
    <label for="minit">Middle Initial:</label><br>
    <input type="text" id="minit" name="minit" value="<?php echo $minit; ?>"><br><br>
    <label for="lname">Last Name:</label><br>
    <input type="text" id="lname" name="lname" value="<?php echo $lname; ?>"><br><br>
    <label for="hiredate">Hire Date:</label><br>
    <input type="date" id="hiredate" name="hiredate" value="<?php echo $hiredate; ?>"><br><br>
    <label for="jobclass">Job Class:</label><br>
    <input type="text" id="jobclass" name="jobclass" value="<?php echo $jobclass; ?>"><br><br>
    <label for="street">Street:</label><br>
    <input type="text" id="street" name="street" value="<?php echo $street; ?>"><br><br>
    <label for="city">City:</label><br>
    <input type="text" id="city" name="city" value="<?php echo $city; ?>"><br><br>
    <label for="state">State:</label><br>
    <input type="text" id="state" name="state" value="<?php echo $state; ?>"><br><br>
    <label for="zip">Zip:</label><br>
    <input type="text" id="zip" name="zip" value="<?php echo $zip; ?>"><br><br>
    <label for="salary">Salary:</label><br>
    <input type="text" id="salary" name="salary" value="<?php echo $salary; ?>"><br><br>
    <button type="submit" name="update">Update</button>
    <a href="employees.php" style="margin-left: 10px;">Back</a>
</form>

</body>
</html>
