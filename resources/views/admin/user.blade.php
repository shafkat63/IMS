@extends('layout.app')
@section('main')

    <h4 class="py-3 mb-2">User List</h4>
    <nav class="navbar navbar-example navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="javascript:void(0)"></a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbar-ex-3"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbar-ex-3">
                <div class="navbar-nav me-auto">
                    <a class="nav-item nav-link active" href="javascript:void(0)">User Setup</a>
                </div>

                <form onsubmit="return false">
                    <button class="btn btn-outline-success" onclick="showModal()" type="button">Add New</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="card">
        <h5 class="card-header">User Table</h5>
        <div class="table-responsive text-nowrap">
            <table class="table" id="dataInfo-dataTable">
                <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Create At</th>
                    <th>Update At</th>
                    <th>Roles</th>
                    <th>Actions</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>


    <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-dialog-centered modal-add-new-role">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <h3 class="role-title">Add New User</h3>
                    </div>
                    <!-- Add role form -->
                    <form id="addRoleForm" onsubmit="return false">@csrf
                        <div class="row g-1">
                            <div class="col mb-1">
                                <label class="form-label" for="name">Name</label>
                                <input type="hidden" id="id" name="id">
                                <input type="text" id="name" name="name" class="form-control"
                                       placeholder="Enter name" tabindex="1"/>
                            </div>
                            <div class="col mb-1">
                                <label class="form-label" for="name">Password</label>
                                <input type="text" id="password" name="password" class="form-control"
                                       placeholder="Enter Password" tabindex="2"/>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col mb-1">
                                <label class="form-label" for="phone">Phone</label>
                                <input type="text" id="phone" name="phone" class="form-control"
                                       placeholder="Enter Phone" tabindex="3"/>
                            </div>
                            <div class="col mb-1">
                                <label class="form-label" for="email">Email</label>
                                <input type="text" id="email" name="email" class="form-control"
                                       placeholder="Enter Email" tabindex="4"/>
                            </div>
                            <div class="col mb-1">
                                <label class="form-label" for="division_id">Select Project</label>
                                <select class="form-control" id="roles" name="roles[]" multiple>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1" onclick="addData()">Submit</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">Cancel
                            </button>
                        </div>
                    </form>
                    <!--/ Add role form -->
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $.ajax({
            url: "{{ url('GetRoles') }}",
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                console.log(data);
                if (data.statusCode && data.statusCode === 400) {
                    swal({
                        text: data.statusMsg || "Roles Not Found",
                        timer: '1500'
                    });
                } else {
                    var selectRoles = $('#roles');
                    selectRoles.empty();
                    //selectRoles.append('<option value="">Select Project</option>'); // Add default option
                    data.forEach(function(role) {
                        selectRoles.append('<option value="' + role.name + '">' + role.name + '</option>');
                    });
                }
            },
            error: function () {
                // Handle AJAX request error
                swal({
                    text: "Error occurred while fetching roles",
                    timer: '1500'
                });
            }
        });

        var table1 = $('#dataInfo-dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('all.User') !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'phone', name: 'phone'},
                {data: 'email', name: 'email'},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'roles_html', name: 'roles_html'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        function showModal(){
            $('#addRoleModal form')[0].reset();
            $('#addRoleModal').modal('show');
        }

        function addData() {
            url = "{{ url('User') }}";
            $.ajax({
                url: url,
                type: "POST",
                data: new FormData($("#addRoleModal form")[0]),
                contentType: false,
                processData: false,
                success: function (data) {
                    //console.log(data);
                    var dataResult = JSON.parse(data);
                    if (dataResult.statusCode == 200) {
                        $('#addRoleModal').modal('hide');
                        $('#dataInfo-dataTable').DataTable().ajax.reload();
                        swal("Success", dataResult.statusMsg);
                        $('#addRoleModal form')[0].reset();
                    }
                },  error: function (xhr, status, error) {
                    var errorMessage = "Error occurred";
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.responseText) {
                        errorMessage = xhr.responseText;
                    }
                    swal({
                        title: "Oops",
                        text: errorMessage,
                        icon: "error",
                        timer: '1500'
                    });
                }
            });
            return false;
        };

        function showData(id) {
            $.ajax({
                url: "{{ url('User') }}" + '/' + id,
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    $('#addRoleModal form')[0].reset();
                    $('.role-title').text('Update Permission');
                    $('#addRoleModal').modal('show');
                    $('#id').val(data[0].id);
                    $('#name').val(data[0].name);
                    $('#phone').val(data[0].phone);
                    $('#email').val(data[0].email);
                },  error: function (xhr, status, error) {
                    var errorMessage = "Error occurred";
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.responseText) {
                        errorMessage = xhr.responseText;
                    }
                    swal({
                        title: "Oops",
                        text: errorMessage,
                        icon: "error",
                        timer: '1500'
                    });
                }
            });
        }

        function getRoles() {

        }

        function  deleteData(id) {
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{ url('User') }}" + '/' + id,
                            type: "POST",
                            data: {'_method': 'DELETE', '_token': csrf_token},
                            success: function (data) {
                                console.log(data);
                                var dataResult = JSON.parse(data);
                                if (dataResult.statusCode == 200) {
                                    $('#dataInfo-dataTable').DataTable().ajax.reload();
                                    swal({
                                        title: "Delete Done",
                                        text: "Poof! Your data file has been deleted!",
                                        icon: "success",
                                        button: "Done"
                                    });
                                } else {
                                    swal("Your imaginary file is safe!");
                                }
                            },  error: function (xhr, status, error) {
                                var errorMessage = "Error occurred";
                                if (xhr.responseJSON && xhr.responseJSON.message) {
                                    errorMessage = xhr.responseJSON.message;
                                } else if (xhr.responseText) {
                                    errorMessage = xhr.responseText;
                                }
                                swal({
                                    title: "Oops",
                                    text: errorMessage,
                                    icon: "error",
                                    timer: '1500'
                                });
                            }
                        });
                    } else {
                        swal("Your imaginary file is safe!");
                    }
                });
        }


    </script>
@endsection
