<!-- Dropdown Structure -->
<ul id='dropdown1' class='dropdown-content'>
    <li><a href="/locale/pt-br">Português</a></li>
    <li><a href="/locale/en">English</a></li>
</ul>

<div class="parallax-container">
    <nav>
        <div class="nav-wrapper">
            <div class="container">
                <a href="/" class="brand-logo">{{ __('My Heroes - Forum')  }}</a>
                <a href="/login" class="btn right">Login</a>
                <ul class="right">
                    <li>
                        <!-- Dropdown Trigger -->
                        <a class='dropdown-trigger btn' href='#' data-target='dropdown1'>{{ __('Language') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="parallax">
        <img src="{{ asset('img/help.jpg') }}" alt="">
    </div>
</div>
