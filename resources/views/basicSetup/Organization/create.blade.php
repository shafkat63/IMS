@extends('layout.app')
@section('main')

<h4 class="py-3 mb-2">Organization</h4>

<nav class="navbar navbar-example navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="javascript:void(0)"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-ex-3">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-ex-3">
            <div class="navbar-nav me-auto">
                <a class="nav-item nav-link active" href="javascript:void(0)">Organization Setup</a>
            </div>
        </div>
    </div>
</nav>

<div class="container mt-4 ">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Add New Organization</h4>
            <a href="{{ url('organization') }}" class="btn btn-secondary">
                <i class='bx bx-arrow-back' ></i> Back
            </a>
            
        </div>
        
        
        <div class="card-body">
            <form id="createForm" class="row g-3" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="id" name="id" class="form-control" />

                <div class="col-6 mb-4 justify-content-center" >
                    <label class="form-label" for="organization_logo">Organization Logo</label>
                    <input type="file" id="organization_logo" name="organization_logo" class="form-control" onchange="previewImage(event)" />
                    <img id="itemImageSource1" style="width: 210px;height:126px;border: 1px solid #ddd;padding:3px;cursor:pointer;display:block;">
                </div>
<div class="row">
                <div class="col-6 mb-4">
                    <label class="form-label" for="organization_name">Organization Name</label>
                    <input type="text" id="organization_name" name="organization_name" class="form-control"
                        placeholder="Bang Jin" required />
                </div>

                <div class="col-6 mb-4">
                    <label class="form-label" for="tin_number">TIN Number</label>
                    <input type="text" id="tin_number" name="tin_number" class="form-control" placeholder="8965XXXXXXXX"
                        required />
                </div>

                <div class="col-6 mb-4">
                    <label class="form-label" for="bin_number">BIN Number</label>
                    <input type="text" id="bin_number" name="bin_number" class="form-control" placeholder="2547XXXXXXXX"
                        required />
                </div>

                <div class="col-6 mb-4">
                    <label class="form-label" for="vat_registration_number">VAT Registration Number</label>
                    <input type="text" id="vat_registration_number" name="vat_registration_number" class="form-control"
                        placeholder="4698XXXXXXXX" required />
                </div>

                <div class="col-6 mb-4">
                    <label class="form-label" for="national_id">National ID</label>
                    <input type="text" id="national_id" name="national_id" class="form-control" placeholder="5552091160"
                        required />
                </div>

                <div class="col-6 mb-4">
                    <label class="form-label" for="address_1">Address 1</label>
                    <input type="text" id="address_1" name="address_1" class="form-control" placeholder="Dhaka"
                        required />
                </div>

                <div class="col-6 mb-4">
                    <label class="form-label" for="address_2">Address 2</label>
                    <input type="text" id="address_2" name="address_2" class="form-control" placeholder="Khulna" />
                </div>

                <div class="col-6 mb-4">
                    <label class="form-label" for="contact_person_1">Contact Person 1</label>
                    <input type="text" id="contact_person_1" name="contact_person_1" class="form-control"
                        placeholder="Md.Kamal Hossain" required />
                </div>

                <div class="col-6 mb-4">
                    <label class="form-label" for="contact_person_2">Contact Person 2</label>
                    <input type="text" id="contact_person_2" name="contact_person_2" class="form-control"
                        placeholder="Md.Jamal Hossain" />
                </div>

                <div class="col-6 mb-4">
                    <label class="form-label" for="contact_number_1">Contact Number 1</label>
                    <input type="text" id="contact_number_1" name="contact_number_1" class="form-control"
                        placeholder="017XXXXXXXX" required />
                </div>

                <div class="col-6 mb-4">
                    <label class="form-label" for="contact_number_2">Contact Number 2</label>
                    <input type="text" id="contact_number_2" name="contact_number_2" class="form-control"
                        placeholder="017XXXXXXXX" />
                </div>

                <div class="col-6 mb-4">
                    <label class="form-label" for="email_address">Email Address</label>
                    <input type="email" id="email_address" name="email_address" class="form-control"
                        placeholder="abc@gmail.com" required />
                </div>

                <div class="col-6 mb-4">
                    <label class="form-label" for="web_address">Web Address</label>
                    <input type="text" id="web_address" name="web_address" class="form-control"
                        placeholder="www.bangjin.com.bd" />
                </div>

                <div class="col-6 mb-4">
                    <label class="form-label" for="mobile_wallet_number">Mobile Wallet Number</label>
                    <input type="text" id="mobile_wallet_number" name="mobile_wallet_number" class="form-control"
                        placeholder="01XXXXXXXXX" />
                </div>

                <div class="col-6 mb-4">
                    <label class="form-label" for="erc_number">ERC Number</label>
                    <input type="text" id="erc_number" name="erc_number" class="form-control" />
                </div>

                <div class="col-6 mb-4">
                    <label class="form-label" for="status">Status</label>
                    <select id="status" name="status" class="form-select">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
                <div class="col-12 text-center">
                    <button type="button" class="btn btn-primary me-sm-3 me-1" onclick="save()">Submit</button>
                    <button type="reset" class="btn btn-secondary">Clear</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection


@section('script')

<script>

function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('itemImageSource1');
            output.src = reader.result;
            output.style.display = 'block';  // Show the image
        };
        reader.readAsDataURL(event.target.files[0]);
    }
    function save() {
        let url = "{{ url('organization') }}"; 
        let formData = new FormData($("#createForm")[0]);  

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.statusCode === 200) {
                    swal("Success", response.statusMsg, "success").then(() => {
                        window.location.href = "{{ url('organization') }}";  
                    });
                }else {
                    swal("Error", response.statusMsg || "An unknown error occurred.", "error");
                }
            },
            error: function (xhr) {
                let errorMessage = "Error occurred";
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                } else if (xhr.responseText) {
                    errorMessage = xhr.responseText;
                }
                swal({ title: "Oops", text: errorMessage, icon: "error", timer: 1500000 });
            }
        });

        return false;
    }

</script>



@endsection