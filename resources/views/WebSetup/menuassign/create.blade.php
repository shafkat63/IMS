@extends('layout.appmain')
@section('title', '- Menu Assign')

@section('main')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Menu Assign</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item">Web Setup</li>
                    <li class="breadcrumb-item active">Menu Assign</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <div class="card">
                    <div class="card-body" id="addFrom">
                        <div class="row">
                            <div class="col-md-10">
                                <h5 class="card-title">Add Menu Assign</h5>
                            </div>
                            <div class="col-md-2 mt-3">
                                <a href="{{route('menuassign.index')}}" type="button" class="btn btn-outline-info btn-sm text-right">Back <i class="bi bi-arrow-left-short"></i></a>
                            </div>
                        </div>

                        <!-- Multi Columns Form -->
                        <form class="row g-3">@csrf
                            <div class="col-md-6">
                                <label for="menu_role" class="form-label">Select Role</label>
                                <select id="menu_role" class="form-select" name="menu_role">
                                    <option selected value="">Select Role</option>
                                    @foreach($roles as $value)
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>

                            <!-- Modern Multi-select Menu Items -->
                            <div class="col-md-6">
                                <label for="menu_id" class="form-label">Select Menu Items</label>
                                <select id="menu_id" class="form-select" name="menu_id[]" multiple="multiple">
                                    @foreach($menu as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="text-center">
                                <button type="button" onclick="addData()" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>

    </main>
    <!-- End #main -->
@endsection

@section('script')
    <script>
        // Initialize Select2 on page load
        $(document).ready(function() {
            $('#menu_id').select2({
                placeholder: "Select menu items",
                allowClear: true,
                width: '100%'
            });
        });

        function addData() {
            url = "{{ url('menuassign') }}";
            $.ajax({
                url: url,
                type: "POST",
                data: new FormData($("#addFrom form")[0]),
                contentType: false,
                processData: false,
                success: function (data) {
                    var dataResult = JSON.parse(data);
                    if (dataResult.statusCode == 200) {
                        swal("Success", dataResult.statusMsg);
                        $('#addFrom form')[0].reset();
                        $('#menu_id').val(null).trigger('change'); // Reset the Select2 selection
                    } else if (dataResult.statusCode == 204) {
                        showErrors(dataResult.errors);
                    } else {
                        swal({
                            title: "Oops",
                            text: dataResult.statusMsg,
                            icon: "error",
                            timer: '1500'
                        });
                    }
                },
                error: function (data) {
                    console.log(data);
                    swal({
                        title: "Oops",
                        text: "Error occurred",
                        icon: "error",
                        timer: '1500'
                    });
                }
            });
            return false;
        };

        // Add other functions if needed
    </script>
@endsection
