<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Employee Assignments</title>
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

    .assign-btn {
        padding: 6px 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .assign-btn:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>

<h2>Employee Assignments</h2>

<table>
    <thead>
        <tr>
            <th>Employee ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Facility Street</th>
            <th>Facility City</th>
            <th>Facility State</th>
            <th>Facility Zip</th>
            <th>Facility Type</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Include the database connection file
        include("config.php");

        // Retrieve data from the database
        $sql = "SELECT Employee.EmpID, Employee.FName, Employee.LName, Facility.Street, Facility.City, Facility.State, Facility.Zip, Facility.FacType, Facility.Desc
                FROM Employee
                LEFT JOIN Facility ON Employee.FacID = Facility.FacID";
        $result = mysqli_query($con, $sql);

        // Check if there are any assignments
        if (mysqli_num_rows($result) > 0) {
            // Output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['EmpID']; ?></td>
                    <td><?php echo $row['FName']; ?></td>
                    <td><?php echo $row['LName']; ?></td>
                    <td><?php echo $row['Street'] ?? ''; ?></td>
                    <td><?php echo $row['City'] ?? ''; ?></td>
                    <td><?php echo $row['State'] ?? ''; ?></td>
                    <td><?php echo $row['Zip'] ?? ''; ?></td>
                    <td><?php echo $row['FacType'] ?? ''; ?></td>
                    <td><?php echo $row['Desc'] ?? ''; ?></td>
                    <td>
                        <?php if (empty($row['Street'])) : ?>
                            <button onclick="location.href='assign_facility.php'" class="assign-btn">Assign Facility</button>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php
            }
        } else {
            // No assignments found
            echo "<tr><td colspan='10'>No assignments found</td></tr>";
        }
        ?>
    </tbody>
</table>

<!-- Update facility assignment button -->
<button onclick="location.href='assign_facility.php'" class="assign-btn">Update Facility Assignment</button>

</body>
</html>
