@extends('layout.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Boards</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th>User</th>
                            <th>Members</th>
                            <th style="width: 40px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($boards as $board)
                            <tr>
                                <td>{{$board->id}}</td>
                                <td>{{$board->name}}</td>
                                <td>{{$board->name}}</td>
                                <td>{{$board->user_id}}</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-primary" type="button" data-user="{{json_encode($board)}}" data-toggle="modal" data-target="#edit-modal">
                                            <i class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-danger" type="button" data-user="{{json_encode($board)}}" data-toggle="modal" data-target="#delete-modal">
                                            <i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <div class="d-flex justify-content-center">
                    {!! $boards->links() !!}
                </div>
            </div>
        </div>
        <!-- /.card -->

        <div class="modal fade" id="edit-modal">
            <div class="modal-dialog">
                <form action="" method="POST">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit name</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="editName"></div>
                            <input type="hidden" name="editId" value="" />
                            <div class="form-group">
                                <label for="editRole">Role</label>
                                <select class="custom-select rounded-0" id="editRole">
                                    <option value="{{\App\Models\User::ROLE_USER}}">User</option>
                                    <option value="{{\App\Models\User::ROLE_ADMIN}}">Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <div class="modal fade" id="delete-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Default Modal</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>One fine body&hellip;</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

    </section>
    <!-- /.content -->
@endsection
