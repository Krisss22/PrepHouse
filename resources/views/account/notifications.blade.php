@extends('layouts.app')

@section('content')
    @include('layouts.part.user_menu')
    <div class="main-content">
        <div class="account-section-block">
            <div class="account-section-title">Account</div>
            <div class="account-section-left-block">
                <form class="account-notifications-form" action="{{ route('account-notifications-save') }}" method="post">
                    @method('get')
                    @csrf

                    <div class="account-form-descriptions">I am interested in the following types of email from PrepHome:</div>

                    <div class="account-form-half-width-input-block-left">
                        <label>PrepHome news, tips and stories</label>
                    </div>
                    <div class="account-form-half-width-input-block-right">
                        @error('news')
                        <br>
                        <span class="account-validation-error-message invalid-news" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input id="account-notifications-news" type="checkbox" name="news" {{ Auth::user()->news ? 'checked' : '' }}>
                    </div>
                    <div class="account-notifications-separation-line"></div>
                    <div class="account-form-half-width-input-block-left">
                        <label>Surveys (once every several months)</label>
                    </div>
                    <div class="account-form-half-width-input-block-right">
                        @error('surveys')
                        <br>
                        <span class="account-validation-error-message invalid-surveys" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input id="account-notifications-surveys" type="checkbox" name="surveys" {{ Auth::user()->surveys ? 'checked' : '' }}>
                    </div>
                    <div class="account-notifications-separation-line"></div>
                    <div class="account-form-half-width-input-block-left">
                        <label>Special Promotions</label>
                    </div>
                    <div class="account-form-half-width-input-block-right">
                        @error('promotions')
                        <br>
                        <span class="account-validation-error-message invalid-promotions" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input id="account-notifications-promotions" type="checkbox" name="promotions" {{ Auth::user()->promotions ? 'checked' : '' }}>
                    </div>
                </form>
            </div>
            <div class="account-section-right-block">
                <a href="{{ route('account-profile') }}">Profile</a>
                <a href="{{ route('account-password') }}">Password</a>
                <a href="{{ route('account-notifications') }}" class="active">Notification Preferences</a>
            </div>
        </div>
    </div>
@endsection
