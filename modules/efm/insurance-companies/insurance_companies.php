<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Insurance Companies</title>
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

    button {
        padding: 5px 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>

<h2>Insurance Companies</h2>

<table>
    <thead>
        <tr>
            <th>Insurance ID</th>
            <th>Name</th>
            <th>Address</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Include the database connection file
        include("config.php");

        // Query to fetch insurance companies
        $sql = "SELECT * FROM `Insurance Company`";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            $cnt = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $cnt; ?></td>
                    <td><?php echo $row['Name']; ?></td>
                    <td><?php echo $row['Street'] . ", " . $row['City'] . ", " . $row['State'] . ", " . $row['Zip']; ?></td>
                </tr>
                <?php
                $cnt++;
            }
        } else {
            echo "<tr><td colspan='3'>No insurance companies found</td></tr>";
        }

        // Close connection
        mysqli_close($con);
        ?>
    </tbody>
</table>

<div style="text-align: center; margin-top: 20px;">
    <button onclick="window.location.href = 'add_insurance_company.php';">Add Insurance Company</button>
</div>

</body>
</html>
