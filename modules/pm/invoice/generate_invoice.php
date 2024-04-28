<?php
// Include your database connection file (e.g., config.php)
include("config.php");

// Check if date and insurance company are set in the URL
if(isset($_GET['date']) && isset($_GET['insurance'])) {
    // Get date and insurance company from the URL
    $date = $_GET['date'];
    $insurance = $_GET['insurance'];
    
    // Retrieve invoices for the selected date and insurance company
    $sql_invoices = "SELECT i.Inv_id, i.Inv_Date, a.Cost AS Inv_Amt, a.Pid
            FROM Invoice i
            LEFT JOIN Appointment a ON i.Inv_id = a.Inv_id
            WHERE i.Inv_Date = ? AND i.Ins_id = ?";
    $stmt = mysqli_prepare($con, $sql_invoices);
    mysqli_stmt_bind_param($stmt, "ss", $date, $insurance);
    mysqli_stmt_execute($stmt);
    $result_invoices = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    
    // Initialize variables for total amount calculation
    $total_amount = 0;
    
    // Output the invoice details
    echo "<h2>Insurance Company Invoice for $date</h2>";
    echo "<h3>Insurance Company: $insurance</h3>";
    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Invoice ID</th>";
    echo "<th>Invoice Date</th>";
    echo "<th>Invoice Amount</th>";
    echo "<th>Patient ID</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    // Loop through each invoice and display the details
    while ($row = mysqli_fetch_assoc($result_invoices)) {
        echo "<tr>";
        echo "<td>" . $row['Inv_id'] . "</td>";
        echo "<td>" . $row['Inv_Date'] . "</td>";
        echo "<td>$" . $row['Inv_Amt'] . "</td>";
        echo "<td>" . $row['Pid'] . "</td>";
        echo "</tr>";
        // Accumulate the total amount
        $total_amount += $row['Inv_Amt'];
    }
    echo "</tbody>";
    echo "<tfoot>";
    echo "<tr>";
    echo "<td colspan='2'><strong>Total Amount:</strong></td>";
    echo "<td><strong>$total_amount</strong></td>";
    echo "<td></td>";
    echo "</tr>";
    echo "</tfoot>";
    echo "</table>";
} else {
    // If date or insurance company is not set in the URL, display an error message
    echo "<h2>Error: Date or Insurance Company not provided.</h2>";
}
?>
