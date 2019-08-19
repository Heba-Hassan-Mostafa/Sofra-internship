<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Mail\ResetPassword;
use App\Models\Restaurant;
use App\Models\Token;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    // Register Restaurant

    public function register(Request $request)
    {

        // Restaurant Validation Rule
        $validation = validator()->make($request->all(), [

            'name' => 'required',
            'email' => 'required|unique:restaurants',
            'password' => 'required|confirmed',
            'phone' => 'required',
            'district_id' => 'required',
            'min_price' => 'required',
            'delivery_price' => 'required',
            'whatsapp_num' => 'required',
            'image' => 'required',
            'status' => 'required|in:open,close',

        ]);

        //Validation Error
        if ($validation->fails()) {
            return apiResponse(0, $validation->errors()->first(), $validation->errors());

        }
        //Encrypt Password
        $request->merge(['password' => bcrypt($request->password)]);

        // Create Clients
        $restaurant=Restaurant::create($request->all());
        //image
        if ($request->hasFile('image')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/meals/';    // upload path
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();    // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension;    // renaming image
            $image->move($destinationPath, $name);    // uploading file to given path
            $restaurant->update(['image' => 'uploads/items/' . $name]);
        }
            $restaurant->api_token = str::random(60);
        $restaurant->save();
        // dd($client);
        return apiResponse(1,'Successfully added',[
            'api_token'=> $restaurant-> api_token,
            'client'=>$restaurant
        ]);

    }



    //Login Restaurant
    public function login(Request $request)
    {

        $validation = validator()->make($request->all(), [
            'email' => 'required',
            'password' => 'required|confirmed'
        ]);

        $restaurant = Restaurant::where('email', $request->email)->first();
        if ($restaurant) {
            if (Hash::check($request->password, $restaurant->password)) {
                return apiResponse(1, 'Signed in', [
                    'api_token' => $restaurant->api_token,
                    'client' => $restaurant
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
        $restaurant=Restaurant::where('email',$request->email)->first();
        if ($restaurant){
            $code=rand(1111,9999);
            $update=$restaurant->update(['pin_code'=>$code]);
            if ($update){
                Mail::to($restaurant->email)
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
        $restaurant = Restaurant::where('pin_code', $request->pin_code)
            ->where('pin_code', '!=', 0)
            ->where('email', $request->email)->first();
        if ($restaurant) {
            $restaurant->password = bcrypt($request->password);
            $restaurant->pin_code = null;
            if ($restaurant->save()) {
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

            'email' => Rule::unique('restaurants')->ignore($request->user()->id),
            'password' => 'confirmed',
        ]);

        if ($validation->fails()){

            return apiResponse(0, $validation->errors()->first(), $validation->errors());

        }
        //Encrypt Password
        $request->merge(['password' => bcrypt($request->password)]);

        //update image
        if ($request->hasFile('image')) {
            if (file_exists($request->user()->photo)) {
                unlink($request->user()->image);
            }
            $path = public_path();
            $destinationPath = $path . '/uploads/restaurants/'; // upload path
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renaming image
            $image->move($destinationPath, $name); // uploading file to given path
            $request->user()->update(['photo' => 'uploads/restaurants/' . $name]);
        }
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
        $validation=validator()->make($request->all(),

            [
                'token'=>'required',

            ] );
        //Error Message
        if ($validation->fails()){
            $data=$validation->errors();
            return apiResponse(0,$validation->errors()->first(), $validation->errors(),$data);
        }
        Token::where('token',$request->token)->delete();

        return apiResponse(1,'Successfully deleted');

    }


    //contacts Function
    public function contacts(Request $request){
        // rules
        $validation = validator()->make($request->all(),
            [
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'message' => 'required',
                'note' => 'required|in:complain,suggestion,enquiry',

            ]);

        if ($validation->fails()) {
            return apiResponse(0, $validation->errors()->first(), $validation->errors());
        }

        //Create
        $contacts= $request->user()->contacts()->create($request->all());;

        return apiResponse(1,'success',$contacts);




    }


}
