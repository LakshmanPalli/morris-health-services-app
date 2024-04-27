<?php
// Include your database connection file (e.g., config.php)
include("config.php");

// Define variables and initialize with empty values
$Cost = $Inv_id = $SSN = $P_id = "";
$Cost_err = $Inv_id_err = $SSN_err = $P_id_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate Inv_id
    if(empty(trim($_POST["Inv_id"]))){
        $Inv_id_err = "Please enter the invoice ID.";
    } else{
        $Inv_id = trim($_POST["Inv_id"]);
    }

    // Validate SSN
    if(empty(trim($_POST["SSN"]))){
        $SSN_err = "Please enter the SSN.";
    } else{
        $SSN = trim($_POST["SSN"]);
    }

    // Validate P_id
    if(empty(trim($_POST["P_id"]))){
        $P_id_err = "Please enter the patient ID.";
    } else{
        $P_id = trim($_POST["P_id"]);
    }

    // Check input errors before inserting into database
    if(empty($Inv_id_err) && empty($SSN_err) && empty($P_id_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO Invoice (Cost, Inv_id, SSN, P_id) VALUES (?, ?, ?, ?)";

        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_Cost, $param_Inv_id, $param_SSN, $param_P_id);

            // Set parameters
            $param_Cost = $_POST['Cost']; // Manually added by the receptionist
            $param_Inv_id = $Inv_id;
            $param_SSN = $SSN;
            $param_P_id = $P_id;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to invoice list page
                header("location: invoices.php");
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
<title>Generate Invoice</title>
</head>
<body>

<h2>Generate Invoice</h2>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="Cost">Cost:</label><br>
    <input type="text" id="Cost" name="Cost" value="<?php echo $Cost; ?>">
    <br><br>
    <label for="Inv_id">Invoice ID:</label><br>
    <input type="text" id="Inv_id" name="Inv_id" value="<?php echo $Inv_id; ?>">
    <span><?php echo $Inv_id_err; ?></span><br><br>
    <label for="SSN">SSN:</label><br>
    <input type="text" id="SSN" name="SSN" value="<?php echo $SSN; ?>">
    <span><?php echo $SSN_err; ?></span><br><br>
    <label for="P_id">Patient ID:</label><br>
    <input type="text" id="P_id" name="P_id" value="<?php echo $P_id; ?>">
    <span><?php echo $P_id_err; ?></span><br><br>
    <button type="submit">Generate Invoice</button>
</form>

<!-- Navigation to Invoice schema -->
<button onclick="location.href='invoices.php'" class="invoice-schema-btn">View Invoices</button>

</body>
</html>
