<?php include 'server/server.php' ?>
<?php 
   include 'model/footer.php';
   $live_inid = $_GET['id'];
   $live_inquery = "SELECT * FROM tbllive_in AS c JOIN tblresident_requested AS r ON c.requirements = r.requirement WHERE c.live_id='$live_inid' AND c.cert_name = r.certificate_name AND c.email = r.email AND c.requester = r.resident_name";
   $live_inresult = $conn->query($live_inquery);
   $live_inReq = $live_inresult->fetch_assoc();

   $live_inQuery = "SELECT *, cert_id FROM tblresident_requested WHERE requirement = '{$live_inReq['requirements']}' AND certificate_name = '{$live_inReq['cert_name']}' AND email = '{$live_inReq['email']}' AND resident_name = '{$live_inReq['requester']}' AND status IN('on hold','approved')";
   $live_inResult = $conn->query($live_inQuery );
   $live_inCert = $live_inResult->fetch_assoc();
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
                                <label>Request ID no.</label>
                                <input type="text" class="form-control btn btn-light btn-dark disabled text-black" value="<?= ucwords($live_inCert['req_cert_id']) ?>">
                            </div>
                            <div class="form-group">
                                <label>Wife's Name</label>
                                <input type="text" class="form-control btn btn-light btn-dark disabled text-black" value="<?= ucwords($live_inReq['wife']) ?>">
                            </div>
                            <div class="form-group">
                                <label>Wife's Age</label>
                                <input type="text" class="form-control btn btn-light btn-dark disabled text-black" value="<?= ucwords($live_inReq['wife_age']) ?>">
                            </div>
                            <div class="form-group">
                                <label>Husband's Name</label>
                                <input type="text" class="form-control btn btn-light btn-dark disabled text-black" value="<?= ucwords($live_inReq['husband']) ?>">
                            </div>
                            <div class="form-group">
                                <label>Husband's Age</label>
                                <input type="text" class="form-control btn btn-light btn-dark disabled text-black" value="<?= ucwords($live_inReq['husband_age']) ?>">
                            </div>
                            <div class="form-group">
                                <label>Purok</label>
                                <input type="text" class="form-control btn btn-light btn-dark disabled text-black" value="<?= ucwords($live_inReq['purok']) ?>">
                            </div>
                            <div class="form-group">
                                <label>Live In</label>
                                <input type="text" class="form-control btn btn-light btn-dark disabled text-black" value="<?= ucwords($live_inReq['living_year']) ?>">
                            </div>
                            <div class="form-group">
                                <label>Reason</label>
                                <input type="text" class="form-control btn btn-light btn-dark disabled text-black" value="<?= ucwords($live_inReq['requirements']) ?>">
                            </div>
                            <div class="form-group">
                                <label>Certificate Name</label>
                                <input type="text" class="form-control btn btn-light btn-dark disabled text-black" value="<?= ucwords($live_inReq['cert_name']) ?>">
                            </div>
                            <div class="form-group">
                                <label>Requester Name</label>
                                <input type="text" class="form-control btn btn-light btn-dark disabled text-black" value="<?= ucwords($live_inReq['requester']) ?>">
                            </div>
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="text" class="form-control btn btn-light btn-dark disabled text-black" value="<?= $live_inReq['email'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Date Issued</label>
                                <input type="date" class="form-control btn btn-light btn-dark disabled text-black" value="<?= ucwords($live_inReq['date_applied']) ?>">
                            </div>
                            <div class="form-group">
                                <label>Update Status Request</label>
                                <select class="form-control text-black btn btn-outline-light" required name="status" id="status">
                                    <option value="on hold">On Hold</option>
                                    <option value="approved">Approved</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </div>                      
                        </div>
                    </div>
                    <div class="modal-footer mt-2 d-flex justify-content-center">
                        <input type="hidden" name="cert_id" id="cert_id" value="<?= $live_inCert['cert_id'] ?>">
                        <input type="hidden" name="req_cert_id" id="req_cert_id" value="<?= $live_inCert['req_cert_id'] ?>">
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
        if (localStorage.getItem('openlive_inModal') === 'true') {
            var editModal = document.getElementById("editModal");
            if (editModal) {
                $(editModal).modal('show');
            }
            localStorage.removeItem('openlive_inModal');
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