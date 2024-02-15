<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    public function ProfileView(){
        //recupere l'utilisateur connecte
        if(Auth::user()->id != null)
        {
            $id=Auth::user()->id;
       
            $user=User::find($id);
            return view('backend.users.profile',compact('user'));
        } else {
            return redirect('auth.login');
        }
    }

    public function ProfileEdit(){
          //recupere l'utilisateur connecte
          $id=Auth::user()->id;
          $editData=User::find($id);
          return view('backend.users.edit_profile',compact('editData'));
    }

    public function ProfileStore(Request $request){
        $data=User::find(Auth::user()->id);
        $data->name = $request->name;
    	$data->email = $request->email;
    	$data->mobile = $request->mobile;
    	$data->address = $request->address;
    	$data->gender = $request->gender;

        if ($request->file('image')) {
    		$file = $request->file('image');
    		@unlink(public_path('upload/user_image/'.$data->image));
    		$filename = date('YmdHi').$file->getClientOriginalName();
    		$file->move(public_path('upload/user_image'),$filename);
    		$data['image'] = $filename;
    	}
    	$data->save();

    	$notification = array(
    		'message'=>'User Profile Updated Successfully',
    		'alert-type'=>'success'
    	);

    	return redirect()->route('profile.view')->with($notification);
    }
    public function PasswordView(){
        return view('backend.users.edit_password');
    }

    public function PasswordUpdate(Request $request){
        $validatedData = $request->validate([
    		'oldpassword' => 'required',
    		'password' => 'required|confirmed',
    	]);

        $recuperMotdepasse=Auth::user()->password;
        
        if(Hash::check($request->oldpassword,$recuperMotdepasse)){
          $user=User::find(Auth::id());
          $user->password=Hash::make($request->password);
          $user->save();
          Auth::logout();
          return redirect()->route('login');
        }else{
            return redirect()->back();
        }
       
    }

   
}
