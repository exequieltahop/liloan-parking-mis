<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- csrf-token --}}
    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>{{$title}}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-light">
    {{$slot}}

    {{-- alerts --}}
    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', ()=>{
                toastr.error({{session('error')}}, "Error");
            });
        </script>
    @endif
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', ()=>{
                toastr.success({{session('success')}}, "Success");
            });
        </script>
    @endif
</body>

</html>