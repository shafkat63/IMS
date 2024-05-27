@extends('layout.app')
@section('main')

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
        <div class="card-body text-center">
            <h2 class="mb-2 mx-2">Page Not Found :(</h2>
            <p class="mb-4 mx-2">Oops! 😖 The requested URL was not found on this server.</p>
            <a href="index.html" class="btn btn-primary">Back to home</a>
            <div class="mt-3">
                <img src="../../assets/img/illustrations/page-misc-error-light.png" alt="page-misc-error-light" width="500" class="img-fluid" data-app-dark-img="illustrations/page-misc-error-dark.png" data-app-light-img="illustrations/page-misc-error-light.png">
            </div>
        </div>
    </div>


@endsection

