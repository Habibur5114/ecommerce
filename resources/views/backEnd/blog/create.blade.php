@extends('backEnd.layouts.master')
@section('title','Users Create')
@section('css')
    <link href="{{asset('public/backEnd')}}/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/backEnd')}}/assets/css/switchery.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/backEnd')}}/assets/libs/summernote/summernote-lite.min.css" rel="stylesheet" type="text/css" />

@endsection
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{route('blogs.index')}}" class="btn btn-primary rounded-pill">Manage</a>
                    </div>
                    <h4 class="page-title">Blog Create</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('blogs.store')}}" method="POST" class=row data-parsley-validate=""  enctype="multipart/form-data">
                            @csrf
                            <form id="createForm" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="mb-3">
                                        <label for="service_title" class="form-label">Blog Author</label>
                                        <input type="text" value="{{Auth::user()->name}}" name="blog_author"  class="form-control" placeholder="Blog Author">
                                        @error('blog_author')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="service_title" class="form-label">Blog Title</label>
                                        <input type="text"  name="blog_title" class="form-control" placeholder="Blog Title" value="{{old('blog_title')}}" required>
                                        @error('blog_title')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="service_title" class="form-label">Blog Image</label>
                                        <input type="file"  name="blog_image" class="form-control" value="{{old('blog_title')}}" required>
                                        @error('blog_image')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="service_title" class="form-label">Blog Short Description</label>
                                        <textarea name="blog_short_desc" id=""  class="form-control" cols="30" rows="2" required>{{old('blog_title')}}</textarea>
                                        @error('blog_short_desc')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="service_title" class="form-label">Blog Long Description</label>
                                        <textarea name="blog_long_desc" id="blogDesc"  class="summernote form-control" cols="30" rows="10" required>{{old('blog_long_desc')}}</textarea>
                                        @error('blog_long_desc')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                            <div>
                                <input type="submit" class="btn btn-success" value="Submit">
                            </div>

                        </form>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
    </div>
@endsection


@section('script')
    <script src="{{asset('public/backEnd/')}}/assets/libs/parsleyjs/parsley.min.js"></script>
    <script src="{{asset('public/backEnd/')}}/assets/js/pages/form-validation.init.js"></script>
    <script src="{{asset('public/backEnd/')}}/assets/libs/select2/js/select2.min.js"></script>
    <script src="{{asset('public/backEnd/')}}/assets/js/pages/form-advanced.init.js"></script>
    <script src="{{asset('public/backEnd/')}}/assets/js/switchery.min.js"></script>
    <script src="{{asset('public/backEnd/')}}/assets/libs//summernote/summernote-lite.min.js"></script>
    <script>
        $(".summernote").summernote({
            placeholder: "Enter Your Text Here",
        });
        
        
        $(document).ready(function(){
            var elem = document.querySelector('.js-switch');
            var init = new Switchery(elem);
        });
    </script>
@endsection