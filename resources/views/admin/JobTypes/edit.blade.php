@extends('front.layouts.app')

@section('content')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.job_types') }}">Job Types</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                @include('admin.sidebar')
            </div>
            <div class="col-lg-9">
                @include('front.message')
                <div class="card border-0 shadow mb-4">
                    <div class="card-body card-form">
                        <form action="" method="post" id="updateJobType" name="updateJobType">
                            @csrf
                            <div class="card-body  p-4">
                                <h3 class="fs-4 mb-1">Job Type / Edit</h3>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Name <span class="text-danger">*</span></label>
                                    <input type="text" value="{{ $job_type->name }}" name="name" id="name" placeholder="Enter category Name" class="form-control">
                                    <p></p>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option {{ ($job_type->status == 1) ? 'selected' : '' }} value="1">Active</option>
                                        <option {{ ($job_type->status == 0) ? 'selected' : '' }} value="0">Block</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer  p-4">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('customJs')
    <script type="text/javascript">


$("#updateJobType").submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "put",
            url: "{{ route('admin.job_types.update',$job_type->id) }}",
            data: $("#updateJobType").serializeArray(),
            dataType: "json",
            success: function (response) {
                if(response.status == true){

                    $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    window.location.href="{{ route('admin.job_types') }}";

                }else{

                    var errors = response.errors;
                    // For name
                    if(errors.name){
                        $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.name);
                    }else{
                        $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }

                }
            }
        });

    });

    </script>
@endsection
