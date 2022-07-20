@extends('admin.Layouts.layoutmaster')

@section('body')
    <div class="col-md-12 mt-1 mb-2"><button type="button" id="addNewBook" class="btn btn-success">Add</button>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">User Management</h4>
                    <div class="table-responsive">
                        <div class="scroll-wrap">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Gender</th>
                                        <th>Birthday</th>
                                        <th>More</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->gender == 1 ? 'male' : 'female' }}</td>
                                            <td>{{ $user->birthday }}</td>
                                            <td>
                                                <a href="javascript:void(0)" class="btn btn-primary edit"
                                                    data-id="{{ $user->id }}">Edit</a>
                                                <a href="javascript:void(0)" class="btn btn-primary delete"
                                                    data-id="{{ $user->id }}">Delete</a>
                                            </td>
                                        </tr>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- boostrap model -->
    <div class="modal fade" id="ajax-user-model" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxUserModel"></h4>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" id="addEditUserForm" name="addEditUserForm" class="form-horizontal"
                        method="POST">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="username"
                                    placeholder="Enter Book Name" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Enter your email" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Phone</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="phone" name="phone"
                                    placeholder="Enter your phone" value="" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Gender</label>
                            <div class="col-sm-12">
                                <label style="margin-right: 10px">male</label>
                                <input style="margin-right: 10px" type="radio" id="gender" name="gender"
                                    value="" required="">
                                <label style="margin-right: 10px">female</label>
                                <input type="radio" id="gender" name="gender" value="" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Birthday</label>
                            <div class="col-sm-12">
                                <input type="date" class="form-control" id="birthday" name="birthday"
                                    placeholder="Enter author Name" value="" required="">
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="btn-save" value="update-user">Save
                                changes
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <!-- end bootstrap model -->
    <script type="text/javascript">
        $(document).ready(function($) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#addNewBook').click(function() {
                $('#addEditUserForm').trigger("reset");
                $('#ajaxUserModel').html("Add Book");
                $('#ajax-user-model').modal('show');
            });

            $('body').on('click', '.edit', function() {
                var id = $(this).data('id');

                // ajax
                $.ajax({
                    type: "GET",
                    url: '/admin/user/' + id,
                    dataType: 'json',
                    success: function(res) {
                        $('#ajaxUserModel').html("Edit user");
                        $('#ajax-user-model').modal('show');
                        $('#id').val(res.id);
                        $('#btn-save').val(res.id);
                        $('#name').val(res.name);
                        $('#email').val(res.email);
                        $('#phone').val(res.phone);
                        $('#gender').val(res.gender);
                        $('#birthday').val(res.birthday);
                    }
                });
            });
            $('body').on('click', '.delete', function() {
                if (confirm("Delete Record?") == true) {
                    var id = $(this).data('id');

                    // ajax
                    $.ajax({
                        type: "DELETE",
                        url: '/admin/user/' + id,
                        success: function(res) {
                            window.location.reload();
                        }
                    });
                }
            });

            $('body').on('click', '#btn-save', function(e) {
                e.preventDefault();
                var id = $("#btn-save").val();
                var name = $("#name").val();
                var gender = $("#gender").val();
                var birthday = $("#birthday").val();
                var phone = $("#phone").val();
                console.log(id);
                // ajax
                $.ajax({
                    type: "PUT",
                    url: '/admin/user/' + id,
                    data: {
                        name: name,
                        gender: 1,
                        birthday: birthday,
                        phone: phone,
                        email: email,
                        status: 1,
                    },
                    dataType: 'json',
                    success: function(res) {
                        window.location.reload();
                        $("#btn-save").html('Submit');
                        $("#btn-save").attr("disabled", false);
                    }
                });
            });

        });
    </script>
    </div>
@endsection
