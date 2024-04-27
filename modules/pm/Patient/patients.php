<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Patient List</title>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    /* Custom colors for different job classes */
    /* Add more classes and colors as needed */
    .edit-btn, .delete-btn {
        background-color: transparent;
        border: none;
        cursor: pointer;
    }

    .edit-btn:hover, .delete-btn:hover {
        color: blue;
    }
</style>
</head>
<body>

<h2>Patient List</h2>

<form method="GET">
    <input type="text" name="search" placeholder="Search by first name..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
    <button type="submit">Search</button>
    <a href="patients.php" style="margin-left: 10px;">Reset</a>
    <button> <a href="add_patient.php" style="margin-left: 10px;">Add</a> </button>
</form>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Pid</th>
            <th>FName</th>
            <th>Minit</th>
            <th>LName</th>
            <th>Street</th>
            <th>City</th>
            <th>State</th>
            <th>Zip</th>
            <th>SSN</th>
            <th>Ins_id</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include("config.php");

        $search = isset($_GET['search']) ? $_GET['search'] : '';

        $query = "SELECT * FROM Patient";
        
        if (!empty($search)) {
            $query .= " WHERE FName LIKE '%$search%'";
        }

        $query .= " ORDER BY FName";
        
        $stmt = $con->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $count = 1;
        while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['Pid']; ?></td>
                <td><?php echo $row['FName']; ?></td>
                <td><?php echo $row['Minit']; ?></td>
                <td><?php echo $row['LName']; ?></td>
                <td><?php echo $row['Street']; ?></td>
                <td><?php echo $row['City']; ?></td>
                <td><?php echo $row['State']; ?></td>
                <td><?php echo $row['Zip']; ?></td>
                <td><?php echo $row['SSN']; ?></td>
                <td><?php echo $row['Ins_id']; ?></td>
                <td>
                    <a href="edit_patient.php?id=<?php echo $row['Pid']; ?>" class="edit-btn">✏️</a>
                </td>
            </tr>
        <?php 
            $count++;
        } 
        mysqli_close($con);
        ?>
    </tbody>
</table>

</body>
</html>
