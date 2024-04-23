<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Employee List</title>
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
    .admin {
        background-color: #ffe6e6; /* Light red */
    }

    .hcp {
        background-color: #ffffcc; /* Light yellow */
    }

    .doctor {
        background-color: #e6f7ff; /* Light blue */
    }

    .nurse {
        background-color: #e6ffe6; /* Light green */
    }

    /* this is an extra feature not mentioned in the scope of project (safe to drop) */

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

<h2>Employee List</h2>

<form method="GET">
    <input type="text" name="search" placeholder="Search by first name..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
    <button type="submit">Search</button>
    <a href="employees.php" style="margin-left: 10px;">Reset</a>
    <button> <a href="add_employee.php" style="margin-left: 10px;">Add</a> </button>
</form>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>SSN</th>
            <th>First Name</th>
            <th>Middle Initial</th>
            <th>Last Name</th>
            <th>Employee ID</th>
            <th>Hire Date</th>
            <th>Job Class</th>
            <th>Address</th>
            <th>Salary</th>
            <th>FacID</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include("config.php");

        $search = isset($_GET['search']) ? $_GET['search'] : '';

        $ret = "SELECT * FROM employee";
        
        if (!empty($search)) {
            $ret .= " WHERE FName LIKE '%$search%'";
        }

        $ret .= " ORDER BY FName";
        
        $stmt = $con->prepare($ret);
        $stmt->execute();
        $res = $stmt->get_result();
        $cnt = 1;
        while ($row = $res->fetch_object()) {
            $jobClass = strtolower($row->Jobclass); // Convert job class to lowercase for comparison
            $classColor = '';
            switch ($jobClass) {
                case 'admin':
                case 'manager':
                    $classColor = 'admin';
                    break;
                case 'hcp':
                case 'staff':
                    $classColor = 'hcp';
                    break;
                case 'doctor':
                    $classColor = 'doctor';
                    break;
                case 'nurse':
                    $classColor = 'nurse';
                    break;
                // Add more cases as needed for other job classes
                default:
                    $classColor = '';
            }
        ?>
            <tr class="<?php echo $classColor; ?>">
                <td><?php echo $cnt; ?></td>
                <td><?php echo $row->SSN; ?></td>
                <td><?php echo $row->FName; ?></td>
                <td><?php echo $row->Minit; ?></td>
                <td><?php echo $row->LName; ?></td>
                <td><?php echo $row->EmpID; ?></td>
                <td><?php echo $row->Hiredate; ?></td>
                <td><?php echo $row->Jobclass; ?></td>
                <td><?php echo $row->Street . ", " . $row->City . ", " . $row->State . ", " . $row->Zip; ?></td>
                <td><?php echo $row->Salary; ?></td>
                <td><?php echo $row->FacID; ?></td>
                <td>
                    <a href="edit_employee.php?id=<?php echo $row->EmpID; ?>" class="edit-btn">✏️</a>
                </td>
            </tr>
        <?php 
            $cnt = $cnt + 1;
        } 
        mysqli_close($con);
        ?>
    </tbody>
</table>

</body>
</html>
