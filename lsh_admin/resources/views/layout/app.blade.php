<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Labason Safe Haven</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="icon" type="image/x-icon" href="{{ asset('home_images/lsh_favicon.svg') }}">

    {{-- Date Picker Start --}}
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Bootstrap Datepicker CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">

        <!-- Bootstrap Datepicker JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    {{-- Date Picker End --}}

    <link rel="stylesheet" href="{{ asset('customer_css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('customer_css/nav.css') }}">
</head>
<body>
    @yield('nav')
    @yield('content')
    @yield('footer')

    {{-- Date Picker Script --}}
    <script>
        $(document).ready(function(){
            $('#dateRangePicker').datepicker({
                format: "mm/dd/yyyy",
                clearBtn: true,
                todayBtn: true,
                autoclose: true,
                todayHighlight: true,
                startDate: "today",
                endDate: '+1y',
                multidate: true, // Allow selection of multiple dates
                multidateSeparator: " - " // Separator between dates
            });
        });
    </script>
    {{-- Date Pucker Script End --}}
</body>
</html>