@extends('layouts.backend.app')

@section('title','Post')

@push('css')
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <a href="{{ route('admin.post.index') }}" class="btn btn-danger waves-effect">BACK</a>

        @if($post->is_approved == false)
           <button type="button" class="btn btn-success waves-effect pull-right"
           onclick="approvedPost({{ $post->id }})">
                <i class="material-icons">done</i>
                <span>Approved</span>
           </button>
           <form method="POST" action="{{ route('admin.approval.post',$post->id) }}" style="display: none" id="approvalid">
               @csrf
               @method('PUT')
           </form>


        @else
         <button type="button" class="btn btn-success pull-right" disabled>
                <i class="material-icons">done</i>
                 <span>Approved</span>
           </button>

        @endif

    </br>
    </br>
        <form action="{{ route('admin.post.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            {{ $post->title }}
                            <br>
                            <br>
                            <small>Posted By <strong> <a href="">{{ $post->user->name }}</a> on {{ $post->created_at->toFormattedDateString() }} </strong> </small>
                        </div>
                        <div class="body">
                            
                            {!! $post->body !!}

                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">

                    <div class="card">
                        <div class="header bg-amber">
                            <h2>
                                Categories 
                            </h2>
                        </div>
                        <div class="body">
                           @foreach($post->categories as $category)
                            <span class="label bg-cyan">{{ $category->name }}</span>
                           @endforeach
                        </div>
                    </div>

                     <div class="card">
                        <div class="header bg-green">
                            <h2>
                                Tags
                            </h2>
                        </div>
                        <div class="body">
                           @foreach($post->tags as $tag)
                            <span class="label bg-cyan">{{ $tag->name }}</span>
                           @endforeach
                        </div>
                    </div>

                     <div class="card">
                        <div class="header bg-amber">
                            <h2>
                                Featured Image
                            </h2>
                        </div>
                        <div class="body">
                            <img class="img-responsive thumbnail" 
                            src="{{ asset(Storage::disk('public')->url('post/'.$post->image))  }}" alt="">
                            {{-- {{ asset('uploads/item/'.$item->image) }} --}}
                        </div>
                    </div>


                </div>

            </div>
            
        </form>
    </div>
@endsection

@push('js')
    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <!-- TinyMCE -->
<script src="{{ asset('assets/backend/plugins/tinymce/tinymce.js') }}"></script>
  <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script>
        $(function () {
            //TinyMCE
            tinymce.init({
                selector: "textarea#tinymce",
                theme: "modern",
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{ asset('assets/backend/plugins/tinymce') }}';
        });

     function approvedPost(id) {
        swal({
                title: 'Are you sure?',
                text: "You want ot Approved this post",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Approved it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('approvalid').submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your Post is approved :)',
                        'info'
                    )
                }
            })
        }

    </script>

@endpush