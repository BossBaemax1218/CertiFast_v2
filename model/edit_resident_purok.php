<?php
session_start();
include '../server/server.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $conn->real_escape_string($_POST['id']);
    $rstatus = $conn->real_escape_string($_POST['rstatus']);

    if (!empty($id) && !empty($rstatus)) {
        $validStatuses = array('approved', 'rejected', 'on hold');
        if (in_array($rstatus, $validStatuses)) {
            $query = "UPDATE tblresident SET residency_status=? WHERE id=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("si", $rstatus, $id);

            if ($stmt->execute()) {
                $_SESSION['message'] = 'Status has been updated!';
                $_SESSION['success'] = 'success';

                if ($rstatus === 'approved') {
                    $purok_result = $conn->query("SELECT * FROM tblresident WHERE id = $id");
                    $row = $purok_result->fetch_assoc();
                    $national_id = $conn->real_escape_string($row['national_id']);
                    $citizen = $conn->real_escape_string($row['citizenship']);
                    $fname = $conn->real_escape_string($row['firstname']);
                    $mname = $conn->real_escape_string($row['middlename']);
                    $lname = $conn->real_escape_string($row['lastname']);
                    $address = $conn->real_escape_string($row['address']);
                    $bplace = $conn->real_escape_string($row['birthplace']);
                    $bdate = $conn->real_escape_string($row['birthdate']);
                    $age = $conn->real_escape_string($row['age']);
                    $cstatus = $conn->real_escape_string($row['civilstatus']);
                    $gender = $conn->real_escape_string($row['gender']);
                    $purok = $conn->real_escape_string($row['purok']);
                    $vstatus = $conn->real_escape_string($row['voterstatus']);
                    $email = $conn->real_escape_string($row['email']);
                    $taxno = $conn->real_escape_string($row['taxno']);
                    $number = $conn->real_escape_string($row['phone']);
                    $occupation = $conn->real_escape_string($row['occupation']);
                    $res_status = $conn->real_escape_string($row['residency_status']);
                    $profile = $conn->real_escape_string($row['profileimg']);
                    $profile2 = $_FILES['img']['name'];

                    $newName = date('dmYHis') . str_replace(" ", "", $profile2);
                    $target = "../assets/uploads/resident_profile/" . basename($newName);
                    $insertQuery = "UPDATE tblpurok_records SET national_id='$national_id',citizenship='$citi',`firstname`='$fname', `middlename`='$mname', `lastname`='$lname', `address`='$address', `birthplace`='$bplace', `birthdate`='$bdate', 
                    age=$age, `civilstatus`='$cstatus', `gender`='$gender', `purok`='$purok', `voterstatus`='$vstatus', `taxno`='$taxno', `phone`='$number', `email`='$email',`occupation`='$occu', `resident_type`='$deceased'
                    WHERE id=$id;";

                    if ($conn->query($insertQuery) === TRUE) {
                        move_uploaded_file($_FILES['img']['tmp_name'], $target);

                        $_SESSION['message'] = 'Resident information has been confirmed and inserted successfully!';
                        $_SESSION['success'] = 'success';
                    } else {
                        $_SESSION['message'] = 'Error: ' . $conn->error;
                        $_SESSION['success'] = 'danger';
                    }
                } elseif ($rstatus === 'rejected') {
                    header("Location: ../purok_request.php");
                    exit();
                }
            } else {
                $_SESSION['message'] = 'Error updating status: ' . $conn->error;
                $_SESSION['success'] = 'danger';
            }
            $stmt->close();
        } else {
            $_SESSION['message'] = 'Invalid residency status provided.';
            $_SESSION['success'] = 'danger';
        }
    } else {
        $_SESSION['message'] = 'Please provide both ID and residency status.';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../purok_request.php");
    exit();
}
