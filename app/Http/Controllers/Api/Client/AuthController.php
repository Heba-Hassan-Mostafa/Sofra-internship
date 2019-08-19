<?php

namespace App\Http\Controllers\Api\Client;

use App\Models\Client;
use App\Mail\ResetPassword;
use App\Models\Restaurant;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;


class AuthController extends Controller
{
    // Register Client

    public function register(Request $request)
    {

        // Client Validation Rule
        $validation = validator()->make($request->all(), [

            'name' => 'required',
            'email' => 'required|unique:clients',
            'password' => 'required|confirmed',
            'phone' => 'required',
            'district_id' => 'required',
        ]);

        //Validation Error
        if ($validation->fails()) {
            return apiResponse(0, $validation->errors()->first(), $validation->errors());

        }
        //Encrypt Password
        $request->merge(['password' => bcrypt($request->password)]);

        // Create Clients
        $client=Client::create($request->all());
        $client->api_token = str::random(60);

        $client->save();
       // dd($client);
        return apiResponse(1,'Successfully added',[
            'api_token'=> $client-> api_token,
            'client'=>$client
        ]);

    }



    //Login Client
    public function login(Request $request)
    {

        $validation = validator()->make($request->all(), [
            'email' => 'required',
            'password' => 'required|confirmed'
        ]);

        $client = Client::where('email', $request->email)->first();
        if ($client) {
            if (Hash::check($request->password, $client->password)) {
                return apiResponse(1, 'Signed in', [
                    'api_token' => $client->api_token,
                    'client' => $client
                ]);
            } else {
                return apiResponse(0, 'The login data is incorrect');
            }
        } else {
            return apiResponse(0, 'The login data is incorrect');
        }
    }


       // RestPassword
        public function resetPassword(Request $request){

        $validation=validator()->make($request->all(),[

            'email'=>'required'
        ]);

        if ($validation->fails()){
            return apiResponse(0,$validation->errors()->first(),$validation->errors());
        }
        $client=Client::where('email',$request->email)->first();
        if ($client){
            $code=rand(1111,9999);
            $update=$client->update(['pin_code'=>$code]);
            if ($update){
                Mail::to($client->email)
                    ->bcc('bebamohammed0@gmail.com')
                    ->send(new ResetPassword($code));
                return apiResponse(1,'Check Your Phone',['pin_code_for_test'=>$code]);
            }
            else{
                return apiResponse(0,'There Is An Error Occurred,Try Again');
            }
        }
        else{
            return apiResponse(0,'There is no account associated with this Email');
        }




        }

        // New Password

    public function newPassword(Request $request)
    {
        $validation = validator()->make($request->all(), [

            'email' => 'required',
            'pin_code' => 'required',
            'password' => 'required|confirmed',
        ]);

        if ($validation->fails()) {

            return apiResponse(0, $validation->errors()->first(), $validation->errors());
        }
        $client = Client::where('pin_code', $request->pin_code)
            ->where('pin_code', '!=', 0)
            ->where('email', $request->email)->first();
        if ($client) {
            $client->password = bcrypt($request->password);
            $client->pin_code = null;
            if ($client->save()) {
                return apiResponse(1, 'Password Changed successfully');
            } else {
                return apiResponse(0, 'There Is An Error Occurred,Try Again');
            }
        } else {
            return apiResponse(0, 'This Code Is Invalid');
        }

    }

    //Change Profile
    public function profile(Request $request){

        $validation=validator()->make($request->all(),[

            'email' => Rule::unique('clients')->ignore($request->user()->id),
            'password' => 'confirmed',
        ]);

        if ($validation->fails()){

            return apiResponse(0, $validation->errors()->first(), $validation->errors());

        }
        //Encrypt Password
        $request->merge(['password' => bcrypt($request->password)]);
        //Update Clients
        $user = request()->user();
        $user->update($request->all());
        return apiResponse(1, 'Modified Successfully', [
            'api_token' => $user->api_token,
            'client' => $user
        ]);
    }

    // Register Token
    public function registerToken(Request $request)
    {
      $validation=validator()->make($request->all(),[

          'plateform'=>'required|in:android,ios',
          'token'=>'required'

      ]);

        if ($validation->fails()){
            $data=$validation->errors();
            return apiResponse(0,$validation->errors()->first(), $validation->errors(),$data);
        }
        Token::where('token',$request->token)->delete();
        $request->user()->tokens()->create($request->all());
        return apiResponse(1,'Successfully Registered');

    }

    // Remove Tokens
    public function removeToken(Request $request)
    {
        $validation = validator()->make($request->all(),

            [
                'token' => 'required',

            ]);
        //Error Message
        if ($validation->fails()) {
            $data = $validation->errors();
            return apiResponse(0, $validation->errors()->first(), $validation->errors(), $data);
        }
        Token::where('token', $request->token)->delete();

        return apiResponse(1, 'Successfully deleted');
    }



     }
