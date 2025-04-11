<?php

namespace App\Http\Controllers;

use App\Models\admin\doctor\DoctorModel;
use App\Models\admin\doctor\DoctorReportModel;
use App\Models\BookModel;
use App\Models\innerPageModel;
use App\Models\NotifyMr;
use App\Models\PurchasedPlan;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\GlobalModel;

use App\Models\leadModel;

class ApiController extends Controller
{


    public function login(Request $request)
    {
        $error  = false;

        if ($request->email == '') {
            $error = true;
            return response()->json(['code' => '401', 'message' => 'Email is required!']);
        }

        if ($request->password == '') {
            $error = true;
            return response()->json(['code' => '401', 'message' => 'Password is required!']);
        }

        if ($error === false) {
            $check = User::where('role', 'mr')->where('email', $request->email)->first();
            //  return $check->genre;

            if (!empty($check)) {
                if ($check) {
                    
                    // if($check->is_loggedin ==1){
                    //     return response()->json(['code' => 401, 'message' => 'This user already login to another device']);
                    // }else{
                         $checkpassword = Hash::check($request->password, $check->password);

                    if ($checkpassword) {

                        // plan allotment
                        $planallotemnt = PurchasedPlan::where('alloted_user_id', $check->id)->first();

                        if (empty($planallotemnt)) {
                            return response()->json(['code' => 401, 'message' => 'Plan not alloted kindly contact with your company!']);
                        }
                        // check if the user is valid means should not be expired
                        if (date('Y-m-d') > date('Y-m-d', strtotime($planallotemnt->expiry_date))) {
                            return response()->json(['code' => 401, 'message' => 'Your plan has been expired!']);
                        } else {
                            $cid =   PurchasedPlan::where('alloted_user_id', $check->id)->first();
                            $companyname = User::where('id', $cid->company_id)->first();



                            if ($check->is_paused == 1) {
                                return response()->json(['code' => 401, 'message' => "You are paused and can login after " . $check->paused_till]);
                            } else {
                                
                                User::where('role', 'mr')->where('email', $request->email)->update(['is_loggedin'=>1]);

                                if (!empty($companyname->logo)) {
                                    $logo = url($companyname->logo);
                                } else {
                                    $logo = '';
                                }
                                $arr = array(
                                    'id' => $check->id,
                                    'role' => $check->role ?? ' ',
                                    'license_code' => $planallotemnt->unique_code ?? '',
                                    'name' => $check->name ?? '',
                                    'phone' => $check->phone ?? '',
                                    'email' => $check->email  ?? '',
                                    'work_area' => $check->work_area ?? '',
                                    'company_name' => $companyname->company_name ?? '',
                                    'plan_expirydate' => $planallotemnt->expiry_date ?? '',
                                    'is_paused' => $check->is_paused ?? 0,
                                    'paused_till' => $check->paused_till ?? '',
                                    'company_logo' => $logo ?? '',
                                );
                                return response()->json(['code' => 200, 'message' => "Successfully Login", 'data' => $arr]);
                            }
                        }
                    } else {
                        return response()->json(['code' => 401, 'message' => "Wrong Password"]);
                    }
                        
                    // }
                   
                } else {
                    return response()->json(['code' => 401, 'message' => 'Email not registered']);
                }
            } else {
                return response()->json(['code' => 401, 'message' => 'Not Registered User']);
            }
        }
    }


    public function getbooks(Request $request)
    {
        $url = 'https://prodv.in/';
        $error = false;

        if ($request->mr_id == '') {
            $error = true;
            return response()->json(['code' => '401', 'message' => 'Please Pass mr id ']);
        }

        $checkid = DB::table('purchasedcredits')->where('alloted_user_id', $request->mr_id)->first();

        // Check if user has purchased credits
        if (!empty($checkid)) {
            $booksarr = [];

            // get books created by company
            $getbooks = BookModel::where('company_id', $checkid->company_id)->orderBy('id', 'desc')->get();

            if (!$getbooks->isEmpty()) {
                foreach ($getbooks as $listing) {
                    $innerpagearr = []; // Reset inner page array for each book

                    // Get inner pages for the current book
                    $checkinnerpage = innerPageModel::where('book_id', $listing->id)->orderBy('sequence', 'asc')->get();

                    if (!$checkinnerpage->isEmpty()) {
                        foreach ($checkinnerpage as $innerpagelist) {
                            array_push($innerpagearr, [
                                'id' => $innerpagelist->id,
                                'title' => $innerpagelist->title,
                                'inner_image' => !empty($innerpagelist->inner_image) ? $url . $innerpagelist->inner_image : "",
                                'youtube_link' => !empty($innerpagelist->youtube_link) ? $innerpagelist->youtube_link : "",
                                'audio_link' => !empty($innerpagelist->audio_file) ? $url . $innerpagelist->audio_file : "",
                            ]);
                        }
                    }

                    // Push book details with its inner pages to the main array
                    array_push($booksarr, [
                        'id' => $listing->id,
                        'title' => $listing->title,
                        'cover_image' => $url . $listing->cover_image,
                        'innerpage' => $innerpagearr
                    ]);
                }

                return response()->json(['code' => '200', 'message' => 'Books Found Successfully!', 'data' => $booksarr]);
            } else {
                return response()->json(['code' => '200', 'message' => 'No Books Found!']);
            }
        } else {
            return response()->json(['code' => '401', 'message' => 'No Books created!']);
        }
    }



