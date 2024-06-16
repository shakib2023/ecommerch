<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">





<!-- mdn bootstrap link start -->
<!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css"
  rel="stylesheet"
/>
 <!--mdn bootstrap link end  -->


      <!-- Bootstrap css -->
      <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- animate css -->
    <link rel="stylesheet" href="{{asset('css/animate.min.css')}}">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="{{asset('css/fontawesome.all.min.css')}}">
    <!-- owl.carousel css -->
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <!-- owl.theme.default css -->
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">

    <!-- datatable min.css -->
    <link rel="stylesheet" href="{{asset('css/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/datatables-select.min.css')}}">


    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css"
    />

    <!-- navbar css  -->
    <link rel="stylesheet" href="{{asset('css/search.css')}}">
    <!-- navbar css  -->
    <link rel="stylesheet" href="{{asset('css/navbar.css')}}">

    <!-- Responsive css -->
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">

     <!-- Style css -->
     <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
    <div id="app">
        @include('sweetalert::alert')
        <main>
        @include('layouts.menue')

        @yield('content')

        @include('layouts.footer')
        </main>
    </div>

<!-- ckeditor use in blog description -->
  <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace( 'summary-ckeditor' );
</script>



<script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
    <!-- Bootstrap js -->
    <script src="{{asset('js/bootstrap.bundle.js')}}"></script>
    <!-- owl carousel js -->
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <!-- wow.js -->
    <script src="{{asset('js/wow.min.js')}}"></script>
    <!-- datatables -->
    <script src="{{asset('js/datatables-select.min.js')}}"></script>
    <script src="{{asset('js/datatables.min.js')}}"></script>
    <!-- sweet alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Custom js -->
    <script src="{{asset('js/custom.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@stack('custom.script')
</body>
</html>
