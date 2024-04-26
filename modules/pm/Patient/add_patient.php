<?php
// Include your database connection file (e.g., config.php)
include("config.php");

// Define variables and initialize with empty values
$firstName = $middleName = $lastName = $street = $city = $state = $zip = $ssn = $insuranceID = "";
$firstName_err = $lastName_err = $street_err = $city_err = $state_err = $zip_err = $ssn_err = $insuranceID_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate First Name
    if(empty(trim($_POST["firstName"]))){
        $firstName_err = "Please enter first name.";
    } else{
        $firstName = trim($_POST["firstName"]);
    }

    // Validate Middle Name
    // Middle name is optional, so no validation required
	if(!empty(trim($_POST["middleName"]))){
        $minit = trim($_POST["middleName"]);
    }


    // Validate Last Name
    if(empty(trim($_POST["lastName"]))){
        $lastName_err = "Please enter last name.";
    } else{
        $lastName = trim($_POST["lastName"]);
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
    if(empty(trim($_POST["insuranceID"]))){
        $insuranceID_err = "Please enter insurance ID.";
    } else{
        $insuranceID = trim($_POST["insuranceID"]);
    }

    // Check input errors before inserting into database
    if(empty($firstName_err) && empty($lastName_err) && empty($street_err) && empty($city_err) && empty($state_err) && empty($zip_err) && empty($ssn_err) && empty($insuranceID_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO Patient (FName, Minit, LName, Street, City, State, Zip, SSN, Ins_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssss", $param_firstName, $param_middleName, $param_lastName, $param_street, $param_city, $param_state, $param_zip, $param_ssn, $param_insuranceID);

            // Set parameters
            $param_firstName = $firstName;
            $param_middleName = $middleName;
            $param_lastName = $lastName;
            $param_street = $street;
            $param_city = $city;
            $param_state = $state;
            $param_zip = $zip;
            $param_ssn = $ssn;
            $param_insuranceID = $insuranceID;

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
    <label for="firstName">First Name:</label><br>
    <input type="text" id="firstName" name="firstName" value="<?php echo $firstName; ?>">
    <span><?php echo $firstName_err; ?></span><br><br>
    <label for="middleName">Middle Name:</label><br>
    <input type="text" id="middleName" name="middleName" value="<?php echo $middleName; ?>"><br><br>
    <label for="lastName">Last Name:</label><br>
    <input type="text" id="lastName" name="lastName" value="<?php echo $lastName; ?>">
    <span><?php echo $lastName_err; ?></span><br><br>
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
    <label for="insuranceID">Insurance ID:</label><br>
    <input type="text" id="insuranceID" name="insuranceID" value="<?php echo $insuranceID; ?>">
    <span><?php echo $insuranceID_err; ?></span><br><br>
    <button type="submit">Add Patient</button>
</form>

</body>
</html>
