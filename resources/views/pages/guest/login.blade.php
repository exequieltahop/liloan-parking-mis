<x-auth-layout title="Log In">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" rel="stylesheet">

    <main class="container-fluid vh-100 d-grid" style="place-items: center;">
        <section class="border shadow-lg bg-white w-100 rounded" style="max-width: 500px; padding: 2em;">
            <h1 class="display-6 mb-4">Log In</h1>
            {{-- form --}}
            <form action="{{route('login-user')}}" method="POST">
                {{-- csrf --}}
                @csrf
                {{-- email --}}
                <input type="email" name="email" id="email" class="form-control mb-3" autocomplete="email"
                    placeholder="email@example.com" required>
                {{-- password --}}
                <input type="password" name="password" id="password" class="form-control mb-3"
                    autocomplete="current-password" minlength="8" placeholder="********" required>
                {{-- submit btn --}}
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-box-arrow-in-right" style="font-style: normal;"> SIGN IN</i>
                </button>
            </form>
        </section>
    </main>
</x-auth-layout>