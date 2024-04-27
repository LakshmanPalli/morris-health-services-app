<?php
// Include the database connection file
include("config.php");

// Check if the month is provided
if(isset($_GET['month'])) {
    // Sanitize the input month
    $selected_month = mysqli_real_escape_string($con, $_GET['month']);
    
    // Extract year and month from the selected month
    list($year, $month) = explode('-', $selected_month);
    
    // Query to fetch revenue data for the selected month grouped by day
    $revenue_query = "SELECT DATE(a.Date_Time) AS RevenueDate,
                            SUM(a.Cost) AS TotalRevenue
                      FROM Appointment a
                      WHERE YEAR(a.Date_Time) = '$year' AND MONTH(a.Date_Time) = '$month'
                      GROUP BY RevenueDate
                      ORDER BY TotalRevenue DESC
                      LIMIT 5";
    
    // Execute the query
    $revenue_result = mysqli_query($con, $revenue_query);
    
    // Check if there are any results
    if(mysqli_num_rows($revenue_result) > 0) {
        // Display the table header
        echo "<h2>Top 5 Revenue Days for Month: $selected_month</h2>";
        echo "<table border='1'>
                <tr>
                    <th>Date</th>
                    <th>Total Revenue</th>
                </tr>";
        
        // Display the revenue data for each day
        while($row = mysqli_fetch_assoc($revenue_result)) {
            $revenue_date = $row['RevenueDate'];
            $total_revenue = $row['TotalRevenue'];
            
            // Display date and total revenue
            echo "<tr>
                    <td>$revenue_date</td>
                    <td>$total_revenue</td>
                  </tr>";
        }
        
        // Close the table
        echo "</table>";
        
        // Add back button
        echo "<br><a href='javascript:history.back()' class='back-btn'>Back</a>";
    } else {
        // No revenue data found for the selected month
        echo "<h2>No revenue data found for month: $selected_month</h2>";
        
        // Add back button
        echo "<br><a href='javascript:history.back()' class='back-btn'>Back</a>";
    }
} else {
    // Month is not provided
    echo "<h2>Please select a month to generate the report.</h2>";
}

// Close the database connection
mysqli_close($con);
?>