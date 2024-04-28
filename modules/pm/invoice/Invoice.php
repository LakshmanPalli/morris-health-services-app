<?php
// Include your database connection file (e.g., config.php)
include("config.php");

// Retrieve unique insurance companies from the database
$sql_insurance = "SELECT DISTINCT Ins_id FROM Invoice";
$result_insurance = mysqli_query($con, $sql_insurance);

// Retrieve unique dates from the database
$sql_dates = "SELECT DISTINCT Inv_Date FROM Invoice"; // check for the dates fetched
$result_dates = mysqli_query($con, $sql_dates);

// Retrieve all invoices data from the database
$sql_all_invoices = "SELECT i.Inv_id, i.Inv_Date, a.Cost AS Inv_Amt, i.Ins_id, a.Pid
        FROM Invoice i
        LEFT JOIN Appointment a ON i.Inv_id = a.Inv_id
        ORDER BY a.Date_Time DESC"; // Sorting by the latest appointment
$result_all_invoices = mysqli_query($con, $sql_all_invoices);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>All Invoices</title>
<style>
    /* CSS styles remain the same as before */
</style>
</head>
<body>

<h2>All Invoices</h2>

<!-- Form for selecting date and insurance company -->
<form method="GET" action="generate_invoice.php">
    <label for="date">Select Date:</label>
    <select name="date" id="date">
        <?php
        while ($row = mysqli_fetch_assoc($result_dates)) {
            echo "<option value='" . $row['Inv_Date'] . "'>" . $row['Inv_Date'] . "</option>";
        }
        ?>
    </select>
    <label for="insurance">Select Insurance Company:</label>
    <select name="insurance" id="insurance">
        <?php
        while ($row = mysqli_fetch_assoc($result_insurance)) {
            echo "<option value='" . $row['Ins_id'] . "'>" . $row['Ins_id'] . "</option>";
        }
        ?>
    </select>
    <button type="submit">Generate Invoice</button>
</form>

<!-- Button to navigate to insurance companies page -->
<button onclick="location.href='../../../modules/efm/insurance-companies/insurance_companies.php'" class="navigation-link">View Insurance Companies</button>

<!-- Display all invoices -->
<table>
    <thead>
        <tr>
            <th>Invoice ID</th>
            <th>Invoice Date</th>
            <th>Invoice Amount</th>
            <th>Insurance Company ID</th>
            <th>Patient ID</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Check if there are any invoices
        if (mysqli_num_rows($result_all_invoices) > 0) {
            // Output data of each invoice
            while ($row = mysqli_fetch_assoc($result_all_invoices)) {
                ?>
                <tr>
                    <td><?php echo $row['Inv_id']; ?></td>
                    <td><?php echo $row['Inv_Date']; ?></td>
                    <td><?php echo $row['Inv_Amt']; ?></td>
                    <td><?php echo $row['Ins_id']; ?></td>
                    <td><a href="patients.php" class="navigation-link"><?php echo $row['Pid']; ?></a></td>
                </tr>
                <?php
            }
        } else {
            // No invoices found
            echo "<tr><td colspan='5'>No invoices found</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>
