@extends('layout.app')
@section('main')
@section('title', '- Roles')

<h4 class="py-3 mb-2">Roles List</h4>

<p>A role provided access to predefined menus and features so that depending on <br> assigned role an administrator
    can have access to what user needs.</p>
<!-- Role cards -->
<div class="row g-3">

    <div class="col-xl-4 col-lg-6 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <h6 class="fw-normal">Total 4 users</h6>
                    <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                            title="Vinnie Mostowy" class="avatar avatar-sm pull-up">
                            <img class="rounded-circle" src="../../assets/img/avatars/5.png" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                            title="Allen Rieske" class="avatar avatar-sm pull-up">
                            <img class="rounded-circle" src="../assets/img/avatars/1.png" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                            title="Julee Rossignol" class="avatar avatar-sm pull-up">
                            <img class="rounded-circle" src="../assets/img/avatars/6.png" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                            title="Kaith D'souza" class="avatar avatar-sm pull-up">
                            <img class="rounded-circle" src="../assets/img/avatars/5.png" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                            title="John Doe" class="avatar avatar-sm pull-up">
                            <img class="rounded-circle" src="../assets/img/avatars/1.png" alt="Avatar">
                        </li>
                    </ul>
                </div>
                <div class="d-flex justify-content-between align-items-end">
                    <div class="role-heading">
                        <h4 class="mb-1">Administrator</h4>
                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal"
                            class="role-edit-modal"><small>Edit Role</small></a>
                    </div>
                    <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-6 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <h6 class="fw-normal">Total 7 users</h6>
                    <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                            title="Jimmy Ressula" class="avatar avatar-sm pull-up">
                            <img class="rounded-circle" src="../assets/img/avatars/5.png" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                            title="John Doe" class="avatar avatar-sm pull-up">
                            <img class="rounded-circle" src="../assets/img/avatars/1.png" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                            title="Kristi Lawker" class="avatar avatar-sm pull-up">
                            <img class="rounded-circle" src="../assets/img/avatars/6.png" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                            title="Kaith D'souza" class="avatar avatar-sm pull-up">
                            <img class="rounded-circle" src="../assets/img/avatars/5.png" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                            title="Danny Paul" class="avatar avatar-sm pull-up">
                            <img class="rounded-circle" src="../assets/img/avatars/1.png" alt="Avatar">
                        </li>
                    </ul>
                </div>
                <div class="d-flex justify-content-between align-items-end">
                    <div class="role-heading">
                        <h4 class="mb-1">Manager</h4>
                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal"
                            class="role-edit-modal"><small>Edit Role</small></a>
                    </div>
                    <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-6 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <h6 class="fw-normal">Total 5 users</h6>
                    <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                            title="Andrew Tye" class="avatar avatar-sm pull-up">
                            <img class="rounded-circle" src="../assets/img/avatars/6.png" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                            title="Rishi Swaat" class="avatar avatar-sm pull-up">
                            <img class="rounded-circle" src="../assets/img/avatars/5.png" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                            title="Rossie Kim" class="avatar avatar-sm pull-up">
                            <img class="rounded-circle" src="../assets/img/avatars/1.png" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                            title="Kim Merchent" class="avatar avatar-sm pull-up">
                            <img class="rounded-circle" src="../assets/img/avatars/5.png" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                            title="Sam D'souza" class="avatar avatar-sm pull-up">
                            <img class="rounded-circle" src="../assets/img/avatars/6.png" alt="Avatar">
                        </li>
                    </ul>
                </div>
                <div class="d-flex justify-content-between align-items-end">
                    <div class="role-heading">
                        <h4 class="mb-1">Users</h4>
                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal"
                            class="role-edit-modal"><small>Edit Role</small></a>
                    </div>
                    <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<hr class="my-5" />
<nav class="navbar navbar-example navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="javascript:void(0)"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-ex-3">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-ex-3">
            <div class="navbar-nav me-auto">
                <a class="nav-item nav-link active" href="javascript:void(0)">Role Setup</a>
            </div>

            <form onsubmit="return false">
                <button class="btn btn-outline-success" onclick="showModal()" type="button">Add New</button>
            </form>
        </div>
    </div>
</nav>


<div class="card">
    <h5 class="card-header">Role Table</h5>
    <div class="table-responsive text-nowrap">
        <table class="table" id="dataInfo-dataTable">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Guard Name</th>
                    <th>Create At</th>
                    <th>Update At</th>
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
                    <h3 class="role-title">Add New Role</h3>
                    <p>Set role permissionsssss</p>
                </div>
                <!-- Add role form -->
                <form id="addRoleForm" class="row g-3" onsubmit="return false">@csrf
                    <div class="col-12 mb-4">
                        <label class="form-label" for="modalRoleName">Role Name</label>
                        <input type="hidden" id="id" name="id">
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter a role name"
                            tabindex="-1" />
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

