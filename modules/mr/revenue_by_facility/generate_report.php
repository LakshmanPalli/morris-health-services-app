<?php
// Include the database connection file
include("config.php");

// Check if the date is provided
if(isset($_GET['date'])) {
    // Sanitize the input date
    $selected_date = mysqli_real_escape_string($con, $_GET['date']);
    
    // Query to fetch revenue data for the selected date grouped by facility
    $revenue_query = "SELECT f.FacID, f.Street, f.City, f.Desc, 
                            SUM(a.Cost) AS TotalRevenue
                      FROM Facility f
                      LEFT JOIN Appointment a ON f.FacID = a.FacID
                      WHERE DATE(a.Date_Time) = '$selected_date'
                      GROUP BY f.FacID";
    
    // Execute the query
    $revenue_result = mysqli_query($con, $revenue_query);
    
    // Check if there are any results
    if(mysqli_num_rows($revenue_result) > 0) {
        // Display the table header
        echo "<h2>Revenue by Facility for Date: $selected_date</h2>";
        echo "<table border='1'>
                <tr>
                    <th>Facility ID</th>
                    <th>Facility Name</th>
                    <th>Street</th>
                    <th>City</th>
                    <th>Total Revenue</th>
                </tr>";
        
        // Initialize total revenue
        $total_revenue = 0;
        
        // Display the revenue data for each facility
        while($row = mysqli_fetch_assoc($revenue_result)) {
            $fac_id = $row['FacID'];
            $street = $row['Street'];
            $city = $row['City'];
            $desc = $row['Desc'];
            $total_revenue += $row['TotalRevenue'];
            
            // Display facility details and total revenue
            echo "<tr>
                    <td>$fac_id</td>
                    <td>$desc</td> 
                    <td>$street</td>
                    <td>$city</td>                   
                    <td>{$row['TotalRevenue']}</td>
                  </tr>";
        }
        
        // Display the total revenue for the day
        echo "<tr>
                <td colspan='4'><b>Total Revenue</b></td>
                <td><b>$total_revenue</b></td>
              </tr>";
        
        // Close the table
        echo "</table>";
        // Add back button
        echo "<br><a href='javascript:history.back()' class='back-btn'>Back</a>";
   
    } else {
        // No revenue data found for the selected date
        echo "<h2>No revenue data found for date: $selected_date</h2>";
    }
} else {
    // Date is not provided
    echo "<h2>Please select a date to generate the report.</h2>";
}

// Close the database connection
mysqli_close($con);
?>
