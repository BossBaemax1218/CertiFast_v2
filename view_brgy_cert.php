<?php include 'server/server.php' ?>
<?php 
   include 'model/footer.php';
   $cleid = $_GET['id'];
   $clequery = "SELECT c.* FROM tblclearance AS c JOIN tblresident_requested AS r ON c.requirement = r.requirement WHERE c.c_id='$cleid' AND c.cert_name = r.certificate_name AND c.email = r.email";
   $cleresult = $conn->query($clequery);
   $cleresident = $cleresult->fetch_assoc();

   $clecertIdQuery = "SELECT *, cert_id FROM tblresident_requested WHERE requirement = '{$cleresident['requirement']}' AND certificate_name = '{$cleresident['cert_name']}'";
   $clecertIdResult = $conn->query($clecertIdQuery);
   $clerequestedCert = $clecertIdResult->fetch_assoc();
?>
<?php include 'list_certificates.php' ?>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Request Information</h5>
                <a href="list_certificates.php" type="button" class="text-black fw-bold" aria-label="Close" style="text-decoration: none;">
                    <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                </a>
            </div>
            <div class="modal-body">
                <form method="POST" action="model/edit_cert_status.php" enctype="multipart/form-data">
                    <input type="hidden" name="size" value="1000000">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Certificate ID no.</label>
                                <input type="text" class="form-control btn btn-light btn-dark disabled text-black" value="<?= ucwords($clerequestedCert['req_cert_id']) ?>">
                            </div>
                            <div class="form-group">
                                <label>Certificate Name</label>
                                <input type="text" class="form-control btn btn-light btn-dark disabled text-black" value="<?= ucwords($cleresident['cert_name']) ?>">
                            </div>
                            <div class="form-group">
                                <label>Requester Name</label>
                                <input type="text" class="form-control btn btn-light btn-dark disabled text-black" value="<?= ucwords($cleresident['fullname']) ?>">
                            </div>
                            <div class="form-group">
                                <label>Tax no.</label>
                                <input type="text" class="form-control btn btn-light btn-dark disabled text-black" value="<?= ucwords($cleresident['taxno']) ?>">
                            </div>
                            <div class="form-group">
                                <label>Purok</label>
                                <input type="text" class="form-control btn btn-light btn-dark disabled text-black" value="<?= ucwords($cleresident['purok']) ?>">
                            </div>
                            <div class="form-group">
                                <label>Reasons</label>
                                <input type="text" class="form-control btn btn-light btn-dark disabled text-black" value="<?= ucwords($cleresident['requirement']) ?>">
                            </div>
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="text" class="form-control btn btn-light btn-dark disabled text-black" value="<?= $cleresident['email'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Date Issued</label>
                                <input type="date" class="form-control btn btn-light btn-dark disabled text-black" value="<?= ucwords($cleresident['date_applied']) ?>">
                            </div>
                            <div class="form-group">
                                <label>Update Status Certificate</label>
                                <select class="form-control text-black btn btn-outline-light" required name="status" id="status">
                                    <option value="on hold">On Hold</option>
                                    <option value="approved">Approved</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </div>                      
                        </div>
                    </div>
                    <div class="modal-footer mt-2 d-flex justify-content-center">
                        <input type="hidden" name="cert_id" id="cert_id" value="<?= $clerequestedCert['cert_id'] ?>">
                        <a href="list_certificates.php" type="submit" class="btn btn-danger" style="text-decoration: none;">Close</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php if(!isset($_GET['closeModal'])){ ?>
    <script>
        setTimeout(function(){ openModal(); }, 1000);
    </script>
<?php } ?>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        if (localStorage.getItem('openCleCertModal') === 'true') {
            var editModal = document.getElementById("editModal");
            if (editModal) {
                $(editModal).modal('show');
            }
            localStorage.removeItem('openCleCertModal');
        }
    });
</script>
<script>
function editStatus(that){
    cert_id          = $(that).attr('data-cert_id');
    status     = $(that).data('data-status');

    $('#cert_id').val(cert_id);
    $('#status').val(status);
}
</script>