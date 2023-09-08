<?php
include('../server/server.php');

if (!isset($_SESSION['username'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = $_SESSION['username'];
    $name = $conn->real_escape_string($_POST['name']);
    $price = floatval($_POST['price']); 
    $date = $conn->real_escape_string($_POST['date']); 
    $details = $conn->real_escape_string($_POST['details']);
    $email = $conn->real_escape_string($_POST['email']);
    $req = $conn->real_escape_string($_POST['requirement']);
    $qty = intval($_POST['quantity']);

    $totalAmount = $price * $qty;

    if (!empty($user) && !empty($name) && is_numeric($price) && is_numeric($qty)) {
        $insert = "INSERT INTO tblpayments (`details`, `amounts`, `date`, `user`, `name`, `email`, `status`, `requirement`, `quantity`) VALUES ('$details', $totalAmount, '$date', '$user', '$name', '$email', 'paid', '$req', $qty)";
        $result = $conn->query($insert);

        if ($result === true) {
            $updateClaimed = "UPDATE tblresident_requested SET `status` = 'claimed' WHERE email='$email' AND requirement ='$req' LIMIT 1";
            $resultUpdate = $conn->query($updateClaimed);

            if ($resultUpdate === true) {
                $_SESSION['message'] = 'Payment has been saved and request status set to claimed!';
                $_SESSION['success'] = 'success';
            } else {
                $_SESSION['message'] = 'Payment has been saved, but there was an issue setting the request status!';
                $_SESSION['success'] = 'warning';
            }

            if (isset($_SERVER["HTTP_REFERER"])) {
                header("Location: " . $_SERVER["HTTP_REFERER"] . '&closeModal');
            }
        } else {
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';

            if (isset($_SERVER["HTTP_REFERER"])) {
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            }
        }
    } else {
        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';

        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
}

$conn->close();
?>
