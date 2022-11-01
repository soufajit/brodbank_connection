<html>

<head>
    <title>Broadband Connection</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.css" />
    <!-- <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles"> -->
    <style>
        table {
            padding: 10px;
        }

       
    </style>

</head>

<body>
    <div class="container">
    <div id='loader'></div>
        <div class="page-controls-section mt-4">
            <a class="btn btn-secondary" href="/">Add</a>
            <a class="btn btn-light active" href="javascript:void(0)">View</a>
        </div>
        <div class="page-controls-section mt-4" style='float: right;'>
            <a class="btn btn-success" href="export">Excel</a>
            <a class="btn btn-danger" href="pdf">PDF</a>
        </div>
        <div style="border:1px solid #dedbd5; border-top:none">
            <!-- <p class=text-primary>{{isset($message)?$message:''}}</p> -->
            <center>
                <h4 class="float-none w-auto text-primary p-2">Registration Details</h4>
            </center>

            <!-- <div style="margin-left:1000px ;">
                <a href="export" class="btn btn-success">
                Excel
                </a>
                <a href="export" class="btn btn-success">
                    PDF
                </a>
            </div> -->

            <br>
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Sl No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile No</th>
                        <th>Age</th>
                        <th>Document</th>
                        <th>Provider</th>
                        <th>Speed</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sl = 1;
                    foreach ($regDetails as $value) { ?>
                        <tr>
                            <td>{{$sl++}}</td>
                            @php $proid= Crypt::encrypt($value->registration_id); @endphp
                            <td><a href="/profile/{{$proid}}">{{$value->applicant_name}}</a></td>
                            <td>{{$value->email_id}}</td>
                            <td>{{$value->mobile_number}}</td>
                            <td>{{$value->age}}</td>

                            <td> <a href="{{asset('uploads/'.$value->imgae_path)}}">{{$value->imgae_path}}</a></td>
                            <td>{{$value->provider_name}}</td>
                            <td>{{$value->connection_speed}}</td>
                            @php $regID= Crypt::encrypt($value->registration_id); @endphp
                            <td>
                                <a href="/editData/{{$regID}}" class="btn btn-warning">Edit</a>
                                <a href="/delate/{{$regID}}" class="btn btn-danger">Delate</a>

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script> -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('asset/js/alert.js') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "lengthMenu": [
                    [2, 5, 10, -1],
                    [2, 5, 10, "All"]
                ], //"lengthMenu": [ [2, 4, 8, -1], [2, 4, 8, "All"] ],
            });
        });
    </script>
  
</body>

<footer class="col-md-3 mx-auto">
    <!-- © 2022. CSM Pvt Ltd. All Rights Reserved -->
</footer>

<html>

<!-- var phoneno = /^\d{10}$/;
var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
var phoneno = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/; -->