{{-- //Add menu to role --}}
<div class="modal fade" id="assignMenuToRole" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-simple modal-dialog-centered modal-add-new-role">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="role-title">Add New Role</h3>
                    <p>Set role permissions</p>
                </div>
                <!-- Add role form -->
                <form id="addRoleForm" class="row g-3" onsubmit="return false">@csrf
                    <div class="col-12 mb-4">
                        <label class="form-label" for="modalRoleName">Role Name</label>
                        <input type="hidden" id="addId" name="id">
                        <input type="text" id="addName" name="name" class="form-control" placeholder="Enter a role name"
                            tabindex="-1" readonly />
                    </div>
                    <div class="col-12 RolePermissions">
                        <h4>Role Permissions</h4>
                        <div class="row" id="menus-list">
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1"
                            onclick="giveMenuToRole()">Submit</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                    </div>
                </form>
                <!--/ Add role form -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addRolePermissionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-simple modal-dialog-centered modal-add-new-role">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="role-title">Add New Role</h3>
                    <p>Set role permissions</p>
                </div>
                <!-- Add role form -->
                <form id="addRoleForm" class="row g-3" onsubmit="return false">@csrf
                    <div class="col-12 mb-4">
                        <label class="form-label" for="modalRoleName">Role Name</label>
                        <input type="hidden" id="addIds" name="id">
                        <input type="text" id="addNames" name="name" class="form-control"
                            placeholder="Enter a role name" tabindex="-1" readonly />
                    </div>
                    <div class="col-12 RolePermissions">
                        <h4>Role Permissions</h4>
                        <div class="row" id="permissions-lists">
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1"
                            onclick="givePermissionToRole()">Submit</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
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
            ajax: '{!! route('all.Role') !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'guard_name', name: 'guard_name'},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        function showModal(){
            $('#addRoleModal').modal('show');
            $('.RolePermissions').hide();
        }

        function addData() {
            url = "{{ url('Role') }}";
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

        function addPermissionToRole(id) {
            $.ajax({
                url: "{{ url('addpermission') }}" + '/' + id,
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    console.log(data);
                    $('#addRolePermissionModal form')[0].reset();
                    $('.role-title').text('Add Role Permission');
                    $('#addRolePermissionModal').modal('show');
                    $('#addIds').val(data.role.id);
                    $('#addNames').val(data.role.name);

                    var roleHavePermissionIds = Object.keys(data.roleHavePermission);

                    // Group permissions by type
                    var permissionGroups = {
                        view: [],
                        create: [],
                        delete: [],
                        update: []
                    };

                    $.each(data.permissions, function (index, permission) {
                        if (permission.name.includes('view')) {
                            permissionGroups.view.push(permission);
                        } else if (permission.name.includes('create')) {
                            permissionGroups.create.push(permission);
                        } else if (permission.name.includes('delete')) {
                            permissionGroups.delete.push(permission);
                        } else if (permission.name.includes('update')) {
                            permissionGroups.update.push(permission);
                        }
                    });

                    var permissionsHtml = '<div class="row">';

                    function generatePermissionColumn(type, permissions) {
                        if (permissions.length === 0) return ''; // Skip if no permissions of this type

                        var typeCapitalized = type.charAt(0).toUpperCase() + type.slice(1);
                        var columnHtml = '<div class="col-md-3">'; // Each type in its own column
                        columnHtml += `<div class="form-check">`;
                        columnHtml += `<input class="form-check-input select-all-group" type="checkbox" id="selectAll${typeCapitalized}">`;
                        columnHtml += `<label class="form-check-label fw-bold" for="selectAll${typeCapitalized}"> Select All ${typeCapitalized}</label>`;
                        columnHtml += `</div><hr>`;

                        $.each(permissions, function (index, permission) {
                            var isChecked = roleHavePermissionIds.includes(permission.id.toString()) ? 'checked' : '';
                            columnHtml += `<div class="form-check">`;
                            columnHtml += `<input class="form-check-input permission-checkbox ${type}-checkbox" type="checkbox" name="permission[]" value="${permission.name}" ${isChecked}>`;
                            columnHtml += `<label class="form-check-label"> ${permission.name}</label>`;
                            columnHtml += `</div>`;
                        });

                        columnHtml += '</div>'; // Close column
                        return columnHtml;
                    }

                    permissionsHtml += generatePermissionColumn('view', permissionGroups.view);
                    permissionsHtml += generatePermissionColumn('create', permissionGroups.create);
                    permissionsHtml += generatePermissionColumn('delete', permissionGroups.delete);
                    permissionsHtml += generatePermissionColumn('update', permissionGroups.update);

                    permissionsHtml += '</div>'; // Close row

                    $('#permissions-lists').html(permissionsHtml);

                    // Select All Functionality for Each Column
                    $('.select-all-group').on('change', function () {
                        var type = $(this).attr('id').replace('selectAll', '').toLowerCase();
                        $(`.${type}-checkbox`).prop('checked', $(this).prop('checked'));
                    });

                    // Uncheck "Select All" if any permission is unchecked manually
                    $('.permission-checkbox').on('change', function () {
                        var type = $(this).attr('class').match(/(view|create|delete|update)-checkbox/)[1];
                        if ($(`.${type}-checkbox:checked`).length === $(`.${type}-checkbox`).length) {
                            $(`#selectAll${type.charAt(0).toUpperCase() + type.slice(1)}`).prop('checked', true);
                        } else {
                            $(`#selectAll${type.charAt(0).toUpperCase() + type.slice(1)}`).prop('checked', false);
                        }
                    });
                },
                error: function (xhr, status, error) {
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

        function addMenuToRole(id) {
    $.ajax({
        url: "{{ url('addmenu') }}" + '/' + id,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            console.log(data);

            $('#assignMenuToRole form')[0].reset();
            $('.role-title').text('Assign Menu To Role');
            $('#assignMenuToRole').modal('show');

            $('#addId').val(data.role.id);
            $('#addName').val(data.role.name);

            // Function to build menu tree with Bootstrap styles
            function buildMenuTree(menuList) {
                let menusHtml = '<div class="row">';

                $.each(menuList, function (index, menu) {
                    menusHtml += `
                        <div class="col-md-6 mb-2">
                            <div class="form-check">
                                <input class="form-check-input menu-checkbox" type="checkbox" name="menu_id[]" value="${menu.id}" id="menu_${menu.id}">
                                <label class="form-check-label fw-bold" for="menu_${menu.id}">${menu.title}</label>
                            </div>`;

                    // If this menu has submenus, nest them inside
                    if (menu.submenu.length > 0) {
                        menusHtml += `
                            <div class="ms-4 border-start ps-3 mt-2"> 
                                ${buildMenuTree(menu.submenu)}
                            </div>`;
                    }

                    menusHtml += `</div>`;
                });

                menusHtml += '</div>';
                return menusHtml;
            }

            // Generate menu structure
            $('#menus-list').html(buildMenuTree(data.menu));

            // Add "Select All" checkbox for better usability
            $('#menus-list').prepend(`
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="selectAllMenus">
                    <label class="form-check-label fw-bold text-primary" for="selectAllMenus">Select All Menus</label>
                </div>
            `);

            // Check already assigned menus
            $.each(data.menu, function (index, menu) {
                if (menu.menu_exists) {
                    $(`.menu-checkbox[value="${menu.id}"]`).prop('checked', true);
                }

                // Check submenus
                if (menu.submenu.length > 0) {
                    $.each(menu.submenu, function (subIndex, subMenu) {
                        if (subMenu.menu_exists) {
                            $(`.menu-checkbox[value="${subMenu.id}"]`).prop('checked', true);
                        }
                    });
                }
            });

            // "Select All" functionality
            $('#selectAllMenus').on('change', function () {
                $('.menu-checkbox').prop('checked', $(this).prop('checked'));
            });

            // Uncheck "Select All" if any checkbox is unchecked
            $('.menu-checkbox').on('change', function () {
                if ($('.menu-checkbox:checked').length === $('.menu-checkbox').length) {
                    $('#selectAllMenus').prop('checked', true);
                } else {
                    $('#selectAllMenus').prop('checked', false);
                }
            });

        },
        error: function (xhr, status, error) {
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
                timer: 1500
            });
        }
    });
}



        function givePermissionToRole() {
            url = "{{ url('GivePermissionToRole') }}";
            $.ajax({
                url: url,
                type: "POST",
                data: new FormData($("#addRolePermissionModal form")[0]),
                contentType: false,
                processData: false,
                success: function (data) {
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


        function giveMenuToRole() {
                    var url = "{{ url('GiveMenuToRole') }}";

                    var formData = {
                        role_id: $('#addId').val(), 
                        menu_id: [] 
                    };

                    $('#menus-list input[type="checkbox"]:checked').each(function () {
                        formData.menu_id.push($(this).val());
                    });

                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            ...formData,
                            _token: $('input[name="_token"]').val() 
                        },
                        dataType: 'json', 
                        success: function (data) {
                            if (data.statusCode == 200) {
                                $('#assignMenuToRole').modal('hide');
                                $('#dataInfo-dataTable').DataTable().ajax.reload();
                                swal("Success", data.statusMsg);
                                $('#addRoleForm')[0].reset(); // Reset the form
                            } else {
                                swal("Failed", data.statusMsg);
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
                                title: "Oops",
                                text: errorMessage,
                                icon: "error",
                                timer: 1500
                            });
                        }
                    });
                    return false;
}



        function showData(id) {
            $.ajax({
                url: "{{ url('Role') }}" + '/' + id,
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    $('#addRoleModal form')[0].reset();
                    $('.role-title').text('Update Role');
                    $('#addRoleModal').modal('show');
                    $('#id').val("");
                    $('#name').val("");
                    $('#id').val(data[0].id);
                    $('#name').val(data[0].name);
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
                            url: "{{ url('Role') }}" + '/' + id,
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
                    } else {
                        swal("Your imaginary file is safe!");
                    }
                });
        }


</script>
@endsection