<?php
// Include your database connection file (e.g., config.php)
include("config.php");

// Define variables and initialize with empty values
$FName = $Minit = $LName = $street = $city = $state = $zip = $ssn = $Ins_id = "";
$FName_err = $LName_err = $street_err = $city_err = $state_err = $zip_err = $ssn_err = $Ins_id_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate First Name
    if(empty(trim($_POST["FName"]))){
        $FName_err = "Please enter first name.";
    } else{
        $FName = trim($_POST["FName"]);
    }
    
    // Validate Middle Name
    // Middle name is optional, so no validation required
    
    // Validate Last Name
    if(empty(trim($_POST["LName"]))){
        $LName_err = "Please enter last name.";
    } else{
        $LName = trim($_POST["LName"]);
    }
    
    // Validate Street
    if(empty(trim($_POST["street"]))){
        $street_err = "Please enter street.";
    } else{
        $street = trim($_POST["street"]);
    }
    
    // Validate City
    if(empty(trim($_POST["city"]))){
        $city_err = "Please enter city.";
    } else{
        $city = trim($_POST["city"]);
    }
    
    // Validate State
    if(empty(trim($_POST["state"]))){
        $state_err = "Please enter state.";
    } else{
        $state = trim($_POST["state"]);
    }
    
    // Validate Zip
    if(empty(trim($_POST["zip"]))){
        $zip_err = "Please enter ZIP code.";
    } else{
        $zip = trim($_POST["zip"]);
    }
    
    // Validate SSN
    if(empty(trim($_POST["ssn"]))){
        $ssn_err = "Please enter SSN.";
    } else{
        $ssn = trim($_POST["ssn"]);
    }
    
    // Validate Insurance ID
    if(empty(trim($_POST["Ins_id"]))){
        $Ins_id_err = "Please enter insurance ID.";
    } else{
        $Ins_id = trim($_POST["Ins_id"]);
    }
    
    // Check input errors before inserting into database
    if(empty($FName_err) && empty($LName_err) && empty($street_err) && empty($city_err) && empty($state_err) && empty($zip_err) && empty($ssn_err) && empty($Ins_id_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO Patient (First_Name, Middle_Name, Last_Name, Street, City, State, Zip, SSN, Insurance_ID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssss", $param_FName, $param_Minit, $param_LName, $param_street, $param_city, $param_state, $param_zip, $param_ssn, $param_Ins_id);
            
            // Set parameters
            $param_FName = $FName;
            $param_Minit = $Minit;
            $param_LName = $LName;
            $param_street = $street;
            $param_city = $city;
            $param_state = $state;
            $param_zip = $zip;
            $param_ssn = $ssn;
            $param_Ins_id = $Ins_id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to patient list page
                header("location: patients.php");
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
<title>Add Patient</title>
</head>
<body>

<h2>Add Patient</h2>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="FName">First Name:</label><br>
    <input type="text" id="FName" name="FName" value="<?php echo $FName; ?>">
    <span><?php echo $FName_err; ?></span><br><br>
    <label for="Minit">Middle Name:</label><br>
    <input type="text" id="Minit" name="Minit" value="<?php echo $Minit; ?>"><br><br>
    <label for="LName">Last Name:</label><br>
    <input type="text" id="LName" name="LName" value="<?php echo $LName; ?>">
    <span><?php echo $LName_err; ?></span><br><br>
    <label for="street">Street:</label><br>
    <input type="text" id="street" name="street" value="<?php echo $street; ?>">
    <span><?php echo $street_err; ?></span><br><br>
    <label for="city">City:</label><br>
    <input type="text" id="city" name="city" value="<?php echo $city; ?>">
    <span><?php echo $city_err; ?></span><br><br>
    <label for="state">State:</label><br>
    <input type="text" id="state" name="state" value="<?php echo $state; ?>">
    <span><?php echo $state_err; ?></span><br><br>
    <label for="zip">Zip:</label><br>
    <input type="text" id="zip" name="zip" value="<?php echo $zip; ?>">
    <span><?php echo $zip_err; ?></span><br><br>
    <label for="ssn">SSN:</label><br>
    <input type="text" id="ssn" name="ssn" value="<?php echo $ssn; ?>">
    <span><?php echo $ssn_err; ?></span><br><br>
    <label for="Ins_id">Insurance ID:</label><br>
    <input type="text" id="Ins_id" name="Ins_id" value="<?php echo $Ins_id; ?>">
    <span><?php echo $Ins_id_err; ?></span><br><br>
    <button type="submit">Add Patient</button>
    <a href="Add_appointment.php" style="margin-left: 10px;">Add Appointment</a>
</form>

</body>
</html>
