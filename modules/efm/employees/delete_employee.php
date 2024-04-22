/* this is an extra feature not mentioned in the scope of project (safe to drop) */

<?php
// Include your database connection file (e.g., config.php)
include("config.php");

// Check if employee ID is provided in the URL
if(isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $empID = mysqli_real_escape_string($con, $_GET['id']);

    // SQL query to delete the employee record
    $delete_sql = "DELETE FROM employee WHERE EmpID = '$empID'";

    // Execute the query
    if(mysqli_query($con, $delete_sql)) {
        echo "Employee record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }
}

// Close the database connection
mysqli_close($con);
?>
