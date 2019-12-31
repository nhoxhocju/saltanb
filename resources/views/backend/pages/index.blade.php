@extends('backend.layouts.default')
@section('content')
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">List pages</h3>

                        <div class="box-tools">
                            <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control pull-right"
                                    placeholder="Search">

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
                                <th>Name</th>
                                <th>Created at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($pages as $page)
                            <tr>
                                <td>{{ $page->id }}</td>
                                <td>{{ $page->name }}</td>
                                <td>{{ $page->created_at }}</td>
                                <td><span class="label label-{{($page->is_static == 'Can fix') ? 'success' : 'danger    '}}">{{ $page->is_static }}</span></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown">Action</button>
                                        <button type="button" class="btn btn-sm btn-info dropdown-toggle"
                                            data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ route("pages.$page->url_page") }}" target="_blank">View</a></li>
                                            <li><a href="{{ route('backend.grapesjs.edit', $page->id) }}">Edit</a></li>
                                            {{-- <li><a href="#">Delete</a></li> --}}
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

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
