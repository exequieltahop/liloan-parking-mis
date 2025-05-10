<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="{{csrf_token()}}">

    <meta name="theme-color" content="#000029" />

    <link rel="apple-touch-icon" href="{{ asset('parking-logo.png') }}">

    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    <title>{{$title}}</title>
    {{-- vite --}}
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">

    <style>
        html{
            --primary : #000029 !important;
        }

        .text-primary {
            color: var(--primary) !important;
        }

        .bg-primary {
            background-color: var(--primary) !important;
        }

        .btn-primary {
            background-color: var(--primary) !important;
            outline: none !important;
            border: none !important;
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


    <script src="{{asset('helper.js')}}"></script>

    <script src="{{ asset('sw.js') }}"></script>

    <script>
        if (!navigator.serviceWorker.controller) {
            navigator.serviceWorker.register("/sw.js")
            .then(function (reg) {
                console.log("Service worker has been registered for scope: " + reg.scope);
            });
        }
    </script>


    {{-- alerts --}}
    @if (session()->has('error'))
    <script>
        document.addEventListener('DOMContentLoaded', ()=>{
                toastr.error("{{session('error')}}", "Error");
            });
    </script>
    @endif
    @if (session()->has('success'))
        <script>
            document.addEventListener('DOMContentLoaded', ()=>{
                    toastr.success("{{session('success')}}", "Success");
                });
        </script>
    @endif
</body>

</html>