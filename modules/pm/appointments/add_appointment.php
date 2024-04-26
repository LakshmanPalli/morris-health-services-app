<?php
// Include your database connection file (e.g., config.php)
include("config.php");

// Define variables and initialize with empty values
$SSN = $Pid = $FacID = $Date_Time = "";
$SSN_err = $Pid_err = $FacID_err = $Date_Time_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate SSN
    if(empty(trim($_POST["SSN"]))){
        $SSN_err = "Please select a doctor.";
    } else{
        $SSN = trim($_POST["SSN"]);
    }
    
    // Validate Pid
    if(empty(trim($_POST["Pid"]))){
        $Pid_err = "Please select a patient.";
    } else{
        $Pid = trim($_POST["Pid"]);
    }
    
    // Validate FacID
    if(empty(trim($_POST["FacID"]))){
        $FacID_err = "Please select a facility.";
    } else{
        $FacID = trim($_POST["FacID"]);
    }
    
    // Validate Date_Time
    if(empty(trim($_POST["Date_Time"]))){
        $Date_Time_err = "Please enter date and time.";
    } else{
        $Date_Time = trim($_POST["Date_Time"]);
    }
    
    // Check input errors before inserting into database
    if(empty($SSN_err) && empty($Pid_err) && empty($FacID_err) && empty($Date_Time_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO Appointment (SSN, Pid, FacID, Date_Time) VALUES (?, ?, ?, ?)";
        
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_SSN, $param_Pid, $param_FacID, $param_Date_Time);
            
            // Set parameters
            $param_SSN = $SSN;
            $param_Pid = $Pid;
            $param_FacID = $FacID;
            $param_Date_Time = $Date_Time;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to appointments list page
                header("location: appointments.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($con);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Appointment</title>
</head>
<body>

<h2>Add Appointment</h2>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="SSN">Doctor:</label><br>
    <select id="SSN" name="SSN">
        <!-- Populate the dropdown with doctors -->
        <?php
        $sql = "SELECT * FROM Doctor";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['SSN'] . "'>" . $row['Name'] . "</option>";
        }
        ?>
    </select>
    <span><?php echo $SSN_err; ?></span><br><br>

    <label for="Pid">Patient:</label><br>
    <select id="Pid" name="Pid">
        <!-- Populate the dropdown with patients -->
        <?php
        $sql = "SELECT * FROM Patient";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['Pid'] . "'>" . $row['FName'] . " " . $row['LName'] . "</option>";
        }
        ?>
    </select>
    <span><?php echo $Pid_err; ?></span><br><br>

    <label for="FacID">Facility:</label><br>
    <select id="FacID" name="FacID">
        <!-- Populate the dropdown with facilities -->
        <?php
        $sql = "SELECT * FROM Facility";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['FacID'] . "'>" . $row['Street'] . ", " . $row['City'] . ", " . $row['State'] . ", " . $row['Zip'] . "</option>";
        }
        ?>
    </select>
    <span><?php echo $FacID_err; ?></span><br><br>

    <label for="Date_Time">Date and Time:</label><br>
    <input type="datetime-local" id="Date_Time" name="Date_Time" value="<?php echo $Date_Time; ?>">
    <span><?php echo $Date_Time_err; ?></span><br><br>

    <button type="submit">Add Appointment</button>
</form>

</body>
</html>
