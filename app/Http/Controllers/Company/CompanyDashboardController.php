<?php

namespace App\Http\Controllers\Company;

use Auth;
use Hash;
use Validator;
use Carbon\Carbon;
use App\Model\User;
use App\Model\Company;
use GuzzleHttp\Client;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Exception\GuzzleException;

class CompanyDashboardController extends Controller
{
    public function dashboard(Company $company, Request $request)
    {
    	menuSubmenu('dashboard', 'dashboard');

    	// http://fdapp.18gps.net//GetDataService.aspx?method=loginSystem&LoginName=000&LoginPassword=123456&LoginType=ENTERPRISE&language=cn&ISMD5=0&timeZone=+08&apply=APP&loginUrl=


        // $url = "https://hostparkbd.net/api/check.php?user=easyproducts&pass=Easy9191230&todo=balance";

        $url = "http://fdapp.18gps.net//GetDataService.aspx?method=loginSystem&LoginName={$company->login_code}&LoginPassword={$company->login_password}&LoginType={$company->login_type}&language=en&ISMD5=0&timeZone=+06&apply=APP&loginUrl=";
        // dd($url);
        $client = new Client();
             
        try {
                $r = $client->request('GET', $url);
                $result = $r->getBody()->getContents();

                $arr = json_decode($result, true);

                // dd($arr);
                // return $arr['balance'];

                if($arr['success'] == 'true')
                {
                	$company->school_id = $arr['id'];
                	$company->mds = $arr['mds'];
                	$company->loggedin_at = Carbon::now();
                	$company->save();
                }

            } catch (\GuzzleHttp\Exception\ConnectException $e) {
                // This is will catch all connection timeouts
                // Handle accordinly
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                // This will catch all 400 level errors.
                // return $e->getResponse()->getStatusCode();
            }


            $url = "http://fdapp.18gps.net//GetDateServices.asmx/GetDate?method=getDeviceList&mds={$company->mds}";

        // dd($url);
        $client = new Client();
             
        try {
                $r = $client->request('GET', $url);
                $result = $r->getBody()->getContents();

                $arr = json_decode($result, true);

                $object = (object)$arr;

                // dd($object);

                // return $arr['balance'];

                // dd($arr['rows']);

                

            } catch (\GuzzleHttp\Exception\ConnectException $e) {
                // This is will catch all connection timeouts
                // Handle accordinly
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                // This will catch all 400 level errors.
                // return $e->getResponse()->getStatusCode();
            }

            if($object->success == 'true')
            {

               return view('company.companyDashboard',['company'=>$company, 'items' => $object->rows]);
            }
            else
            {

                
    	       return view('company.companyDashboard',['company'=>$company, 'items'=> []]);

            }
 
    	
        return view('company.companyDashboard',['company'=>$company]);
    }

    public function servicesAll(Company $company, Request $request)
    {
    	menuSubmenu('dashboard', 'servicesAll');    	

        $url = "http://fdapp.18gps.net//GetDateServices.asmx/GetDate?method=getDeviceList&mds={$company->mds}";

        // dd($url);
        $client = new Client();
             
        try {
                $r = $client->request('GET', $url);
                $result = $r->getBody()->getContents();

                $arr = json_decode($result, true);

                $object = (object)$arr;

                // dd($object);

                // return $arr['balance'];

                // dd($arr['rows']);

                

            } catch (\GuzzleHttp\Exception\ConnectException $e) {
                // This is will catch all connection timeouts
                // Handle accordinly
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                // This will catch all 400 level errors.
                // return $e->getResponse()->getStatusCode();
            }

            if($object->success == 'true')
            {

    	       return view('company.servicesAll',['company'=>$company, 'items' => $object->rows]);
            }
            else
            {

                $url = "http://fdapp.18gps.net//GetDataService.aspx?method=loginSystem&LoginName={$company->login_code}&LoginPassword={$company->login_password}&LoginType={$company->login_type}&language=en&ISMD5=0&timeZone=+06&apply=APP&loginUrl=";
                // dd($url);
                $client = new Client();
                     
                try {
                    $r = $client->request('GET', $url);
                    $result = $r->getBody()->getContents();

                    $arr = json_decode($result, true);

                    // dd($arr);
                    // return $arr['balance'];

                    if($arr['success'] == 'true')
                    {
                        $company->school_id = $arr['id'];
                        $company->mds = $arr['mds'];
                        $company->loggedin_at = Carbon::now();
                        $company->save();
                    }

                } catch (\GuzzleHttp\Exception\ConnectException $e) {
                    // This is will catch all connection timeouts
                    // Handle accordinly
                } catch (\GuzzleHttp\Exception\ClientException $e) {
                    // This will catch all 400 level errors.
                    // return $e->getResponse()->getStatusCode();
                }



                $url = "http://fdapp.18gps.net//GetDateServices.asmx/GetDate?method=getDeviceList&mds={$company->mds}";

                // dd($url);
                $client = new Client();
                     
                try {
                        $r = $client->request('GET', $url);
                        $result = $r->getBody()->getContents();

                        $arr = json_decode($result, true);

                        $object = (object)$arr;

                        // dd($object);

                        // return $arr['balance'];

                        // dd($arr['rows']);

                        

                    } catch (\GuzzleHttp\Exception\ConnectException $e) {
                        // This is will catch all connection timeouts
                        // Handle accordinly
                    } catch (\GuzzleHttp\Exception\ClientException $e) {
                        // This will catch all 400 level errors.
                        // return $e->getResponse()->getStatusCode();
                    }

                    if($object->success == 'true')
                    {

                       return view('company.servicesAll',['company'=>$company, 'items' => $object->rows]);
                    }
                    else
                    {
                        return view('company.servicesAll',['company'=>$company, 'items' => []]);
                    }

            }

    }

