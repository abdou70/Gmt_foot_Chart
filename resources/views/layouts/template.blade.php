<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="cache-control" content="private, max-age=0, no-cache">
  <meta http-equiv="pragma" content="no-cache">
  <meta http-equiv="expires" content="0">
  <title>{{ config('app.name', 'GMT-FOOD') }}</title>
  <link href=" {{ asset('template/img/GMT__FOOD.png') }}" rel="icon">
  <link href=" {{ asset('template/img/GMT__FOOD.png') }}" rel="GMT__FOOD">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">


  <!-- Bootstrap core CSS -->
  <link href="{{ asset('template/lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <!--external css-->
  <link href="{{ asset('template/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="{{ asset('template/css/zabuto_calendar.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('template/lib/gritter/css/jquery.gritter.css') }}" />
  <!-- Custom styles for this template -->
  <link href="{{ asset('template/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('template/css/style-responsive.css') }}" rel="stylesheet">

  <!-- js placed at the end of the document so the pages load faster -->
  <script src="{{ asset('template/lib/chart-master/Chart.js') }}"></script>
  <script src="{{ asset('template/lib/jquery/jquery.min.js') }}"></script>


</head>

<body>


  <div id="container">
    <section id="container">

      @yield('nav')
      <!--main content start-->
      <section id="main-content">
        <section class="wrapper">
          @yield('content')

          <!--main content end-->

        </section>
      </section>
      @yield('pooper')
      @yield('footer')
    </section>
    @yield('login')
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="{{ asset('template/lib/chart-master/Chart.js') }}"></script>

    <script src="{{ asset('template/lib/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('template/lib/bootstrap/js/bootstrap.min.js') }}"></script>
    <script class="include" type="text/javascript" src="{{ asset('template/lib/jquery.dcjqaccordion.2.7.js') }}"></script>
    <script src="{{ asset('template/lib/jquery.scrollTo.min.js') }}"></script>
    <script src="{{ asset('template/lib/jquery.nicescroll.js') }}" type="text/javascript"></script>
    <script src="{{ asset('template/lib/jquery.sparkline.js') }}"></script>
    <!--common script for all pages-->
    <script src="{{ asset('template/lib/common-scripts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('template/lib/gritter/js/jquery.gritter.js') }}"></script>
    <script type="text/javascript" src="{{ asset('template/lib/gritter-conf.js') }}"></script>
    <!--script for this page-->
    <script src="{{ asset('template/lib/sparkline-chart.js') }}"></script>
    <script src="{{ asset('template/lib/zabuto_calendar.js') }}"></script>
    <script src="{{ asset('template/lib/myScript.js') }}"></script>
    <script>
      history.pushState(null, null, document.URL);
      window.addEventListener('popstate', function() {
        history.pushState(null, null, document.URL);
      });
    </script>
    <script type="text/javascript">
      function logout(event) {
        event.preventDefault();
        var check = confirm("Voullez vous vous déconnecté ?");
        if (check) {
          document.getElementById('logout-form').submit();
        }
      }
    </script>
</body>

</html>