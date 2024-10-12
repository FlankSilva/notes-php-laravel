<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        @vite('resources/css/app.css')
        <title>Document</title>
    </head>
    <body>
        <p>text from the layout (TOP)</p>

        <hr>
        @yield('content')
        <hr>

        <p>Text from the layout (BOTTOM)</p>
    </body>
</html>
