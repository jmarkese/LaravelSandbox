<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-2.2.4/dt-1.10.13/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-2.2.4/dt-1.10.13/datatables.min.js"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">

    <table id="example" class="display" cellspacing="0" width="100%">
    </table>

</div>

<script>
    $(document).ready(function() {
        $('#example').DataTable( {
            "serverSide": true,
            "processing": true,
            "ajax": "datatablestest",
            columns : [
                { "data": "id", "title": "Id", "name": "id" },
                { "data": "name", "title": "Name", "name": "name" },
                { "data": "number", "title": "Number", "name": "number" },
                { "data": "magentas[].name", "title": "Magenta", "name": "magentas.*.name" },
                { "data": "yellow.name", "title": "Yellow", "name": "yellow.name" },
                { "data": "black.name", "title": "Black", "name": "black.name" },
                { "data": "many_blacks[].name", "title": "Black Many", "name": "manyBlacks.*.name" },
                { "data": "grey.name", "title": "Grey", "name": "grey.name" },
                { "data": "blues[].cyans[].name", "title": "Cyan", "name": "blues.*.cyans.*.name" },
                { "data": "reds[].name", "title": "Reds", "name": "reds.*.name" },
                //{ "data": "created_at", "title": "Created", "name": "created_at"  },
            ]
        } );
    } );
</script>

</body>
</html>