    public function getinnerpages(Request $request)
    {
        $url = 'https://prodv.in/';
        $error  = false;

        if ($request->book_id == '') {
            $error = true;
            return response()->json(['code' => '401', 'message' => 'Please Pass Book id ']);
        }

        $checkid  =  User::where('id', $request->mr_id)->first();

        // Initialize the innerpage array
        $innerpagearr = [];

        // Get the book details
        $getbooks = BookModel::where('id', $request->book_id)->first();

        // Check if the book exists
        if ($getbooks) {
            // Prepare the cover page data
            $coverPage = [
                'id' => 0,
                'title' => "",
                'inner_image' => $url . $getbooks->cover_image,
                'youtube_link' => "",
                'audio_link' => "",

            ];

            // Add the cover page at the beginning of the array
            array_push($innerpagearr, $coverPage);

            // Get inner pages
            $checkinnerpage = innerPageModel::where('book_id', $request->book_id)->orderBy('sequence', 'asc')->get();

            // Check if inner pages exist
            if (!$checkinnerpage->isEmpty()) {
                foreach ($checkinnerpage as $inerpagelist) {
                    array_push($innerpagearr, [
                        'id' => $inerpagelist->id,
                        'title' => $inerpagelist->title,
                        'inner_image' => !empty($inerpagelist->inner_image) ?  $url . $inerpagelist->inner_image : "",
                        'youtube_link' => !empty($inerpagelist->youtube_link) ? $inerpagelist->youtube_link : "",
                        'audio_link' =>  !empty($inerpagelist->audio_file)  ? $url . $inerpagelist->audio_file : "",
                    ]);
                }

                return response()->json(['code' => '200', 'message' => 'Books Inner Pages Found Successfully!', 'data' => $innerpagearr]);
            } else {
                return response()->json(['code' => '401', 'message' => 'No Inner Pages found for this Book!']);
            }
        } else {
            return response()->json(['code' => '401', 'message' => 'No Book found with the given Book id!']);
        }
    }



