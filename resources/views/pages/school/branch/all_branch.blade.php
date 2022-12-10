@extends('layouts.master')
@section('title')All Branch @endsection
@section('body_content')


<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
      <h4 class="fw-bold">All Branch</h4>
    </div>
    <div class="d-flex align-items-center flex-wrap text-nowrap">
      <button type="button" class="btn btn-danger btn-rounded" data-bs-toggle="modal" data-bs-target="#exampleModal">Add New Branch</button>
    </div>
  </div>

    <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                
                <div class="table-responsive">
                    <table width="100%" class="table table-bordered table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th width="5%">SI</th>
                                <th>Branch Name</th>
                                <th>Address</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php( $i = 1 )
                            @foreach($branches as $branch)
                            <tr>
                                <td>{{$i}}</em></td>
                                <td>{{$branch->name}}</td>
                                <td>{{$branch->address}}</td>
                                <td width="25%">
                                    <a type="button" href="{{url('/admin/edit-branch/'.$branch->id)}}" class="btn btn-primary btn-rounded btn-icon" data-toggle="tooltip" title="Edit"> <i data-feather="pen-tool"></i> </a>
                                    <!--<button type="button" class="btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Permissions">Info</button>-->
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
                        <h5 class="modal-title" id="exampleModalLabel">Add New Branch</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                        </div>
                        <div class="modal-body">
                        
                            <form action="{{route('admin.create.branch')}}" method="post" id="form_1" class="forms-sample">
                                @csrf
                                <div class="mb-3">
                                    <label for="form-label">Branch Name</label>
                                    <input type="text" class="form-control" id="" required name="branch_name" placeholder="Ex: Branch Name">
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
            $('input[type=radio][name=vat_status]').on('change', function() {
                var vat_rate_parent = document.getElementById("vat_rate_parent_div");

                if($(this).val() == 'yes') {
                    vat_rate_parent.classList.remove("d-none");
                    $('#vat_rate').val('');
                    $("#vat_rate").prop('required', true);
                }
                else {
                    vat_rate_parent.classList.add("d-none");
                    $('#vat_rate').val('');
                    $("#vat_rate").prop('required', false);
                }
            });
        </script>
@endsection
