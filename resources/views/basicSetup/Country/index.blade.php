@extends('layout.app')
@section('main')

<h4 class="py-3 mb-2">Country </h4>


<nav class="navbar navbar-example navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="javascript:void(0)"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-ex-3">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-ex-3">
            <div class="navbar-nav me-auto">
                <a class="nav-item nav-link active" href="javascript:void(0)">Country Setup</a>
            </div>

            <form onsubmit="return false">
                <button class="btn btn-outline-success" onclick="showModal()" type="button">Add New</button>
            </form>
        </div>
    </div>
</nav>
<div class="card">
    <h5 class="card-header">Country Table</h5>
    <div class="table-responsive text-nowrap">
        <table class="table" id="dataInfo-dataTable">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Country Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>


<div class="modal fade" id="createCountryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-dialog-centered modal-add-new-country">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="country-title">Add New Country</h3>
                    <p>Enter Country details</p>
                </div>
                <!-- Add bank form -->
                <form id="createCountryForm" class="row g-3" onsubmit="return false">@csrf
                    <div class="col-12 mb-4">
                        <input type="hidden" id="id" name="id" class="form-control" />
                    </div>

                    <div class="col-12 mb-4">
                        <label class="form-label" for="country">Country Name</label>
                        <input type="text" id="country" name="country" class="form-control"
                            placeholder="Example: Bangladesh" />
                    </div>
                    <div class="col-12 mb-4">
                        <label class="form-label" for="status">Status</label>
                        <select id="status" name="status" class="form-select">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1"
                            onclick="saveCountry()">Submit</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                    </div>
                </form>
                <!--/ Add bank form -->
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
            ajax: '{!! route('all.countries') !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        function showModal(){
            $('#createCountryModal').modal('show');
            $('.RolePermissions').hide();
        }

        function saveCountry () {
            let url = "{{ url('countries') }}"; // Adjust URL to match your endpoint
            let formData = new FormData($("#createCountryForm")[0]);

                $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.statusCode === 200) {
                            // Hide the modal
                            $('#createCountryModal').modal('hide');

                            if ($('#dataInfo-dataTable').length) {
                                $('#dataInfo-dataTable').DataTable().ajax.reload();
                            }

                            // Show success message
                            swal("Success", response.statusMsg, "success");

                            // Reset the form
                            $('#createCountryForm')[0].reset();
                        } else {
                            // Handle case where statusCode isn't 200
                            swal("Error", response.statusMsg || "An unknown error occurred.", "error");
                        }
                    },
                    error: function (xhr) {
                        let errorMessage = "Error occurred";

                        // Extract error details from the response
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        } else if (xhr.responseText) {
                            errorMessage = xhr.responseText;
                        }

                        // Display error message
                        swal({
                            title: "Oops",
                            text: errorMessage,
                            icon: "error",
                            timer: 1500
                        });
                    }
    });

    return false; // Prevent form submission
}


    


function showData(id) {
    $.ajax({
        url: "{{ url('countries') }}/" + id, 
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            // Reset and update the modal form
            console.log(data);
            
            $('#createCountryForm')[0].reset(); 
            $('.country-title').text('Update Country'); 
            $('#createCountryModal').modal('show');

            // Populate form fields with data
            $('#id').val(data.id);
            $('#country').val(data.name);
            $('#status').val(data.status);
        },
        error: function (xhr, status, error) {
            let errorMessage = "Error occurred";
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMessage = xhr.responseJSON.message;
            } else if (xhr.responseText) {
                errorMessage = xhr.responseText;
            }
            swal({
                title: "Oops",
                text: errorMessage,
                icon: "error",
                timer: 1500,
            });
        },
    });
}

function deleteData(id) {
    // Get the CSRF token from the meta tag
    var csrf_token = $('meta[name="csrf-token"]').attr('content');

    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this file!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "{{ url('countries') }}/" + id, 
                type: "POST",
                data: {
                    '_method': 'DELETE',
                    '_token': csrf_token
                },
                success: function (response) {
                    // Check if the deletion was successful
                    if (response.statusCode === 200) {
                        // Reload the DataTable to reflect the changes
                        $('#dataInfo-dataTable').DataTable().ajax.reload();

                        // Show a success message
                        swal({
                            title: "Delete Done",
                            text: "The record has been deleted!",
                            icon: "success",
                            button: "Done"
                        });
                    } else {
                        // If deletion failed, show an appropriate message
                        swal("Error", response.statusMsg || "Failed to delete the record.", "error");
                    }
                },
                error: function (xhr, status, error) {
                    // Handle errors and display a friendly message
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
        } else {
            swal("Your file is safe!");
        }
    });
}



</script>
@endsection