<?php
include('../server/server.php');

if (!isset($_SESSION['username'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

function validateImageFormat($filePath) {
    // Create a new finfo object
    $finfo = new finfo(FILEINFO_MIME_TYPE);

    // Get the MIME type of the file
    $mimeType = $finfo->file($filePath);

    // Check if the MIME type corresponds to an image
    if (strpos($mimeType, 'image/') === 0) {
        // Valid image file format
        return true;
    } else {
        // Invalid image file format
        return false;
    }
}

$name = $conn->real_escape_string($_POST['fullname']);
$pos = $conn->real_escape_string($_POST['position']);
$start = $conn->real_escape_string($_POST['start']);
$end = $conn->real_escape_string($_POST['end']);
$status = $conn->real_escape_string($_POST['status']);
$profile = $conn->real_escape_string($_POST['profile-image']); // base 64 image
$profile2 = $_FILES['img']['name'];
// change profile2 name
$newName = date('dmYHis').str_replace(" ", "", $profile2);

// image file directory
$target = "../assets/uploads/officials/".basename($newName);

if (!empty($name) && !empty($pos) && !empty($start) && !empty($end) && !empty($status)) {

    $query = "SELECT * FROM tblofficials WHERE fullname='$name'";
    $res = $conn->query($query);

    if ($res->num_rows) {
        $_SESSION['message'] = 'Please enter your real name!';
        $_SESSION['success'] = 'danger';
    } else {
        if (!empty($profile) && !empty($profile2)) {
            // Check if the base64 image starts with "data:image"
            if (strpos($profile, 'data:image') === 0) {
                // Generate a temporary file path
                $tempFilePath = tempnam(sys_get_temp_dir(), 'image');

                // Decode the base64 image and save it to the temporary file
                file_put_contents($tempFilePath, base64_decode(substr($profile, strpos($profile, ',') + 1)));

                // Validate the image file format
                if (!validateImageFormat($tempFilePath)) {
                    $_SESSION['message'] = 'Invalid image file format!';
                    $_SESSION['success'] = 'danger';
                    header("Location: ../officials.php");
                    exit();
                }

                // Move the temporary file to the target directory
                $moved = move_uploaded_file($tempFilePath, $target);
            } else {
                $_SESSION['message'] = 'Invalid image file format!';
                $_SESSION['success'] = 'danger';
                header("Location: ../officials.php");
                exit();
            }

            // ...
        } else if (!empty($profile) && empty($profile2)) {
            // Check if the base64 image starts with "data:image"
            if (strpos($profile, 'data:image') === 0) {
                // Generate a temporary file path
                $tempFilePath = tempnam(sys_get_temp_dir(), 'image');

                // Decode the base64 image and save it to the temporary file
                file_put_contents($tempFilePath, base64_decode(substr($profile, strpos($profile, ',') + 1)));

                // Validate the image file format
                if (!validateImageFormat($tempFilePath)) {
                    $_SESSION['message'] = 'Invalid image file format!';
                    $_SESSION['success'] = 'danger';
                    header("Location: ../officials.php");
                    exit();
                }

                // Move the temporary file to the target directory
                $moved = move_uploaded_file($tempFilePath, $target);
            } else {
                $_SESSION['message'] = 'Invalid image file format!';
                $_SESSION['success'] = 'danger';
                header("Location: ../officials.php");
                exit();
            }

            // ...
        } else if (empty($profile) && !empty($profile2)) {
            // Validate the image file format
            if (!validateImageFormat($_FILES['img']['tmp_name'])) {
                $_SESSION['message'] = 'Invalid image file format!';
                $_SESSION['success'] = 'danger';
                header("Location: ../officials.php");
                exit();
            }

            $moved = move_uploaded_file($_FILES['img']['tmp_name'], $target);

            // ...
        } else {
            $insert = "INSERT INTO tblofficials (`fullname`, `position`, `photo`, `termstart`, `termend`, `status`) VALUES ('$name', '$pos', 'person.png', '$start', '$end', '$status')";
            $result = $conn->query($insert);

            // ...
        }
    }
} else {
    $_SESSION['message'] = 'Please fill up the form completely!';
    $_SESSION['success'] = 'danger';
}

header("Location: ../officials.php");

$conn->close();
?>
