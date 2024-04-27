<?php
// Include your database connection file (e.g., config.php)
include("config.php");

// Retrieve data from the database
$sql = "SELECT i.Inv_id, i.Inv_Date, a.Cost AS Inv_Amt, i.Ins_id
        FROM Invoice i
        LEFT JOIN Appointment a ON i.Inv_id = a.Inv_id
        ORDER BY a.Date_Time DESC"; // Sorting by the latest appointment
$result = mysqli_query($con, $sql);
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>All Invoices</title>
<style>
    body {
        font-family: Arial, sans-serif;
    }
    
    h2 {
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    .generate-invoice-btn {
        padding: 6px 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .generate-invoice-btn:hover {
        background-color: #0056b3;
    }

    .navigation-link {
        color: blue;
        text-decoration: underline;
        cursor: pointer;
    }

    .navigation-link:hover {
        color: #0000EE;
    }
</style>
</head>
<body>

<h2>All Invoices</h2>

<table>
    <thead>
        <tr>
            <th>Invoice ID</th>
            <th>Invoice Date</th>
            <th>Invoice Amount</th>
            <th>Insurance Company ID</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Check if there are any invoices
        if (mysqli_num_rows($result) > 0) {
            // Output data of each invoice
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['Inv_id']; ?></td>
                    <td><?php echo $row['Inv_Date']; ?></td>
                    <td><?php echo $row['Inv_Amt']; ?></td>
                    <td><a href="insurance_companies.php" class="navigation-link"><?php echo $row['Ins_id']; ?></a></td>
                    <td>
                        <!-- Generate Invoice button to navigate to Invoice_detail.php -->
                        <button onclick="location.href='Invoice_detail.php?Inv_id=<?php echo $row['Inv_id']; ?>'" class="generate-invoice-btn">Generate Invoice</button>
                    </td>
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
