<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class crmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(User::checkPermission('admin.crm') == true){  
            $roles = DB::table('roles')->where('s_code', Auth::user()->s_code)->get();
            $branches = DB::table('branch_settings')->where('s_code', Auth::user()->s_code)->get(['id','name']);

            $crms = DB::table('users')
                    ->join('model_has_roles', 'users.id', 'model_has_roles.model_id')
                    ->select('users.*', 'model_has_roles.role_id')
                    ->where('users.s_code', Auth::user()->s_code)
                    ->where('users.type', '!=', 'owner')
                    ->get();
            
            return view('pages.school.crm.all_crm', compact('crms', 'roles', 'branches'));
        
        }
        else {
            return Redirect()->back()->with('error', 'Sorry you can not access this page');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(User::checkPermission('admin.crm') == true){
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'phone' => 'required|unique:users',
                'email' => 'required|unique:users',
                'password' => 'required|confirmed|min:8',
                
            ]);
        
            if ($validator->fails()) {
                Alert::error('Error', 'Error occurred!');
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = array();
            $data['s_code']= Auth::user()->s_code;
            $data['name']=$request->name;
            $data['branch_id']=$request->branch_id;
            $data['phone']=$request->phone;
            $data['email']=$request->email;
            $data['address']=$request->address;
            $data['type']=$request->type;
            $data['active']= 1;
            $data['password']=Hash::make($request->password);

            $insert = DB::table('users')->insert($data);

            if($insert) {
                $findUser = User::where('phone', $request->phone)->first();
                $role_data = array();
                $role_data['role_id'] = ($request->type == 'branch_user') ? $request->role_id : $request->admin_helper_role;
                $role_data['model_type'] = 'App\Models\User';
                $role_data['model_id'] = $findUser->id;
                $insert_role = DB::table('model_has_roles')->insert($role_data);

                if($insert_role) {
                    Alert::success('Success', 'CRM Added Successfully.');
                    return redirect()->back();
                }
                else {
                    Alert::error('Error', 'Error occurred! Please try again.');
                    return redirect()->back();
                }
                
            }
            else {
                Alert::error('Error', 'Error occurred! Please try again.');
                return redirect()->back();
            }
        }
        else {
            return Redirect()->back()->with('error', 'Sorry you can not access this page');
        }
    }
    
    public function reset_crm_password(Request $request)
    {
        if(User::checkPermission('admin.crm') == true){
            $validator = Validator::make($request->all(), [
                'password' => 'required|confirmed|min:8',
                
            ]);
        
            if ($validator->fails()) {
                Alert::error('Error', 'Error occurred!');
                return redirect()->back()->withErrors($validator)->withInput();
            }
            
            return Redirect()->back()->with('success', 'success');

            // $data = array();
            // $data['s_code']= Auth::user()->s_code;
            // $data['name']=$request->name;
            // $data['branch_id']=$request->branch_id;
            // $data['phone']=$request->phone;
            // $data['email']=$request->email;
            // $data['address']=$request->address;
            // $data['type']=$request->type;
            // $data['active']= 1;
            // $data['password']=Hash::make($request->password);

            // $insert = DB::table('users')->insert($data);

            // if($insert) {
                
                
            // }
            // else {
            //     return Redirect()->back()->with('error', 'Sorry you can not access this page');
            // }
        }
        else {
            return Redirect()->back()->with('error', 'Sorry you can not access this page');
        }
    }
    
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(User::checkPermission('admin.crm') == true){
            
            $roles = DB::table('roles')->where('s_code', Auth::user()->s_code)->get();
            $branches = DB::table('branch_settings')->where('s_code', Auth::user()->s_code)->get(['id','name']);
            
            $user_info = DB::table('users')
                        ->join('model_has_roles', 'users.id', 'model_has_roles.model_id')
                        ->select('users.*', 'model_has_roles.role_id')
                        ->where('users.s_code', Auth::user()->s_code)
                        ->where('users.id', $id)
                        ->first();

            return view('pages.school.crm.edit_crm', compact('user_info', 'roles', 'branches'));
            //return view('cms.shop_admin.crm.edit_crm', compact('user_info', 'roles', 'branches'));
        }
        else {
            return Redirect()->back()->with('error', 'Sorry you can not access this page');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(User::checkPermission('admin.crm') == true){
            $crm_info = User::find($id);
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'phone' => 'required|unique:users,phone,'.$crm_info->id,
                'email' => 'required|max:255|unique:users,email,'.$crm_info->id,
                
            ]);
        
            if ($validator->fails()) {
                Alert::error('Error', 'Error occurred!');
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = array();
            $data['name']=$request->name;
            $data['branch_id']= ($request->type == 'branch_user') ? $request->branch_id : null;
            $data['phone']=$request->phone;
            $data['email']=$request->email;
            $data['address']=$request->address;
            $data['type']=$request->type;
            
            $update_crm = User::where('id', $id)->update($data);

            if($update_crm) {

                $role_data = array(
                    'role_id' => ($request->type == 'branch_user') ? $request->role_id : $request->admin_helper_role,
                );
                $update_role = DB::table('model_has_roles')->where('model_id', $id)->update($role_data);

                Alert::success('Success', 'CRM Update Successfully.');
                return redirect()->route('admin.crm');
            }
            else {
                Alert::error('Error', 'Error occurred! Please try again.');
                return redirect()->back();
            }
        }
        else {
            return Redirect()->back()->with('error', 'Sorry you can not access this page');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //Begin:: Deactive CRM
    public function DeactiveCRM($id) {
        if(User::checkPermission('admin.crm') == true){
            $data = array(
                'active' => 0,
            );
            $Q = User::where('id', $id)->where('s_code', Auth::user()->s_code)->update($data);
            if($Q) {
                return redirect()->back()->with('success', 'CRM Deactive Successfully.');
            }
            else {
                return redirect()->back()->with('error', 'Error occurred! Please try again.');;
            }
        }
        else {
            return Redirect()->back()->with('error', 'Sorry you can not access this page');
        }

    }
    //End:: Deactive CRM

    //Begin:: Active CRM
    public function ActiveCRM($id) {
        if(User::checkPermission('admin.crm') == true){
            $data = array(
                'active' => 1,
            );

            $Q = User::where('id', $id)->where('s_code', Auth::user()->s_code)->update($data);
            if($Q) {
                return redirect()->back()->with('success', 'CRM Active Successfully.');;
            }
            else {
                return redirect()->back()->with('error', 'Error occurred! Please try again.');;
            }
        }
        else {
            return Redirect()->back()->with('error', 'Sorry you can not access this page');
        }

    }
    //End:: Active CRM

    
}
