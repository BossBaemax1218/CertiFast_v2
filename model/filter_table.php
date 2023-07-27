<?php
if (isset($_POST['certType'])) {
    // Retrieve the selected certificate type and authorize status from the form data
    $selectedCertType = $_POST['certType'];
    $selectedAuthorizeStatus = $_POST['authorize_status'];

    // Perform filtering based on the selected values
    // You can update your SQL query or filtering logic here to fetch the filtered data

    // Example: Fetch filtered data from the database
    $filteredData = fetchDataFromDatabase($selectedCertType, $selectedAuthorizeStatus);
}
?>

<div class="card-body">
    <div class="table-responsive">
        <table id="residenttable" class="table">
            <thead>
                <tr>
                    <th scope="col">Fullname</th>
                    <th scope="col">Birthdate</th>
                    <th scope="col">Age</th>
                    <th scope="col">Civil Status</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Purok</th>
                    <?php if (isset($_SESSION['username'])) : ?>
                        <?php if ($_SESSION['role'] == 'administrator') : ?>
                    <?php endif ?>
                    <th class="text-center" scope="col">Action</th>
                    <?php endif ?>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($filteredData)): ?>
                <?php $no = 1; foreach ($filteredData as $row): ?>
                        <tr>
                            <td>
                                <div class="avatar avatar-xs">
                                    <img src="<?= preg_match('/data:image/i', $row['picture']) ? $row['picture'] : 'assets/uploads/resident_profile/' . $row['picture'] ?>" alt="Resident Profile" class="avatar-img rounded-circle">
                                </div>
                                <?= ucwords($row['lastname'] . ', ' . $row['firstname'] . ' ' . $row['middlename']) ?>
                            </td>
                            <td><?= $row['birthdate'] ?></td>
                            <td><?= $row['age'] ?></td>
                            <td><?= $row['civilstatus'] ?></td>
                            <td><?= $row['gender'] ?></td>
                            <td><?= $row['purok'] ?></td>
                            <?php if (isset($_SESSION['username'])) : ?>
                                <?php if ($_SESSION['role'] == 'administrator') : ?>
                            <?php endif ?>
                            <td class="text-center">
                                <div class="form-button-action">
                                    <?php
                                    $selectedCertificate = 'list_certificates.php?id=' . $row['id'];
                                    if (isset($_POST['certType'])) {
                                        switch ($_POST['certType']) {
                                            case 'Barangay Clearance':
                                                $selectedCertificate = 'generate_brgy_cert.php';
                                                break;
                                            case 'Certificate of Residency':
                                                $selectedCertificate = 'generate_residency_cert.php';
                                                break;
                                            case 'Certificate of Indigency':
                                                $selectedCertificate = 'generate_indi_cert.php';
                                                break;
                                            case 'Business Permit':
                                                $selectedCertificate = 'generate_business_permit.php';
                                                break;
                                            // Add more cases for other certificate types if needed
                                            default:
                                                // Handle the default case if necessary, such as redirecting to a general page or showing an error message.
                                                break;
                                        }
                                    }
                                    ?>
                                    <a type="button" data-toggle="tooltip" href="<?= $selectedCertificate ?>" data-id="<?= $row['id'] ?>" class="btn btn-link btn-primary generate-certificate-btn" data-original-title="Generate Certificate">
                                        <i class="fas fa-print"></i>
                                    </a>
                                </div>
                            </td>
                            <?php endif ?>
                        </tr>
                    <?php $no++;
                    endforeach ?>
                <?php endif ?>
            </tbody>
        </table>
    </div>
    </div>