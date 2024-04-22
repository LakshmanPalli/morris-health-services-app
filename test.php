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
</style>
</head>
<body>

<h2>Employee List</h2>

<form method="GET">
    <input type="text" name="search" placeholder="Search by name...">
    <button type="submit">Search</button>
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
        </tr>
    </thead>
    <tbody>
        <?php
        include("config.php");

        $search = isset($_GET['search']) ? $_GET['search'] : '';

        $ret = "SELECT * FROM employee WHERE FName LIKE '%$search%' ORDER BY FName";
        $stmt = $con->prepare($ret);
        $stmt->execute();
        $res = $stmt->get_result();
        $cnt = 1;
        while ($row = $res->fetch_object()) {
        ?>
            <tr>
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
