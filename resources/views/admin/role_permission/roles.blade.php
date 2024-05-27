@extends('layout.app')
@section('main')

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
                    <p>Set role permissions</p>
                </div>
                <!-- Add role form -->
                <form id="addRoleForm" class="row g-3" onsubmit="return false">@csrf
                    <div class="col-12 mb-4">
                        <label class="form-label" for="modalRoleName">Role Name</label>
                        <input type="hidden" id="id" name="id">
                        <input type="text" id="name" name="name" class="form-control"
                               placeholder="Enter a role name" tabindex="-1"/>
                    </div>
                    <div class="col-12 RolePermissions">
                        <h4>Role Permissions</h4>
                        <!-- Permission table -->
                        <div class="table-responsive">
                            <table class="table table-flush-spacing">
                                <tbody>
                                <tr>
                                    <td class="text-nowrap fw-medium">Administrator Access <i
                                            class="bx bx-info-circle bx-xs" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Allows a full access to the system"></i>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="selectAll"/>
                                            <label class="form-check-label" for="selectAll">
                                                Select All
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-nowrap fw-medium">User Management</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="form-check me-3 me-lg-5">
                                                <input class="form-check-input" type="checkbox"
                                                       id="userManagementRead"/>
                                                <label class="form-check-label" for="userManagementRead">
                                                    Read
                                                </label>
                                            </div>
                                            <div class="form-check me-3 me-lg-5">
                                                <input class="form-check-input" type="checkbox"
                                                       id="userManagementWrite"/>
                                                <label class="form-check-label" for="userManagementWrite">
                                                    Write
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                       id="userManagementCreate"/>
                                                <label class="form-check-label" for="userManagementCreate">
                                                    Create
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-nowrap fw-medium">Content Management</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="form-check me-3 me-lg-5">
                                                <input class="form-check-input" type="checkbox"
                                                       id="contentManagementRead"/>
                                                <label class="form-check-label" for="contentManagementRead">
                                                    Read
                                                </label>
                                            </div>
                                            <div class="form-check me-3 me-lg-5">
                                                <input class="form-check-input" type="checkbox"
                                                       id="contentManagementWrite"/>
                                                <label class="form-check-label" for="contentManagementWrite">
                                                    Write
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                       id="contentManagementCreate"/>
                                                <label class="form-check-label" for="contentManagementCreate">
                                                    Create
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-nowrap fw-medium">Disputes Management</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="form-check me-3 me-lg-5">
                                                <input class="form-check-input" type="checkbox"
                                                       id="dispManagementRead"/>
                                                <label class="form-check-label" for="dispManagementRead">
                                                    Read
                                                </label>
                                            </div>
                                            <div class="form-check me-3 me-lg-5">
                                                <input class="form-check-input" type="checkbox"
                                                       id="dispManagementWrite"/>
                                                <label class="form-check-label" for="dispManagementWrite">
                                                    Write
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                       id="dispManagementCreate"/>
                                                <label class="form-check-label" for="dispManagementCreate">
                                                    Create
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-nowrap fw-medium">Database Management</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="form-check me-3 me-lg-5">
                                                <input class="form-check-input" type="checkbox"
                                                       id="dbManagementRead"/>
                                                <label class="form-check-label" for="dbManagementRead">
                                                    Read
                                                </label>
                                            </div>
                                            <div class="form-check me-3 me-lg-5">
                                                <input class="form-check-input" type="checkbox"
                                                       id="dbManagementWrite"/>
                                                <label class="form-check-label" for="dbManagementWrite">
                                                    Write
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                       id="dbManagementCreate"/>
                                                <label class="form-check-label" for="dbManagementCreate">
                                                    Create
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-nowrap fw-medium">Financial Management</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="form-check me-3 me-lg-5">
                                                <input class="form-check-input" type="checkbox"
                                                       id="finManagementRead"/>
                                                <label class="form-check-label" for="finManagementRead">
                                                    Read
                                                </label>
                                            </div>
                                            <div class="form-check me-3 me-lg-5">
                                                <input class="form-check-input" type="checkbox"
                                                       id="finManagementWrite"/>
                                                <label class="form-check-label" for="finManagementWrite">
                                                    Write
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                       id="finManagementCreate"/>
                                                <label class="form-check-label" for="finManagementCreate">
                                                    Create
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-nowrap fw-medium">Reporting</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="form-check me-3 me-lg-5">
                                                <input class="form-check-input" type="checkbox" id="reportingRead"/>
                                                <label class="form-check-label" for="reportingRead">
                                                    Read
                                                </label>
                                            </div>
                                            <div class="form-check me-3 me-lg-5">
                                                <input class="form-check-input" type="checkbox"
                                                       id="reportingWrite"/>
                                                <label class="form-check-label" for="reportingWrite">
                                                    Write
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                       id="reportingCreate"/>
                                                <label class="form-check-label" for="reportingCreate">
                                                    Create
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-nowrap fw-medium">API Control</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="form-check me-3 me-lg-5">
                                                <input class="form-check-input" type="checkbox" id="apiRead"/>
                                                <label class="form-check-label" for="apiRead">
                                                    Read
                                                </label>
                                            </div>
                                            <div class="form-check me-3 me-lg-5">
                                                <input class="form-check-input" type="checkbox" id="apiWrite"/>
                                                <label class="form-check-label" for="apiWrite">
                                                    Write
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="apiCreate"/>
                                                <label class="form-check-label" for="apiCreate">
                                                    Create
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-nowrap fw-medium">Repository Management</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="form-check me-3 me-lg-5">
                                                <input class="form-check-input" type="checkbox" id="repoRead"/>
                                                <label class="form-check-label" for="repoRead">
                                                    Read
                                                </label>
                                            </div>
                                            <div class="form-check me-3 me-lg-5">
                                                <input class="form-check-input" type="checkbox" id="repoWrite"/>
                                                <label class="form-check-label" for="repoWrite">
                                                    Write
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="repoCreate"/>
                                                <label class="form-check-label" for="repoCreate">
                                                    Create
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-nowrap fw-medium">Payroll</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="form-check me-3 me-lg-5">
                                                <input class="form-check-input" type="checkbox" id="payrollRead"/>
                                                <label class="form-check-label" for="payrollRead">
                                                    Read
                                                </label>
                                            </div>
                                            <div class="form-check me-3 me-lg-5">
                                                <input class="form-check-input" type="checkbox" id="payrollWrite"/>
                                                <label class="form-check-label" for="payrollWrite">
                                                    Write
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="payrollCreate"/>
                                                <label class="form-check-label" for="payrollCreate">
                                                    Create
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Permission table -->
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
<div class="modal fade" id="addRolePermissionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-dialog-centered modal-add-new-role">
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
                    $('#addRoleModal form')[0].reset();
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
