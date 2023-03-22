<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\User;
use App\Models\Order;
use App\Models\Review;

use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    //Profile Page
    public function profilePage(){
        return view('admin.account.profilePage');
    }

    //Profile Edit Page
    public function profileEditPage(){
        return view('admin.account.profileEditPage');
    }

    //Profile Edit
    public function ProfileEdit(Request $request){

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

        return redirect()->route('account#profilePage');
    }

    // Change Password Page
    public function changePasswordPage(){
        return view('admin.account.changePasswordPage');
    }

    // Change Password
    public function changePassword(Request $request){

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

    //Admin List Page
    public function adminListPage(){
        $key  = request('searchKey');

        $admins = User::when($key,function($query){

            $key  = request('searchKey');

            $query->where('name','like','%' .$key. '%');

        })->where('role','admin')->paginate(3);

        $admins->appends(request()->query());

        return view('admin.account.adminListPage',compact('admins'));
    }

    //Admin Role Change Page
    public function adminRoleChangePage(Request $request){
        $admin = User::where('id',$request->id)->get();
        return view('admin.account.adminRoleChangePage',compact('admin'));
    }

    //Admin Role Change
    public function adminRoleChange(Request $request){
        $data = $this->admin_user_RoleChangeData($request);
        User::where('id',$request->id)->update($data);
        return redirect()->route('account#adminListPage');
    }

    //Admin Delete
    public function adminDelete(Request $request){
        $imageName = User::select('image')->where('id',$request->id)->get()->toArray();
        $imageName = $imageName[0]['image'];

        if($imageName != null){
            Storage::delete('public/' .$imageName);
        }

        User::where('id',$request->id)->delete();
        return redirect()->route('account#adminListPage');
    }

    //User List Page
    public function userListPage(){

        $key  = request('searchKey');

        $users = User::when($key,function($query){

            $key  = request('searchKey');

            $query->where('name','like','%' .$key. '%');

        })->where('role','user')->paginate(3);

        $users->appends(request()->query());

        return view('admin.account.userListPage',compact('users'));
    }

    //User Role Change Page
    public function userRoleChangePage(Request $request){
        $user = User::where('id',$request->id)->get();
        return view('admin.account.userRoleChangePage',compact('user'));
    }

    //User Role Change
    public function userRoleChange(Request $request){
        $data = $this->admin_user_RoleChangeData($request);
        User::where('id',$request->id)->update($data);
        return redirect()->route('account#userListPage');
    }

    //User Delete
    public function userDelete(Request $request){
        $imageName = User::select('image')->where('id',$request->id)->get()->toArray();
        $imageName = $imageName[0]['image'];

        if($imageName != null){
            Storage::delete('public/' .$imageName);
        }

        User::where('id',$request->id)->delete();
        // If the user account is deleted, his the related data will also be deleted
        Review::where('user_id',$request->id)->delete();
        Order::where('user_id',$request->id)->delete();
        OrderList::where('user_id',$request->id)->delete();

        return redirect()->route('account#userListPage');
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

    // Admin_User Role Change Data
    private function admin_user_RoleChangeData($request){
        return[
            'role'=> $request->changeRole
        ];
    }
}
