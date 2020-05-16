<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        {{--bootstrap cdn--}}
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com./jquery-1.11.3.min.js"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
        </div>

            <div class="content">
                <div class="title m-b-md">

                    {{--Laravel Home Page is the default value passed in case if the child template doesn't consist of section contentBlock --}}
                    @yield('contentBlock', 'Laravel Home Page')

                </div>
            </div>
        </div>
    </body>
</html>
