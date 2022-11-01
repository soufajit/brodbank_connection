<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facedes\input;
use Illuminate\Support\Facedes\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use App\Exports\UserExport;
use App\Exports\ProfileExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Testing\MimeType;
// use Intervention\Image\Facades\Image;
use Intervention\Image\Facades\Image as Image;
// use app\Models\ProviderMasterModel; 
// use App\Models\ConnectionMasterModel; 
// use App\Models\RegistrationDetailsModel;
use PDF;

use Session;
use Illuminate\Support\Facades\Crypt;



class anoController extends Controller
{
    public function index(Request $request)
    {
        // $provider = ProviderMasterModel::all(); 
        $provider = DB::table('provider_master')->get();
        return view('add', ['provider' => $provider]);
    }
    public function getDetails(Request $request)
    {
        $data = $request->all();

        $connectionType = DB::table('connection_master')->select('*')->where('provider_id', '=', $data['providerId'])->get();

        // print_r($connectionType);exit;

        $html = '<option hidden="hidden" value="">Select</option>';
        foreach ($connectionType as $list) {
            $html .= '<option value="' . $list->connection_id . '">' . $list->connection_speed . '</option>';
        }
        return json_encode(array('html' => $html));
    }
    public function registration(Request $request)
    {
        // echo "registration"; exit;
        $data       =   $request->all();
        $file       =   $request->file('docs');
        $file_name  =   $file->getClientOriginalName();
        $extension  =   $file->getClientOriginalExtension();
        $destinationPath = 'uploads';
        DB::beginTransaction();
        try {

            if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'pdf') {
                $file->move($destinationPath, $file_name);

                DB::table('registration_details')->insert(
                    [
                        'applicant_name'   => $data['app_name'],
                        'email_id'         => $data['email'],
                        'mobile_number'    => $data['mobile'],
                        'gender'           => $data['gender'],
                        'dob'              => $data['dob'],
                        'age'              => $data['hdnAge'],
                        'imgae_path'       => $file_name,
                        'provider_id'      => $data['serviceProvider'],
                        'connection_id'    => $data['connectionSpeed']

                    ]
                );

                // $message = "success";

                return back();
            } else {
                $message = "* PDF and JPG only";
                return back()->with('message', $message);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $message = "error";
            return back()->with('message', $message);
        }
    }
    public function view(Request $request)
    {

        // $regDetails = RegistrationDetailsModel::select('*','PM.provider_name','CN.connection_speed')
        // ->leftjoin('connection_master AS CN', 'CN.connection_id', '=', 'registration_details.connection_id')
        // ->leftjoin('provider_master AS PM', 'PM.provider_int', '=', 'registration_details.provider_id')
        // ->orderBy('registration_details.applicant_name','DESC')->get();

        $regDetails = DB::table('registration_details')->select('*', 'PM.provider_name', 'CN.connection_speed')
            ->leftjoin('connection_master AS CN', 'CN.connection_id', '=', 'registration_details.connection_id')
            ->leftjoin('provider_master AS PM', 'PM.provider_int', '=', 'registration_details.provider_id')
            ->orderBy('registration_details.applicant_name', 'DESC')
            ->where('status','0')->get();


        // print_r($regDetails); exit;



        return view('view', ['regDetails' => $regDetails]);
    }

    public function editData($encparam)
    {
        $regID = Crypt::decrypt($encparam);

        $editData = DB::table('registration_details')->select('*', 'PM.provider_name', 'CN.connection_speed')
            ->leftjoin('connection_master AS CN', 'CN.connection_id', '=', 'registration_details.connection_id')
            ->leftjoin('provider_master AS PM', 'PM.provider_int', '=', 'registration_details.provider_id')
            ->where('registration_details.registration_id', $regID)
            ->get();


        //dd($editData);

        $provider = DB::table('provider_master')->get();
        //dd($provider);
        return view('add1', ['provider' => $provider], ['editData' => $editData]);
    }

