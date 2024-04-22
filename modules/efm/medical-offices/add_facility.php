<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Facility</title>
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
    <h2>Add Facility</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="street">Street:</label>
        <input type="text" id="street" name="street" required>

        <label for="city">City:</label>
        <input type="text" id="city" name="city" required>

        <label for="state">State:</label>
        <input type="text" id="state" name="state" required>

        <label for="zip">Zip:</label>
        <input type="text" id="zip" name="zip" required>

        <label for="size">Size:</label>
        <input type="text" id="size" name="size" required>

        <label for="office_count">Office Count:</label>
        <input type="text" id="office_count" name="office_count" required>

        <label for="room_count">Room Count:</label>
        <input type="text" id="room_count" name="room_count" required>

        <label for="p_code">Postal Code:</label>
        <input type="text" id="p_code" name="p_code" required>

        <label for="fac_type">Type:</label>
        <input type="text" id="fac_type" name="fac_type" required>

        <label for="desc">Description:</label>
        <textarea id="desc" name="desc" rows="4" required></textarea>

        <input type="submit" value="Submit">
        <button> <a href="medical_offices.php" style="margin-left: 10px;">Back</a> </button>
    </form>
    
</div>

</body>
</html>
