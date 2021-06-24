@extends('layouts.backend.app')

@section('title','Comments')

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
                            COMMENTS
                            <span class="badge bg-blue">{{ $comments->count() }}</span>
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
                                   
                                    <th>Comments Inf0</th>
                                    <th>Post Info</th>
                                    <th>Action</th>
                        </thead>

   @foreach($comments as $key=>$comment)

     <tbody>
        <tr>
            
            <td>
                <div class="media">
                    <div class="media-left">
                        <a href="#">
                            <img src="{{ Storage::disk('public')->url('profile/'.$comment->user->image) }}" width="60" height="60" alt="">
                        </a>
                    </div>

                     <div class='media-body'>
                        <a class="name" href="#"><b>{{ $comment->user->name }}</b></a>
                 <h6 class="date">on {{ $comment->created_at->diffForHumans()}}</h6>
                   <p>{{ $comment->comment }}</p>
 <a target="_blank" href="{{ route('post.details',$comment->post->slug.'#comments') }}">Reply</a>
            </div> 
                </div>
            </td>
    
    <td>
    <div class="media">
        <div class="media-right">
            <a target="_blank" href="{{ route('post.details',$comment->post->slug) }}">
                <img class="media-object" src="{{ Storage::disk('public')->url('post/'.$comment->post->image) }}" width="64" height="64">
            </a>
        </div>
        <div class="media-body">
            <a target="_blank" href="{{ route('post.details',$comment->post->slug) }}">
                <h4 class="media-heading">{{ Str::limit($comment->post->title,'40') }}</h4>
            </a>
            <p>by <strong>{{ $comment->post->user->name }}</strong></p>
        </div>
    </div>
    </td>
           
            
             <td class="text-center">

                    <button class="btn btn-danger waves-effect" type="button" 
                    onclick="removeCommentPost({{ $comment->id }})" >
                        <i class="material-icons">delete</i>
                    </button>
                <form id="delete-form-{{ $comment->id}}" action="{{ route('admin.comment.destroy',$comment->id)}} " method="POST" style="display: none;">
                        @csrf
                       @method('DELETE')
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
        
        function removeCommentPost(id) {
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