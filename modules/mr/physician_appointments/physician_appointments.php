<?php
// Include the database connection file
include("config.php");

// Query to retrieve distinct physician first names
$physician_query = "SELECT DISTINCT e.FName 
                    FROM Employee e 
                    JOIN Appointment a ON e.SSN = a.SSN 
                    WHERE e.Jobclass = 'Doctor'";
$physician_result = mysqli_query($con, $physician_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Physician Appointments</title>
</head>
<body>

<h2>Physician Appointments</h2>

<form action="generate_report.php" method="post">
    <label for="date">Select Date:</label>
    <select name="date" id="date">
        <?php
        // Query to retrieve distinct appointment dates
        $date_query = "SELECT DISTINCT DATE(Date_Time) AS appointment_date FROM Appointment";
        $date_result = mysqli_query($con, $date_query);
        while ($row = mysqli_fetch_assoc($date_result)) {
            echo "<option value='" . $row['appointment_date'] . "'>" . $row['appointment_date'] . "</option>";
        }
        ?>
    </select>
    <br><br>
    <label for="physician">Select Physician:</label>
    <select name="physician" id="physician">
        <?php
        // Check if physician data is available
        if (mysqli_num_rows($physician_result) > 0) {
            while ($physician_row = mysqli_fetch_assoc($physician_result)) {
                echo "<option value='" . $physician_row['FName'] . "'>" . $physician_row['FName'] . "</option>";
            }
        } else {
            echo "<option value=''>No Physicians Found</option>";
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
