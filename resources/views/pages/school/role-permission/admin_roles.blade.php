@extends('layouts.master')
@section('title')Admin Roles @endsection
@section('body_content')

  <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
      <h4 class="fw-bold">Admin Roles</h4>
    </div>
    <div class="d-flex align-items-center flex-wrap text-nowrap">
      <button type="button" class="btn btn-primary btn-rounded" data-bs-toggle="modal" data-bs-target="#exampleModal">Add New Role</button>
    </div>
  </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table width="100%" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>Role Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php( $i = 1 )
                                @foreach($roles as $role)
                                <tr>
                                    <td>{{$i}}</em></td>
                                    <td>{{str_replace(Auth::user()->s_code."#","", $role->name)}}</em></td>
                                    <td width="25%">
                                        <a type="button" href="{{url('/admin/edit-admin-role/'.$role->id)}}" class="btn btn-primary btn-rounded btn-icon" data-toggle="tooltip" title="Edit"> <i data-feather="pen-tool"></i> </a>
                                        <a type="button" href="{{url('/admin/admin-helper-role-permissions/'.$role->id)}}" class="btn btn-danger btn-rounded" data-toggle="tooltip" title="Permissions">Permissions</a>
                                    </td>
                                </tr>
                                @php( $i += 1 )
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Admin Helper Role</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                            </div>
                            <div class="modal-body">
                            
                                <form action="{{route('admin.create.roll')}}" method="post" id="form_1" class="forms-sample">
									@csrf

                                    <div class="mb-3">
                                        <label for="form-label">Role Name</label>
                                        <input type="text" class="form-control" id="" required name="name" placeholder="Ex: Admin Manager">
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

@endsection
