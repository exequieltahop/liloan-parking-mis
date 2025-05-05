<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>{{$title}}</title>
    {{-- vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .text-primary{
            color: rgb(0, 0, 41) !important;
        }
    </style>
</head>

<body class="bg-light">
    <div class="d-flex p-4 gap-4">
        @include('extensions.sidebar')

        {{-- header & main wrapper --}}
        <div class="d-flex flex-column w-100">
            {{-- header --}}
            @include('extensions.header')

            {{-- main --}}
            {{$slot}}
        </div>
    </div>

    {{-- alerts --}}
    @if (session()->has('error'))
    <script>
        document.addEventListener('DOMContentLoaded', ()=>{
                toastr.error({{session('error')}}, "Error");
            });
    </script>
    @endif
    @if (session()->has('success'))
    <script>
        document.addEventListener('DOMContentLoaded', ()=>{
                toastr.success({{session('success')}}, "Success");
            });
    </script>
    @endif
</body>

</html>