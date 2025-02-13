@extends('layouts.admin')
@section('title', 'Upload Images ')

@section('styles')

<style>
    .icon_class{
        font-size: 30px;
        margin: 7px;
    }
</style>

@endsection

@section('content')
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <!-- end page title -->
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Upload Images</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                    <li class="breadcrumb-item active">Upload Images<</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body p-4">
                                <form action="/admin/upload_file" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div>
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="image" class="form-label">Image</label>
                                                    <input class="form-control" type="file" 
                                                        id="image" name="image" required>
                                                </div>
                                                <div class="mb-3">
                                                    <button class="btn btn-primary" type="submit">Upload Image</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mt-3 mt-lg-0">
                                                <h5>FAQ</h5>
                                                <div class="accordion" id="accordionExample">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingOne">
                                                            <button class="accordion-button" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                                aria-expanded="true" aria-controls="collapseOne">
                                                                What is Upload Image?
                                                            </button>
                                                        </h2>
                                                        <div id="collapseOne" class="accordion-collapse collapse show"
                                                            aria-labelledby="headingOne"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <strong>This is your file manager to upload images in your system.</strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Image Name</th>
                                            <th>Preview</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($images as $gd)
                                        <tr>
                                            <td>{{ $gd->id }}</td>
                                            <td>{{ $gd->name}}</td>
                                            <td><img src="/uploads/{{ $gd->name}}" height="60px"/></td>
                                            <td>{{ $gd->uploaded_date}}</td>
                                            <td>
                                                <a href="/uploads/{{ $gd->name}}" class="text-lg" download="{{ $gd->name}}">
                                                    <i class="mdi mdi-download text-success text-lg icon_class"></i>
                                                </a>
                                                <span class="text-lg" onclick="navigator.clipboard.writeText('{{ env('APP_URL') }}/uploads/{{ $gd->name}}').then(() => alert('Text copied to clipboard'));">
                                                    <i class="mdi mdi-content-copy text-lg text-primary icon_class"></i>
                                                </span>
                                                <a href="/admin/uploads_remove_files?id={{ $gd->id}}" class="text-lg" >
                                                    <i class="mdi mdi-trash-can-outline text-danger text-lg icon_class"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        @endforeach

                                        

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> 
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->
    </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


    @include('dashboard.components.footer')
    </div>
    <!-- end main content-->
@endsection


@section('scripts')



    <script>
        $('#datatable').DataTable();
        $('#countries').select2({
            multiple: true,
        });
    </script>
@endsection
