/* Todo: need to validate the form, and deal with the constraint, and checks to safely add and maintain consistency */

<?php
// Include your database connection file (e.g., config.php)
include("config.php");

// Define variables and initialize with empty values
$ssn = $fname = $minit = $lname = $hiredate = $jobclass = $street = $city = $state = $zip = $salary = "";
$ssn_err = $fname_err = $lname_err = $hiredate_err = $jobclass_err = $salary_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate SSN
    if(empty(trim($_POST["ssn"]))){
        $ssn_err = "Please enter SSN.";
    } else{
        $ssn = trim($_POST["ssn"]);
    }

    // Validate First Name
    if(empty(trim($_POST["fname"]))){
        $fname_err = "Please enter first name.";
    } else{
        $fname = trim($_POST["fname"]);
    }

    // Validate Last Name
    if(empty(trim($_POST["lname"]))){
        $lname_err = "Please enter last name.";
    } else{
        $lname = trim($_POST["lname"]);
    }

    // Validate Hire Date
    if(empty(trim($_POST["hiredate"]))){
        $hiredate_err = "Please enter hire date.";
    } else{
        $hiredate = trim($_POST["hiredate"]);
    }

    // Validate Job Class
    if(empty(trim($_POST["jobclass"]))){
        $jobclass_err = "Please enter job class.";
    } else{
        $jobclass = trim($_POST["jobclass"]);
    }

    // Validate Salary
    if(empty(trim($_POST["salary"]))){
        $salary_err = "Please enter salary.";
    } else{
        $salary = trim($_POST["salary"]);
    }

    // Check input errors before inserting into database
    if(empty($ssn_err) && empty($fname_err) && empty($lname_err) && empty($hiredate_err) && empty($jobclass_err) && empty($salary_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO employee (SSN, FName, Minit, LName, Hiredate, Jobclass, Street, City, State, Zip, Salary) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssssss", $param_ssn, $param_fname, $param_minit, $param_lname, $param_hiredate, $param_jobclass, $param_street, $param_city, $param_state, $param_zip, $param_salary);
            
            // Set parameters
            $param_ssn = $ssn;
            $param_fname = $fname;
            $param_minit = $minit;
            $param_lname = $lname;
            $param_hiredate = $hiredate;
            $param_jobclass = $jobclass;
            $param_street = $street;
            $param_city = $city;
            $param_state = $state;
            $param_zip = $zip;
            $param_salary = $salary;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to employee list page
                header("location: employees.php");
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
<title>Add Employee</title>
</head>
<body>

<h2>Add Employee</h2>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="ssn">SSN:</label><br>
    <input type="text" id="ssn" name="ssn" value="<?php echo $ssn; ?>">
    <span><?php echo $ssn_err; ?></span><br><br>
    <label for="fname">First Name:</label><br>
    <input type="text" id="fname" name="fname" value="<?php echo $fname; ?>">
    <span><?php echo $fname_err; ?></span><br><br>
    <label for="minit">Middle Initial:</label><br>
    <input type="text" id="minit" name="minit" value="<?php echo $minit; ?>"><br><br>
    <label for="lname">Last Name:</label><br>
    <input type="text" id="lname" name="lname" value="<?php echo $lname; ?>">
    <span><?php echo $lname_err; ?></span><br><br>
    <label for="hiredate">Hire Date:</label><br>
    <input type="date" id="hiredate" name="hiredate" value="<?php echo $hiredate; ?>">
    <span><?php echo $hiredate_err; ?></span><br><br>
    <label for="jobclass">Job Class:</label><br>
    <input type="text" id="jobclass" name="jobclass" value="<?php echo $jobclass; ?>">
    <span><?php echo $jobclass_err; ?></span><br><br>
    <label for="street">Street:</label><br>
    <input type="text" id="street" name="street" value="<?php echo $street; ?>"><br><br>
    <label for="city">City:</label><br>
    <input type="text" id="city" name="city" value="<?php echo $city; ?>"><br><br>
    <label for="state">State:</label><br>
    <input type="text" id="state" name="state" value="<?php echo $state; ?>"><br><br>
    <label for="zip">Zip:</label><br>
    <input type="text" id="zip" name="zip" value="<?php echo $zip; ?>"><br><br>
    <label for="salary">Salary:</label><br>
    <input type="text" id="salary" name="salary" value="<?php echo $salary; ?>">
    <span><?php echo $salary_err; ?></span><br><br>
    <button type="submit">Add Employee</button>
</form>

</body>
</html>
