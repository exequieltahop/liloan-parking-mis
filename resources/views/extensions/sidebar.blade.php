<aside class="d-none d-lg-block ">
    <h5 class="text-primary">LPPIS</h5>
    <nav>
        <ul class="nav d-flex flex-column">
            <li
                class="nav-item list-group-item list-group-action list-group-secondary p-3 px-4 @if(Route::currentRouteName() == 'dashboard') bg-primary rounded shadow-lg  @endif">
                <a href="{{route('dashboard')}}"
                    class="nav-item text-decoration-none text-uppercase w-100 d-block">
                    <i class="bi bi-speedometer text-nowrap {{Route::currentRouteName() == 'dashboard' ? 'text-white' : 'text-dark'}}"
                        style="font-style: normal; letter-spacing: 0.1em;">
                        Dashboard</i>
                </a>
            </li>

            {{-- sign in as admin --}}
            <li
                class="nav-item list-group-item list-group-action list-group-secondary p-3 px-4  @if(Route::currentRouteName() == 'login')  bg-primary rounded shadow-lg @endif">
                <a href="{{route('login')}}"
                    class="nav-item text-decoration-none text-uppercase text-dark w-100 d-block">
                    <i class="bi bi-box-arrow-left {{Route::currentRouteName() == 'login' ? 'text-white' : 'text-dark'}}" style="font-style: normal; letter-spacing: 0.1em; ">
                        Sign In</i>
                </a>
            </li>


            @if (auth()->user())
            <li class="nav-item list-group-item list-group-action list-group-secondary p-3 px-4  @if(Route::currentRouteName() == 'logs')  bg-primary rounded shadow-lg @endif">
                <a href="{{route('logs')}}"
                    class="nav-item text-decoration-none text-uppercase text-dark w-100 d-block ">
                    <i class="bi bi-clock-history {{Route::currentRouteName() == 'logs' ? 'text-white' : 'text-dark'}}" style="font-style: normal; letter-spacing: 0.1em;"> Logs</i>
                </a>
            </li>
            <li class="nav-item list-group-item list-group-action list-group-secondary p-3 px-4">
                <a href="{{route('logout')}}"
                    class="nav-item text-decoration-none text-uppercase text-dark w-100 d-block ">
                    <i class="bi bi-arrow-left text-primary" style="font-style: normal; letter-spacing: 0.1em;"> Log
                        Out</i>
                </a>
            </li>
            @endif
            <li class="nav-item list-group-item list-group-action list-group-secondary p-3 px-4">
                <div class="dropdown">
                    <i class="bi bi-three-dots-vertical nav-item text-decoration-none text-uppercase text-dark w-100 d-block" style="font-style: normal; cursor: pointer;" data-bs-toggle="dropdown"> More</i>
                    <div class="dropdown-menu">
                        <button id="installPwaBtn" class="btn nav-item text-decoration-none text-uppercase text-dark w-100 d-block "
                        onclick="click_btn()">
                        <i class="bi bi-arrow-left text-primary" style="font-style: normal; letter-spacing: 0.1em;"> Install App</i>
                    </button>
                    </div>
                </div>
            </li>
        </ul>
    </nav>
</aside>

<div class="offcanvas offcanvas-start p-3 bg-light" id="sidebar-offcanvas" style="width: fit-content">
    <div class="offcanvas-header p-0 ">
        <h5 class="offcanvas-title m-0 text-primary">LPPIS</h5>
        <button class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body p-0 pt-3">
        <nav class="">
            <ul class="nav d-flex flex-column">
                <li
                    class="nav-item list-group-item list-group-action list-group-secondary p-3 px-4  @if(Route::currentRouteName() == 'dashboard')  bg-primary rounded @endif">
                    <a href="{{route('dashboard')}}"
                        class="nav-item text-decoration-none text-uppercase text-dark w-100 d-block ">
                        <i class="bi bi-speedometer {{Route::currentRouteName() == 'dashboard' ? 'text-white' : 'text-dark'}}" style="font-style: normal; letter-spacing: 0.1em;">
                            Dashboard</i>
                    </a>
                </li>

                {{-- sign in as admin --}}
                <li
                    class="nav-item list-group-item list-group-action list-group-secondary  p-3 px-4  @if(Route::currentRouteName() == 'login')  bg-primary rounded @endif">
                    <a href="{{route('login')}}"
                        class="nav-item text-decoration-none text-uppercase text-dark w-100 d-block ">
                        <i class="bi bi-box-arrow-left {{Route::currentRouteName() == 'login' ? 'text-white' : 'text-dark'}}" style="font-style: normal; letter-spacing: 0.1em;">
                            Sign In</i>
                    </a>
                </li>

                @if (auth()->user())
                <li class="nav-item list-group-item list-group-action list-group-secondary p-3 px-4  @if(Route::currentRouteName() == 'logs')  bg-primary rounded @endif">
                    <a href="{{route('logs')}}"
                        class="nav-item text-decoration-none text-uppercase text-dark w-100 d-block ">
                        <i class="bi bi-clock-history {{Route::currentRouteName() == 'logs' ? 'text-white' : 'text-dark'}}" style="font-style: normal; letter-spacing: 0.1em;"> Logs</i>
                    </a>
                </li>
                <li class="nav-item list-group-item list-group-action list-group-secondary p-3 px-4">
                    <a href="{{route('logout')}}"
                        class="nav-item text-decoration-none text-uppercase text-dark w-100 d-block ">
                        <i class="bi bi-arrow-left text-primary" style="font-style: normal; letter-spacing: 0.1em;"> Log
                            Out</i>
                    </a>
                </li>
                @endif
                <li class="nav-item list-group-item list-group-action list-group-secondary p-3 px-4">
                    <div class="dropdown">
                        <i class="bi bi-three-dots-vertical nav-item text-decoration-none text-uppercase text-dark w-100 d-block" style="font-style: normal; cursor: pointer;" data-bs-toggle="dropdown"> More</i>
                        <div class="dropdown-menu">
                            <button id="installPwaBtn" class="btn nav-item text-decoration-none text-uppercase text-dark w-100 d-block "
                            onclick="click_btn()">
                            <i class="bi bi-arrow-left text-primary" style="font-style: normal; letter-spacing: 0.1em;"> Install App</i>
                        </button>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>