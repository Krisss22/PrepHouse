@extends('layouts.app')

@section('content')
    @include('layouts.part.user_menu')
    <div class="main-content">
        <div class="account-section-block">
            <div class="account-section-title">Account</div>
            <div class="account-section-left-block">
                <form class="account-password-form" action="{{ route('account-password-save') }}" enctype="multipart/form-data" method="post">
                    @method('post')
                    @csrf

                    <div class="account-form-full-width-input-block account-form-text-input-block">
                        <label>Old password</label>
                        @error('oldPassword')
                        <br><span class="account-validation-error-message invalid-oldPassword" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input type="password" name="oldPassword" value="">
                    </div>
                    <div class="account-form-full-width-input-block account-form-text-input-block">
                        <label>New password</label>
                        @error('newPassword')
                        <br><span class="account-validation-error-message invalid-newPassword" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input type="password" name="newPassword" value="">
                    </div>
                    <div class="account-form-full-width-input-block account-form-text-input-block">
                        <label>Confirm new password</label>
                        @error('confirmNewPassword')
                        <br><span class="account-validation-error-message invalid-confirmNewPassword" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input type="password" name="confirmNewPassword" value="">
                    </div>

                    <button type="submit" class="account-form-submit-button">Change</button>
                </form>
            </div>
            <div class="account-section-right-block">
                <a href="{{ route('account-profile') }}">Profile</a>
                <a href="{{ route('account-password') }}" class="active">Password</a>
                <a href="{{ route('account-notifications') }}">Notification Preferences</a>
            </div>
        </div>
    </div>
@endsection
