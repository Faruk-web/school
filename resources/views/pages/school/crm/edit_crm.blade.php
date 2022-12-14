@extends('layouts.master')
@section('title')Edit CRM @endsection
@section('body_content')

<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
      <h4 class="fw-bold">Edit CRM</h4>
    </div>
  </div>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{url('/admin/update-crm/'.$user_info->id)}}" class="forms-sample" method="post" id="form_1">
                @csrf
                    
                    <div class="row">
                        <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="example-text-input">CRM Name</label>
                                    <input type="text" value="{{$user_info->name}}" class="form-control" id="" required name="name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="example-text-input">CRM Email</label>
                                    <input type="text" class="form-control" id="" value="{{$user_info->email}}" required name="email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="example-text-input">CRM Address</label>
                                    <input type="text" class="form-control" id="" value="{{$user_info->address}}" required name="address">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="example-text-input">CRM Phone Number</label>
                                    <input type="text" class="form-control" value="{{$user_info->phone}}" maxlength="11" minlength="11" required name="phone">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="mb-4 shadow rounded border p-2">
                                    <label class="">CRM Type</label>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" @if($user_info->type == 'owner_helper') checked @endif class="custom-control-input" id="type_owner_helper" value="owner_helper" required name="type">
                                        <label class="custom-control-label" for="type_owner_helper">Admin Helper</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio"  @if($user_info->type == 'branch_user') checked @endif class="custom-control-input" id="type_branch_user" value="branch_user" name="type">
                                        <label class="custom-control-label" for="type_branch_user">Branch User</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 pb-3">
                                <div class="mb-4 shadow p-3 @if($user_info->type != 'owner_helper') d-none @endif" id="admin_helper_role_div">
                                    <label for="admin_helper_role">Select a Role</label>
                                    <select class="form-control" id="admin_helper_role" name="admin_helper_role">
                                        <option value="">-- Select One --</option>
                                        @foreach($roles as $admin_role)
                                            @if($admin_role->which_roll == 'admin')
                                                <option @if($admin_role->id == $user_info->role_id) selected class="bg-success text-light" @endif  value="{{$admin_role->id}}">{{str_replace(Auth::user()->s_code."#","", $admin_role->name)}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row shadow p-3 @if($user_info->type != 'branch_user') d-none @endif" id="branch_user_parent_div">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="branch_id">Select a Branch</label>
                                            <select class="form-control" id="branch_id" name="branch_id">
                                                <option value="">-- Select Branch --</option>
                                                @foreach($branches as $branch)
                                                <option @if($branch->id == $user_info->branch_id) selected class="bg-success text-light" @endif value="{{$branch->id}}">{{$branch->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="branch_user_role">Select a Role</label>
                                            <select class="form-control" id="branch_user_role" name="role_id">
                                                <option value="">-- Select role --</option>
                                                @foreach($roles as $branch_role)
                                                    @if($branch_role->which_roll == 'branch')
                                                        <option @if($branch_role->id == $user_info->role_id) selected class="bg-success" @endif value="{{$branch_role->id}}">{{str_replace(Auth::user()->s_code."#","", $branch_role->name)}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" onclick="form_submit(1)" id="submit_button_1">Save</button>
                        <button type="button" disabled class="btn btn-success" style="display: none;" id="processing_button_1">Processing....</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
    $('input[type=radio][name=type]').on('change', function() {
        var admin_helper_role_div = document.getElementById("admin_helper_role_div");
        var branch_user_parent_div = document.getElementById("branch_user_parent_div");
        

        if($(this).val() == 'owner_helper') {
            admin_helper_role_div.classList.remove("d-none");
            branch_user_parent_div.classList.add("d-none");
            
            $("#admin_helper_role").prop('required', true);
            $("#branch_user_role").prop('required', false);
            $("#branch_id").prop('required', false);
            
        }
        else if($(this).val() == 'branch_user'){
            admin_helper_role_div.classList.add("d-none");
            branch_user_parent_div.classList.remove("d-none");
            
            $("#admin_helper_role").prop('required', false);
            $("#branch_user_role").prop('required', true);
            $("#branch_id").prop('required', true);
        }
    });

    $("#confirm_password").on("change paste keyup cut select", function() {
        var password_matched = document.getElementById("password_matched");
        var password_not_matched = document.getElementById("password_not_matched");

        var password = $('#password').val();
        var confirm_password = $('#confirm_password').val();
        if(password == confirm_password && password != '') {
            password_matched.classList.remove("d-none");
            password_not_matched.classList.add("d-none");
        }
        else if(password == '' || confirm_password == ''){
            password_matched.classList.add("d-none");
            password_not_matched.classList.add("d-none");
        }
        else {
            password_matched.classList.add("d-none");
            password_not_matched.classList.remove("d-none");
        }
    });


</script>

@endsection
