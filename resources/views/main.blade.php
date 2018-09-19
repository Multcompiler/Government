<!DOCTYPE html>
<html lang="en">

<head>

    @include('partials._title')
    @include('partials._styles')

</head>

<body class="fix-header">
<!-- ============================================================== -->
<!-- Preloader -->
<!-- ============================================================== -->
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
    </svg>
</div>
<!-- ============================================================== -->
<!-- Wrapper -->
<!-- ============================================================== -->
<div id="wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
@include('partials._top_nav')
<!-- End Top Navigation -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
@include('partials._side_nav')
<!-- ============================================================== -->
    <!-- End Left Sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page Content -->
    <!-- ============================================================== -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-xs-9">
                    <h4 class="page-title">Government Requirement Collection</h4></div>
                <div class="col-xs-3">
                    <button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20"><i
                                class="ti-settings text-white"></i></button>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <!-- ============================================================== -->
            <!-- Different data widgets -->
            <!-- ============================================================== -->
            <!-- .row -->
            @yield('content')

        </div>
        <!-- /.container-fluid -->
        <footer class="footer text-center"> 2018 &copy; All Right Reserved</footer>
    </div>
    <!-- ============================================================== -->
    <!-- End Page Content -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
{{Html::script('bower_components/jquery/dist/jquery.min.js')}}

{{Html::script('bootstrap/dist/js/bootstrap.min.js')}}
{{Html::script('bower_components/sidebar-nav/dist/sidebar-nav.min.js')}}
{{Html::script('js/jquery.slimscroll.js')}}
{{Html::script('js/waves.js')}}
{{Html::script('bower_components/waypoints/lib/jquery.waypoints.js')}}
{{Html::script('bower_components/counterup/jquery.counterup.min.js')}}
{{Html::script('bower_components/chartist-js/dist/chartist.min.js')}}
{{Html::script('bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js')}}
{{Html::script('bower_components/jquery-sparkline/jquery.sparkline.min.js')}}
{{Html::script('js/custom.min.js')}}
{{Html::script('js/jasny-bootstrap.js')}}
{{Html::script('js/dashboard1.js')}}
{{Html::script('bower_components/toast-master/js/jquery.toast.js')}}
{{Html::script('plugins/bower_components/styleswitcher/jQuery.style.switcher.js')}}
{{Html::script('bower_components/datatables/jquery.dataTables.min.js')}}

<!-- Sweet-Alert  -->
{{Html::script('bower_components/sweetalert/sweetalert.min.js')}}
{{Html::script('bower_components/sweetalert/jquery.sweet-alert.custom.js')}}
{{Html::script('bower_components/register-steps/jquery.easing.min.js')}}
{{Html::script('bower_components/register-steps/register-init.js')}}



