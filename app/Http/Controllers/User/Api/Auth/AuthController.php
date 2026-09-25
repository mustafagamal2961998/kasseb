<?php

namespace App\Http\Controllers\User\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\LoginRequest;
use App\Http\Requests\User\Auth\RegisterRequest;
use App\Http\Requests\User\Auth\SendOtpRequest;
use App\Http\Resources\User\User\UserResource;
use App\Http\Requests\User\Auth\CheckOtpRequest;
use App\Http\Requests\User\Auth\UpdatePasswordRequest;
use App\Models\User;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;


class AuthController extends Controller
{
    public function login(LoginRequest $request){

        $user = User::where('phone',$request->phone)->first();

        if(!Auth::attempt(['phone'=>$request->phone,'password'=>$request->password])){
            return response()->json([
                'data'=>[
                 'message'=>'خطآ : في تسجيل الدخول',
                 ],
                 'statusCode'=>422
             ]);
        }
        
        

        if($user->status!='active'){
            return response()->json([
                'data'=>[
                    'message'=>'عفوآ حسابك غير مفعل',
                 ],
                 'statusCode'=>422
             ]);
        }
        
        $token = $user->createToken('authToken')->plainTextToken;
        
        return response()->json(['data'=>[
            'access_token' => $token, 
            'token_type' => 'Bearer',
            'user_data'=> new UserResource($user),
        ],'statusCode'=>200]);
    }


    public function register(RegisterRequest $request){
        

        $store = User::create($request->all());
        $store->profile()->create($request->all());
        if($request->hasFile('avatar')){
            $store->addMedia($request->file('avatar'))
                  ->toMediaCollection('avatar');
        }else{
            $store->copyMedia(public_path('assets/media/dashboard/avatar.png'))->toMediaCollection('avatar');
        }
        $getUser = User::with('addresses')->find($store->id);
    //   // Generate 6-digit OTP (does not start with 0)
    //     $otp = rand(100000, 999999);
    
    //     // Save OTP (example)
    //     $getUser->otp = $otp;
    //     $getUser->save();
    //     $this->whatsAppSendOtp($store->phone,$otp);
        // هنا تبعت الـ OTP SMS أو WhatsApp
        // sendSms($getUser->phone, $otp);
    
        return response()->json([
            'message' => 'تم إرسال ال OTP',
            'status'=>true
        ]);
        
           $address = Address::create([
                'user_id' => $store->id,
                'address' => $request->address,
                'lat' => $request->lat,
                'lng' => $request->lng,
            ]);
        // $token = $getUser->createToken('authToken')->plainTextToken;
        
        // return response()->json(['data'=>[
        //     'access_token' => $token, 
        //     'token_type' => 'Bearer',
        //     'user_data'=> new UserResource($getUser),
        // ],'statusCode'=>200]);

    }
    
    public function sendOtp(SendOtpRequest $request)
    {
        
        $getUser = User::where('phone', $request->phone)->first();
    
        if (!$getUser) {
            return response()->json([
                'message' => 'الحساب غير موجود',
                'status'=>false
            ], 404);
        }
    
        // Generate 6-digit OTP (does not start with 0)
        $otp = rand(100000, 999999);
    
        // Save OTP (example)
        $getUser->otp = $otp;
        $getUser->save();
        $this->whatsAppSendOtp($request->phone,$otp);
        // هنا تبعت الـ OTP SMS أو WhatsApp
        // sendSms($getUser->phone, $otp);
    
        return response()->json([
            'message' => 'تم إرسال ال OTP',
            'status'=>true
        ]);
    }
    
    public function checkOtp(CheckOtpRequest $request){
        $getUser = User::where('phone',$request->phone)->where('otp',$request->otp)->first();
        
        if(!$getUser){
            return response()->json([
                'message' => 'حدث خطأ',
                'status'=>false
            ], 404);
        }
        $getUser->update([
            'status'=>'active',
            ]);
            
            $token = $getUser->createToken('authToken')->plainTextToken;
        
        return response()->json(['data'=>[
            'access_token' => $token, 
            'token_type' => 'Bearer',
            'user_data'=> new UserResource($getUser),
             'status'=>true
        ]]);
        // return response()->json([
        //     'status'=>true
        // ]);
    }
    
    private function whatsAppSendOtp($phone,$otp){
        
    //   $response = Http::withHeaders([
    //         'token' => env('WAPILOT_TOKEN'),
    //         'Content-Type' => 'application/json',
    //         ])->post('https://api.wapilot.net/api/v2/'.env('INSTANCE_ID').'/send-message', [
    //                 'chat_id' => "2".$phone,
    //                 'text' => "🔐 رمز التفعيل الخاص بك هو:\n\n{$otp}\n\nيُرجى عدم مشاركته مع أي شخص.",
    //         ]);
    
    
        $params=array(
            'token' => env('WAPILOT_TOKEN'),
            'to' => '2'.$phone,
            'body' => "🔐 رمز التفعيل الخاص بك هو:\n\n{$otp}\n\nيُرجى عدم مشاركته مع أي شخص.",
        );
        
        $client = new Client();
        $headers = [
          'Content-Type' => 'application/x-www-form-urlencoded'
        ];
        $options = ['form_params' =>$params ];
        $request = new Request('POST', 'https://api.ultramsg.com/'.env('INSTANCE_ID').'/messages/chat', $headers);
        $res = $client->sendAsync($request, $options)->wait();

    }
    
    public function updatePassword(UpdatePasswordRequest $request){
        $getUser = User::where('phone',$request->phone)->first();
        $getUser->password = Hash::make($request->password);
        $getUser->save();
        return response()->json([
            'message' => ' تم تغيير كلمة المرور بنجاح',
            'status'=>true
        ]);
    }

}
