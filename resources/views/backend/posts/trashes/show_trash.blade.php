@extends('backend.layouts.default')
@section('content')
<!-- Content Wrapper. Contains post content -->
<div class="row">
    @include('message')
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">List Posts Trashed</h3>
                {{-- <a class="btn-sm btn-primary" href="{{ route('backend.posts.create') }}">Create Post</a> --}}
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
                        <th>Deleted at</th>
                        <th>Delete by</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($postsTrashedOfLanguage as $post)
                    <tr>
                        <td>{{ $post->pivot->post_id }}</td>
                        <td>{{ $post->pivot->title }}</td>
                        <td>{{ $post->category_name }}</td>
                        <td>{{ $post->deleted_at }}</td>
                        <td>{{ $post->deleted_by }}</td>
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
                                            href="{{ route('backend.posts.trashes.preview_post_trashed', $post->id) }}">Preview</a></li>
                                    <li>
                                        <a data-url="{{ route('backend.posts.trashes.restore', $post->id) }}"
                                        data-content="<p class='modalBody'>{{ __('Are you sure you want restore this post???') }}</p>"
                                        data-title="<h3 class='modal-title'>{{ __('Restore') }}</h3>"
                                        data-button="<button class='btn btn-danger btn-submit-modal' type='submit'><i class='fa fa-trash'
                                            aria-hidden='true'></i>&nbsp;{{ __('Restore') }}</button>"
                                        data-method="PUT" data-toggle="modal"
                                        data-type="restore"
                                        data-id="{{ $post->id }}"
                                        href="#"
                                        data-target="#modal">Restore
                                        </a>
                                    </li>
                                    <li>
                                        <a data-url="{{ route('backend.posts.delete', $post->id) }}"
                                        data-content="<p class='modalBody'>{{ __('Are you sure you want delete forever this post???') }}</p>"
                                        data-title="<h3 class='modal-title'>{{ __('Delete') }}</h3>"
                                        data-button="<button class='btn btn-danger btn-submit-modal' type='submit'><i class='fa fa-trash'
                                            aria-hidden='true'></i>&nbsp;{{ __('Delete') }}</button>"
                                        data-method="DELETE" data-toggle="modal"
                                        data-type="delete"
                                        data-id="{{ $post->id }}"
                                        href="#"
                                        data-target="#modal">Permanently Delete
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
<div class="modal fade" id="modal">
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
                    <input type="hidden" name="id">
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
        $('#modal').on('hidden.bs.modal', function (e) {
            $('#modal .modalBody').remove();
            $('#modal .modal-title').remove();
            $('#modal .btn-submit-modal').remove();
        });
        $('#modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var url = button.data('url');
            var content = button.data('content');
            var title = button.data('title');
            var buttonSubmit = button.data('button');
            var method = button.data('method');
            var type = button.data('type');
            var id = button.data('id');
            var arrayChecked = [];

            $('#modalForm').attr("action", url);
            $('#modal .modal-body').append(content);
            $('#modal .modal-header').append(title);
            $('#modalForm').append(buttonSubmit);
            $("#modalForm input[name=_method]").val(method);
            $("#modalForm input[name=type]").val(type);
            $("#modalForm input[name=id]").val(id);
        });
    });
</script>
@endpush
@endsection
