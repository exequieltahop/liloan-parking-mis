<aside class="d-none d-lg-block ">
    <h5 class="text-primary">LPPIS</h5>
    <nav>
        <ul class="nav d-flex flex-column">
            <li
                class="nav-item list-group-item list-group-action list-group-secondary p-3 px-4 @if(Route::currentRouteName() == 'dashboard') bg-white rounded shadow-lg  @endif">
                <a href="{{route('dashboard')}}"
                    class="nav-item text-decoration-none text-uppercase text-dark w-100 d-block ">
                    <i class="bi bi-speedometer text-nowrap text-primary"
                        style="font-style: normal; letter-spacing: 0.1em;">
                        Dashboard</i>
                </a>
            </li>

            {{-- sign in as admin --}}
            <li
                class="nav-item list-group-item list-group-action list-group-secondary p-3 px-4  @if(Route::currentRouteName() == 'sign-in')  bg-white rounded shadow-lg @endif">
                <a href="{{route('dashboard')}}"
                    class="nav-item text-decoration-none text-uppercase text-dark w-100 d-block">
                    <i class="bi bi-box-arrow-left text-primary" style="font-style: normal; letter-spacing: 0.1em; ">
                        Sign In</i>
                </a>
            </li>


            @if (auth()->user())
            <li class="nav-item list-group-item list-group-action list-group-secondary">
                <a href="#" class="nav-item text-decoration-none text-uppercase text-dark w-100 d-block ">
                    <i class="bi bi-arrow-left text-primary" style="font-style: normal; letter-spacing: 0.1em;"> Log Out</i>
                </a>
            </li>
            @endif
        </ul>
    </nav>
</aside>

<div class="offcanvas offcanvas-start p-3 bg-light" id="sidebar-offcanvas" style="width: fit-content">
    <div class="offcanvas-header pb-0">
        <h5 class="offcanvas-title m-0 text-primary">LPPIS</h5>
        <button class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <nav>
            <ul class="nav d-flex flex-column">
                <li
                    class="nav-item list-group-item list-group-action list-group-secondary  @if(Route::currentRouteName() == 'dashboard')  bg-white rounded shadow-lg p-3 px-4 @endif">
                    <a href="{{route('dashboard')}}"
                        class="nav-item text-decoration-none text-uppercase text-dark w-100 d-block ">
                        <i class="bi bi-speedometer text-primary" style="font-style: normal; letter-spacing: 0.1em;"> Dashboard</i>
                    </a>
                </li>

                {{-- sign in as admin --}}
                <li
                    class="nav-item list-group-item list-group-action list-group-secondary  p-3 px-4  @if(Route::currentRouteName() == 'sign-in')  bg-white rounded shadow-lg @endif">
                    <a href="{{route('dashboard')}}"
                        class="nav-item text-decoration-none text-uppercase text-dark w-100 d-block ">
                        <i class="bi bi-box-arrow-left text-primary" style="font-style: normal; letter-spacing: 0.1em;"> Sign In</i>
                    </a>
                </li>

                @if (auth()->user())
                <li class="nav-item list-group-item list-group-action list-group-secondary">
                    <a href="#" class="nav-item text-decoration-none text-uppercase text-dark w-100 d-block ">
                        <i class="bi bi-arrow-left text-primary" style="font-style: normal; letter-spacing: 0.1em;"> Log Out</i>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
    </div>
</div>