<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the values from the form
    $agree = $_POST['agree'];

    // Validate and sanitize the inputs
    if (empty($agree)) {
        echo "Error: Value cannot be empty.";
        exit;
    }

    // Sanitize the inputs
    $agree = filter_var($agree, FILTER_SANITIZE_STRING);

    // Include the server.php file for the database connection
    include 'server/server.php';

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO tbl_termpolicy (agree) VALUES (?)");

    // Bind the parameters
    $stmt->bind_param("s", $agree);

    // Execute the statement
    if ($stmt->execute()) {
        // Close the statement
        $stmt->close();

        // Close the connection
        $conn->close();

        // Redirect to the login page after saving the data
        header("Location: login.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();

    // Close the connection
    $conn->close();

    // Close the modal after saving the data
    echo '<script type="text/javascript">
        $("#termprivacy").modal("hide");
    </script>';
}
?>
