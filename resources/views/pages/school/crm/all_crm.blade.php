@extends('layouts.master')
@section('title')CRM @endsection
@section('body_content')

  <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
      <h4 class="fw-bold">CRM</h4>
    </div>
    <div class="d-flex align-items-center flex-wrap text-nowrap">
      <button type="button" class="btn btn-primary btn-rounded" data-bs-toggle="modal" data-bs-target="#exampleModal">Add New CRM</button>
    </div>
  </div>

    <div class="row">
        <div class="col-md-12 text-danger">
            @if($errors->any())
                {!! implode('', $errors->all('<div class="text-danger">:message</div>')) !!}
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table width="100%" class="table table-bordered table-striped table-vcenter">
                            <thead>
                                <tr>
                                    <th width="5%">SI</th>
                                    <th width="25%">CRM Name</th>
                                    <th width="10%">Address</th>
                                    <th>Phone</th>
                                    <th>Type</th>
                                    <th>Role</th>
                                    <th width="8%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php( $i = 1 )
                                @foreach($crms as $crm)
                                @php( $role_name = DB::table('roles')->where('id', $crm->role_id)->first() )
                                <tr>
                                    <td>{{$i}}</em></td>
                                    <td>{{$crm->name}}</td>
                                    <td>{{$crm->address}}</td>
                                    <td>{{$crm->phone}}</td>
                                    <td>@if($crm->type == 'branch_user') 
                                        @php( $branch_info = DB::table('branch_settings')->where('id', $crm->branch_id)->where('s_code', Auth::user()->s_code)->first('name'))
                                        <span class="badge bg-primary">Branch User</span><br>
                                        <span style="font-size: 13px; color: #F50057;" class="text-bold">Branch Name: {{$branch_info->name}}</span>
                                        @elseif($crm->type == 'owner_helper') <span class="badge bg-danger">Admin Helper</span> @endif</td>
                                    <td>{{str_replace(Auth::user()->s_code."#","", $role_name->name)}}</td>
                                    <td>
                                        <a type="button" href="{{url('/admin/edit-crm/'.$crm->id)}}" class="btn btn-primary btn-rounded btn-icon" data-toggle="tooltip" title="Edit"> <i data-feather="pen-tool"></i> </a>
                                        @if($crm->active == 1)
                                            <a type="button" href="{{url('/admin/deactive-crm/'.$crm->id)}}" class="btn btn-rounded btn-sm btn-success" data-toggle="tooltip" title="CRM is active now, click to deactive">Active</a>
                                        @else
                                            <a type="button" href="{{url('/admin/active-crm/'.$crm->id)}}" class="btn btn-rounded btn-sm btn-warning" data-toggle="tooltip" title="CRM is deactive now, click to active">Deactive</a>
                                        @endif
                                        <!--<button type="button" onclick="reset_password('{{$crm->name}}', '{{$crm->id}}')" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#password_reset_modal">Reset Password</button>-->
    
                                    </td>
                                </tr>
                                @php( $i += 1 )
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New CRM</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('admin.create.crm')}}" method="post" id="form_1" class="forms-sample">
									@csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="example-text-input"> <span class="text-danger">*</span>CRM Name</label>
                                                <input type="text" class="form-control" id="" required name="name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="example-text-input"><span class="text-danger">*</span>CRM Email</label>
                                                <input type="text" class="form-control" id="" required name="email">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="example-text-input"><span class="text-danger">*</span>CRM Address</label>
                                                <input type="text" class="form-control" id="" required name="address">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="example-text-input"><span class="text-danger">*</span>CRM Phone Number</label>
                                                <input type="text" class="form-control" maxlength="11" minlength="11" required name="phone">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="example-text-input"><span class="text-danger">*</span>Password (min: 8)</label>
                                                <input type="password" class="form-control" id="password" required name="password">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="example-text-input"><span class="text-danger">*</span>Confirm Password</label>
                                                <input type="password" class="form-control" id="confirm_password" required name="password_confirmation">
                                                <span class="text-danger d-none" id="password_not_matched">Password Not Matched</span>
                                                <span class="text-success d-none" id="password_matched">Password Matched</span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3 shadow rounded p-2">
                                                <label class=""><span class="text-danger">*</span>CRM Type</label>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="custom-control-input" id="type_owner_helper" value="owner_helper" required name="type">
                                                    <label class="custom-control-label" for="type_owner_helper">Admin Helper</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="custom-control-input" id="type_branch_user" value="branch_user" name="type">
                                                    <label class="custom-control-label" for="type_branch_user">Branch User</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 pb-3">
                                            <div class="mb-3 shadow p-3 d-none" id="admin_helper_role_div">
                                                <label for="admin_helper_role">Select a Role</label>
                                                <select class="form-control" id="admin_helper_role" name="admin_helper_role">
                                                    <option value="">-- Select One --</option>
                                                    @foreach($roles as $admin_role)
                                                        @if($admin_role->which_roll == 'admin')
                                                            <option value="{{$admin_role->id}}">{{str_replace(Auth::user()->s_code."#","", $admin_role->name)}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="row shadow p-3 d-none" id="branch_user_parent_div">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="branch_id">Select a Branch</label>
                                                        <select class="form-control" id="branch_id" name="branch_id">
                                                            <option value="">-- Select Branch --</option>
                                                            @foreach($branches as $branch)
                                                            <option value="{{$branch->id}}">{{$branch->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="branch_user_role">Select a Role</label>
                                                        <select class="form-control" id="branch_user_role" name="role_id">
                                                            <option value="">-- Select role --</option>
                                                            @foreach($roles as $branch_role)
                                                                @if($branch_role->which_roll == 'branch')
                                                                    <option value="{{$branch_role->id}}">{{str_replace(Auth::user()->s_code."#","", $branch_role->name)}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary mr-1" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" onclick="form_submit(1)" id="submit_button_1">Submit</button>
                                        <button type="button" disabled class="btn btn-outline-success" style="display: none;" id="processing_button_1">Processing....</button>
                                    </div>
								</form>
                            </div>
                        </div>
                        </div>
                    </div>
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
        
        
        function reset_password(crm_name, id) {
            $('#password_reset_crm_id').val(id);
            $('#password_reset_crm_name').text(crm_name);
            
        }
        
    </script>

@endsection
