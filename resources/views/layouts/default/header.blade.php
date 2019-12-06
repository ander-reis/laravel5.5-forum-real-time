<!-- Dropdown Structure -->
<ul id='dropdown1' class='dropdown-content'>
    <li><a href="/locale/pt-br">Português</a></li>
    <li><a href="/locale/en">English</a></li>
</ul>

@if (\Auth::user())
<ul id='dropdown1' class='dropdown-content'>
    <li><a href="/profile">{{ __('Profile') }}</a></li>
    <li>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </li>
</ul>
@endif

<div class="parallax-container">
    <nav>
        <div class="nav-wrapper">
            <div class="container">
                <a href="/" class="brand-logo">{{ __('My Heroes - Forum')  }}</a>

                <ul class="right">
                    <li>
                        <!-- Dropdown Trigger -->
                        <a class='dropdown-trigger btn' href='#' data-target='dropdown1'>{{ __('Language') }}</a>
                    </li>
                    @if(\Auth::user())
                        <li>
                            <!-- Dropdown Trigger -->
                            <a class='dropdown-trigger btn' href='#' data-activates="user"
                               data-target='dropdown1'>{{ \Auth::user()->name }}</a>
                        </li>
                    @else
                        <li>
                            <!-- Dropdown Trigger -->
                            <a href='/login' data-target='dropdown1'>{{ __('Login') }}</a>
                        </li>
                        <li>
                            <a href='/register'
                               data-target='dropdown1'>{{ __('Sign Up') }}</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="parallax">
        <img src="{{ asset('img/help.jpg') }}" alt="">
    </div>
</div>
