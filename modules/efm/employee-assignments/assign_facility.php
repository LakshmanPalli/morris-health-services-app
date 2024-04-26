<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Assign Facility</title>
<style>
    body {
        font-family: Arial, sans-serif;
    }
    
    h2 {
        text-align: center;
    }

    form {
        max-width: 600px;
        margin: 0 auto;
    }

    label {
        display: block;
        margin-bottom: 8px;
    }

    select, button {
        padding: 8px;
        margin-top: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: 100%;
        box-sizing: border-box;
    }

    button {
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
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
</style>
</head>
<body>

<h2>Assign Facility</h2>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="employee">Select Employee:</label>
    <select name="employee" id="employee" required>
        <!-- Populate the dropdown with employees -->
        <?php
        include("config.php");
        $sql = "SELECT * FROM Employee";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['EmpID'] . "'>" . $row['FName'] . " " . $row['LName'] . "</option>";
        }
        ?>
    </select>

    <label for="facility">Select Facility:</label>
    <select name="facility" id="facility" required>
        <!-- Populate the dropdown with facilities -->
        <?php
        $sql = "SELECT * FROM Facility";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['FacID'] . "'>" . $row['Street'] . ", " . $row['City'] . ", " . $row['State'] . ", " . $row['Zip'] . "</option>";
        }
        ?>
    </select>

    <button type="submit" name="submit">Assign Facility</button>
    </form>

<?php
// Check if the form is submitted
if(isset($_POST['submit'])) {
    // Retrieve data from the form
    $employeeID = $_POST['employee'];
    $facilityID = $_POST['facility'];

    // Update the Employee table with the selected facility ID
    $updateQuery = "UPDATE Employee SET FacID = '$facilityID' WHERE EmpID = '$employeeID'";
    if(mysqli_query($con, $updateQuery)) {
        echo "<p style='color: green; text-align: center;'>Facility assigned successfully.</p>";
    } else {
        echo "<p style='color: red; text-align: center;'>Error assigning facility.</p>";
    }
}
?>

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
        </tr>
    </thead>
    <tbody>
        <?php
        // Retrieve data from the database
        $sql = "SELECT Employee.EmpID, Employee.FName, Employee.LName, Facility.Street, Facility.City, Facility.State, Facility.Zip
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
                </tr>
                <?php
            }
        } else {
            // No assignments found
            echo "<tr><td colspan='7'>No assignments found</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>

<?php
// Close the database connection
mysqli_close($con);
?>
