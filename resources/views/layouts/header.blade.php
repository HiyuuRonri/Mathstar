@php
    use Illuminate\Support\Str;
    $currentRoute = Route::currentRouteName();
@endphp

<nav class="navbar navbar-expand-md navbar-light shadow-sm header">
    @if(Str::startsWith($currentRoute, ['login', 'password', 'register']))
        <h1>Login to Gain Full Access!</h1>
    @elseif(Str::startsWith($currentRoute, ['role']))
        <h1>CLICK YOUR ROLE</h1>
    @else
        <div class="pe-4"></div>

        <!-- MATH STAR LOGO -->
        <div class="ps-5 pe-5 pt-2">
            <a href="{{ auth()->check() && auth()->user()->role === 'teacher' ? route('student-stats') : route('games') }}">
                <img src="/svg/MathStarLogo.svg" alt="MSLogo">
            </a>
        </div>

        @if(auth()->check() && auth()->user()->role === 'teacher')
            <!-- CREATE QUIZ -->
            <div class="ps-5 pe-5 pt-1 text-center">
                <a href="{{ route('create-quiz') }}" class="d-block">
                    <img src="/svg/pencil_icon.svg" alt="PencilIcon" style="height:41px;" class="pb-1">
                </a>
                <span>CREATE QUIZ</span>
            </div>

            <!-- GAMES -->
            <div class="ps-5 pe-5 pt-1 text-center">
                <a href="{{ route('student-stats') }}" class="d-block">
                    <img src="/svg/student_icon.svg" alt="StudentIcon" style="height:41px;" class="pb-1">
                </a>
                <span>STUDENT INFO</span>
            </div>

            <!-- QUIZ DASHBOARD -->
            <div class="ps-5 pe-5 pt-1 text-center">
                <a href="{{ route('info-quiz') }}" class="d-block">
                    <img src="/svg/quiz_icon.svg" alt="QuizIcon" style="height:41px;" class="pb-1">
                </a>
                <span>QUIZZES</span>
            </div>
        @endif
        @if(auth()->check() && auth()->user()->role === 'pupil')
        <div class="ps-5 pe-5 pt-1 text-center">
                <a href="{{ route('games') }}" class="d-block">
                    <img src="/svg/game_icon.svg" alt="GameIcon" style="height:41px;" class="pb-1">
                </a>
                <span>GAMES</span>
            </div>
        @endif
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
    @endif

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav me-auto"></ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ms-auto">
            <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('role') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->username }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        <a class="dropdown-item" href="{{ route('account.destroy') }}"
                             onclick="event.preventDefault();
                             if (confirm('Are you sure you want to delete your account? This action cannot be undone.')) {
                                document.getElementById('delete-account-form').submit();
                            }">
                            {{ __('Delete Account') }}
                        </a>
                        <form id="delete-account-form" action="{{ route('account.destroy') }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                        </form>
                        

                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>
