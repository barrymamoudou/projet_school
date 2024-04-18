<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function UserView(){
        $data['alldata'] = User::where('usertype', 'Admin')->get();
        return view('backend.users.view_users',$data);
        
    }

    public function UserAdd(){
        return view('backend.users.add');
    }

    public function UserStore(Request $request){
        $validateDate = $request->validate([
            'email'=> 'required|unique:users',
            'name'=> 'required',
        ]);

        $data=new User();
        $code =rand(0000,9999);
        $data->role = $request->role;
        $data->usertype = 'Admin';
        $data->email = $request->email;
        $data->name = $request->name;
        $data->password = bcrypt($request->code);
        $data->code=$code;
        $data->save();
        $notification = array(
            'message' => 'Enregistrement reussir avec success',
            'alert-type' => 'success',
        );
        return redirect()->route('user.view')->with($notification);
        
    }

    public function UserEdit($id){

        $dataEdit = User::find($id);
        return view('backend.users.edit',compact('dataEdit'));
    }

    public function UserUpdate(Request $request,$id){
        $data=User::find($id);
        $data->email = $request->email;
        $data->name = $request->name;
        $data->role = $request->role;
        $data->save();
        $notification = array(
            'message' => 'Modification reussir avec success',
            'alert-type' => 'info',
        );
        return redirect()->route('user.view')->with($notification);
    }

    public function UserDelete($id){
        $user = User::find($id);
        $user->delete();
        $notification = array(
            'message' => 'Suppression reussir avec success !!',
            'alert-type' => 'info',
        );
        return redirect()->route('user.view')->with($notification);
    }

    // ici je ferais le code de rechercher les elements de la base de données

}
