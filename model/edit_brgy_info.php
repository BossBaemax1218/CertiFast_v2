<?php
include '../server/server.php';

if (!isset($_SESSION['username'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $province   = $conn->real_escape_string($_POST['province']);
    $brgy       = $conn->real_escape_string($_POST['brgy']);
    $town       = $conn->real_escape_string($_POST['town']);
    $brgy_add   = $conn->real_escape_string($_POST['brgy_address']);
    $number     = $conn->real_escape_string($_POST['number']);
    $b_email    = $conn->real_escape_string($_POST['b_email']);

    if (!empty($_FILES['city_logo']['name']) || !empty($_FILES['brgy_logo']['name']) || !empty($_FILES['db_img']['name'])) {

        $newC = date('dmYHis') . str_replace(" ", "", $_FILES['city_logo']['name']);
        $newB = date('dmYHis') . str_replace(" ", "", $_FILES['brgy_logo']['name']);
        $newD = date('dmYHis') . str_replace(" ", "", $_FILES['db_img']['name']);

        $target  = "../assets/uploads/" . basename($newC);
        $target1 = "../assets/uploads/" . basename($newB);
        $target2 = "../assets/uploads/" . basename($newD);

        $query = "UPDATE tblbrgy_info 
                  SET province_name = '$province', town_name = '$town', brgy_address = '$brgy_add', brgy_name = '$brgy', contact_number = '$number', brgy_email = '$b_email'";

        if (!empty($_FILES['city_logo']['name'])) {
            $query .= ", city_logo = '$newC'";
        }

        if (!empty($_FILES['brgy_logo']['name'])) {
            $query .= ", brgy_logo = '$newB'";
        }

        if (!empty($_FILES['db_img']['name'])) {
            $query .= ", dashboardphoto = '$newD'";
        }

        $query .= " WHERE id = 1";

        if ($conn->query($query) === true) {
            $_SESSION['message'] = 'Barangay Info has been updated!';
            $_SESSION['success'] = 'success';

            if (!empty($_FILES['city_logo']['tmp_name'])) {
                move_uploaded_file($_FILES['city_logo']['tmp_name'], $target);
            }

            if (!empty($_FILES['brgy_logo']['tmp_name'])) {
                move_uploaded_file($_FILES['brgy_logo']['tmp_name'], $target1);
            }

            if (!empty($_FILES['db_img']['tmp_name'])) {
                move_uploaded_file($_FILES['db_img']['tmp_name'], $target2);
            }
        } else {
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }
    } else {
        $query = "UPDATE tblbrgy_info 
                  SET province_name = '$province', town_name = '$town', brgy_address = '$brgy_add', brgy_name = '$brgy', contact_number = '$number', brgy_email = '$b_email' 
                  WHERE id = 1";

        if ($conn->query($query) === true) {
            $_SESSION['message'] = 'Barangay Info has been updated!';
            $_SESSION['success'] = 'success';
        } else {
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }
    }
} else {
    $_SESSION['message'] = 'Please complete the form!';
    $_SESSION['success'] = 'danger';
}

if (isset($_SERVER["HTTP_REFERER"])) {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}

$conn->close();