    public function productStatus(Company $company, Request $request)
    {
        

        $url = "http://fdapp.18gps.net//GetDateServices.asmx/GetDate?method=BMSrealTimeState&mds={$company->mds}&macid={$request->macid}&_r={time()}";
        // dd($url);
        $client = new Client();
             
        try {
                $r = $client->request('GET', $url);
                $result = $r->getBody()->getContents();

                $arr = json_decode($result, true);

                if($arr['success'] == 'true')
                {
                    $data = $arr['data'][0];
                    $state = json_decode($data['State'], true);



                }else
                {
                    if($request->ajax())
                    {

                      return Response()->json([
                        'view'=>View('company.includes.modals.productStatusModalLg', [
                        'company' => null,
                        'state' => null,
                        'macid' => $request->macid,
                        'platenumber' => $request->platenumber
                        ])->render(),
                        'success' => false,
                      ]);
                    }

                }                

            } catch (\GuzzleHttp\Exception\ConnectException $e) {
                // This is will catch all connection timeouts
                // Handle accordinly
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                // This will catch all 400 level errors.
                // return $e->getResponse()->getStatusCode();
            }

            if($request->ajax())
            {
                

              return Response()->json([
                'view'=>View('company.includes.modals.productStatusModalLg', [
                'company' => $company,
                'state' => $state,
                'macid' => $request->macid,
                'platenumber' => $request->platenumber
                ])->render(),

                'success' => $arr['success'] == 'true' ? true : false,
              ]);
            }

            return back();


    }

    public function productSettings(Company $company, Request $request)
    {
        

        $url = "http://fdapp.18gps.net//GetDateServices.asmx/GetDate?method=BMSrealTimeState&mds={$company->mds}&macid={$request->macid}&_r={time()}";
        // dd($url);
        $client = new Client();
             
        try {
                $r = $client->request('GET', $url);
                $result = $r->getBody()->getContents();

                $arr = json_decode($result, true);

                if($arr['success'] == 'true')
                {
                    $data = $arr['data'][0];

                    $setting = json_decode($data['Seting'], true);


                }else
                {
                    if($request->ajax())
                    {

                      return Response()->json([
                        'view'=>View('company.includes.modals.productSettingsModalLg', [
                        'company' => null,
                        'setting' => null, 
                        'macid' => $request->macid,
                        'platenumber' => $request->platenumber  
                        ])->render(),
                        'success' => false,
                      ]);
                    }

                }                

            } catch (\GuzzleHttp\Exception\ConnectException $e) {
                // This is will catch all connection timeouts
                // Handle accordinly
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                // This will catch all 400 level errors.
                // return $e->getResponse()->getStatusCode();
            }

            if($request->ajax())
            {
                

              return Response()->json([
                'view'=>View('company.includes.modals.productSettingsModalLg', [
                'company' => $company,
                'setting' => $setting,
                'macid' => $request->macid,
                'platenumber' => $request->platenumber
                ])->render(),

                'success' => $arr['success'] == 'true' ? true : false,
              ]);
            }

            return back();


    }

