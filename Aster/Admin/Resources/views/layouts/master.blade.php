<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Module Admin</title>

       {{-- Laravel Mix - CSS File --}}
{{--        @vite(['Aster/Admin/Resources/assets/sass/admin.scss'])--}}
        @yield('css')
    </head>
    <body>
    <div>
        
    </div>
        @yield('content')
        <div class="bg-#000000">

        </div>
        @vite(['Aster/Admin/Resources/assets/js/admin.js'])
        @yield('js')
    </body>
</html>
