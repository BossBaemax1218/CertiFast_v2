<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $agree = $_POST['agree'];
    if (empty($agree)) {
        echo "Error: Value cannot be empty.";
        exit;
    }

    $agree = filter_var($agree, FILTER_SANITIZE_STRING);
    include 'server/server.php';
    $stmt = $conn->prepare("INSERT INTO tbl_termpolicy (agree) VALUES (?)");

    $stmt->bind_param("s", $agree);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: login.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
    echo '<script type="text/javascript">
        $("#termprivacy").modal("hide");
    </script>';
}
?>