    public function productVersion(Company $company, Request $request)
    {
        

        $url = "http://fdapp.18gps.net//GetDateServices.asmx/GetDate?method=GetBmsSNInfo&mds={$company->mds}&Macid={$request->macid}&Key=BMS_Version&_r={time()}";
        $client = new Client();
             
        try {
                $r = $client->request('GET', $url);
                $result = $r->getBody()->getContents();

                $arr = json_decode($result, true);


                if($arr['success'] == 'true')
                {
                    $data = json_decode($arr['data'][0], true);
                }else
                {
                    if($request->ajax())
                    {

                      return Response()->json([
                        'view'=>View('company.includes.modals.productVersionModalLg', [
                        'company' => null,
                        'data' => null, 
                        'macid' => $request->macid,
                        'platenumber' => $request->platenumber  
                        ])->render(),
                        'success' => false,
                      ]);
                    }

                }                

            } catch (\GuzzleHttp\Exception\ConnectException $e) {
                // This is will catch all connection timeouts
                // Handle accordinly
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                // This will catch all 400 level errors.
                // return $e->getResponse()->getStatusCode();
            }

            if($request->ajax())
            {
                

              return Response()->json([
                'view'=>View('company.includes.modals.productVersionModalLg', [
                'company' => $company,
                'data' => $data,
                'macid' => $request->macid,
                'platenumber' => $request->platenumber
                ])->render(),

                'success' => $arr['success'] == 'true' ? true : false,
              ]);
            }

            return back();
    }


    public function companyDetails(Company $company)
    {
        menuSubmenu('dashboard', 'companyDetails');

        $url = "http://fdapp.18gps.net//GetDateServices.asmx/GetDate?method=getDeviceList&mds={$company->mds}";

        // dd($url);
        $client = new Client();
             
        try {
                $r = $client->request('GET', $url);
                $result = $r->getBody()->getContents();

                $arr = json_decode($result, true);

                $object = (object)$arr;

                // dd($object);

                // return $arr['balance'];

                // dd($arr['rows']);

                

            } catch (\GuzzleHttp\Exception\ConnectException $e) {
                // This is will catch all connection timeouts
                // Handle accordinly
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                // This will catch all 400 level errors.
                // return $e->getResponse()->getStatusCode();
            }

            if($object->success == 'true')
            {

               return view('company.companyDetails',['company'=>$company, 'items' => $object->rows]);
            }
            else
            {

                $url = "http://fdapp.18gps.net//GetDataService.aspx?method=loginSystem&LoginName={$company->login_code}&LoginPassword={$company->login_password}&LoginType={$company->login_type}&language=en&ISMD5=0&timeZone=+06&apply=APP&loginUrl=";
                // dd($url);
                $client = new Client();
                     
                try {
                    $r = $client->request('GET', $url);
                    $result = $r->getBody()->getContents();

                    $arr = json_decode($result, true);

                    // dd($arr);
                    // return $arr['balance'];

                    if($arr['success'] == 'true')
                    {
                        $company->school_id = $arr['id'];
                        $company->mds = $arr['mds'];
                        // $company->loggedin_at = Carbon::now();
                        $company->save();
                    }

                } catch (\GuzzleHttp\Exception\ConnectException $e) {
                    // This is will catch all connection timeouts
                    // Handle accordinly
                } catch (\GuzzleHttp\Exception\ClientException $e) {
                    // This will catch all 400 level errors.
                    // return $e->getResponse()->getStatusCode();
                }



                $url = "http://fdapp.18gps.net//GetDateServices.asmx/GetDate?method=getDeviceList&mds={$company->mds}";

                // dd($url);
                $client = new Client();
                     
                try {
                        $r = $client->request('GET', $url);
                        $result = $r->getBody()->getContents();

                        $arr = json_decode($result, true);

                        $object = (object)$arr;

                        // dd($object);

                        // return $arr['balance'];

                        // dd($arr['rows']);

                        

                    } catch (\GuzzleHttp\Exception\ConnectException $e) {
                        // This is will catch all connection timeouts
                        // Handle accordinly
                    } catch (\GuzzleHttp\Exception\ClientException $e) {
                        // This will catch all 400 level errors.
                        // return $e->getResponse()->getStatusCode();
                    }

                    if($object->success == 'true')
                    {

                       return view('company.companyDetails',['company'=>$company, 'items' => $object->rows]);
                    }
                    else
                    {
                        return view('company.companyDetails',['company'=>$company, 'items' => []]);
                    }

            }
    }

