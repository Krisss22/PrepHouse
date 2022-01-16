<div class="left-menu-block">
    <div class="left-menu-block-icon"><a href="{{ route('home') }}"><img src="{{ asset('images/left_menu/main-icon.png') }}"></a></div>
    <div class="left-menu-block-item left-menu-block-item-dashboard">
        <div class="left-menu-block-item-icon"><img src="{{ asset('images/left_menu/dashboard.png') }}"></div>
        <div class="left-menu-block-item-title">Dashboard</div>
    </div>
    <div class="left-menu-block-item left-menu-block-item-study">
        <div class="left-menu-block-item-icon"><img src="{{ asset('images/left_menu/study.png') }}"></div>
        <div class="left-menu-block-item-title">Study</div>
    </div>
    <div class="left-menu-block-item left-menu-block-item-testing left-menu-block-item-active">
        <div class="left-menu-block-item-icon"><img src="{{ asset('images/left_menu/testing.png') }}"></div>
        <div class="left-menu-block-item-title">testing</div>
    </div>
    <div class="left-menu-block-item left-menu-block-item-strategies">
        <div class="left-menu-block-item-icon"><img src="{{ asset('images/left_menu/strategies.png') }}"></div>
        <div class="left-menu-block-item-title">Strategies</div>
    </div>
    @if(Auth::user())
            <div class="left-menu-block-item left-menu-block-item-profile left-menu-block-item-bottom">
                <a href="{{ route('account-profile') }}">
                    <div class="left-menu-block-item-icon">{{ Auth::user()->getInitials() }}</div>
                    <div class="left-menu-block-item-title">Profile</div>
                </a>
            </div>
    @endif
</div>
