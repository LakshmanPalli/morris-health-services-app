<?php
// Include the database connection file
include("config.php");

// Query to calculate average daily revenue for each insurance company
$sql = "SELECT 
            i.Name AS Insurance_Company, 
            DATE(a.Date_Time) AS Appointment_Date, 
            AVG(a.Cost) AS Average_Daily_Revenue
        FROM 
            Appointment a
        JOIN 
            Invoice inv ON a.Inv_id = inv.Inv_id
        JOIN 
            `Insurance Company` i ON inv.Ins_id = i.Ins_id
        GROUP BY 
            i.Ins_id, DATE(a.Date_Time)";

$result = mysqli_query($con, $sql);

// Display the results in a tabular format
if (mysqli_num_rows($result) > 0) {
    echo "<h2>Report: Average Daily Revenue by Insurance Company</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Insurance Company</th><th>Appointment Date</th><th>Average Daily Revenue</th></tr>";
    
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['Insurance_Company'] . "</td>";
        echo "<td>" . $row['Appointment_Date'] . "</td>";
        echo "<td>$" . number_format($row['Average_Daily_Revenue'], 2) . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "No data available.";
}

// Close the database connection
mysqli_close($con);
?>
