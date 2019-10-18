<html>
    <head>
        <title>Claws</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="admin-prefix" content="{{ config('claws.admin_url') }}">
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,700,800" rel="stylesheet">
        <link href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" rel="stylesheet">
        <link href="{{ asset('claws-admin/css/style.css') }}" rel="stylesheet" type="text/css" >
    </head>
    <body>
        <div id="app"></div>
        <script> 
            window.Claws = @json($claws)
        </script>
        <script type="text/javascript" src="{{ asset('claws-admin/js/app.js') }}"></script>
    </body>
</html>