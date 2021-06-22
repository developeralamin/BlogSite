@extends('layouts.backend.app')

@section('title','Favorite Post')

@push('css')
 
 <!-- JQuery DataTable Css -->
    <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }} " rel="stylesheet">

@endpush


@section('content')

<div class="container-fluid">
            <div class="block-header">
    
            </div>
           
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                             <h2>
                            ALL Favorite Post
                            <span class="badge bg-blue">{{ $posts->count() }}</span>
                        </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th><i class="material-icons">favorite</i></th>
                                    {{--<th><i class="material-icons">comment</i><</th>--}}
                                    <th><i class="material-icons">visibility</i></th>
                                    <th>Action</th>
                        </thead>

   @foreach($posts as $key=>$post)

     <tbody>
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ Str::limit($post->title,'15') }}</td>
            <td>{{ $post->user->name }}</td>
            <td>{{ $post->favorite_to_users->count() }}</td>
            <td>{{ $post->view_count }}</td>
        
            <td>{{ $post->created_at }}</td>
            {{-- <td>{{ $post->updated_at }}</td> --}}
            
     <td class="text-center">

         <a href="{{ route('admin.post.show',$post->id) }}" class="btn btn-info waves-effect">
           <i class="material-icons">visibility</i>
        </a>
        <button class="btn btn-danger waves-effect" type="button" 
        onclick="removefavoritePost({{ $post->id }})" >
            <i class="material-icons">delete</i>
        </button>
    <form id="delete-form-{{$post->id}}" action="{{ route('post.favorite',$post->id)}} " method="POST" style="display: none;">
            @csrf
           
   </form>
    </td>
        </tr>

    </tbody>

         @endforeach()

                    </table>
                </div>
            </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>

 


@endsection

@push('js')
   <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <script src="{{ asset('assets/backend/js/pages/tables/jquery-datatable.js') }} "></script>

     <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>

    <script type="text/javascript">
        
        function removefavoritePost(id) {
        swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }

    </script>
@endpush