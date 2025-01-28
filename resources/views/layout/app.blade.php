<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Bangla Chemical @yield("title")</title>

    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/logo.svg')}}" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/boxicons.css')}}" />
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{asset('assets/vendor/css/theme-default.css')}}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}" />
    <!-- Page CSS -->
    <!-- Helpers -->
    <script src="{{asset('assets/vendor/js/helpers.js')}}"></script>
    <script src="{{asset('assets/js/config.js')}}"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @auth
            @php
            $prefix = Request::route()->getPrefix();
            $route = Route::current()->getName();
            @endphp
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="/Home" class="app-brand-link">
                        <span class="app-brand-text demo menu-text fw-bolder ms-2"><img
                                src="{{ asset('assets/img/logo.svg') }}" width="30px" /> IMS</span>
                    </a>

                    <a href="javascript:void(0);"
                        class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item active">
                        <a href="Home" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Dashboard</div>
                        </a>
                    </li>
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text" data-i18n="Apps &amp; Pages">Apps &amp; Pages</span>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-user"></i>
                            <div class="text-truncate" data-i18n="Users">Users</div>
                        </a>
                        <ul class="menu-sub">


                        </ul>
                    </li>
                    <?php
                    // Define the menu items as an array
                    $menuItems = [
                        ['route' => 'Role.index', 'url' => 'Role', 'label' => 'Roles'],
                        ['route' => 'Permission.index', 'url' => 'Permission', 'label' => 'Permission'],
                        ['route' => 'User.index', 'url' => 'User', 'label' => 'User'],
                    ];
                    ?>

                    <!-- Parent Menu -->
                    <li
                        class="menu-item {{ in_array($route, array_column($menuItems, 'route')) ? 'active open' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-check-shield"></i>
                            <div class="text-truncate" data-i18n="Roles &amp; Permissions">Roles &amp; Permissions</div>
                        </a>
                        <ul class="menu-sub">
                            @foreach ($menuItems as $item)
                            <li class="menu-item {{ $route === $item['route'] ? 'active' : '' }}">
                                <a href="{{ url($item['url']) }}" class="menu-link">
                                    <div class="text-truncate" data-i18n="{{ $item['label'] }}">{{ $item['label'] }}
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>

                    <?php
                        // Define the menu items as an array
                        $menuItems = [
                            ['route' => 'organization.index', 'url' => 'organization', 'label' => 'Organization'],
                            ['route' => 'countries.index', 'url' => 'countries', 'label' => 'Countries'],
                            ['route' => 'banks.index', 'url' => 'banks', 'label' => 'Banks'],
                            ['route' => 'bank-branches.index', 'url' => 'bank-branches', 'label' => 'Bank Branches'],
                            ['route' => 'modes-of-units.index', 'url' => 'modes-of-units', 'label' => 'Modes of Units'],
                            ['route' => 'colors.index', 'url' => 'colors', 'label' => 'Colors'],
                            ['route' => 'currencies.index', 'url' => 'currencies', 'label' => 'Currencies'],
                            ['route' => 'product-types.index', 'url' => 'product-types', 'label' => 'Product Types'],
                            ['route' => 'product-categories.index', 'url' => 'product-categories', 'label' => 'Product Categories'],
                            ['route' => 'product-sub-categories.index', 'url' => 'product-sub-categories', 'label' => 'Product Sub Categories'],
                            ['route' => 'products.index', 'url' => 'products', 'label' => 'Products'],
                            ['route' => 'manufacturers.index', 'url' => 'manufacturers', 'label' => 'Manufacturers'],
                            ['route' => 'shipment-modes.index', 'url' => 'shipment-modes', 'label' => 'Shipment Modes'],
                            ['route' => 'customers.index', 'url' => 'customers', 'label' => 'Customers'],
                            ['route' => 'suppliers.index', 'url' => 'suppliers', 'label' => 'Suppliers'],
                            ['route' => 'payment-statuses.index', 'url' => 'payment-statuses', 'label' => 'Payment Statuses'],
                            ['route' => 'product-grades.index', 'url' => 'product-grades', 'label' => 'Product Grades'],
                        ];
                        ?>


                    <!-- Parent Menu -->
                    <li
                        class="menu-item {{ in_array($route, array_column($menuItems, 'route')) ? 'active open' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-store"></i>
                            <div class="text-truncate" data-i18n="Roles &amp; Permissions">Basic Setup</div>
                        </a>
                        <ul class="menu-sub">
                            @foreach ($menuItems as $item)
                            <li class="menu-item {{ $route === $item['route'] ? 'active' : '' }}">
                                <a href="{{ url($item['url']) }}" class="menu-link">
                                    <div class="text-truncate" data-i18n="{{ $item['label'] }}">{{ $item['label'] }}
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>


                    <?php
                        // Define the menu items as an array
                        $menuItems = [
                            ['route' => 'customer-inquiry.index', 'url' => 'customer-inquiry', 'label' => 'Customer Inquiry'],
                            ['route' => 'inquiry-to-supplier.index', 'url' => 'inquiry-to-supplier', 'label' => 'Inquiry To Supplier'],
                            ['route' => 'supplier-offer.index', 'url' => 'supplier-offer', 'label' => 'Supplier Offer'],
                            ['route' => 'offer-to-customer.index', 'url' => 'offer-to-customer', 'label' => 'Offer To Customer'],
                            ['route' => 'customer-feedback.index', 'url' => 'customer-feedback', 'label' => 'Customer Feedback'],
                            ['route' => 'order-to-supplier.index', 'url' => 'order-to-supplier', 'label' => 'Order to Supplier'],
                            ['route' => 'proforma-invoice.index', 'url' => 'proforma-invoice', 'label' => 'Proforma Invoice'],
                            ['route' => 'indent.index', 'url' => 'indent', 'label' => 'Indent'],
                            ['route' => 'draft-lc.index', 'url' => 'draft-lc', 'label' => 'Draft L/C'],
                            ['route' => 'original-lc.index', 'url' => 'original-lc', 'label' => 'Original L/C'],
                            ['route' => 'lc-amendment.index', 'url' => 'lc-amendment', 'label' => 'L/C Amendment'],
                            ['route' => 'shipment-advice.index', 'url' => 'shipment-advice', 'label' => 'Shipment Advice'],
                            ['route' => 'shipment-booking.index', 'url' => 'shipment-booking', 'label' => 'Shipment Booking'],
                            ['route' => 'shipping-document.index', 'url' => 'shipping-document', 'label' => 'Shipping Document'],
                            ['route' => 'commission-settlement.index', 'url' => 'commission-settlement', 'label' => 'Commission Settlement'],
                            ['route' => 'document-archive.index', 'url' => 'document-archive', 'label' => 'Document Archive'],
                        ];
                            ?>

                    <!-- Parent Menu -->
                    <li
                        class="menu-item {{ in_array($route, array_column($menuItems, 'route')) ? 'active open' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-package"></i>
                            <div class="text-truncate" data-i18n="RegularEntry &amp; Order Management">All Regular Entry</div>
                        </a>
                        <ul class="menu-sub">
                            @foreach ($menuItems as $item)
                            <li class="menu-item {{ $route === $item['route'] ? 'active' : '' }}">
                                <a href="{{ url($item['url']) }}" class="menu-link">
                                    <div class="text-truncate" data-i18n="{{ $item['label'] }}">{{ $item['label'] }}
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>




                </ul>
            </aside>
            @else
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="Home" class="app-brand-link">
                        <span class="app-brand-text demo menu-text fw-bolder ms-2">BChemical</span>
                    </a>
                    <a href="javascript:void(0);"
                        class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>
                <div class="menu-inner-shadow"></div>
                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item active">
                        <a href="index.html" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Error 404</div>
                        </a>
                    </li>
                </ul>
            </aside>
            @endauth
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center">

                            </div>
                        </div>
                        <!-- /Search -->

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{asset('assets/img/avatars/1.png')}}" alt
                                            class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{asset('assets/img/avatars/1.png')}}" alt
                                                            class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block">{{ auth()->user()->name }}</span>
                                                    <small class="text-muted">{{ auth()->user()->email }}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li class="nav-item">
                                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" style="margin-left: 16px;"" class=" btn btn-danger
                                                d-flex align-items-center justify-content-center ml-2 gap-2">
                                                <i class="bi bi-box-arrow-right"></i>
                                                <span>Logout</span>
                                            </button>
                                        </form>
                                    </li>

                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('main')
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme text-light py-3">
                        <div class="container-xxl d-flex flex-wrap justify-content-center align-items-center">
                            <!-- Left Section -->
                            <div class="mb-2 mb-md-0">
                                &copy; <span id="currentYear"></span>
                                <a href="https://srl.com.bd/" target="_blank"
                                    class="footer-link fw-bold text-light text-decoration-none">
                                    SRL
                                </a>. All Rights Reserved.
                            </div>

                        </div>
                    </footer>

                    <script>
                        // Dynamically set the current year
                    document.getElementById("currentYear").textContent = new Date().getFullYear();
                    </script>

                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <script src="{{asset('assets/vendor/js/menu.js')}}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>

    <!-- Main JS -->
    <script src="{{asset('assets/js/main.js')}}"></script>

    <!-- Page JS -->
    <script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>

    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>

    <script src="{{asset('assets/js/sweetalert.min.js')}}"></script>

    @yield('script')
</body>

</html>