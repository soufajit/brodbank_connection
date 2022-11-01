<!-- @if(Session::has('message'))
<p class="alert alert-info">{{ Session::get('message') }}</p>
@endif -->
<html>

<head>
    <title>Broadband Connection</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <!-- <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles"> -->
    <style>
        .error {
            color: red;
        }

        p {
            text-align: center;
        }

        label {
            font-weight: bold;
        }

        .red {
            color: red;
            font-weight: bold;
        }

        #loader {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.75) url("public/uploads/loder.gif") no-repeat center center;
            z-index: 99999;
        }
    </style>


</head>

<body>
    <div class="container">
        <div id='loader'></div>
        <div class="page-controls-section mt-4">
            <div class="nav-item nav-link nav-fill">
                <a class="btn btn-light active" href="javascript:void(0);">Add</a>
                <a class="btn btn-secondary" href="/view">View</a>

            </div>
            <div style="border:1px solid #dedbd5; border-top:none">
                <center>
                    <h4 class="float-none w-auto text-primary p-2">Broadband Internet Connection Form</h4>
                </center>
                <form action="registration_form" id="res" method="post" class="p-3" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="serviceProvider" class="form-label">Service Provider Name</label>
                                <sapn class="red">*</span>
                                    <select name="serviceProvider" id="serviceProvider" class="form-control">
                                        <option hidden="hidden" value="">Select</option>
                                        @foreach ($provider as $viewData)
                                        <option value="{{$viewData->provider_int}}">{{$viewData->provider_name}}</option>
                                        @endforeach

                                    </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="connectionSpeed" class="form-label">Connection Speed</label>
                                <sapn class="red">*</span>
                                    <select name="connectionSpeed" id="connectionSpeed" class="form-control">

                                    </select>
                            </div>
                        </div>
                    </div>
                    <fieldset class="rounded border border-secondary p-2">
                        <legend class="float-none w-auto text-primary p-2">
                            <h4>Applicant Details</h4>
                        </legend>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="app_name" class="form-label">Applicant Name</label>
                                    <sapn class="red">*</span>
                                        <input type="text" class="form-control" id="app_name" name="app_name" placeholder="Applicant Name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="mobile" class="form-label">Email ID</label>
                                    <sapn class="red">*</span>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email ID">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="mobile" class="form-label">Mobile No</label>
                                    <sapn class="red">*</span>
                                        <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile No">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="date of birth" class="form-label">Date Of Birth</label>
                                    <sapn class="red">*</span>
                                        <input type="text" class="form-control datepicker" id="dob" name="dob" placeholder="Date of Birth" autocomplete="off" onchange=dateValidate();>
                                        <input type="hidden" id="hdnAge" name="hdnAge">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <sapn class="red">*</span><br>
                                        <input type="radio" id="male" name="gender" value="Male">
                                        <label for="Male">Male</label>
                                        <input type="radio" id="female" name="gender" value="Female">
                                        <label for="Female">Female</label><br>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="pic" class="form-label">Upload Address Proof<span class="red">*</span></label>
                                    <input type="file" name="docs" id="docs" class="form-control validate" onchange="readURL(this);">
                                    <span for="pic" class="red">* PDF and JPG only</span>
                                    @if ($message = Session::get('message'))
                                    <!-- <span class="alert alert-warning alert-block">{{ $message }}</span> -->
                                    <script>
                                        Swal.fire({
                                            position: 'top-end',
                                            icon: 'error',
                                            title: 'Uplod PDF and JPG only !!!',
                                            showConfirmButton: false,
                                            timer: 2000
                                        })
                                    </script>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mx-auto">
                                <button type="submit" class="btn btn-success" name="btn" id="btnSubmit">Submit</button>
                                <input type="reset" value="Reset" class="btn btn-warning">
                            </div>
                        </div>
                        @if(Session::has('message'))
                        <input type="hidden" id="hdnmsg" name="hdnmsg" value="{{ Session::get('message')}}">
                        @endif


                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script> -->
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <script src="{{asset('asset/js/alert.js') }}"></script>
    <!-- <script>
            $(document).ready(function(){
                var msg  = $('#hdnmsg').val(); 
                console.log(msg);
                if(msg == undefined){
                   return true;
                }else{
                    if(msg == 'error'){
                        successAlerts('Error','Opps!!.. Something went wrong',"error");
                    }else{
                        successAlerts('Success','Subscription Purchased Successful',"success");
                    }
                }
                
            });
        </script> -->
    <script>
        $(function() {
            $("res").submit(function() {
                $('#loader').show();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                autoclose: true,
                todayHighlight: true,
            });
        });
        $("#dob").datepicker({
            todayHighlight: true,
            autoclose: true,
            endDate: '+0d',
        });

        function dateValidate() {
            var appDate = $('#dob').val();
            var appliedDate = new Date(appDate);
            //calculate month difference from current date in time
            var month_diff = Date.now() - appliedDate.getTime();

            //convert the calculated difference in date format
            var age_dt = new Date(month_diff);

            //extract year from date    
            var year = age_dt.getUTCFullYear();

            //now calculate the age of the user
            var age = Math.abs(year - 1970);
            $('#hdnAge').val(age);
            // if (age < 12) {
            //     $('#dob').val('');
            //     $('#hdnAge').val('');
            // } else {
            //     return true
            // }


        }
    </script>

    <script>
        $("#serviceProvider").change(function() {

            serviceProvider = $(this).val();
            // successAlerts('',serviceProvider,'info');
            $.ajax({
                url: "getdetails",
                type: "POST",
                dataType: "JSON",
                data: {
                    '_token': '{{csrf_token()}}',
                    providerId: serviceProvider
                },
                success: function(data) {
                    $('#connectionSpeed').html(data.html);
                }
            });
        });
    </script>


    <script>
        $(document).ready(function() {

            $('#res').submit(function(e) {
                // alert("hii");
                e.preventDefault();
                var serviceProvider = $('#serviceProvider').val();
                var connectionSpeed = $('#connectionSpeed').val();
                var app_name = $('#app_name').val();
                var mobile = $('#mobile').val();
                var email = $('#email').val();
                var dob = $('#dob').val();
                var docs = $('#docs').val();
                var gender_m = $('#male').val();
                var gender_f = $('#female').val();
                var regEx = /^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/;
                var validEmail = regEx.test(email);
                var mobregExp = /^[6-9]{1}[0-9]{9}$/;
                var name_regex = /^[a-zA-Z\s]+$/;
                var validname = name_regex.test(app_name);
                var validmobile = mobregExp.test(mobile);




                //// AGE CALCULATION ///////

                var userinput = document.getElementById("dob").value;
                var dob = new Date(userinput);
                var result = 0;
                var month_diff = Date.now() - dob.getTime();
                var age_dt = new Date(month_diff);
                var year = age_dt.getUTCFullYear();
                var age = Math.abs(year - 1970);


                if (serviceProvider.length < 1) {
                    Swal.fire("Something Went Wrong!!", "Fill Provider Name", "error");
                } else if (connectionSpeed.length < 1) {
                    Swal.fire("Something Went Wrong!!", "Select Speed", "error");
                } else if (app_name.length < 3) {
                    Swal.fire("Something Went Wrong!!", "Enter Your Name max 3", "error");
                } else if (!validname) {
                    Swal.fire("Something Went Wrong!!", "Name Most be Char", "error");
                } else if (!validEmail) {
                    Swal.fire("Validation Faild!!", "Enter a valid Email", "error");
                } else if (!validmobile) {
                    Swal.fire("Validation Faild!!", "Enter a valid Mobile", "error");
                } else if (dob.length < 1) {
                    Swal.fire("Something Went Wrong!!", "Enter Your DOB", "error");
                } else if (age <= 12) {
                    Swal.fire("Something Went Wrong!!", "age most 12", "error");
                } else if (docs.length < 1) {
                    Swal.fire("Something Went Wrong!!", " Upload Address Proof", "error");
                } else {
                    this.submit();

                    Swal.fire("Your Data Submited", "Check Your Status", "success");
                }

            });

        });
    </script>

    <!-- <script>
            $("#app_name").on('blur',function() {     
                applicantName = $(this).val(); 
                var exp=/^[ a-zA-Z]+$/; 
                var minLength = '3'; 
                if(applicantName.match(exp)){
                    if(applicantName.length>=minLength){
                        return true;
                    }else{
                        // alert("Name atleast 4 character long");
                        successAlerts("Not Valid!","Name atleast 3 character long","error");
                        $('#app_name').val('');
                        return false;
                    }
                }else{
                    // alert("Name must be Alphabets");
                    successAlerts("Not Valid!","Name must be Alphabets","error");
                    $('#app_name').val('');
                    return false;
                }
            });
            $("#email").on('blur',function() {     
                emailId = $(this).val();
                var exp=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if(!(emailId.match(exp)))
                {
                    // alert("Invalid Email Address");
                    successAlerts("Not Valid!","Invalid Email Address","error");
                    $('#email').val('');
                    return false;
                }
                    return true;
            });
            $("#mobile").on('blur',function() {    
                mobile = $(this).val();
                var exp = /^\d{10}$/;    
                if(!(mobile.match(exp)))
                {
                    // alert("Invalid Mobile Number");
                    successAlerts("Not Valid!","Invalid Mobile Number","error");
                    $('#mobile').val('');
                    return false;
                }
                    return true;
            });
            

            function readURL(input) { 
                // successAlerts('uplod','','info');
                fileName = document.querySelector('#docs').value; 
                extension = fileName.split('.').pop();  
                if(extension=='jpg' || extension=='jpeg' || extension=='pdf'){
                    return true;
                }else{
                    successAlerts('Not valid',"Invalid File Type, PDF or JPG only",'error');
                    $('#docs').val('');
                    return false;
                }
            
            }
        </script> -->
    <!-- <script>
       $('#btnSubmit').click(function(){
            $('#res').validate({
                rules: {
                    serviceProvider: {
                        required: true,
                    },
                    connectionSpeed: {
                        required: true
                    },
                    app_name: {
                        required: true
                    },
                    email: {
                        required: true
                    },
                    mobile: {
                        required: true
                    },
                    dob: {
                        required: true
                       
                    },
                    gender: {
                        required: true
                       
                    },
                    docs: {
                        required: true
                    },
                },
                messages: {
                    project: 'Please select ',
                    ptype: 'Please select ',
                    app_name:  'name cant be blank',
                    email:  'email cant be blank', 
                    mobile:  'mobile cant be blank.',
                    dob:  'DOB cant be blank',
                    gender:  'choose gender',
                    doc: 'choose doc .',
                },
                submitHandler: function (form) {
                    Swal.fire("Your Data Submited", "Check Your Status", "success");
                    form.submit();
                }
            });
        });
    </script> -->
</body>

<footer class="col-md-3 mx-auto">
    <!-- © 2022. CSM Pvt Ltd. All Rights Reserved -->
</footer>

<html>

<!-- var phoneno = /^\d{10}$/;
var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
var phoneno = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/; -->