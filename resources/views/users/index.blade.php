{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">  Users
                    <div class="text-muted pt-2 font-size-sm"> Users Datatable</div>
                </h3>
            </div>
          
        </div>

        <div class="card-body">
            @if ($message = Session::get('success'))
            <div id="alert" class="alert alert-custom alert-notice alert-light-success fade show" role="alert">
                <!-- <div class="alert-icon"><i class="flaticon-warning"></i></div> -->
                <div class="alert-text">{{ $message }}</div>
                <div class="alert-close">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="ki ki-close"></i></span>
                    </button>
                </div>
            </div>
            @endif
            <table class="table table-bordered table-hover main_datatable" id="kt_datatable">
                <thead>
                <tr>
                    <th>ID</th> 
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Login Type</th>
                    <th>Image Path</th>
                    <th>Language</th>
                    <th>is online</th>           
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                </tbody>

            </table>

        </div>


        

    </div>

@endsection

{{-- Styles Section --}}
@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection


{{-- Scripts Section --}}
@section('scripts')
    {{-- vendors --}}
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    

    {{-- page scripts --}}
    <script type="text/javascript">
        $(function () {

            var table = $('.main_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('Users') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'full_name', name: 'full_name'},
                    {data: 'email', name: 'email'},                    
                    {data: 'login_type', name: 'login_type'},   
                    {
                        "data": "image_path",
                        "render": function (data) {
                                if(data != ''){
                                    // return '<img src="{{asset("/media/users/blank.png")}}" class="avatar" width="50" height="50"/>';
                                    return '<img src=" {{asset("uploads/Users")}}/' + data + '" class="avatar" width="50" height="50"/>';
                                }else{
                                    return '<img src="https://zee-fashion.com/uploads/logo_zee.png" class="avatar" width="50" height="50"/>';
                                }
                            
                            }
                    },   

                     {
                        "data": "language_id",
                        "render": function (data) {
                                if(language_id ='1'){
                                    // return '<img src="{{asset("/media/users/blank.png")}}" class="avatar" width="50" height="50"/>';
                                    return 'English';
                                }else{
                                    return 'Arabic';
                                }
                            
                            }
                    }, 

                    {
                        "data": "is_online",
                        "render": function (data) {
                                if(is_online ='1'){
                                    // return '<img src="{{asset("/media/users/blank.png")}}" class="avatar" width="50" height="50"/>';
                                    return 'Yes';
                                }else{
                                    return 'No';
                                }
                            
                            }
                    }, 
                    {data: 'action', name: 'action', orderable: false, searchable: false},
               
                   
                ]
            });
        });

        

        $('body').on('click', '.delete', function () {
            var id = $(this).data('id');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!"
            }).then(function(result) {
                if (result.value) {

                    // ajax
                    $.ajax({
                        type:"POST",
                        url: "{{ url('Users/delete') }}",
                        data:{
                            'id': id,
                            '_token': '{{ csrf_token() }}',
                        },
                        dataType: 'json',
                        success: function(res){
                        // success: function(res){
                        // success: function(res){
                            $('.main_datatable').DataTable().ajax.reload();
                        }
                    });
                    Swal.fire(
                        "Deleted!",
                        "Your file has been deleted.",
                        "success"
                    );
                }
            });
        });
    </script>
    <!-- @if ($message = Session::get('success')) -->
    <script>
        // $('#alert').show();
        //     setTimeout(function() {
        //         $('#alert').hide();
        // }, 5000);
     </script>
    <!-- @endif -->
@endsection
