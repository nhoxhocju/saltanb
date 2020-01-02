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
    <form role="form" action="{{ route('backend.posts.trashes.restore', $post->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_english" data-toggle="tab">English</a></li>
                <li><a href="#tab_korea" data-toggle="tab">Korea</a></li>
            </ul>
            <div class="tab-content">
                @foreach($postLanguages as $p)
                    @if($p->code == 'en')
                    <div class="tab-pane active" id="tab_english">
                        <div class="form-group">
                            <label>Title (EN)</label>
                            <input type="text" class="form-control" value="{{ $p->pivot->title }}" placeholder="Enter title" name="title-en" readonly>
                        </div>
                        <div class="form-group">
                            <label>Content (EN)</label>
                            <textarea type="text" class="form-control" id="content-en" placeholder="Enter content"
                                name="content-en">{{ $p->pivot->content }}
                            </textarea>
                        </div>
                    </div>
                    @endif
                @endforeach

                @foreach($postLanguages as $p)
                    @if($p->code == 'kr')
                    <div class="tab-pane" id="tab_korea">
                        <div class="form-group">
                            <label>Title (KR)</label>
                            <input type="text" class="form-control" value="{{ $p->pivot->title }}" placeholder="Enter title" name="title-kr" readonly>
                        </div>
                        <div class="form-group">
                            <label>Content (KR)</label>
                            <textarea type="text" class="form-control" placeholder="Enter content" id="content-kr" name="content-kr">{{ $p->pivot->content }}</textarea>
                        </div>
                    </div>
                    @endif
                @endforeach
                
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" name="category_id" disabled>
                        <option value="1" selected>{{ $post->category_name }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status" disabled>
                        <option value="1" selected>{{ $post->status }}</option>
                    </select>
                </div>

            </div>
            <div class="box-footer">
                <a href="{{ route('backend.posts.trashes.show_trash') }}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary pull-right">Restore</button>
            </div>
        </div>
    </form>
</div>

@endsection
@push('scripts')
    <script>
        tinymce.init({
            selector: '#content-en',
            height: 350,
            readonly: 1
        });

        tinymce.init({
            selector: '#content-kr',
            height: 350,
            readonly: 1
        });
  </script>
@endpush
