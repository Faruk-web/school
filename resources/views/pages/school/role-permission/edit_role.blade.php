@extends('layouts.master')
@section('title')Edit Admin Roles @endsection
@section('body_content')

<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
      <h4 class="fw-bold">Edit Admin Roles</h4>
    </div>
  </div>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{url('/admin/update-admin-role/'.$role_info->id)}}" class="forms-sample" method="post" id="form_1">
                @csrf
                    <div class="mb-3">
                        <label for="example-text-input-alt"><span class="text-danger">*</span> Role Name</label>
                        <input type="text" class="form-control form-control-alt" value='{{str_replace(Auth::user()->s_code."#","", $role_info->name)}}' name="name" required>
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

@endsection
