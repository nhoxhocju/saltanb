@extends('backend.layouts.default')
@section('content')
<!-- general form elements -->
<div class="box box-primary">
    <br>
    @include('message')
    <div class="box-header with-border">
        <h3 class="box-title">Create Post</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" action="{{ route('backend.posts.update', $postLanguage[0]->pivot->post_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_english" data-toggle="tab">English</a></li>
                <li><a href="#tab_korea" data-toggle="tab">Korea</a></li>
            </ul>
            <div class="tab-content">
                @foreach($postLanguage as $post)
                @if($post->code == 'en')
                <div class="tab-pane active" id="tab_english">
                    <div class="form-group">
                        <label>Title (EN)</label>
                        <input type="text" class="form-control" value="{{ $post->pivot->title }}" placeholder="Enter title" name="title-en">
                        @if ($errors->has('title-en'))
                        <span style="color: red" role="alert">
                            <strong>{{ $errors->first('title-en') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Content (EN)</label>
                        <textarea type="text" class="form-control" id="content-en" placeholder="Enter content"
                            name="content-en">{{ $post->pivot->content }}
                        </textarea>
                        @if ($errors->has('content-en'))
                        <span style="color: red" role="alert">
                            <strong>{{ $errors->first('title-en') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                @endif
                @endforeach

                @foreach($postLanguage as $post)
                @if($post->code == 'kr')
                <div class="tab-pane" id="tab_korea">
                    <div class="form-group">
                        <label>Title (KR)</label>
                        <input type="text" class="form-control" value="{{ $post->pivot->title }}" placeholder="Enter title" name="title-kr">
                        @if ($errors->has('title-kr'))
                        <span style="color: red" role="alert">
                            <strong>{{ $errors->first('title-kr') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Content (KR)</label>
                        <textarea type="text" class="form-control" placeholder="Enter content" id="content-kr" name="content-kr">{{ $post->pivot->content }}</textarea>
                        @if ($errors->has('content-kr'))
                        <span style="color: red" role="alert">
                            <strong>{{ $errors->first('content-kr') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                @endif
                @endforeach
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" name="category_id">
                        @foreach ($categories as $category)
                        @if($category->id == $idCategoryOfPost)
                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                        @else
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                        @foreach ($listStatus as $status)
                        
                        @if($status['id'] == $idStatusOfPost)
                        <option value="{{ $status['id'] }}" selected>{{ $status['name'] }}</option>
                        @else
                        <option value="{{ $status['id'] }}">{{ $status['name'] }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="box-footer">
                <a href="{{ route('backend.posts.index') }}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary pull-right">Submit</button>
            </div>
        </div>
    </form>
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
