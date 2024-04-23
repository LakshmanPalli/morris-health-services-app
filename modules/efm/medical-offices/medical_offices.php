<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Facilities</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
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

    .btn {
        display: inline-block;
        padding: 8px 12px;
        text-decoration: none;
        color: #fff;
        background-color: #007bff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-primary {
        background-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-danger {
        background-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .btn-success {
        background-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
    }
</style>
</head>
<body>

<h2>Facilities</h2>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Address</th>
            <th>Size</th>
            <th>Office Count</th>
            <th>Room Count</th>
            <th>Postal Code</th>
            <th>Type</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include("config.php");

        // Query to fetch facilities
        $sql = "SELECT * FROM Facility";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            $cnt = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $cnt; ?></td>
                    <td><?php echo $row['Street'] . ", " . $row['City'] . ", " . $row['State'] . ", " . $row['Zip']; ?></td>
                    <td><?php echo $row['Size']; ?></td>
                    <td><?php echo $row['Office_Count']; ?></td>
                    <td><?php echo $row['Room_Count']; ?></td>
                    <td><?php echo $row['P_Code']; ?></td>
                    <td><?php echo $row['FacType']; ?></td>
                    <td><?php echo $row['Desc']; ?></td>
                    <td>
                        <a class="btn btn-primary" href="edit_facility.php?id=<?php echo $row['FacID']; ?>">Edit</a>
                    </td>
                </tr>
                <?php
                $cnt++;
            }
        } else {
            echo "<tr><td colspan='10'>No facilities found</td></tr>";
        }

        // Close connection
        mysqli_close($con);
        ?>
    </tbody>
</table>

<!-- Add a link/button to add a new facility -->
<div style="text-align: center; margin-top: 20px;">
    <a class="btn btn-success" href="add_facility.php">Add Facility</a>
</div>

</body>
</html>