    public function forgotPassword(Request $request)
    {
        if ($request->email == '') {
            $error = true;
            return response()->json(['code' => '401', 'message' => 'Please Pass Email  Id ']);
        }

        $check = User::where('role', 'mr')->where('email', $request->email)->first();

        if (!empty($check)) {
            if ($check) {
                $name   =  $check->name;


                $to_name = $name;
                $to_email = $check->email ??  'bhaveshkapoor09@gmail.com';
                $randomnumber =  rand(111111, 999999);
                // update the  otp to the database
                User::where('email', $request->email)->update(['otp' => $randomnumber]);
                $data = array('name' => $to_name, "otp" => $randomnumber);
                if (Mail::send('emails.forgot-password', $data, function ($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)
                        ->subject('Forgot Password');
                    $message->from('ants4uprodv@gmail.com', 'Forgot Password');
                })) {
                    return response()->json(['code' => 200, 'message' => 'Code has been sent to your email!']);
                } else {
                    return response()->json(['code' => 401, 'message' => 'Something went wrong with email server please try again later!']);
                }
            } else {
                return response()->json(['code' => 401, 'message' => 'Email not registered']);
            }
        } else {
            return response()->json(['code' => 401, 'message' => 'Not Registered User']);
        }
    }


    public function otpVerify(Request $request)
    {
        if ($request->email == '') {
            $error = true;
            return response()->json(['code' => '401', 'message' => 'Please Pass Email  Id ']);
        }

        if ($request->otp == '') {
            $error = true;
            return response()->json(['code' => '401', 'message' => 'Please Pass OTP  ']);
        }

        $check = User::where('role', 'mr')->where('email', $request->email)->first();

        if (!empty($check)) {
            if ($check) {
                if ($check->otp == $request->otp) {
                    return response()->json(['code' => 200, 'message' => 'OTP Verified!']);
                } else {
                    return response()->json(['code' => 401, 'message' => 'Wrong OTP']);
                }
            } else {
                return response()->json(['code' => 401, 'message' => 'Email not registered']);
            }
        } else {
            return response()->json(['code' => 401, 'message' => 'Not Registered User']);
        }
    }




    public function newpassword(Request $request)
    {
        if ($request->email == '') {
            $error = true;
            return response()->json(['code' => '401', 'message' => 'Please Pass Email  Id ']);
        }
        if ($request->new_password == '') {
            $error = true;
            return response()->json(['code' => '401', 'message' => 'Please Pass New Password']);
        }
        if ($request->confirm_password == '') {
            $error = true;
            return response()->json(['code' => '401', 'message' => 'Please Pass Confirm Password']);
        }



        $check = User::where('role', 'mr')->where('email', $request->email)->first();

        if (!empty($check)) {
            if ($check) {
                if ($request->new_password ==  $request->confirm_password) {

                    // create new password
                    $latestpassword =    Hash::make($request->new_password);
                    $update = User::where('email', $request->email)->update(['password' => $latestpassword]);

                    if ($update) {
                        return response()->json(['code' => 200, 'message' => 'Password updated Successfully!']);
                    } else {
                        return response()->json(['code' => 401, 'message' => 'Something Went wrong']);
                    }
                } else {
                    return response()->json(['code' => 401, 'message' => 'New and confirm password are not same!']);
                }
            } else {
                return response()->json(['code' => 401, 'message' => 'Email not registered']);
            }
        } else {
            return response()->json(['code' => 401, 'message' => 'Not Registered User']);
        }
    }


    public function changecurrentpassword(Request $request)
    {
        if ($request->user_id == '') {
            $error = true;
            return response()->json(['code' => '401', 'message' => 'Please Pass User  Id ']);
        }
        if ($request->current_password == '') {
            $error = true;
            return response()->json(['code' => '401', 'message' => 'Please Pass Current Password!']);
        }
        if ($request->new_password == '') {
            $error = true;
            return response()->json(['code' => '401', 'message' => 'Please Pass New Password']);
        }
        if ($request->confirm_password == '') {
            $error = true;
            return response()->json(['code' => '401', 'message' => 'Please Pass Confirm Password']);
        }





        $check = User::where('role', 'mr')->where('id', $request->user_id)->first();

        if (!empty($check)) {

            // verify current password
            $verifyPassword =  Hash::check($request->current_password, $check->password);
            if ($verifyPassword) {

                if ($request->new_password ==  $request->confirm_password) {

                    // create new password
                    $latestpassword =    Hash::make($request->new_password);
                    $update = User::where('id', $request->user_id)->update(['password' => $latestpassword]);

                    if ($update) {
                        return response()->json(['code' => 200, 'message' => 'Password updated Successfully!']);
                    } else {
                        return response()->json(['code' => 401, 'message' => 'Something Went wrong']);
                    }
                } else {
                    return response()->json(['code' => 401, 'message' => 'New and confirm password are not same!']);
                }
            } else {
                return response()->json(['code' => '401', 'message' => 'Wrong Current Password!']);
            }
        } else {
            return response()->json(['code' => 401, 'message' => 'No User Found!']);
        }
    }





    public function ispaused(Request $request)
    {
        if ($request->user_id == '') {
            $error = true;
            return response()->json(['code' => '401', 'message' => 'Please Pass User  Id ']);
        }






        $check = User::where('role', 'mr')->where('id', $request->user_id)->first();

        if (!empty($check)) {


            if ($check->is_paused == 1) {


                return response()->json(['code' => 200, 'message' => 'Paused', 'data' => true]);
            } else {
                return response()->json(['code' => 200, 'message' => 'Not Paused', 'data' => false]);
            }
        } else {
            return response()->json(['code' => 401, 'message' => 'No User Found!']);
        }
    }
    public function logout(Request $request)
    {
        if ($request->user_id == '') {
            $error = true;
            return response()->json(['code' => '401', 'message' => 'Please Pass User  Id ']);
        }






        $check = User::where('role', 'mr')->where('id', $request->user_id)->first();

        if (!empty($check)) {
            $check->update(['is_loggedin'=>0]);

                return response()->json(['code' => 200, 'message' => 'Logout Sussessfully!']);
            
        } else {
            return response()->json(['code' => 401, 'message' => 'No User Found!']);
        }
    }

    public function mrnotifyvalue(Request $request)
    {
        if ($request->user_id == '') {
            $error = true;
            return response()->json(['code' => '401', 'message' => 'Please Pass User  Id ']);
        }






        $check = NotifyMr::where('mr_id', $request->user_id)->first();

        if (!empty($check)) {


            if ($check->is_notify == 1) {


                return response()->json(['code' => 200, 'message' => 'Yes theis is syn required', 'data' => true]);
            } else {
                return response()->json(['code' => 200, 'message' => 'Already Sync', 'data' => false]);
            }
        } else {
            return response()->json(['code' => 200, 'message' => 'No new notification for mr', 'data' => false]);
        }
    }
    public function updatenotifyvalue(Request $request)
    {
        if ($request->user_id == '') {
            $error = true;
            return response()->json(['code' => '401', 'message' => 'Please Pass User  Id ']);
        }






        $check = NotifyMr::where('mr_id', $request->user_id)->first();

        if (!empty($check)) {


            if ($check->is_notify == 1) {
                NotifyMr::where('mr_id', $request->user_id)->update(['is_notify'=>0,'updated_at'=>now()]);

            } 
            return response()->json(['code' => 200, 'message' => 'Notified']);

        } else {
            return response()->json(['code' => 401, 'message' => 'No Sync Found Yet!']);
        }
    }

    public function doctor_report(Request $request)
    {

        if ($request->doctor_id == '') {

            return response()->json(['code' => '401', 'message' => 'Doctor Id Required ']);
        }

        if ($request->report == '') {

            return response()->json(['code' => '401', 'message' => 'report Required ']);
        }



        $data['doctor_id']         = $request->doctor_id;
        $data['report']            = $request->report;


        $saved = DoctorReportModel::insert($data);

        if ($saved) {
            return response()->json(['code' => 200, 'message' => 'Added Successful']);
        } else {
            return response()->json(['code' => 400, 'message' => 'something Went Wrong']);
        }
    }



    public function doctorlist()
    {
        $saved = DoctorModel::where('flag', '!=', '2')->cursor();

        $arr = [];
        if (!empty($saved)) {
            foreach ($saved as $value) {

                array_push($arr, array(
                    'id'                        => $value->id,
                    'name'                      => $value->doctor_name,
                    'specialty'                 => $value->specialty,
                    'contact_number'            => $value->contact_number,
                    'email'                     => $value->email,
                    'clinic_1_address_timings'  => $value->clinic_1_address_timings,
                    'clinic_2_address_timings'  => $value->clinic_1_address_timings,
                    'clinic_3_address_timings'  => $value->clinic_1_address_timings,
                    'clinic_4_address_timings'  => $value->clinic_1_address_timings,
                    'anniversary'               => $value->anniversary,
                    'dob'                       => $value->dob,
                ));
            }
        }

        if ($saved) {
            return response()->json(['code' => 200, 'message' => 'Doctor List ', 'List' => $arr]);
        } else {
            return response()->json(['code' => 400, 'message' => 'something Went Wrong']);
        }
    }
    
    public function contactus(Request $request)
    {
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone'=>'required',
            'message' => 'required|string|min:10',
            'service'=>'nullable',
            'company_name'=>'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 400);
        }

        // Process the contact request (e.g., store in DB, send an email, etc.)
        // For simplicity, let's assume you're logging the contact details.
        $contactData = $request->only(['name', 'email', 'message','phone','service']);
        $companyName = $request->company_name ?? 'Not Given';
        
         $data1['name'] = $request->name;
         $data1['phone'] = $request->phone;
         $data1['email'] = $request->email;
         if($request->service != ''){
            $data1['description'] ='Interested In ' .$request->service .' | ' .$request->message  .' | Company Name is  ' .$companyName ; 
         }else{
            $data1['description'] =$request->message .' | Company Name is  ' .$companyName ; 
         }
         

         
        
        $data1['add_by'] = 20;
        $data1['created_at'] = now();
        $data1['source'] = 'Web Enquiry';
        $data1['unique_id'] = GlobalModel::getlastGFCode('leads');

        $query = leadModel::insertGetId($data1);

        
        // Example: Store the contact data in the database (assuming you have a Contact model)
      $query=  DB::table('contactus')->insert($contactData);
        // Contact::create($contactData);
        
        if($query){
              return response()->json([
            'status' => 'success',
            'message' => 'Your message has been received. We will get back to you shortly.'
        ], 200);
        }else{
              return response()->json([
            'status' => 'error',
            'message' => 'Something went wrong please try again later!'
        ], 500);
        }

        // Example: Send an email notification (optional)

      
    }
}