    public function update(Request $request)
    {
        // echo "registration"; exit;
        $data = $request->all();
        $reid = $data['id'];

        //dd($reid);     
        $file       =   $request->file('docs');
        $file_name  =   $file->getClientOriginalName();
        $extension  =   $file->getClientOriginalExtension();
        $destinationPath = 'uploads';
        $application_name = $data['app_name'];
        $email_id = $data['email'];
        $mobile_number = $data['mobile'];
        $gender = $data['gender'];
        $dob = $data['dob'];
        $age = $data['hdnAge'];
        //dd($age);
        $provider_id = $data['serviceProvider'];
        $connection_id = $data['connectionSpeed'];
        $imgae_path = $file_name;
        $file->move($destinationPath, $file_name);
        DB::beginTransaction();


        $a = DB::table('registration_details')->where('registration_id', $reid)
            ->update(['applicant_name' => $application_name, 'email_id' => $email_id, 'mobile_number' => $mobile_number, 'gender' => $gender, 'dob' => $dob, 'age' => $age, 'imgae_path' => $imgae_path, 'provider_id' => $provider_id, 'connection_id' => $connection_id]);

        $regDetails = DB::table('registration_details')->select('*', 'PM.provider_name', 'CN.connection_speed')
            ->leftjoin('connection_master AS CN', 'CN.connection_id', '=', 'registration_details.connection_id')
            ->leftjoin('provider_master AS PM', 'PM.provider_int', '=', 'registration_details.provider_id')
            ->orderBy('registration_details.applicant_name', 'DESC')->get();
        return view('view', ['regDetails' => $regDetails]);
    }
    public function delate($encparam)
    {
        $regID = Crypt::decrypt($encparam);
        // dd($regID);
        DB::table('registration_details') ->where('registration_id',$regID)
        ->update( [ 'status' =>'1']); 

        $regDetails = DB::table('registration_details')->select('*', 'PM.provider_name', 'CN.connection_speed')
            ->leftjoin('connection_master AS CN', 'CN.connection_id', '=', 'registration_details.connection_id')
            ->leftjoin('provider_master AS PM', 'PM.provider_int', '=', 'registration_details.provider_id')
            ->orderBy('registration_details.applicant_name', 'DESC')
            ->where('status','0')->get();
        return view('view', ['regDetails' => $regDetails]);
    }
    public function export()
    {
        return Excel::download(new UserExport, 'data.xlsx');
    }
    public function generatepdf()
    {
        $regDetails = DB::table('registration_details')->select('*', 'PM.provider_name', 'CN.connection_speed')
            ->leftjoin('connection_master AS CN', 'CN.connection_id', '=', 'registration_details.connection_id')
            ->leftjoin('provider_master AS PM', 'PM.provider_int', '=', 'registration_details.provider_id')
            ->orderBy('registration_details.applicant_name', 'DESC')->get();
        // dd($regDetails);

        $pdf = PDF::loadView('view', ['regDetails' => $regDetails]);

        return $pdf->download('data.pdf');
    }
    public function profile($encparam)
    {
        $proid = Crypt::decrypt($encparam);
        $regDetails = DB::table('registration_details')->select('*', 'PM.provider_name', 'CN.connection_speed')
            ->leftjoin('connection_master AS CN', 'CN.connection_id', '=', 'registration_details.connection_id')
            ->leftjoin('provider_master AS PM', 'PM.provider_int', '=', 'registration_details.provider_id')
            ->orderBy('registration_details.applicant_name', 'DESC')
            ->where('registration_details.registration_id', $proid)
            ->get();


        return view('profile', ['regDetails' => $regDetails]);
    }

    public function export2(Request $request)
    {
        // dd($request->registration_id);
        return Excel::download(new ProfileExport($request->registration_id), 'data.xlsx');
    }

    public function profile_pdf(Request $request)
    {
        // dd($request->registration_id);
        $id = $request->registration_id;
        $regDetails = DB::table('registration_details')->select('*', 'PM.provider_name', 'CN.connection_speed')
            ->leftjoin('connection_master AS CN', 'CN.connection_id', '=', 'registration_details.connection_id')
            ->leftjoin('provider_master AS PM', 'PM.provider_int', '=', 'registration_details.provider_id')
            ->orderBy('registration_details.applicant_name', 'DESC')
            ->where('registration_details.registration_id', $id)->get();
        // dd($regDetails);
        $pdf = PDF::loadView('profile', ['regDetails' => $regDetails]);

        return $pdf->download('data.pdf');
    }
}
