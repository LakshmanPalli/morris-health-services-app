<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>All Appointments</title>
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

    .appointment-status-select {
        padding: 6px 10px;
        border-radius: 4px;
    }
</style>
</head>
<body>

<h2>All Appointments</h2>

<table>
    <thead>
        <tr>
            <th>SSN</th>
            <th>Pid</th>
            <th>FacID</th>
            <th>Date_Time</th>
            <th>Appointment Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Include the database connection file
        include("config.php");

        // Retrieve data from the database sorted based on SSN
        $sql = "SELECT SSN, Pid, FacID, Date_Time, Appointment_Status
                FROM Appointment
                ORDER BY SSN";
        $result = mysqli_query($con, $sql);

        // Check if there are any appointments
        if (mysqli_num_rows($result) > 0) {
            // Output data of each appointment
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['SSN']; ?></td>
                    <td><?php echo $row['Pid']; ?></td>
                    <td><?php echo $row['FacID']; ?></td>
                    <td><?php echo $row['Date_Time']; ?></td>
                    <td>
                        <select class="appointment-status-select">
                            <option value="Scheduled" <?php echo ($row['Appointment_Status'] == 'Scheduled') ? 'selected' : ''; ?>>Scheduled</option>
                            <option value="In Progress" <?php echo ($row['Appointment_Status'] == 'In Progress') ? 'selected' : ''; ?>>In Progress</option>
                            <option value="Completed" <?php echo ($row['Appointment_Status'] == 'Completed') ? 'selected' : ''; ?>>Completed</option>
                        </select>
                    </td>
                    <td>
                        <?php if ($row['Appointment_Status'] == 'Completed') : ?>
                            <button class="generate-invoice-btn">Generate Invoice</button>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php
            }
        } else {
            // No appointments found
            echo "<tr><td colspan='6'>No appointments found</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>
