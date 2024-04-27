<?php
// Include your database connection file (e.g., config.php)
include("config.php");

// Define variables and initialize with empty values
$Inv_id = $Inv_Date = $Inv_Amount = $Ins_id = "";
$Inv_id_err = $Inv_Date_err = $Inv_Amount_err = $Ins_id_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate Inv_id
    if(empty(trim($_POST["Inv_id"]))){
        $Inv_id_err = "Please enter the invoice ID.";
    } else{
        $Inv_id = trim($_POST["Inv_id"]);
    }

    // Validate Inv_Date
    if(empty(trim($_POST["Inv_Date"]))){
        $Inv_Date_err = "Please enter the invoice date.";
    } else{
        $Inv_Date = trim($_POST["Inv_Date"]);
    }

    // Validate Inv_Amount
    if(empty(trim($_POST["Inv_Amount"]))){
        $Inv_Amount_err = "Please enter the invoice amount.";
    } else{
        $Inv_Amount = trim($_POST["Inv_Amount"]);
    }

    // Validate Ins_id
    if(empty(trim($_POST["Ins_id"]))){
        $Ins_id_err = "Please enter the insurance company ID.";
    } else{
        $Ins_id = trim($_POST["Ins_id"]);
    }

    // Check input errors before inserting into database
    if(empty($Inv_id_err) && empty($Inv_Date_err) && empty($Inv_Amount_err) && empty($Ins_id_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO Invoice (Inv_id, Inv_Date, Inv_Amount, Ins_id) VALUES (?, ?, ?, ?)";

        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_Inv_id, $param_Inv_Date, $param_Inv_Amount, $param_Ins_id);

            // Set parameters
            $param_Inv_id = $Inv_id;
            $param_Inv_Date = $Inv_Date;
            $param_Inv_Amount = $Inv_Amount;
            $param_Ins_id = $Ins_id;

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
    <label for="Inv_id">Invoice ID:</label><br>
    <input type="text" id="Inv_id" name="Inv_id" value="<?php echo $Inv_id; ?>">
    <span><?php echo $Inv_id_err; ?></span><br><br>
    <label for="Inv_Date">Invoice Date:</label><br>
    <input type="date" id="Inv_Date" name="Inv_Date" value="<?php echo $Inv_Date; ?>">
    <span><?php echo $Inv_Date_err; ?></span><br><br>
    <label for="Inv_Amount">Invoice Amount:</label><br>
    <input type="text" id="Inv_Amount" name="Inv_Amount" value="<?php echo $Inv_Amount; ?>">
    <span><?php echo $Inv_Amount_err; ?></span><br><br>
    <label for="Ins_id">Insurance Company ID:</label><br>
    <input type="text" id="Ins_id" name="Ins_id" value="<?php echo $Ins_id; ?>">
    <span><?php echo $Ins_id_err; ?></span><br><br>
    <button type="submit">Generate Invoice</button>
</form>

<!-- Navigation to Insurance Company schema -->
<button onclick="location.href='insurance_companies.php'" class="insurance-company-btn">View Insurance Companies</button>

<!-- Button to e-mail the invoice -->
<button onclick="location.href='email_invoice.php'" class="email-invoice-btn">E-mail Invoice</button>

<!-- Button to print the invoice -->
<button onclick="window.print()" class="print-invoice-btn">Print</button>

<!-- Button to calculate total amount sorted by P_id -->
<button onclick="location.href='calculate_total_amount.php'" class="calculate-total-amount-btn">Calculate Total Amount</button>

</body>
</html>
