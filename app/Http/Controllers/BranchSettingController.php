<?php

namespace App\Http\Controllers;
use App\Models\Branch_setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use function PHPUnit\Framework\isNull;



class BranchSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(User::checkPermission('branch') == true){
            $branches = branch_setting::where('s_code', Auth::user()->s_code)->get();
            return view('pages.school.branch.all_branch', compact('branches'));
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
        if(User::checkPermission('branch') == true){
            $data = array();
            $data['s_code'] = Auth::user()->s_code;
            $data['name'] = $request->branch_name;
            
            $data['created_at'] = Carbon::now();
            
            $insert = DB::table('branch_settings')->insert($data);

            if($insert) {
                DB::table('moments_traffics')->insert(['s_code' => Auth::user()->s_code, 'user_id' => Auth::user()->id, 'info' => 'Add New Branch(Branch Name: '.$request->branch_name.')', 'created_at' => Carbon::now()]);
                Alert::success('Success', 'New Branch has been created.');
                return Redirect()->back();
            }
            else {
                Alert::warning('Warning', 'Something is wrong, please try again.');
                return Redirect()->back();
            }
        }
        else {
            return Redirect()->back()->with('error', 'Sorry you can not access this page');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\branch_setting  $branch_setting
     * @return \Illuminate\Http\Response
     */
    public function show(branch_setting $branch_setting)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\branch_setting  $branch_setting
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(User::checkPermission('branch') == true){
            $wing = 'main';
            $branch_info = branch_setting::where('id', $id)->where('s_code', Auth::user()->s_code)->first();
            return view('cms.shop_admin.branch.edit_branch', compact('branch_info', 'wing'));
        }
        else {
            return Redirect()->back()->with('error', 'Sorry you can not access this page');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\branch_setting  $branch_setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(User::checkPermission('branch') == true){
            $data = array();
            $data['branch_name'] = $request->branch_name;
            $data['branch_address'] = $request->branch_address;
            $data['branch_phone_1'] = $request->branch_phone_1;
            $data['branch_phone_2'] = $request->branch_phone_2;
            $data['branch_email'] = $request->branch_email;
            $data['vat_status'] = $request->vat_status;
            $data['vat_rate'] = $request->vat_rate;
            $data['discount_type'] = $request->discount_type;
            $data['online_sell_status'] = $request->online_sell_status;
            $data['sell_note'] = $request->sell_note;
            $data['others_charge'] = $request->others_charge;
            $data['sms_status'] = $request->sms_status;
            $data['print_by'] = $request->default_printer;
            $data['updated_at'] = Carbon::now();
            
            $update = DB::table('branch_settings')->where('id', $id)->update($data);
            if($update) {
                DB::table('moments_traffics')->insert(['s_code' => Auth::user()->s_code, 'user_id' => Auth::user()->id, 'info' => 'Update Branch(Name: '.$request->branch_name.') Info', 'created_at' => Carbon::now()]);
                Alert::success('Success', 'Branch has been updated successfully.');
                return Redirect()->route('admin.all.branch');
            }
            else {
                Alert::warning('Warning', 'Something is wrong, please try again.');
                return Redirect()->back();
            }
        }
        else {
            return Redirect()->back()->with('error', 'Sorry you can not access this page');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\branch_setting  $branch_setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(branch_setting $branch_setting)
    {
        //
    }

    //Begin:: Branch user role and permission
    public function Branch_role_and_permission() {
        if(User::checkPermission('branch.role.permission') == true){
            $roles = DB::table('roles')->where('s_code', Auth::user()->s_code)->where('which_roll', 'branch')->get();
            return view('pages.school.branch.branch_roles', compact('roles'));            
        }
        else {
            return Redirect()->back()->with('error', 'Sorry you can not access this page');
        }
    }
    //End:: Branch user role and permission


    //Begin:: Create Branch user role
    public function Create_branch_role(Request $request) {
        if(User::checkPermission('branch.role.permission') == true){
            $role_name = Auth::user()->s_code.'#'.$request->name;
            $check = DB::table('roles')->where('name', $role_name)->first();
            if(!empty($check->id)) {
                return Redirect()->back()->with('error', 'This role is already exist!');
            }
            else {
                $data = array();
                $data['name'] = $role_name;
                $data['which_roll'] = 'branch';
                $data['guard_name'] = 'web';
                $data['s_code'] = Auth::user()->s_code;
                $data['created_at'] = Carbon::now();

                $insert = DB::table('roles')->insert($data);
                if($insert) {
                    DB::table('moments_traffics')->insert(['s_code' => Auth::user()->s_code, 'user_id' => Auth::user()->id, 'info' => 'Added New Branch Role(role name: '.$request->name.')', 'created_at' => Carbon::now()]);
                    return Redirect()->back()->with('success', 'New role has been created.');
                }
                else {
                    return Redirect()->back()->with('error', 'Error Occoured, Please Try again.');
                }
            }
        }
        else {
            return Redirect()->back()->with('error', 'Sorry you can not access this page');
        }
    }
    //End:: Create Branch user role

    //Begin:: Edit Branch user role
    public function Edit_branch_user_role($id) {
        if(User::checkPermission('branch.role.permission') == true){
            $role_info = DB::table('roles')->where('id', $id)->where('s_code', Auth::user()->s_code)->first();
            if(!empty($role_info->id)) {
                $wing = 'main';
                return view('cms.shop_admin.branch.edit_branch_role', compact('role_info', 'wing'));
            }
            else {
                Alert::warning('Warning', 'Sorry! You can not access this role');
                return Redirect()->back();
            }
        }
        else {
            return Redirect()->back()->with('error', 'Sorry you can not access this page');
        }
        
    }
    //Begin:: Edit Branch user role

    //Begin:: Update Branch user role
    public function Update_branch_user_role(Request $request, $id) {
        if(User::checkPermission('branch.role.permission') == true){
            $role_name = Auth::user()->s_code.'#'.$request->name;
            $check = DB::table('roles')->where('name', $role_name)->first();
            if(!empty($check->id)) {
                Alert::warning('Warning', 'Sorry, This role is already exist!');
                return Redirect()->back();
            }
            else {
                $data = array();
                $data['name'] = $role_name;
                $data['updated_at'] = Carbon::now();
                $update = DB::table('roles')->where('id', $id)->update($data);
                if($update) {
                    DB::table('moments_traffics')->insert(['s_code' => Auth::user()->s_code, 'user_id' => Auth::user()->id, 'info' => 'Update Branch User Role(role name: '.$request->name.')', 'created_at' => Carbon::now()]);
                    return Redirect()->route('admin.branch.role')->with('success', 'Role has been Updated.');
                }
                else {
                    return Redirect()->back()->with('error', 'Error Occoured, Please Try again.');
                }
                
            }
        }
        else {
            return Redirect()->back()->with('error', 'Sorry you can not access this page');
        }
    }
    //Begin:: Update Branch user role

    //Begin:: Branch role Permission
    public function branch_helper_permission($id) {
        if(User::checkPermission('branch.role.permission') == true){
            $role = Role::findById($id);
            $permissions = Permission::all();
            $permissionGroups = User::getPermissionGroupsForBranchUser();
            return view('pages.school.branch.branch_user_role_permission', compact('permissions', 'permissionGroups', 'role'));
        }
        else {
            return Redirect()->back()->with('error', 'Sorry you can not access this page');
        } 
    }
    //End:: Branch role Permission

    //Begin:: Branch Setting Index
    public function branch_setting_index() {
        if(User::checkPermission('branch.setting') == true){
            $branch_info = branch_setting::where('id', Auth::user()->branch_id)->first();
            $wing = 'main';
            return view('cms.branch.branch_info.setting', compact('branch_info', 'wing'));
        }
        else {
            return Redirect()->back()->with('error', 'Sorry you can not access this page');
        }
    }
    //End:: Branch Setting Index

    //Begin:: Branch Setting Update
    public function branch_setting_update(Request $request) {
        if(User::checkPermission('branch.setting') == true){
            $data = array();
            $data['vat_status'] = $request->vat_status;
            $data['vat_rate'] = $request->vat_rate;
            $data['discount_type'] = $request->discount_type;
            $data['online_sell_status'] = $request->online_sell_status;
            $data['sell_note'] = $request->sell_note;
            $data['others_charge'] = $request->others_charge;
            $data['sms_status'] = $request->sms_status;
            $data['print_by'] = $request->default_printer;
            $data['updated_at'] = Carbon::now();

            $update = branch_setting::where('id', Auth::user()->branch_id)->update($data);
            if($update) {
                DB::table('moments_traffics')->insert(['s_code' => Auth::user()->s_code, 'user_id' => Auth::user()->id, 'info' => 'Updated Branch Settings', 'created_at' => Carbon::now()]);
                return Redirect()->back()->with('success', 'Setting update successfully.');
            }
            else {
                Redirect()->back()->with('error', 'Something is wrong, Please try again.');
            }
        }
        else {
            return Redirect()->back()->with('error', 'Sorry you can not access this page');
        }
    }
    //End:: Branch Setting Update








}
