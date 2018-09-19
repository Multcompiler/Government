<script>

    if ($("#mydiv").hasClass("success_register")) {
        swal("Success!", "User Successful Registered.", "success");
    }
    else if($("#mydiv").hasClass("wait_confirm")) {
        swal("Fail!", "Wait For Admin Approval.", "error");
    }
    else if($("#mydiv").hasClass("school_info_updated")) {
        swal("Success!", "School  Information Successful Updated.", "success");
    }else if($("#mydiv").hasClass("profile_info_added")) {
        swal("Success!", "Profile  Information Successful Updated.", "success");
    }else if($("#mydiv").hasClass("success_teacher_deleted")) {
        swal("Success!", "Teacher Information Successful Deleted.", "success");
    }else if($("#mydiv").hasClass("success_user_deleted")) {
        swal("Success!", "User Information Successful Deleted.", "success");
    }else if($("#mydiv").hasClass("success_school_deleted")) {
        swal("Success!", "School Information Successful Deleted.", "success");
    }else if($("#mydiv").hasClass("success_teacher_added")) {
        swal("Success!", "Teacher Information Successful Added.", "success");
    }else if($("#mydiv").hasClass("success_requirement_added")) {
        swal("Success!", "Requirement Information Successful Added.", "success");
    }else if($("#mydiv").hasClass("success_user_update")) {
        swal("Success!", "User Information Successful Updated.", "success");
    }else if($("#mydiv").hasClass("submit_school")) {
        swal("Success!", "School Successful Registed.", "success");
    }else if($("#mydiv").hasClass("head_accept")) {
        swal("Success!", "Access Successfully Changed", "success");
    }else if($("#mydiv").hasClass("user_imported")) {
        swal("Success!", "Users Successfully Imported", "success");
    }else if($("#mydiv").hasClass("user_added")) {
        swal("Success!", "New User Successfully Added", "success");
    }else if($("#mydiv").hasClass("head_exist")) {
        swal("Fail!", "Information Already Exists", "error");
    }else if($("#mydiv").hasClass("user_exist")) {
        swal("Fail!", "User Already Exists", "error");
    }else if($("#mydiv").hasClass("head_assigned")) {
        swal("Success!", "HeadMaster  Assigned Successful","success");
    }else if($("#mydiv").hasClass("delete_head")) {
        swal("Success!", "HeadMaster  Assigned Successful","success");
    }else if($("#mydiv").hasClass("head_deleted")) {
        swal("Success!", "HeadMaster  Information Successful Deleted","success");
    }

   // swal("Cancelled", "Your imaginary file is safe :)", "error");

</script>