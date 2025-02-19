@extends('layout.app')
@section('main')

<h4 class="py-3 mb-2">Menu List</h4>


<!-- Role cards -->
<div class="row g-3">

  

</div>

<hr class="my-5"/>
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
                <a class="nav-item nav-link active" href="javascript:void(0)">Menu Setup</a>
            </div>

            <form onsubmit="return false">
                <button class="btn btn-outline-success" onclick="showModal()" type="button">Add New</button>
            </form>
        </div>
    </div>
</nav>
<div class="card">
    <h5 class="card-header">Menu Table</h5>
    <div class="table-responsive text-nowrap">
        <table class="table" id="dataInfo-dataTable">
            <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>menu id</th>
                <th>role</th>
                <th>status</th>
                <th>Actions</th>
            </tr>
            </thead>
        </table>
    </div>
</div>


<div class="modal fade" id="addMenuModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-dialog-centered modal-add-new-role">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="role-title">Add New Menu Assign</h3>
                    <p>Set Menu Assign permissions</p>
                </div>
                <!-- Add role form -->
                <form id="addMenuForm" class="row g-3" onsubmit="return false">@csrf
                    <div class="col-12 mb-4">
                        <label class="form-label" for="modalRoleName">Manu Name</label>
                        <input type="hidden" id="id" name="id">
                        <input type="text" id="name" name="name" class="form-control"
                               placeholder="Enter a role name" tabindex="-1"/>
                    </div>
                
                    <div class="col-12 text-center">
                        <button type="button" class="btn btn-primary me-sm-3 me-1" onclick="addData()">Submit</button>
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
<div class="modal fade" id="addRolePermissionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-dialog-centered modal-add-new-role">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="role-title">Add New Role</h3>
                    <p>Set role permissions</p>
                </div>
                <!-- Add role form -->
                <form id="addMenuForm" class="row g-3" onsubmit="return false">@csrf
                    <div class="col-12 mb-4">
                        <label class="form-label" for="modalRoleName">Role Name</label>
                        <input type="hidden" id="addId" name="id">
                        <input type="text" id="addName" name="name" class="form-control"
                               placeholder="Enter a role name" tabindex="-1" readonly/>
                    </div>
                    <div class="col-12 RolePermissions">
                        <h4>Role Permissions</h4>
                        <div class="row" id="permissions-list">
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1" onclick="givePermissionToRole()">Submit</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
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
        var table1 = $('#dataInfo-dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('all.menuassign') !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'menu', name: 'menu'},
                {data: 'role_id', name: 'role'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        function showModal(){
            $('#addMenuModal').modal('show');
            $('.RolePermissions').hide();
        }

        function addData() {
    let url = "{{ url('menuassign') }}";
    $.ajax({
        url: url,
        type: "POST",
        data: new FormData($("#addMenuModal form")[0]),
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.statusCode == 200) {  // No need to parse JSON manually
                $('#addMenuModal').modal('hide');
                $('#dataInfo-dataTable').DataTable().ajax.reload();

                swal({
                    title: "Success",
                    text: data.statusMsg,
                    icon: "success",
                    timer: 1500
                });

                $('#addMenuModal form')[0].reset();
            }
        }, 
        error: function (xhr, status, error) {
            var errorMessage = "Error occurred";

            if (xhr.responseJSON && xhr.responseJSON.statusMsg) {
                errorMessage = xhr.responseJSON.statusMsg;
            } else if (xhr.responseText) {
                errorMessage = xhr.responseText;
            }

            swal({
                title: "Oops!",
                text: errorMessage,
                icon: "error",
                timer: 1500
            });
        }
    });
    return false;
}
 

        function addRoleToMenu(id) {
            $.ajax({
                url: "{{ url('addroletomenu') }}" + '/' + id,
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    console.log(data);
                    $('#addMenuModal form')[0].reset();
                    $('.role-title').text('Add Role Permission');
                    $('#addRolePermissionModal').modal('show');
                    $('#addId').val(data.role.id);
                    $('#addName').val(data.role.name);

                    // Convert roleHavePermission to an array of permission IDs
                    var roleHavePermissionIds = Object.keys(data.roleHavePermission);

                    var permissionsHtml = '';
                    $.each(data.permissions, function(index, permission) {
                        var isChecked = roleHavePermissionIds.includes(permission.id.toString()) ? 'checked' : ''; // Check if the permission ID is in the role's permissions
                        permissionsHtml += '<div class="form-check col-md-3">';
                        permissionsHtml += '<input class="form-check-input" type="checkbox" name="permission[]" value="' + permission.name + '" ' + isChecked + '>';
                        permissionsHtml += '<label class="form-check-label" for="selectAll"> ' + permission.name + '</label>';
                        permissionsHtml += '</div>';
                    });
                    $('#permissions-list').html(permissionsHtml);
                }, error: function (xhr, status, error) {
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
        };

        function givePermissionToRole() {
            url = "{{ url('GivePermissionToRole') }}";
            $.ajax({
                url: url,
                type: "POST",
                data: new FormData($("#addRolePermissionModal form")[0]),
                contentType: false,
                processData: false,
                success: function (data) {
                    //console.log(data);
                    var dataResult = JSON.parse(data);
                    if (dataResult.statusCode == 200) {
                        $('#addRolePermissionModal').modal('hide');
                        $('#dataInfo-dataTable').DataTable().ajax.reload();
                        swal("Success", dataResult.statusMsg);
                        $('#addRolePermissionModal form')[0].reset();
                    }else {
                        swal("Failed", dataResult.statusMsg);

                    }
                }, error: function (xhr, status, error) {
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
        url: "{{ url('menuassign') }}/" + id, 
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            console.log(data); // Debugging - Remove in production
            
            // Reset and update the modal form
            $('#addMenuForm')[0].reset(); 
            $('.role-title').text('Update Menu Assign'); 
            $('#addMenuModal').modal('show');

            // Populate form fields with existing data
            $('#id').val(data.id);
            $('#name').val(data.menu);
        },
        error: function (xhr) {
            let errorMessage = "Error occurred";
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMessage = xhr.responseJSON.message;
            } else if (xhr.responseText) {
                errorMessage = xhr.responseText;
            }
            swal({
                title: "Oops!",
                text: errorMessage,
                icon: "error",
                timer: 2000, // 2 seconds
                buttons: false
            });
        },
    });
}

function deleteData(id) {
    var csrf_token = $('meta[name="csrf-token"]').attr('content');

    swal({
        title: "Are you sure?",
        text: "Once deleted, this menu assign record cannot be recovered!",
        icon: "warning",
        buttons: ["Cancel", "Yes, delete it!"],
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "{{ url('menuassign') }}/" + id,
                type: "POST",
                data: { '_method': 'DELETE', '_token': csrf_token },
                dataType: "JSON",
                success: function (data) {
                    if (data.statusCode === 200) {
                        $('#dataInfo-dataTable').DataTable().ajax.reload();
                        swal({
                            title: "Deleted!",
                            text: "The menu assign record has been deleted successfully.",
                            icon: "success",
                            button: "OK",
                        });
                    } else {
                        swal({
                            title: "Error",
                            text: "Something went wrong. Please try again!",
                            icon: "error",
                        });
                    }
                },
                error: function (xhr) {
                    let errorMessage = "Error occurred";
                    if (xhr.responseJSON && xhr.responseJSON.statusMsg) {
                        errorMessage = xhr.responseJSON.statusMsg;
                    } else if (xhr.responseText) {
                        errorMessage = xhr.responseText;
                    }
                    swal({
                        title: "Oops!",
                        text: errorMessage,
                        icon: "error",
                        button: "OK",
                    });
                }
            });
        } else {
            swal({
                title: "Cancelled",
                text: "Your menu assign record is safe!",
                icon: "info",
                button: "OK",
            });
        }
    });
}



    </script>
@endsection
