<?php
// Include the database connection file
include("config.php");

// Retrieve form data
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];
$facility_desc = $_POST['facility'];

// SQL query to generate the report
$sql = "SELECT a.Date_Time, e.FName AS physician_fname, e.LName AS physician_lname, p.FName AS patient_fname, p.LName AS patient_lname, f.`Desc` AS facility_desc
        FROM Appointment a
        JOIN Employee e ON a.SSN = e.SSN
        JOIN Patient p ON a.Pid = p.Pid
        JOIN Facility f ON a.FacID = f.FacID
        WHERE DATE(a.Date_Time) BETWEEN '$from_date' AND '$to_date'
        AND f.`Desc` = '$facility_desc'";

$result = mysqli_query($con, $sql);

// Check if there are any appointments
if (mysqli_num_rows($result) > 0) {
    // Output appointment details
    echo "<h2>Appointment Details</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Date</th><th>Physician</th><th>Patient</th><th>Facility</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['Date_Time'] . "</td>";
        echo "<td>" . $row['physician_fname'] . " " . $row['physician_lname'] . "</td>";
        echo "<td>" . $row['patient_fname'] . " " . $row['patient_lname'] . "</td>";
        echo "<td>" . $row['facility_desc'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    // No appointments found
    echo "No appointments found for the selected time period and facility.";
}

// Close the database connection
mysqli_close($con);
?>
