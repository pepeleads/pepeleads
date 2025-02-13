@extends('layouts.horizontal_layout_client')
@section('title','Notifications ')

@section('content')

<div class="main-content ">
    <div class="page-content ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-end mb-3">
                       
                    </div>
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Manage Notifications</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Notifications</a></li>
                                <li class="breadcrumb-item active">Notifications</li>
                            </ol>
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
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($notifications as $notification)
                                    <tr>
                                        <td>{{$notification->id}}</td>
                                        <td>{{$notification->notification_title}}</td>
                                        <td>
                                            {{$notification->notification_description}}
                                            @if($notification->notification_link) -
                                            <a href="{{$notification->notification_link}}" target="_blank">View Link</a>
                                            @endif
                                        </td>
                                        <td>{{$notification->created_at}}</td>
                                       
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('dashboard.components.footer')
</div>

@endsection


@section('scripts')
<script>
    $('#datatable').DataTable({
        order: [[0, 'desc']]
    });
    $(document).on('click', '.view_password', function() {
        $('.password_' + $(this).data('id')).attr('type', 'text');
        $(this).addClass('hide_password');
        $(this).removeClass('view_password');
        $(this).html('<i class="mdi mdi-eye-off-outline"></i>')
    })
    $(document).on('click', '.hide_password', function() {
        $('.password_' + $(this).data('id')).attr('type', 'password');
        $(this).addClass('view_password');
        $(this).removeClass('hide_password');
        $(this).html('<i class="mdi mdi-eye-outline"></i>')
        // alert($(this).data('id'))
    })
</script>
@endsection