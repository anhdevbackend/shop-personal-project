<?php

namespace App\Http\Controllers\User;

use Storage;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class userAccountController extends Controller
{
    //Profile Page
    public function userProfilePage(){
        return view('user.account.userProfilePage');
    }

    //Profile Edit Page
    public function userProfileEditPage(){
        return view('user.account.userProfileEditPage');
    }

    //Profile Edit
    public function userProfileEdit(Request $request){

        $this->checkProfileEditValidation($request);
        $data = $this->profileEditData($request);

        if($request->hasfile('userProfile')){

            $oldImageName = User::select('image')->where('id',$request->userId)->first()->toarray();
            $oldImageName = $oldImageName['image'];

            if($oldImageName != null){
                Storage::delete('public/' . $oldImageName);
            }

            $imageName = uniqid() . $request->file('userProfile')->getClientOriginalName();

            $request->file('userProfile')->storeAs('public',$imageName);

            $data['image']=$imageName;

            User::where('id',$request->userId)->update($data);
        }else{
            User::where('id',$request->userId)->update([
                'name'=> $request->userName,
                'email'=> $request->userEmail,
                'phone'=> $request->userPhone,
                'address'=> $request->userAddress
            ]);
        }

        return redirect()->route('account#userProfilePage');
    }

     // Change Password Page
     public function userChangePasswordPage(){
        return view('user.account.changePasswordPage');
    }

     // Change Password
     public function userChangePassword(Request $request){

        $this->checkValidationChangePassword($request);

        $userOldPassword = $request->oldPassword;
        $DatabaseOldPassword = Auth::user()->password;
        $userId =Auth::user()->id;

        if( Hash::check($userOldPassword , $DatabaseOldPassword) == true){

            $changePassword = $this->changePasswordData($request);

            User::where('id',$userId)->update($changePassword);

            Auth::logout();
            return redirect()->route('auth#loginPage');
        }
    }

    // Check Profile Edit Validation
    private function checkProfileEditValidation($request){
        Validator::make($request->all(),[
            'userProfile' => 'mimes:jpeg,jpg,wepb,png',
            'userName' => 'required|max:50',
            'userEmail' => 'required|max:30',
            'userPhone' => 'required|max:15',
            'userAddress' => 'required',
        ])->validate();
    }

    // Get Profile Edit Data
    private function profileEditData($request){
        return[
            'name'=> $request->userName,
            'email'=> $request->userEmail,
            'image'=> $request->userProfile,
            'phone'=> $request->userPhone,
            'address'=> $request->userAddress
        ];
    }

    // Check Change Password Validation
    private function checkValidationChangePassword($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:8',
            'newPassword' => 'required|min:8',
            'comfirmPassword' => 'required|min:8|same:newPassword'
        ])->validate();
    }

    // Change Password Data
    private function changePasswordData($request){
        $userNewPassword = $request->newPassword;

        return[
            'password'=> Hash::make($userNewPassword)
        ];
    }

}
