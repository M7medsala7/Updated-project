<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\PostJob;
use App\CandidateInfo;
use App\EmployerProfile;
use Socialite;
use Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    Public function StoreVideo(request $request)
    {
        $file = $request->file('name');
        dd($file);
    }
    public function redirectToProvider($id){
       
        Session::put('TypeRegestier',$id);

        return Socialite::driver('facebook')->redirect();
    }

    public function handleProvider(){

        $userDataFace=Socialite::driver('facebook')->user();
        $userExsist=User::where('email',$userDataFace->email)->first();
        if($userExsist ==null)
        {

            $type=Session::get('TypeRegestier');
            if($type==2)
                $type="candidate";
            else
                $type="employer";


           
        $user = User::create(['name'=>$userDataFace->name,'email'=>$userDataFace->email,'password' =>$userDataFace->token,'type'=>$type]);
           
                unset($userDataFace->name,$userDataFace->email,$userDataFace->token);
              
                \Auth::loginUsingId($user->id);
                return redirect('/home');
        }
        else
        {

        \Auth::loginUsingId($userExsist->id);
                return redirect('/home');
        }
    }


    public function redirectToProviderGoogle($id){
         Session::put('TypeRegestier',$id);
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderGooglr(){
        $userData=Socialite::driver('google')->user();
        $userExsist=User::where('email',$userData->email)->first();

        if($userExsist == null)
        {

        $user = User::create(['name'=>$userData->name,'email'=>$userData->email,'password' =>$userData->token,'type'=>'employer']);
          
                \Auth::loginUsingId($user->id);
                return redirect('/home');
        }
        else
        {

        \Auth::loginUsingId($userExsist->id);
                return redirect('/home');
        }
    }
//Twitter Regestration


  public function redirectToProvidertwitter($id){
     Session::put('TypeRegestier',$id);
       return Socialite::driver('twitter')->redirect();
    }

    public function handleProvidertwitter(){

    
        $userData = Socialite::driver('twitter')->redirect();
      
        $userExsist=User::where('email',$userData->email)->first();

        if($userExsist == null)
        {

        $user = User::create(['name'=>$userData->name,'email'=>$userData->email,'password' =>$userData->token,'type'=>'employer']);
          
                \Auth::loginUsingId($user->id);
                return redirect('/home');
        }
        else
        {

        \Auth::loginUsingId($userExsist->id);
                return redirect('/home');
        }
    }


//End 


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function emplyReg(Request $request)
    {
        $this->validate($request, [
            'job_id' => 'required',
            'job_for'=>'required',
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'country_id'=>'required',

        ]);
        $code = 1000;
        //get the code value;
        $lastUser =  \DB::table('users')->orderBy('id', 'desc')->first();
        if($lastUser)
        {
            $code = $lastUser->code++;
        }
          $user = User::create(['name'=>$request['name'],'email'=>$request['email'],'password' => bcrypt($request['password']),'type'=>'employer','code'=>$code]);
        $input = $request->all();
        unset($input['name'],$input['email'],$input['password']);
        $input['created_by']= $user->id;
        PostJob::create($input);
        \Auth::loginUsingId($user->id);

        return redirect('/home');
    }
    public function candReg(Request $request)
    {
        $this->validate($request, [
            'job_id' => 'required',
            'industry_id'=>'required',
            'name'=>'required',
            'gender' =>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required',
            'country_id'=>'required',
        ]);
        $code = 1000;
        //get the code value;
        $lastUser =  \DB::table('users')->orderBy('id', 'desc')->first();
        if($lastUser)
        {
            $code = $lastUser->code++;
        }
        $user = User::create(['name'=>$request['name'],'email'=>$request['email'],'password' => bcrypt($request['password']),'type'=>'candidate','code'=>$code]);
        $input = $request->all();
        if($request->hasFile('video_file'))
        {
            $vedio_path = $this->saveFile($request['video_file'],$user);
            $input['vedio_path']=$vedio_path;
        }
        unset($input['name'],$input['email'],$input['password']);
        $input['user_id']= $user->id;
        CandidateInfo::create($input);
        \Auth::loginUsingId($user->id);
        return redirect('/home');
    }

    public function saveFile($file, $user){
        $filename = 'video'.time().$file->getClientOriginalName();
        $type = $file->getMimeType();
        $extension = $file->getClientOriginalExtension();
        $path = public_path().'/videos/'.$user->id;
        $destPath = public_path().'/videos/'.$user->id.'/'.$filename;
        if(!\File::exists($path)) {
            // path does not exist
            \File::makeDirectory($path, $mode = 0777, true, true);
        }
        $success =file_put_contents($destPath,$file);
        $destPath = str_replace(public_path(), "", $destPath);
        return $destPath;
    }


   /***
        *full registeration
    ****/
            //employer part 
    public function empFullRegType(Request $request)
    {
        Session::put('empType',$request['type']);
        return redirect('/f_register/employeer');
    }
    public function empFullReg()
    {
        $type=Session::get('empType');
        return view('auth.create_account',compact('type'));
    }

    public function f_reg_emp(Request $request)
    {
    
    /**
    **Validation 
    **/
     // return $request->all();
        $request['email_confirmation']= strtolower($request['email_confirmation']);
        $request['email']= strtolower($request['email']);
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'type'=>'required',
            'last_name'=>'required',
            'address' =>'required',
            'email'=>'required|email|confirmed|unique:users',
            'password'=>'required',
            'city_id'=>'required',
        ]);
        if ($validator->fails()) {
            return \Response::json($validator->messages(), 500);
        }
    /***
    ***increment code for the new user***
    ***/
        $code = 1000;
        //get the code value;
        $lastUser =  \DB::table('users')->orderBy('id', 'desc')->first();
        if($lastUser)
        {
            $code = $lastUser->code++;
        }
    //*code generated*/

    //**create user
        $user = User::create(['name'=>$request['first_name'].' '.$request['last_name'],'email'=>$request['email'],'password' => bcrypt($request['password']),'type'=>'employer','code'=>$code]);
    //**user created

        $input = $request->all();
        if($user)
        {
            EmployerProfile::create(['city_id'=>$input['city_id'],'type'=>$request['type'],'first_name'=>$request['first_name'],'last_name'=>$request['last_name'],'user_id'=>$user->id]);
        }
        \Auth::loginUsingId($user->id);
        return "true";
    }


    //////Candidate part
    public function candFullReg(Request $request)
    {
        return view('auth.full_candidate_reg');
    }

}