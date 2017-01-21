<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beko Promotions</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.css' rel='stylesheet' type='text/css'>

    <link href="{{urlWithoutSchema('/css/bootstrap.css')}}" rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Orbitron" rel="stylesheet">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <link href="{{urlWithoutSchema('/css/custom.css')}}" rel='stylesheet' type='text/css'>


    <!-- JavaScripts -->
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="{{urlWithoutSchema('/js/bootstrap.js')}}"></script>
    <script src="http://momentjs.com/downloads/moment.js"></script>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    @yield('custom_css')

</head>
<body>

<div class="sa-container">

    <div class="sa-body-content">

        @yield('content')

    </div>

</div>

<script type="text/javascript">
    var base_url = "{{ urlWithoutSchema('') }}";
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.min.js"></script>
<!--Custom java scripts start-->
@yield('custom_js')
<!--Custom java scripts end-->

</body>
</html>