<x-auth-layout title="Log In">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" rel="stylesheet">

    <main class="container-fluid vh-100 d-grid" style="place-items: center;">
        <section class="border shadow-lg bg-white w-100 rounded p-5" style="max-width: 500px;">
            <h1 class="display-6 mb-4">Log In</h1>
            {{-- form --}}
            <form action="{{route('login-user')}}" method="POST">
                {{-- csrf --}}
                @csrf
                
                {{-- email --}}
                <div class="mb-3">
                    <label for="email" class="fw-medium">Email</label>
                    <input type="email" name="email" id="email" class="form-control" autocomplete="email" value="{{ old('email') }}"
                    placeholder="email@example.com">
                    @error('email')
                        <small class="text-danger fw-bold">{{$message}}</small>
                    @enderror
                </div>
                
                {{-- password --}}
                <div class="mb-2">
                    <label for="password" class="fw-medium">Password</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control"
                            autocomplete="current-password" placeholder="********">
                        <i class="bi bi-eye-slash input-group-text" style="cursor: pointer;" id="showhide_password"></i>
                    </div>

                    @error('password')
                        <small class="text-danger fw-bold">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" name="remember_me" id="remember_me" class="form-check-input">
                    <label for="remember_me" class="form-check-label">Remember me</label>
                </div>


                {{-- submit btn --}}
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-box-arrow-in-right" style="font-style: normal;"> SIGN IN</i>
                </button>
            </form>
        </section>
    </main>

    <script>
        /**
         * show/ hide password
         */
        let showPassword = false;

        function ShowHidePassword(){
            const showHide = document.getElementById('showhide_password');
            const inputPassword = document.getElementById('password');

            showHide.addEventListener('click', function(e){

                if(!showPassword){
                    inputPassword.type = 'text';
                    showPassword = true;
                    return;
                }

                inputPassword.type = 'password';
                showPassword = false;
            });
        }

        /**
         * init show hide password
         */
        ShowHidePassword();

    </script>
</x-auth-layout>