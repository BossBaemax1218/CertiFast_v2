function editPos(that){
    pos = $(that).attr('data-pos');
    order = $(that).attr('data-order');
    id = $(that).attr('data-id');

    $('#position').val(pos);
    $('#order').val(order);
    $('#pos_id').val(id);
}

function editChair(that){
    title = $(that).attr('data-title');
    id = $(that).attr('data-id');

    $('#chair').val(title);
    $('#chair_id').val(id);
}

function editPurok(that){
    purok = $(that).attr('data-name');
    total_residents = $(that).attr('data-res');
    total_households = $(that).attr('data-hh');
    id = $(that).attr('data-id');

    $('#purok').val(purok);
    $('#residents').val(total_residents);
    $('#households').val(total_households);
    $('#purok_id').val(id);
}

function editPrecinct(that){
    precinct = $(that).attr('data-precinct');
    details = $(that).attr('data-details');
    id = $(that).attr('data-id');

    $('#precinct').val(precinct);
    $('#details').val(details);
    $('#precinct_id').val(id);
}

function editOfficial(that){
    brgyid = $(that).attr('data-brgyid');
    id = $(that).attr('data-id');
    name = $(that).attr('data-name');
    pos = $(that).attr('data-pos');
    address = $(that).attr('data-add');
    start = $(that).attr('data-start');
    end = $(that).attr('data-end');
    status = $(that).attr('data-status');
    
    $('#barangay_id').val(brgyid);
    $('#off_id').val(id);
    $('#name').val(name);
    $('#position').val(pos);
    $('#address').val(address);
    $('#start').val(start);
    $('#end').val(end);
    $('#status').val(status);
}

function editResident(that){
    id          = $(that).attr('data-id');
    pic         = $(that).attr('data-img');
    nat_id 		= $(that).attr('data-national');
    fname 		= $(that).attr('data-fname');
	mname 		= $(that).attr('data-mname');
    lname 		= $(that).attr('data-lname');
	address 	= $(that).attr('data-address');
    bplace 	    = $(that).attr('data-bplace');
	bdate 		= $(that).attr('data-bdate');
    age 		= $(that).attr('data-age');
    cstatus 	= $(that).attr('data-cstatus');
	gender 	    = $(that).attr('data-gender');
    purok 		= $(that).attr('data-purok');
	vstatus 	= $(that).attr('data-vstatus');
    email 	    = $(that).attr('data-email');
	number 	    = $(that).attr('data-number');
    taxno 	    = $(that).attr('data-taxno');
    citi 	    = $(that).attr('data-citi');
    occu 	    = $(that).attr('data-occu');
    dead 	    = $(that).attr('data-dead');
    remarks 	= $(that).attr('data-remarks');
    purpose 	= $(that).attr('data-purpose');

    $('#res_id').val(id);
    $('#nat_id').val(nat_id);
    $('#fname').val(fname);
    $('#mname').val(mname);
    $('#lname').val(lname);
    $('#address').val(address);
    $('#bplace').val(bplace);
    $('#bdate').val(bdate);
    $('#age').val(age);
    $('#cstatus').val(cstatus);
    $('#gender').val(gender);
    $('#purok').val(purok);
    $('#vstatus').val(vstatus);
    $('#taxno').val(taxno);
    $('#email').val(email);
    $('#number').val(number);
    $('#occupation').val(occu);
    $('#citizenship').val(citi);
    $('#remarks').val(remarks);
    $('#purpose').val(purpose);

    if(dead==1){
        $("#alive").prop("checked", true);
    }else{
        $("#dead").prop("checked", true);
    }

    var str = pic;
    var n = str.includes("data:image");
    if(!n){
        pic = 'assets/uploads/resident_profile/'+pic;
    }
    $('#image').attr('src', pic);
}


function editBlotter1(that){
    id          = $(that).attr('data-id');
    complainant         = $(that).attr('data-complainant');
    respondent 		= $(that).attr('data-respondent');
	victim 		= $(that).attr('data-victim');
    type 		= $(that).attr('data-type');
	l 		= $(that).attr('data-l');
    date 	    = $(that).attr('data-date');
	time 		= $(that).attr('data-time');
    details 		= $(that).attr('data-details');
    status 	= $(that).attr('data-status');

    $('#blotter_id').val(id);
    $('#complainant').val(complainant);
    $('#respondent').val(respondent);
    $('#victim').val(victim);
    $('#type').val(type);
    $('#location').val(l);
    $('#date').val(date);
    $('#time').val(time);
    $('#details').val(details);
    $('#status').val(status);
}

$('.vstatus').change(function(){
    var val = $(this).val();
    if(val=='No'){
        $('.indetity').prop('disabled', 'disabled');
    }else{
        $('.indetity').prop('disabled', false);
    }
});

$(".toggle-password").click(function() {
  var input = $($(this).attr("toggle"));
  if (input.attr("type") === "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
  $(this).toggleClass("fa-eye fa-eye-slash");
});


Webcam.set({
    height: 250,
    image_format: 'jpeg',
    jpeg_quality: 90
});

$('#open_cam').click(function(){
    Webcam.attach( '#my_camera' );
});

function save_photo() {
    // actually snap photo (from preview freeze) and display it
    Webcam.snap( function(data_uri) {
        // display results in page
        document.getElementById('my_camera').innerHTML = 
        '<img src="'+data_uri+'"/>';
        document.getElementById('profileImage').innerHTML = 
        '<input type="hidden" name="profileimg" id="profileImage" value="'+data_uri+'"/>';
    } );
}

$('#open_cam1').click(function(){
    Webcam.attach( '#my_camera1' );
});

function save_photo1() {
    // actually snap photo (from preview freeze) and display it
    Webcam.snap( function(data_uri) {
        // display results in page
        document.getElementById('my_camera1').innerHTML = 
        '<img src="'+data_uri+'"/>';
        document.getElementById('profileImage1').innerHTML = 
        '<input type="hidden" name="profileimg" id="profileImage1" value="'+data_uri+'"/>';
    } );
}

function goBack() {
  window.history.go(-1);
}