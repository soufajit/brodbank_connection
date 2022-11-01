
<p class="alert alert-info"></p>

<html>
    <head>
        <title>Leave Module</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
        <style>
            .error{
                color:red;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <form action="index" id="res" method="post" class="p-3" enctype="multipart/form-data">
                @csrf
                <fieldset class="rounded border border-secondary p-2">
                    <legend class="float-none w-auto text-primary p-2">
                        <h3>Employee Leave Application Form</h3>
                    </legend>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="empcode" class="form-label">Empcode</label>
                                <select class="form-select" aria-label="Default select" id="empcode" name="empcode">
                                    <option hidden="hidden" value="">Select</option>
                                   
                                    <option value=""></option>
                                   
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="empname" class="form-label">Emp Name</label>
                                <input type="text" class="form-control" id="empname" placeholder="Employee Name"
                                    name="empname" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="designation" class="form-label">Designation</label>
                                <input type="text" class="form-control" id="designation" placeholder="Employee Designation"
                                    name="empdesig" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <th scope="col" colspan="2" class="bg-info text-center">Status</th>
                                        <tr>

                                            <th scope="col">CL</th>
                                            <th scope="col">ML</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <p id="cl"></p>
                                            </td>
                                            <td>
                                                <p id="ml"></p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="leavetype" class="form-label">Leave Type</label>
                                <select class="form-select" aria-label="Default select" id="leavetype" name="leavetype">
                                    <option hidden="hidden" value="">Select</option>
                                    <option value="1">Casual</option>
                                    <option value="2">Medical</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4" style="display:none" id="document">
                            <div class="mb-3">
                                <label for="doc" class="form-label">Document</label>
                                <input type="file" class="form-control" id="doc" name="doc" accept="image/jpg">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="fdate" class="form-label">From Date</label>
                                <input type="text" class="form-control datepicker " id="fdate" name="fdate"
                                    placeholder="MM/DD/YYYY" autocomplete="off" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="tdate" class="form-label">To date</label>
                                <input type="text" class="form-control datepicker" id="tdate" name="tdate"
                                    placeholder="MM/DD/YYYY" autocomplete="off" readonly>
                                <p style="display:none" id="xy" class="applFor">(Applying for <span id="no"></span> day)</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="reason" class="form-label">Reason</label>
                                <textarea class="form-control" id=""
                                    style="max-height:80px;min-height:80px;overflow-y: scroll" name="reason"></textarea>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="noofday" id="noofday">
                    <div class="row">
                        <!-- <div class="col-md-2"></div>
                            <div class="col-md-2"></div> -->
                        <div class="col-md-2 mx-auto">
                            <input type="submit" value="Apply" class="btn btn-success" name="btn">
                            <input type="reset" value="Reset" class="btn btn-warning">
                        </div>
                        <!-- <div class="col-md-2"></div>
                            <div class="col-md-2"></div> -->
                    </div>
                    <p class=text-primary></p>
                </fieldset>
            </form>
        </div>
    </body>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                autoclose: true, 
                todayHighlight: true, 
            });
        });

        $('#fdate,#tdate').on('click', function() {
            if ($('#leavetype').val() == "" && $('#leavetype').val() == 0) {
                alert("Select Leave Type First");
                $('#leavetype').focus();
                $('#fdate').val('');
                $('#tdate').val('');
            }
        });
        $("#leavetype").on('change', function() {
            var leaveType = $('#leavetype').val();
            $('#fdate').val('');
            $('#tdate').val('');

            if (leaveType == 1) {
                $("#document").css('display','none');
                $('#fdate,#tdate').datepicker("destroy");
                $("#fdate").datepicker({
                    todayHighlight: true, 
                    autoclose: true,
                    startDate: '+0d', 
                });
                $("#fdate").on('change', function() {
                    $('#tdate').datepicker("destroy");
                    // var fudate = $('#fdate').val().toString();
                    // var currentDate = new Date();
                    // var futuredate = new Date(fudate);

                    // var cdate = (currentDate.getMonth() + 1) + '/' + currentDate.getDate() + '/' + currentDate.getFullYear();
                    // var fdate = (futuredate.getMonth() + 1) + '/' + futuredate.getDate() + '/' + futuredate.getFullYear();
                    $("#tdate").datepicker({                       
                        todayHighlight: true, 
                        autoclose: true,
                        startDate: '+0d', 
                    });
                });

                $('#tdate').on('change', function() {
                    // $('#xy').css("dispaly","none");
                    // $('#tdate').datepicker({
                    //     todayHighlight: true, 
                    //     autoclose: true,
                    //     startDate: '+0d',
                    // });
                    if ($('#fdate').val() == "") {   // not working
                        $('#fdate').focus();
                        $('#tdate').val('');
                        alert("Select From Date First");
                        return false;
                    }
                    var fudate = $('#fdate').val().toString();
                    var fromDate = new Date(fudate);

                    var tdate = $('#tdate').val().toString();
                    var toDate = new Date(tdate);

                    var currentDate = new Date();
                    var cdate = (currentDate.getMonth() + 1) + '/' + currentDate.getDate() + '/' + currentDate.getFullYear();
                    var tdate = (toDate.getMonth() + 1) + '/' + toDate.getDate() + '/' + toDate.getFullYear();
                    var fdate = (fromDate.getMonth() + 1) + '/' + fromDate.getDate() + '/' + fromDate.getFullYear();

                    // if (tdate == fdate) {
                    //     alert("Same date not allowed,Minimum One Day Gap");
                    //     $('#tdate').focus();
                    //     $('#tdate').val('');
                    //     $('#xy').css("display","none");
                    //     return false;
                    // }
                    if (tdate < fdate) {
                        alert("To date must be greater than from date");
                        $('#tdate').focus();
                        $('#tdate').val('');
                        $('#xy').css("display","none");
                        return false;
                    }
                    if (tdate >= fdate) {
                        
                        const diffTime = Math.abs(toDate - fromDate);
                        var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                        console.log(diffTime + " milliseconds");
                        console.log(diffDays + " days");
                        
                        if (diffDays > 2) {                     //3
                            alert("Casual Leave Not allowed");
                            $('#tdate').val('');
                            $('#fdate').val('');
                            $('#xy').css("display","none");
                        }
                        else{
                            alert("Casual Leave allowed");
                            $('#xy').css("display","block");
                            $('#no').text(diffDays+1);
                            $('#noofday').val(diffDays+1);
                        }
                    }
                        
                });
            }else{
                $("#document").css('display','block');
                $('#fdate,#tdate').datepicker("destroy");
                $("#fdate").datepicker({                       
                        todayHighlight: true, 
                        autoclose: true,
                        endDate: '+0d', 
                    });
                    $('#tdate').on('click', function() {
                    if ($('#fdate').val() == "") {
                        $('#fdate').focus();
                        $('#tdate').val('');
                        alert("Select From Date First");
                        return false;
                        }
                    });
                    $("#fdate").on('change', function() {
                    $('#tdate').datepicker("destroy");
                    $("#tdate").datepicker({                       
                        todayHighlight: true, 
                        autoclose: true,
                        endDate: '+0d', 
                    });
                });
                $('#tdate').on('change', function() {
                    if ($('#fdate').val() == "" && $('#fdate').val() == 0) {   // not working
                        $('#fdate').focus();
                        $('#tdate').val('');
                        alert("Select From Date First");
                        return false;
                    }
                    var fudate = $('#fdate').val().toString();
                    var fromDate = new Date(fudate);

                    var tdate = $('#tdate').val().toString();
                    var toDate = new Date(tdate);

                    var currentDate = new Date();
                    var cdate = (currentDate.getMonth() + 1) + '/' + currentDate.getDate() + '/' + currentDate.getFullYear();
                    var tdate = (toDate.getMonth() + 1) + '/' + toDate.getDate() + '/' + toDate.getFullYear();
                    var fdate = (fromDate.getMonth() + 1) + '/' + fromDate.getDate() + '/' + fromDate.getFullYear();

                    if (tdate < fdate) {
                        alert("To date must be greater than from date");
                        $('#tdate').focus();
                        $('#tdate').val('');
                        $('#xy').css("display","none");
                        return false;
                    }
                    if (tdate >= fdate) {
                        
                        const diffTime = Math.abs(toDate - fromDate);
                        var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                        console.log(diffTime + " milliseconds");
                        console.log(diffDays + " days");
                        
                        if (diffDays >= 1) {                     //3
                            alert("Medical Leave Not allowed");
                            $('#tdate').val('');
                            $('#fdate').val('');
                            $('#xy').css("display","none");
                        }
                        else{
                            alert("Medical Leave allowed");
                            $('#xy').css("display","block");
                            $('#no').text(diffDays+1);
                            $('#noofday').val(diffDays+1);
                        }
                    }
                        
                });         
            }

        })


        $("#empcode").change(function() {                
            empcode = $(this).val();
            $.ajax({
                url: "getempdetails", 
                type: "POST", 
                dataType: "JSON", 
                data: {'_token': '{{csrf_token()}}', empid: empcode}, 
                success: function(data) {
                    if (data.status == 200) {
                        $('#empname').val(data.result.empname);
                        $('#designation').val(data.result.designation);
                        $('#cl').html(data.result.cl);
                        $('#ml').html(data.result.ml);
                    }
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#res').validate({
                rules: {
                    empcode: {
                        required: true,
                    },
                    leavetype: {
                        required: true
                    },
                    fdate: {
                        required: true
                    },
                    tdate: {
                        required: true
                    },
                    reason: {
                        required: true
                    },doc: {
                        required: true,
                        extension: "pdf"
                    },
                },
                messages: {
                    empcode: 'Please select empcode ',
                    leavetype: 'Please select leavetype.',
                    fdate:  'Please select fdate',
                    tdate:  'Please select tdate.', 
                    reason:  'Please enter reason.',
                    doc: {
                        'required':'Please Upload .',
                        'extension':'Please Upload Pdf extention Only .',
                    } 
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
        });
    </script>

    <footer class="col-md-3 mx-auto">
        © 2022. CSM Pvt Ltd. All Rights Reserved
    </footer>
    
<html>