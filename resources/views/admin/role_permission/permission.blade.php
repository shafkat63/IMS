@extends('layout.app')
@section('main')

    <h4 class="py-3 mb-2">Roles List</h4>
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
                    <a class="nav-item nav-link active" href="javascript:void(0)">Permission Setup</a>
                </div>

                <form onsubmit="return false">
                    <button class="btn btn-outline-success" onclick="showModal()" type="button">Add New</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="card">
        <h5 class="card-header">Permission Table</h5>
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
                        <h3 class="role-title">Add New Permission</h3>
                    </div>
                    <!-- Add role form -->
                    <form id="addRoleForm" class="row g-3" onsubmit="return false">@csrf
                        <div class="col-12 mb-4">
                            <label class="form-label" for="modalRoleName">Permission Name</label>
                            <input type="hidden" id="id" name="id">
                            <input type="text" id="name" name="name" class="form-control"
                                   placeholder="Enter a Permission name" tabindex="-1"/>
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
    var table1 = $('#dataInfo-dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('all.Permission') !!}',
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
        $('#id').val("");
        $('#name').val("");
        $('#addRoleModal').modal('show');
    }

    function addData() {
        url = "{{ url('Permission') }}";
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

    function showData(id) {
        $.ajax({
            url: "{{ url('Permission') }}" + '/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#addRoleModal form')[0].reset();
                $('.role-title').text('Update Permission');
                $('#addRoleModal').modal('show');
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
                        url: "{{ url('Permission') }}" + '/' + id,
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
