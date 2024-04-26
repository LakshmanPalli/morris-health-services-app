<?php
// Include the database connection file
include("config.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve selected date and physician name from the form
    $selected_date = $_POST['date'];
    $physician_fname = $_POST['physician'];

    // Query to retrieve appointment details based on selected date and physician name
    $sql = "SELECT a.Date_Time, e.FName AS DoctorFName, e.LName AS DoctorLName, CONCAT(p.FName, ' ', p.LName) AS PatientName, 
                   f.Desc AS FacilityName, f.FacType AS FacType, f.Street, f.City, f.State, f.Zip
            FROM Appointment a
            INNER JOIN Employee e ON a.SSN = e.SSN
            INNER JOIN Patient p ON a.Pid = p.Pid
            INNER JOIN Facility f ON a.FacID = f.FacID
            WHERE DATE(a.Date_Time) = '$selected_date' AND e.FName = '$physician_fname'";

    // Execute the query
    $result = mysqli_query($con, $sql);

    // Check if there are any appointments found
    if (mysqli_num_rows($result) > 0) {
        echo "<h2>Physician Appointments on $selected_date with Dr.$physician_fname</h2>";
        echo "<table border='1'>
            <tr>
                <th>Date and Time</th>
                <th>Physician Name</th>
                <th>Patient Name</th>
                <th>Facility Name</th>
                <th>Facility Type</th>
                <th>Facility Address</th>
            </tr>";
        // Output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['Date_Time'] . "</td>";
            echo "<td>" . $row['DoctorFName'] . " " . $row['DoctorLName'] . "</td>";
            echo "<td>" . $row['PatientName'] . "</td>";
            echo "<td>" . $row['FacilityName'] . "</td>";
            echo "<td>" . $row['FacType'] . "</td>";
            echo "<td>" . $row['Street'] . ", " . $row['City'] . ", " . $row['State'] . ", " . $row['Zip'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        // No appointments found for the selected criteria
        echo "<h3>No appointments found for $selected_date with $physician_fname</h3>";
    }
}

// Close the database connection
mysqli_close($con);
?>
