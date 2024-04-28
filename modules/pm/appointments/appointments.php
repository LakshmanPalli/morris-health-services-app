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

    .edit-cost-btn {
        padding: 6px 10px;
        background-color: #28a745; /* Green */
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .edit-cost-btn:hover {
        background-color: #218838;
    }
	
    /* Add more classes and colors as needed */
    .edit-btn, .delete-btn {
        background-color: transparent;
        border: none;
        cursor: pointer;
    }

    .edit-btn:hover, .delete-btn:hover {
        color: blue;
    
</style>
</head>
<body>

<h2>All Appointments</h2>

<button class="add-appointment-btn" onclick="location.href='add_appointment.php'">Add Appointment</button>

<table>
    <thead>
        <tr>
			<th>id</th>
            <th>SSN</th>
            <th>Pid</th>
            <th>FacID</th>
            <th>Date_Time</th>
			<th>Inv_id</th>
            <th>Cost</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Include the database connection file
        include("config.php");

        // Retrieve data from the database sorted based on SSN
        $sql = "SELECT id, SSN, Pid, FacID, Date_Time, Inv_id, Cost
                FROM Appointment
                ORDER BY SSN";
        $result = mysqli_query($con, $sql);

        // Check if there are any appointments
        if (mysqli_num_rows($result) > 0) {
            // Output data of each appointment
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['SSN']; ?></td>
                    <td><?php echo $row['Pid']; ?></td>
                    <td><?php echo $row['FacID']; ?></td>
                    <td><?php echo $row['Date_Time']; ?></td>
                    <td><?php echo $row['Inv_id']; ?></td>
                    <td><?php echo $row['Cost']; ?></td>
                    <td>
						<a href="edit_appointment.php?id=<?php echo $row['id']; ?>" class="edit-btn">✏️</a>
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
