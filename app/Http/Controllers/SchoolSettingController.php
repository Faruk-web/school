<?php

namespace App\Http\Controllers;

use App\Models\SchoolSetting;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Image;
class SchoolSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //school setting
        if(User::checkPermission('admin.setting') == true) {
            $s_code = Auth::user()->s_code;
            $school_info = SchoolSetting::where('code', $s_code)->first();
            $branches = DB::table('branch_settings')->where('s_code', Auth::user()->s_code)->get(['id', 'name', 'address']);
            return view('school.school_admin.school_setting', compact('school_info', 'branches'));
        }
        else{
            return Redirect()->back()->with('error', 'Sorry you can not access this page.');
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
        // dd($request);
        if(User::checkPermission('admin.setting') == true) {   
            $data = array();
            $school_code = Auth::user()->s_code;
            $school_info = SchoolSetting::where('code', $school_code)->first();
            $logo = $request->file('logo');
            if($logo){
                $name_gen = hexdec(uniqid()).".".$logo->getClientOriginalExtension();
                Image::make($logo)->resize(205, 65)->save('images/'.$name_gen);
                $last_img = 'images/'.$name_gen;
                $data['logo'] = $last_img;
                if($school_info->logo && is_file(public_path($school_info->logo))){
                    unlink($school_info->logo);
                }
            }
            $fav_icon = $request->file('fav_icon');
            if($fav_icon){
                $name_gen = hexdec(uniqid()).".".$fav_icon->getClientOriginalExtension();
                Image::make($fav_icon)->resize(205, 65)->save('images/'.$name_gen);
                $last_img = 'images/'.$name_gen;
                $data['fav_icon'] = $last_img;
                if($school_info->fav_icon  && is_file(public_path($school_info->fav_icon ))){
                    unlink($school_info->fav_icon );
                }
            }
             
            $data['code'] = $school_code; 
            $data['name'] = $request->name;
            $data['mail'] = $request->mail;
            $data['phone'] = $request->phone;
            $data['address'] = $request->address;
            $data['website'] = $request->website;
            $data['representative_name'] = $request->representative_name;
            $data['representative_phone'] = $request->representative_phone;
            $data['representative_email'] = $request->representative_email;
            $data['principal_name'] = $request->principal_name;
            $data['principal_email'] = $request->principal_email;
            $data['registration_date'] = $request->registration_date;
            $data['next_renew_date'] = $request->next_renew_date;
            $data['monthley_fee_amount'] = $request->monthley_fee_amount;
            $data['is_active'] = 0 ;
            $data['balance'] = 0 ;
            $data['sms_status'] = 0 ;
            if($school_info != '[]') {
                DB::table('school_settings')->where('code', $school_code)->update($data);
                return Redirect()->back()->with('success', 'Setting Updated Successfully');
            }
            else {
                // $data['created_at'] = Carbon::now();
                // $data['start_date'] = date('Y-m-d');
                // $data['shop_admin_id'] = $shop_id;
                // DB::table('shop_settings')->insert($data);
                // return Redirect()->back()->with('success', 'Setting Updated Successfully');
            }

        }
        else{
            return Redirect()->back()->with('error', 'Sorry you can not access this page.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SchoolSetting  $schoolSetting
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolSetting $schoolSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SchoolSetting  $schoolSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(SchoolSetting $schoolSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SchoolSetting  $schoolSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SchoolSetting $schoolSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SchoolSetting  $schoolSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolSetting $schoolSetting)
    {
        //
    }
}
