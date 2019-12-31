@extends('backend.layouts.default')
@section('content')
<!-- general form elements -->
<div class="box box-primary">
    @include('message')
    <div class="box-header with-border">
        <h3 class="box-title">Create Post</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" action="{{ route('backend.posts.store') }}" method="POST">
        @csrf
        @method('POST')
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_english" data-toggle="tab">English</a></li>
                <li><a href="#tab_korea" data-toggle="tab">Korea</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_english">
                    <div class="form-group">
                        <label>Title (EN)</label>
                        <input type="text" class="form-control" placeholder="Enter title" name="title-en">
                        @if ($errors->has('title-en'))
                        <span style="color: red" role="alert">
                            <strong>{{ $errors->first('title-en') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Content (EN)</label>
                        <textarea type="text" class="form-control" id="content-en" placeholder="Enter content"
                            name="content-en"></textarea>
                        @if ($errors->has('content-en'))
                        <span style="color: red" role="alert">
                            <strong>{{ $errors->first('content-en') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_korea">
                    <div class="form-group">
                        <label>Title (KR)</label>
                        <input type="text" class="form-control" placeholder="Enter title" name="title-kr">
                        @if ($errors->has('title-kr'))
                        <span style="color: red" role="alert">
                            <strong>{{ $errors->first('title-kr') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Content (KR)</label>
                        <textarea type="text" class="form-control" id="content-kr" placeholder="Enter content" name="content-kr"></textarea>
                        @if ($errors->has('content-kr'))
                        <span style="color: red" role="alert">
                            <strong>{{ $errors->first('content-kr') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" name="category_id">
                        <option value="" selected disabled hidden>Choose category</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('category_id'))
                        <span style="color: red" role="alert">
                            <strong>{{ $errors->first('category_id') }}</strong>
                        </span>
                    @endif
                </div>
                <!-- /.tab-pane -->
            </div>
            <div class="box-footer">
                <a href="{{ route('backend.posts.index') }}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary pull-right">Submit</button>
            </div>
            <!-- /.tab-content -->
        </div>
    </form>
    {{-- <form role="form">
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <input type="file" id="exampleInputFile">

                    <p class="help-block">Example block-level help text here.</p>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox"> Check me out
                    </label>
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form> --}}
</div>

@endsection
@push('scripts')
    <script>
        tinymce.init({
            selector: '#content-en',
            height: 350
        });

        tinymce.init({
            selector: '#content-kr',
            height: 350
        });
  </script>
@endpush
