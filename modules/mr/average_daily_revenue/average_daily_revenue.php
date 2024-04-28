<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Average Daily Revenue by Insurance Company</title>
</head>
<body>

<h2>Average Daily Revenue by Insurance Company</h2>

<form action="generate_report.php" method="GET">
    <label for="start_date">Start Date:</label>
    <input type="date" id="start_date" name="start_date" required>
    <br><br>
    <label for="end_date">End Date:</label>
    <input type="date" id="end_date" name="end_date" required>
    <br><br>
    <button type="submit">Generate Report</button>
</form>

</body>
</html>