    public function companyDetailsUpdate(Company $company, Request $request)
    {
        menuSubmenu('dashboard', 'companyDetailsUpdate');
        return view('company.companyDetailsUpdate',['company'=>$company]);
    }

    public function companyDetailsUpdatePost(Company $company, Request $request)
    {
        $validation = Validator::make($request->all(),
        [ 
            'title' => ['required', 'string', 'max:255','min:3'],
            'description' => ['required', 'string', 'max:255'],
            // 'login_code' => ['required', 'string'],
            // 'login_password' => ['required','string'],
            // 'login_type' => ['required'],
            'mobile' => ['nullable'],
            'email' => ['nullable'],
            'address' => ['nullable'],
            'zip_code' => ['nullable'],
            'city' => ['nullable'],
            // 'status' => ['nullable'],
            'country' => ['required'],
 
        ]);

        if($validation->fails())
        {
            
            return back()
            ->withInput()
            ->withErrors($validation);
        }

$company->title = $request->title ?: $company->title;
$company->description = $request->description ?: null;
// $company->login_code = $request->login_code ?: $company->login_code;
// $company->login_password = $request->login_password ?: $company->login_password;
// $company->login_type = $request->login_type ?: $company->login_type;
$company->mobile = $request->mobile ?: $company->mobile;
$company->email = $request->email ?: $company->email;
$company->address = $request->address ?: $company->address;
$company->zip_code = $request->zip_code ?: $company->zip_code;
$company->city = $request->city ?: $company->city;
$company->country = $request->country ?: $company->country;
// $company->status = $request->status ? 'active' : 'inactive';
$company->editedby_id = Auth::id();




        if($request->hasFile('logo'))
        {
            $cp = $request->file('logo');
            $extension = strtolower($cp->getClientOriginalExtension());
            $randomFileName = $company->id.'_logo_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

            #delete old rows of profilepic
            Storage::disk('upload')->put('company/logo/'.$randomFileName, File::get($cp));   
            
            if($company->logo_name)
            {
                $f = 'company/logo/'.$company->logo_name;
                if(Storage::disk('upload')->exists($f))
                {
                    Storage::disk('upload')->delete($f);
                }
            }          

            $company->logo_name = $randomFileName;
        }
        
        $company->save();

        return redirect()->route('company.companyDetailsUpdate', $company)->with('success', 'Company successfully updated.');
    }


    public function editUserDetails(Company $company)
    {
        menuSubmenu('dashboard', 'editUserDetails');
        $user = Auth::user();
        return view('company.editUserDetails', ['user'=>$user, 'company'=>$company]);
    }

    public function updateUserDetails(Company $company, Request $request)
    {
        $validation = Validator::make($request->all(),
        [ 
            'name' => ['required', 'string', 'max:255','min:3'],
            'email' => ['required', 'string','email', 'unique:users,email,'.Auth::id(), 'max:255'],
            'mobile' => ['required', 'string'],
 
        ]);

        if($validation->fails())
        {
            
            return back()
            ->withInput()
            ->withErrors($validation);
        }

        $user = Auth::user();

        $user->name = $request->name ?: $user->name;
        $user->email = $request->email ?: $user->email;
        $user->mobile = $request->mobile ?: $user->mobile;
        
        $user->editedby_id = Auth::id();
        $user->save();

        return back()->with('success', 'User successfully Updated');

    }

    public function editUserPassword(Company $company)
    {
         menuSubmenu('dashboard', 'editUserPassword');
        $user = Auth::user();
        return view('company.editUserPassword',['company'=>$company, 'user'=> $user]);
    }

    public function updateUserPassword(Company $company, Request $request)
    {

        $validation = Validator::make($request->all(),
        [
            // 'oldPassword' =>'min:6',
            'password' => 'required|min:6|confirmed',
            // 'father_name' => 'string'
        ]);
        if($validation->fails())
        {
            return back()
            ->withErrors($validation)
            ->withInput()
            ->with('error', ' Please, Try Again with Correct Password Information.');
        }

        $user = Auth::user();


        if($request->current_password  and (Hash::check($request->current_password, $user->password)))
        {
            $request->user()->fill([
            'password' => Hash::make($request->password)
            ])->save();

            return back()
            ->with('success',' Your Password Successfully Updated!');

        }
        else
        {
            return back()->with('error', 'Please try again with correct information.');
        }
    }

    
}
