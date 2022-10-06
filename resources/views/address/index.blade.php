{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">  Address
                    <div class="text-muted pt-2 font-size-sm"> Address Datatable</div>
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
                    <th>id</th> 
                    <th>User</th>
                    <th>City</th>
                    <th>Area</th>
                    <th>Street Name</th>
                    <th>Bulding Number</th>
                    <th>Floor Number</th>        
                 
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
                ajax: "{{ url('Address') }}",
                columns: [ 

                    {data: 'id', name: 'id'},
 
                    {data: 'user_id', name: 'user_id'},
                    {data: 'city_id', name: 'city_id'},                    
                    {data: 'area_id', name: 'area_id'},                    
                    {data: 'street_name', name: 'street_name'},  
                    {data: 'bulding_number', name: 'bulding_number'},    
                    {data: 'floor_number', name: 'floor_number'},                          
                        

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
                        url: "{{ url('items/delete') }}",
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
