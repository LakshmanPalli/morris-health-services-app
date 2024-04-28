<?php
// Include your database connection file (e.g., config.php)
include("config.php");

// Check if Pid is set in the URL
if(isset($_GET['Pid'])) {
    // Get Pid from the URL
    $Pid = $_GET['Pid'];
    
    // Retrieve the invoices for the given Pid
    $sql = "SELECT i.Inv_id, i.Inv_Date, a.Cost AS Inv_Amt, a.Pid
            FROM Invoice i
            LEFT JOIN Appointment a ON i.Inv_id = a.Inv_id
            WHERE a.Pid = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $Pid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    
    // Initialize variables for total amount calculation
    $total_amount = 0;
    
    // Output the bill-like summary
    echo "<h2>Invoice Summary for Patient ID $Pid</h2>";
    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Invoice ID</th>";
    echo "<th>Invoice Date</th>";
    echo "<th>Invoice Amount</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    // Loop through each invoice and display the details
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['Inv_id'] . "</td>";
        echo "<td>" . $row['Inv_Date'] . "</td>";
        echo "<td>$" . $row['Inv_Amt'] . "</td>";
        echo "</tr>";
        // Accumulate the total amount
        $total_amount += $row['Inv_Amt'];
    }
    echo "</tbody>";
    echo "<tfoot>";
    echo "<tr>";
    echo "<td colspan='2'><strong>Total Amount:</strong></td>";
    echo "<td><strong>$total_amount</strong></td>";
    echo "</tr>";
    echo "</tfoot>";
    echo "</table>";
} else {
    // If Pid is not set in the URL, display an error message
    echo "<h2>Error: Patient ID (Pid) not provided.</h2>";
}
?>
