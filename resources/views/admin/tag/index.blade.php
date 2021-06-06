@extends('layouts.backend.app')

@section('title','Tag')

@push('css')
 
 <!-- JQuery DataTable Css -->
    <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }} " rel="stylesheet">

@endpush


@section('content')

<div class="container-fluid">
            <div class="block-header">
                <a class="btn btn-primary waves-effect" href="{{ route('admin.tags.create') }}">
                <i class="material-icons">add</i>
                <span>Add New Tag</span>
            </a>
            </div>
           
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                             <h2>
                            ALL TAGS
                            <span class="badge bg-blue">{{ $tags->count() }}</span>
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
                            <tr>
                                
                                <th>SL.</th>
                                <th>Name</th>
                                {{-- <th>Slug</th> --}}
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Actions</th>
                            
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>SL.</th>
                                <th>Name</th>
                                {{-- <th>Slug</th> --}}
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>

                        @foreach($tags as $key=>$tag)

    <tbody>
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $tag->name }}</td>
            {{-- <td>{{ $tag->slug }}</td> --}}
            <td>{{ $tag->created_at }}</td>
            <td>{{ $tag->updated_at }}</td>
            
     <td class="text-center">
        <a href="{{ route('admin.tags.edit',$tag->id) }}" class="btn btn-info waves-effect">
            <i class="material-icons">edit</i>
        </a>
        <button class="btn btn-danger waves-effect" type="button" >
            <i class="material-icons">delete</i>
        </button>
  <form id="delete-form" action="" method="POST" style="display: none;">
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
@endpush