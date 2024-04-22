<?php
// Include your database connection file (e.g., config.php)
include("config.php");

// Define variables and initialize with empty values
$street = $city = $state = $zip = $size = $office_count = $room_count = $p_code = $fac_type = $desc = "";
$street_err = $city_err = $state_err = $zip_err = $size_err = $office_count_err = $room_count_err = $p_code_err = $fac_type_err = $desc_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Street
    if (empty(trim($_POST["street"]))) {
        $street_err = "Please enter street.";
    } else {
        $street = trim($_POST["street"]);
    }

    // Validate City
    if (empty(trim($_POST["city"]))) {
        $city_err = "Please enter city.";
    } else {
        $city = trim($_POST["city"]);
    }

    // Validate State
    if (empty(trim($_POST["state"]))) {
        $state_err = "Please enter state.";
    } else {
        $state = trim($_POST["state"]);
    }

    // Validate Zip
    if (empty(trim($_POST["zip"]))) {
        $zip_err = "Please enter zip code.";
    } else {
        $zip = trim($_POST["zip"]);
    }

    // Validate Size
    if (empty(trim($_POST["size"]))) {
        $size_err = "Please enter size.";
    } else {
        $size = trim($_POST["size"]);
    }

    // Validate Office Count
    if (empty(trim($_POST["office_count"]))) {
        $office_count_err = "Please enter office count.";
    } else {
        $office_count = trim($_POST["office_count"]);
    }

    // Validate Room Count
    if (empty(trim($_POST["room_count"]))) {
        $room_count_err = "Please enter room count.";
    } else {
        $room_count = trim($_POST["room_count"]);
    }

    // Validate Postal Code
    if (empty(trim($_POST["p_code"]))) {
        $p_code_err = "Please enter postal code.";
    } else {
        $p_code = trim($_POST["p_code"]);
    }

    // Validate Facility Type
    if (empty(trim($_POST["fac_type"]))) {
        $fac_type_err = "Please enter facility type.";
    } else {
        $fac_type = trim($_POST["fac_type"]);
    }

    // Validate Description
    if (empty(trim($_POST["desc"]))) {
        $desc_err = "Please enter description.";
    } else {
        $desc = trim($_POST["desc"]);
    }

    // Check input errors before updating the database
    if (empty($street_err) && empty($city_err) && empty($state_err) && empty($zip_err) && empty($size_err) && empty($office_count_err) && empty($room_count_err) && empty($p_code_err) && empty($fac_type_err) && empty($desc_err)) {
        // Prepare an update statement
        $sql = "UPDATE Facility SET Street=?, City=?, State=?, Zip=?, Size=?, Office_Count=?, Room_Count=?, P_Code=?, FacType=?, Desc=? WHERE FacID=?";

        if ($stmt = mysqli_prepare($con, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssiisssi", $param_street, $param_city, $param_state, $param_zip, $param_size, $param_office_count, $param_room_count, $param_p_code, $param_fac_type, $param_desc, $param_fac_id);

            // Set parameters
            $param_street = $street;
            $param_city = $city;
            $param_state = $state;
            $param_zip = $zip;
            $param_size = $size;
            $param_office_count = $office_count;
            $param_room_count = $room_count;
            $param_p_code = $p_code;
            $param_fac_type = $fac_type;
            $param_desc = $desc;
            $param_fac_id = $_GET['id']; // Assuming the ID is passed in the URL

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to facilities page after update
                header("location: facilities.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($con);
} else {
    // Fetch facility details based on ID from URL parameter
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Prepare a select statement
        $sql = "SELECT * FROM Facility WHERE FacID = ?";

        if ($stmt = mysqli_prepare($con, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_fac_id);

            // Set parameters
            $param_fac_id = trim($_GET["id"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    // Fetch result row as an associative array
                    $row = mysqli_fetch_assoc($result);

                    // Retrieve individual field values
                    $street = $row["Street"];
                    $city = $row["City"];
                    $state = $row["State"];
                    $zip = $row["Zip"];
                    $size = $row["Size"];
                    $office_count = $row["Office_Count"];
                    $room_count = $row["Room_Count"];
                    $p_code = $row["P_Code"];
                    $fac_type = $row["FacType"];
                    $desc = $row["Desc"];
                } else {
                    // Facility ID not found
                    header("location: error.php");
                    exit();
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);

        // Close connection
        mysqli_close($con);
    } else {
        // URL parameter ID not available
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Facility</title>
<style>
    body {
        font-family: Arial, sans-serif;
    }

    .container {
        max-width: 600px;
        margin: auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    h2 {
        text-align: center;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    textarea {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>

<div class="container">
    <h2>Edit Facility</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $_GET['id']; ?>" method="post">
        <label for="street">Street:</label>
        <input type="text" id="street" name="street" value="<?php echo htmlspecialchars($street); ?>">
        <span><?php echo $street_err; ?></span>

        <label for="city">City:</label>
        <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($city); ?>">
        <span><?php echo $city_err; ?></span>

        <label for="state">State:</label>
        <input type="text" id="state" name="state" value="<?php echo htmlspecialchars($state); ?>">
        <span><?php echo $state_err; ?></span>

        <label for="zip">Zip:</label>
        <input type="text" id="zip" name="zip" value="<?php echo htmlspecialchars($zip); ?>">
        <span><?php echo $zip_err; ?></span>

        <label for="size">Size:</label>
        <input type="text" id="size" name="size" value="<?php echo htmlspecialchars($size); ?>">
        <span><?php echo $size_err; ?></span>

        <label for="office_count">Office Count:</label>
        <input type="text" id="office_count" name="office_count" value="<?php echo htmlspecialchars($office_count); ?>">
        <span><?php echo $office_count_err; ?></span>

        <label for="room_count">Room Count:</label>
        <input type="text" id="room_count" name="room_count" value="<?php echo htmlspecialchars($room_count); ?>">
        <span><?php echo $room_count_err; ?></span>

        <label for="p_code">Postal Code:</label>
        <input type="text" id="p_code" name="p_code" value="<?php echo htmlspecialchars($p_code); ?>">
        <span><?php echo $p_code_err; ?></span>

        <label for="fac_type">Type:</label>
        <input type="text" id="fac_type" name="fac_type" value="<?php echo htmlspecialchars($fac_type); ?>">
        <span><?php echo $fac_type_err; ?></span>

        <label for="desc">Description:</label>
        <textarea id="desc" name="desc" rows="4"><?php echo htmlspecialchars($desc); ?></textarea>
        <span><?php echo $desc_err; ?></span>

        <input type="submit" value="Update">
        <button> <a href="medical_offices.php" style="margin-left: 20px;">Back</a> </button>
    </form>
</div>

</body>
</html>
