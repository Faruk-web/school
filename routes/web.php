<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ShopSettingController;
use App\Http\Controllers\SchoolSettingController;
use App\Http\Controllers\BranchSettingController;
use App\Http\Controllers\crmController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TutorialController;
use App\Http\Controllers\Auth;


Route::get('/register/reseller', [AdminController::class, 'registration_form_reseller'])->name('reseller.referral.link');


Route::group(['middleware' => 'auth'], function () {

    //Begin:: Super Admin Route ----------------------->
    Route::get('/super-admin/pending-shop', [AdminController::class, 'pending_shop'])->name('super_admin.pending.shop');
    Route::get('/super-admin/pending-shop-data', [AdminController::class, 'pending_shop_data'])->name('super.admin.pending.shop.data');
    
    Route::get('/super-admin/activate-shop/{user_id}', [AdminController::class, 'active_shop_owner'])->name('super.admin.activate.shop');
    Route::get('/super-admin/active-shop', [AdminController::class, 'active_shop'])->name('super_admin.active.shop');
    Route::get('/super-admin/active-shop-data', [AdminController::class, 'active_shop_data'])->name('super.admin.active.shop.data');
    Route::get('/super-admin/deactivate-shop-owner/{user_id}', [AdminController::class, 'deactive_shop_owner'])->name('super.admin.deactive.shop');
    Route::get('/super-admin-shop-info/{shop_id}', [AdminController::class, 'super_admin_shop_info'])->name('super.admin.shop.info');
    //Route::post('/super-admin/set-renew-date', [BusinessRenewController::class, 'store'])->name('super.admin.set.renew.date');
    
    
    //super admin tutorials
    Route::get('/super-admin/all-tutorials', [TutorialController::class, 'index'])->name('super_admin.tutorials');
    Route::post('/super-admin/create-tutorials', [TutorialController::class, 'store'])->name('super.admin.create.tutorial');
    Route::get('/super-admin/edit-tutorial/{id}', [TutorialController::class, 'edit']);
    Route::post('/super-admin/update-tutorial/{id}', [TutorialController::class, 'update']);
    
    //super admin Resslers
    Route::get('/super-admin/all-resellers', [AdminController::class, 'resellers'])->name('super_admin.all.reseller');
    Route::get('/super-admin/all-resellers-data', [AdminController::class, 'resellers_data'])->name('super.admin.resellers.data');
    Route::post('/super-admin/store-reseller', [AdminController::class, 'resellers_store'])->name('super.admin.store.reseller');
    Route::get('/super-admin/edit-reseller/{id}', [AdminController::class, 'edit_reseller'])->name('super.admin.edit.reseller');
    Route::post('/super-admin/update-reseller/{id}', [AdminController::class, 'update_reseller'])->name('super.admin.update.reseller');
    Route::get('/reseller-pending-shop', [AdminController::class, 'reseller_pending_shop'])->name('reseller.pending.shop');
    Route::get('/reseller-pending-shop-data', [AdminController::class, 'reseller_pending_shop_data'])->name('reseller.pending.shop.data');
    Route::get('/reseller-active-shop', [AdminController::class, 'reseller_active_shop'])->name('reseller.active.shop');
    Route::get('/reseller-active-shop-data', [AdminController::class, 'reseller_active_shop_data'])->name('reseller.active.shop.data');
    
    Route::get('/reseller-shop-info/{shop_id}', [AdminController::class, 'reseller_shop_info'])->name('reseller.shop.info');
    

    

    //End:: Super Admin Route ----------------------->

    Route::get('/', [AdminController::class, 'Dashboard'])->name('/');

    //Begin:: my moments
    Route::get('/my-moments', [AdminController::class, 'my_moments'])->name('my.moments');
    Route::get('/my-moments-date', [AdminController::class, 'my_moments_date'])->name('my.moments.data');
    
    //Begin:: Support
    Route::get('/support', [AdminController::class, 'support'])->name('user.support');
    


    //Begin:: Shop Admin Route ----------------------->
    
        //Begin:: demo file download
        Route::get('/download/demo/{file_name}', function($file_name = null){
            $path = public_path().'/demo/'.$file_name;
            if (file_exists($path)) {
                return Response::download($path);
            }
            else {
                return Redirect()->back()->with('error', 'No such file exist, Please try again.');
            }
        })->name('download.demo.file');
        //End:: demo file download
    
    
        //Begin::Admin school Setting.
        Route::get('/admin/school-setting', [ShopSettingController::class, 'index'])->name('admin.shop_setting');
        Route::post('/admin/set-school-setting', [ShopSettingController::class, 'store'])->name('admin.set.shop_setting');
        Route::post('/admin/set-school-setting-customer-points', [ShopSettingController::class, 'admin_set_customer_points'])->name('admin.set.shop_setting.customer.point');
        Route::get('/admin/turorials', [ShopSettingController::class, 'shop_admin_tutorials'])->name('admin.tutorials');
        //End::Admin school Setting.
         //Begin::Admin school Setting.
         Route::get('/admin/school-setting', [SchoolSettingController::class, 'index'])->name('admin.school_setting');
         Route::post('/admin/set-school-setting', [SchoolSettingController::class, 'store'])->name('admin.set.school_setting');
         Route::post('/admin/set-school-setting-customer-points', [ShopSettingController::class, 'admin_set_customer_points'])->name('admin.set.shop_setting.customer.point');
         Route::get('/admin/turorials', [ShopSettingController::class, 'shop_admin_tutorials'])->name('admin.tutorials');
         //End::Admin school Setting.
        
        //Begin:: Admin Helper role and permission
        Route::get('/admin/helper-role-permission', [AdminController::class, 'Admin_helper_role_and_permission'])->name('admin.helper_role_permission');
        Route::post('/admin/create-helper-role', [AdminController::class, 'Admin_Create_helper_role'])->name('admin.create.roll');
        Route::get('/admin/edit-admin-role/{id}', [AdminController::class, 'Edit_Admin_helper_role']);
        Route::post('/admin/update-admin-role/{id}', [AdminController::class, 'Update_Admin_helper_role']);
        Route::get('/admin/admin-helper-role-permissions/{id}', [AdminController::class, 'admin_helper_permission']);
        Route::get('/admin/set-permission-to-admin-helper-role', [AdminController::class, 'set_permission_to_admin_helper_role']);
        Route::get('/admin/delete-permission-from-role', [AdminController::class, 'delete_permission_from_role']);
        
        //End::Admin Helper role and permission

        //Begin::Admin Branch role and permission
        Route::get('/admin/branch-role-permission', [BranchSettingController::class, 'Branch_role_and_permission'])->name('admin.branch.role');
        Route::post('/admin/create-branch-role', [BranchSettingController::class, 'Create_branch_role'])->name('admin.create.branch.roll');
        Route::get('/admin/edit-branch-role/{id}', [BranchSettingController::class, 'Edit_branch_user_role']);
        Route::post('/admin/update-branch-user-role/{id}', [BranchSettingController::class, 'Update_branch_user_role']);
        Route::get('/admin/branch-role-permissions/{id}', [BranchSettingController::class, 'branch_helper_permission']);
        //End::Admin Branch role and permission

        
        //Begin::Admin  Branch
        Route::get('/admin/all-branch', [BranchSettingController::class, 'index'])->name('admin.all.branch');
        Route::post('/admin/create-branch', [BranchSettingController::class, 'store'])->name('admin.create.branch');
        Route::get('/admin/edit-branch/{id}', [BranchSettingController::class, 'edit']);
        Route::post('/admin/update-branch/{id}', [BranchSettingController::class, 'update']);
        //End::Admin  Branch


        //Begin::Admin  CRM
        Route::get('/admin/all-crm', [crmController::class, 'index'])->name('admin.crm');
        Route::post('/admin/create-crm', [crmController::class, 'store'])->name('admin.create.crm');
        Route::get('/admin/edit-crm/{id}', [crmController::class, 'edit']);
        Route::post('/admin/update-crm/{id}', [crmController::class, 'update']);
        Route::get('/admin/deactive-crm/{id}', [crmController::class, 'DeactiveCRM']);
        Route::get('/admin/active-crm/{id}', [crmController::class, 'ActiveCRM']);
        Route::post('/admin/reset-crm-password', [crmController::class, 'reset_crm_password'])->name('admin.reset.crm.password');
        //End::Admin  CRM

      

        
        

    //End:: School Owner Route ------------------------->


        


    // End:: Shop Account and transaction Route ---------------------->



    

    // Begin:: Super Admin Route ---------------------->
    


    // End:: Super Admin Route ---------------------->


    



Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');





});

Route::get('/{code}', [ShopSettingController::class, 'shop_login']);



// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

