@extends('backend.layouts.default')
@section('content')
<!-- Content Wrapper. Contains post content -->
<div class="row">
    @include('message')
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">List Posts</h3>
                <a class="btn-sm btn-primary" href="{{ route('backend.posts.create') }}">Create Post</a>
                <div class="box-tools">
                    <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Created at</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($postsByLanguage as $post)
                    <tr>
                        <td>{{ $post->pivot->post_id }}</td>
                        <td>{{ $post->pivot->title }}</td>
                        <td>{{ $post->category_name }}</td>
                        <td>{{ $post->created_at }}</td>
                        <td>{{ $post->status }}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                    data-toggle="dropdown">Action</button>
                                <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                    data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a
                                            href="{{ route('backend.posts.edit', $post->id) }}">Edit</a></li>
                                    <li>
                                        <a data-url="{{ route('backend.posts.trash', $post->id) }}"
                                        data-content="<p class='modalBody'>{{ __('Are you sure you want move to trash this post???') }}</p>"
                                        data-title="<h3 class='modal-title'>{{ __('Move to trash') }}</h3>"
                                        data-button="<button class='btn btn-danger btn-submit-modal' type='submit'><i class='fa fa-trash'
                                            aria-hidden='true'></i>&nbsp;{{ __('Move to trash') }}</button>"
                                        data-method="PUT" data-toggle="modal"
                                        data-type="trash"
                                        href="#"
                                        data-target="#modal-trash">Move to trash
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
<div class="modal fade" id="modal-trash">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <form id="modalForm" action="" method="post">
                    @csrf
                    <input type="hidden" name="_method">
                    <input type="hidden" name="type">
                    {{-- @method("PUT") --}}
                    <div class="checkboxDiv"></div>
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@push('scripts')
<script>
    $(document).ready(function () {
        $('#modal-trash').on('hidden.bs.modal', function (e) {
            $('#modal-trash .modalBody').remove();
            $('#modal-trash .modal-title').remove();
            $('#modal-trash .btn-submit-modal').remove();
        });
        $('#modal-trash').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var url = button.data('url');
            var content = button.data('content');
            var title = button.data('title');
            var buttonSubmit = button.data('button');
            var method = button.data('method');
            var type = button.data('type');
            var arrayChecked = [];

            $('#modalForm').attr("action", url);
            $('#modal-trash .modal-body').append(content);
            $('#modal-trash .modal-header').append(title);
            $('#modalForm').append(buttonSubmit);
            $("#modalForm input[name=_method]").val(method);
            $("#modalForm input[name=type]").val(type);
        });
    });
</script>
@endpush
@endsection
