<div class="app-menu">

    {{-- <div class="logo-box">
        <span class="font-nevan text-lg">LEVEL UP LIFE</span>
    </div> --}}
    <!-- Sidenav Brand Logo -->
    <a href="{{ route('any', 'dashboard') }}" class="logo-box">
        <!-- Light Brand Logo -->
        <div class="logo-light">
            <div src="/images/level-up-light.jpg" class="logo-lg h-6" alt="Light logo">
                <span class="font-nevan text-lg">LEVEL UP LIFE</span>

            </div>
            <img src="/images/level-up-dark.jpg" class="logo-sm" alt="Small logo">
        </div>


        <!-- Dark Brand Logo -->
        <div class="logo-dark">
            <div src="/images/logo-dark.png" class="logo-lg h-12" alt="Dark logo">
                <span class="font-nevan text-lg">LEVEL UP LIFE</span>

            </div>
            <img src="/images/level-up-light.jpg" class="logo-sm" alt="Small logo">

        </div>
    </a>

    <!-- Sidenav Menu Toggle Button -->
    <button id="button-hover-toggle" class="absolute top-5 end-2 rounded-full p-1.5">
        <span class="sr-only">Menu Toggle Button</span>
        <i class="mgc_round_line text-xl"></i>
    </button>

    <!--- Menu -->
    <div class="srcollbar" data-simplebar>
        <ul class="menu" data-fc-type="accordion">
            <li class="menu-title">Menu</li>

            <li class="menu-item">
                <a href="{{ route('dashboard') }}" class="menu-link">
                    <span class="menu-icon"><i class="mgc_dashboard_line"></i></span>
                    <span class="menu-text"> Coach Dashboard </span>
                </a>
            </li>

            <li class="menu-item">
                <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon"><i class="mgc_user_3_line"></i></span>
                    <span class="menu-text"> Trainees </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="sub-menu hidden">
                    <li class="menu-item">
                        <a href="{{ route('trainees.index') }}" class="menu-link">
                            <span class="menu-text">All Trainees</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('trainees.create') }}" class="menu-link">
                            <span class="menu-text">Add New Trainee</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item">
                <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon"><i class="mgc_calendar_day_line"></i></span>
                    <span class="menu-text"> Programs </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="sub-menu hidden">
                    <li class="menu-item">
                        <a href="{{ route('programs.index') }}" class="menu-link">
                            <span class="menu-text">All Programs</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('programs.create') }}" class="menu-link">
                            <span class="menu-text">Create Program</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item">
                <a href="{{ route('exercises.index') }}" class="menu-link">
                    <span class="menu-icon"><i class="mgc_run_line"></i></span>
                    <span class="menu-text"> Exercises </span>
                </a>
            </li>

            {{-- <li class="menu-item">
                <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon"><i class="mgc_dribbble_line"></i></span>
                    <span class="menu-text"> Icons </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="sub-menu hidden">
                    <li class="menu-item">
                        <a href="{{ route('second', ['icons', 'mingcute']) }}" class="menu-link">
                            <span class="menu-text">Mingcute</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('second', ['icons', 'feather']) }}" class="menu-link">
                            <span class="menu-text">Feather</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('second', ['icons', 'material-symbols']) }}" class="menu-link">
                            <span class="menu-text">Material Symbols </span>
                        </a>
                    </li>
                </ul>
            </li> --}}

        </ul>
    </div>
</div>
<!-- Sidenav Menu End  -->
