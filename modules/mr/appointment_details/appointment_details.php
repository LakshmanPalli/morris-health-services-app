<?php
// Include the database connection file
include("config.php");

// Query to retrieve distinct facility descriptions
$facility_query = "SELECT DISTINCT `Desc` FROM Facility";
$facility_result = mysqli_query($con, $facility_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Appointment Details</title>
</head>
<body>

<h2>Appointment Details</h2>

<form action="generate_report.php" method="post">
    <label for="from_date">From:</label>
    <input type="date" id="from_date" name="from_date" required>
    <label for="to_date">To:</label>
    <input type="date" id="to_date" name="to_date" required>
    <br><br>
    <label for="facility">Select Facility:</label>
    <select name="facility" id="facility">
        <?php
        // Check if facility data is available
        if (mysqli_num_rows($facility_result) > 0) {
            while ($facility_row = mysqli_fetch_assoc($facility_result)) {
                echo "<option value='" . $facility_row['Desc'] . "'>" . $facility_row['Desc'] . "</option>";
            }
        } else {
            echo "<option value=''>No Facilities Found</option>";
        }
        ?>
    </select>
    <br><br>
    <button type="submit">Generate Report</button>
</form>

</body>
</html>

<?php
// Close the database connection
mysqli_close($con);
?>
