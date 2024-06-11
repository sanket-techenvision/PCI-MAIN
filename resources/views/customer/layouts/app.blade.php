<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.shared/title-meta')
    @yield('css')
    @include('layouts.shared/head-css')
    
    @vite(['resources/js/head.js'])
    <style>
        input:focus,
        select:focus,
        textarea:focus {
            border: 1px solid grey !important;
        }
    </style>
</head>

<body>
    <div class="wrapper">

        @include('customer.layouts.topbar')

        @include('customer.layouts.sidebar')

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                @yield('content')
            </div>
            @include('layouts.shared/footer')
        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>

    @include('layouts.shared/footer-script')
    @vite(['resources/js/app.js', 'resources/js/layout.js'])
    @yield('script')

    <!-- Session Message -->
    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Success!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });
    </script>
    @endif
    @if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Error!',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    </script>
    @endif
    @if($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Error!',
                text: "{{ $errors->first() }}",
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    </script>
    @endif

</body>

</html>