{{Html::script('plugins/bower_components/custom-select/custom-select.min.js')}}
{{Html::script('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')}}
{{Html::script('plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}
{{Html::script('plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js')}}
{{Html::script('plugins/bower_components/multiselect/js/jquery.multi-select.js')}}


<script>
    var count_var=1;
        $("#add_school").click(function() {
            var lastField1 = $("#buildyourform1 div:last");
            var intId = (lastField1 && lastField1.length && lastField1.data("idx") + 1) || 1;
            var fieldWrapper1 = $("<div class=\"fieldwrapper\" id=\"field" + intId + "\"/>");
            fieldWrapper1.data("idx", intId);
            var div_var = count_var + 1;

            var body_text1 = $('<div class="row">'+
                '<div class="col-md-12">'+
                '<div class="row">'+
                '<div class="form-group col-md-6">'+
                '<label for="exampleInputphone">Class</label>'+
                    '<span id="class_append1'+div_var +'"></span>'+
            '</div>'+
            '<div class="form-group col-md-6">'+
                '<label for="exampleInputphone">User Category</label>'+
                '<span id="category_append1'+div_var+'"></span>'+
                '</div>'+
                '</div>'+
                '<div class="row">'+
            '<div class="form-group col-md-6">'+
                '<label for="exampleInputuname">Male Total</label>'+
            '<div class="input-group">'+
                '<div class="input-group-addon"><i class="ti-user"></i></div>'+
                '<input type="text" name="male_total[]" class="form-control" id="exampleInputuname"'+
           ' placeholder="Male Total" required>'+
           ' </div>'+
            '</div>'+
            '<div class="form-group col-md-6">'+
              '  <label for="exampleInputuname">Female Total</label>'+
           ' <div class="input-group">'+
                '<div class="input-group-addon"><i class="ti-user"></i></div>'+
               ' <input type="text" name="female_total[]" class="form-control" id="exampleInputuname"'+
            'placeholder="Female Total" required>'+
          '  </div>'+
           ' </div>'+
            '</div>'+
            '</div>');

            var removeButton1 = $("<div class=\"col-md-2\"><input type=\"button\" class=\"btn btn-primary remove\" value=\"Remove\" style=\"margin-top: 5px;\"/> </div></div></div>");

            $.ajax({
                url: "{{ url('/Class/Select/Data')}}",
                dataType: 'json',
                success: function (data) {
                    var html_data = '';
                    html_data += '<select class="form-control" name="kidato_id[]" required>'+
                        '<option value=""> -- Select Class -- </option>';
                    for (var i = 0; i < data.length; i++) {
                        html_data += '<option value="' + data[i].id + '"> ' + data[i].class_name + ' </option>';
                    }
                    html_data += '</select>';
                    document.getElementById('class_append1'+count_var).innerHTML = html_data;
                },
                error: function (data) {
                }
            });

            $.ajax({
                url: "{{ url('/Category/Select/Data')}}",
                dataType: 'json',
                success: function (data3) {
                    var html_data3 = '';
                    html_data3 += '<select class="form-control" name="requirement_category_id[]" required>'+
                        '<option value=""> -- Select Category -- </option>';
                    for (var i = 0; i < data3.length; i++) {
                        html_data3 += '<option value="' + data3[i].id + '"> ' + data3[i].user_category + ' </option>';
                    }
                    html_data3 += '</select>';
                    document.getElementById('category_append1'+count_var).innerHTML = html_data3;
                },
                error: function (data2) {
                }
            });
           removeButton1.click(function() {
                $(this).parent().remove();
                if ($('.fieldwrapper').length == 0) {
                    $("#result1").hide();
                }
            });
            fieldWrapper1.append(body_text1);
            fieldWrapper1.append(removeButton1);
            $("#buildyourform1").append(fieldWrapper1);


            if ($('.fieldwrapper').length > 0) {
                $("#result11").show();
                if ($('.sub_button1').length > 0) {
                    //
                }
                else{
                    var sub = $( "<button type='submit' class='sub_button1 btn btn-primary btn-block' style='margin: 5px;'>Upload</button>");
                    $("#result11").append(sub);
                }
            }
            count_var++;
        });
</script>
<script>
    var count_var=1;
    $("#add_requirement").click(function() {
        var lastField = $("#buildyourform div:last");
        var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1;
        var fieldWrapper = $("<div class=\"fieldwrapper\" id=\"field" + intId + "\"/>");
        fieldWrapper.data("idx", intId);
        var div_var = count_var + 1;

        var body_text = $('<div class="row">'+
            '<div class="col-md-12">'+
            '<div class="row">'+
            '<div class="form-group col-md-6">'+
            '<label for="exampleInputphone">Class</label>'+
            '<span id="class_append'+div_var +'"></span>'+
            '</div>'+
            '<div class="form-group col-md-6">'+
            '<label for="exampleInputphone">Requirement Category</label>'+
            '<span id="category_append'+div_var+'"></span>'+
            '</div>'+
            '</div>'+
            '<div class="row">'+
            '<div class="form-group col-md-4">'+
            '<label for="exampleInputuname">Category Name</label>'+
            '<div class="input-group">'+
            '<div class="input-group-addon"><i class="ti-user"></i></div>'+
            '<input type="text" name="category_name[]" class="form-control" id="exampleInputuname"'+
            'placeholder="Category Name" required>'+
            '</div>'+
            '</div>'+
            '<div class="form-group col-md-4">'+
            '<label for="exampleInputuname">Amount Available</label>'+
            '<div class="input-group">'+
            '<div class="input-group-addon"><i class="ti-user"></i></div>'+
            '<input type="text" name="amount_available[]" class="form-control" id="exampleInputuname"'+
            ' placeholder="Amount Available" required>'+
            ' </div>'+
            '</div>'+
            '<div class="form-group col-md-4">'+
            '  <label for="exampleInputuname">Amount Needed</label>'+
            ' <div class="input-group">'+
            '<div class="input-group-addon"><i class="ti-user"></i></div>'+
            ' <input type="text" name="amount_needed[]" class="form-control" id="exampleInputuname"'+
            'placeholder="Amount Needed" required>'+
            '  </div>'+
            ' </div>'+
            '</div>'+
            '</div>');

        var removeButton = $("<div class=\"col-md-2\"><input type=\"button\" class=\"btn btn-primary remove\" value=\"Remove\" style=\"margin-top: 5px;\"/> </div></div></div>");

        $.ajax({
            url: "{{ url('/Class/Select')}}",
            dataType: 'json',
            success: function (data) {
                var html_data = '';
                html_data += '<select class="form-control" name="kidato_id[]" required>'+
                    '<option value=""> -- Select Class -- </option>';
                for (var i = 0; i < data.length; i++) {
                    html_data += '<option value="' + data[i].id + '"> ' + data[i].class_name + ' </option>';
                }
                html_data += '</select>';
                document.getElementById('class_append'+count_var).innerHTML = html_data;
            },
            error: function (data) {
            }
        });

        $.ajax({
            url: "{{ url('/Category/Select')}}",
            dataType: 'json',
            success: function (data2) {
                var html_data2 = '';
                html_data2 += '<select class="form-control" name="requirement_category_id[]" required>'+
                    '<option value=""> -- Select Category -- </option>';
                for (var i = 0; i < data2.length; i++) {
                    html_data2 += '<option value="' + data2[i].id + '"> ' + data2[i].category_name + ' </option>';
                }
                html_data2 += '</select>';
                document.getElementById('category_append'+count_var).innerHTML = html_data2;
            },
            error: function (data2) {
            }
        });
        removeButton.click(function() {
            $(this).parent().remove();
            if ($('.fieldwrapper').length == 0) {
                $("#result1").hide();
            }
        });
        fieldWrapper.append(body_text);
        fieldWrapper.append(removeButton);
        $("#buildyourform").append(fieldWrapper);


        if ($('.fieldwrapper').length > 0) {
            $("#result1").show();
            if ($('.sub_button').length > 0) {
                //
            }
            else{

                var sub = $( "<button type='submit' class='sub_button btn btn-primary btn-block' style='margin: 5px;'>Upload</button>");
                $("#result1").append(sub);
            }
        }
        count_var++;
    });
</script>




<script>
    jQuery(document).ready(function() {
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
        });
        // For select 2
        $(".select2").select2();
        $(".select3").select2();
        $('.selectpicker').selectpicker();
        //Bootstrap-TouchSpin
        $(".vertical-spin").TouchSpin({
            verticalbuttons: true,
            verticalupclass: 'ti-plus',
            verticaldownclass: 'ti-minus'
        });
        var vspinTrue = $(".vertical-spin").TouchSpin({
            verticalbuttons: true
        });
        if (vspinTrue) {
            $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
        }
        $("input[name='tch1']").TouchSpin({
            min: 0,
            max: 100,
            step: 0.1,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            postfix: '%'
        });
        $("input[name='tch2']").TouchSpin({
            min: -1000000000,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            prefix: '$'
        });
        $("input[name='tch3']").TouchSpin();
        $("input[name='tch3_22']").TouchSpin({
            initval: 40
        });
        $("input[name='tch5']").TouchSpin({
            prefix: "pre",
            postfix: "post"
        });
        // For multiselect
        $('#pre-selected-options').multiSelect();
        $('#optgroup').multiSelect({
            selectableOptgroup: true
        });
        $('#public-methods').multiSelect();
        $('#select-all').click(function() {
            $('#public-methods').multiSelect('select_all');
            return false;
        });
        $('#deselect-all').click(function() {
            $('#public-methods').multiSelect('deselect_all');
            return false;
        });
        $('#refresh').on('click', function() {
            $('#public-methods').multiSelect('refresh');
            return false;
        });
        $('#add-option').on('click', function() {
            $('#public-methods').multiSelect('addOption', {
                value: 42,
                text: 'test 42',
                index: 0
            });
            return false;
        });

    });
</script>
<script>
    $(document).ready(function ($) {
        $('#role_check').on('change', function (e) {
            var role_var = $(this).val();
            if (role_var != "") {
                $.ajax({
                    url: "{{ url('/Users/All/View/').'/' }}"+role_var,
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        $('#myTable tr').not(':first').remove();
                        var html = '';
                        for(var i = 0; i < data.length; i++){
                            html += '<tr>'+
                                '<td>' + data[i].firstname + '</td>' +
                                '<td>' + data[i].lastname + '</td>' +
                                '<td>' + data[i].gender + '</td>' +
                                '<td>' + data[i].email + '</td>' +
                                '<td>' + data[i].phone + '</td>' +
                                '<td>' + data[i].status + '</td>' +
                                '<td>'+
                                '<button class="btn btn-instagram waves-effect btn-circle waves-light" type="button"'+
                                'data-toggle="modal" data-target="#exampleModall'+data[i].id+'">'+
                                '<i class="ti-pencil-alt"></i>'+
                                ' </button>'+
                                '<button class="btn btn-pinterest waves-effect btn-circle waves-light" type="button" data-toggle="modal" data-target="#exampleModal'+data[i].id+'"><i class="icon-trash"></i></button>' +
                                '</td>' +
                                '</tr>';
                        }
                        $('#myTable tr').first().after(html);
                    },
                    error: function (data) {
                    }
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
        });
    });
    $('#example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
</script><script>
    function myFunctionForm() {
            $("#import-add").addClass("hide");
            $("#import-add").removeClass("show");
            $("#form-add").addClass("show");
            $("#form-add").removeClass("hide");

    }
    function myFunctionImport() {

            $("#form-add").addClass("hide");
            $("#form-add").removeClass("show");
            $("#import-add").addClass("show");
            $("#import-add").removeClass("hide");

    }
</script>

<script>
    $(document).ready(function ($) {
        $('#school_id').on('change', function (e) {
            var val = $(this).val();
            if (val != "") {
                $(this).closest('form').submit();
            }
        });
    });
</script>

<script>
    function validateForm() {
        var x = document.forms["myForm"]["school_name"].value;
        var y = document.forms["myForm"]["region"].value;
        var z = document.forms["myForm"]["district"].value;
        var w = document.forms["myForm"]["ward"].value;
        var k = document.forms["myForm"]["phone"].value;
        var s = document.forms["myForm"]["box"].value;

        if (x == "" && y == "" && z == "" && w == "" && k == "" && s == "") {
            swal("Fail!", "Fill all the Fields before Submit.", "error");
            return false;
        }
    }

</script>
<script>
    $(document).ready(function ($) {
        $("#region").change(function () {
            $.get("{{ url('/api/dropdown')}}",
                {option: $(this).val()},
                function (data) {

                    var item = $('#district');
                    item.empty();
                    var dat = JSON.stringify(data);
                    var stringify = JSON.parse(dat);
                    item.append("<option value=''> -- Default -- </option>");
                    for (var i = 0; i < stringify.length; i++) {
                        item.append("<option value='" + stringify[i]['id'] + "'>" + stringify[i]['name'] + "</option>");
                    }
                });
        });
    });

    $(document).ready(function ($) {
        $("#district").change(function () {
            $.get("{{ url('/api/drop')}}",
                {option: $(this).val()},
                function (data) {

                    var item = $('#ward');
                    item.empty();
                    var dat = JSON.stringify(data);
                    var stringify = JSON.parse(dat);
                    for (var i = 0; i < stringify.length; i++) {
                        item.append("<option value='" + stringify[i]['id'] + "'>" + stringify[i]['name'] + "</option>");
                    }
                });
        });
    });
</script>


@include('partials._messages')

</body>


<!-- Mirrored from wrappixel.com/ampleadmin/ampleadmin-html/ampleadmin-minimal/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 22 Apr 2018 11:10:04 GMT -->
</html>
