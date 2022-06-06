@extends('layouts.app')

@section('content')
    @include('layouts.part.user_menu')
    <div class="main-content">
        <div class="account-section-block">
            <div class="account-section-title">Account</div>
            <div class="account-section-left-block">
                <form class="account-profile-form" action="{{ route('account-profile-save') }}" enctype="multipart/form-data" method="post">
                    @method('post')
                    @csrf

                    <div class="account-image-block">
                        <div class="account-image">
                            <img src="{{ (Auth::user()->image === '' || Auth::user()->image === null || Auth::user()->image === 'user.svg') ? asset('images/user.svg') : asset('storage/images/users/' . Auth::user()->id . '/' . Auth::user()->image) }}" id="account-image">
                        </div>
                        <div class="account-image-description">Change your Profile Image<br>JPG or PNG up to 5MB.</div>
                        @error('image')
                        <br><span class="account-validation-error-message invalid-image" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="account-image-buttons">
                            <input type="file" name="image" id="account-upload-image-input" class="hidden" value="user.svg">
                            <div id="account-upload-image-button">Upload</div>
                            <a id="account-image-remove-button">Remove</a>
                        </div>
                    </div>
                    <div class="account-separate-line"></div>
                    <div class="account-form-text-input-block account-form-half-width-input-block account-form-half-width-input-block-left">
                        <label>First Name</label>
                        @error('firstName')
                            <br><span class="account-validation-error-message invalid-firstName" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input type="text" name="firstName" value="{{ Auth::user()->name ?? '' }}">
                    </div>
                    <div class="account-form-text-input-block account-form-half-width-input-block account-form-half-width-input-block-right">
                        <label>Surname</label>
                        @error('surname')
                        <br><span class="account-validation-error-message invalid-surname" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input type="text" name="surname" value="{{ Auth::user()->surname ?? '' }}">
                    </div>
                    <div class="account-form-full-width-input-block account-form-text-input-block">
                        <label>Job Title</label>
                        @error('jobTitle')
                        <br><span class="account-validation-error-message invalid-jobTitle" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input type="text" name="jobTitle" value="{{ Auth::user()->job_title ?? '' }}">
                    </div>
                    <div class="account-form-full-width-input-block account-form-text-input-block">
                        <label>Education</label>
                        @error('education')
                        <br><span class="account-validation-error-message invalid-education" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <select name="education">
                            <option value="School" {{ Auth::user()->education === 'School' ? 'selected' : '' }}>School</option>
                            <option value="Master" {{ Auth::user()->education === 'Master' ? 'selected' : '' }}>Master</option>
                        </select>
                    </div>
                    <div class="account-form-full-width-input-block account-form-text-input-block">
                        <label>Certificates</label>
                        @error('certificates')
                        <br><span class="account-validation-error-message invalid-certificates" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <textarea name="certificates">{{ Auth::user()->certificates ?? '' }}</textarea>
                    </div>
                    <div class="account-form-full-width-input-block account-form-text-input-block">
                        <label>Address</label>
                        @error('address')
                        <br><span class="account-validation-error-message invalid-address" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <textarea name="address">{{ Auth::user()->address ?? '' }}</textarea>
                    </div>
                    <div class="account-form-full-width-input-block account-form-text-input-block">
                        <label>Email</label>
                        @error('email')
                        <br><span class="account-validation-error-message invalid-email" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input name="email" value="{{ Auth::user()->email ?? '' }}">
                    </div>

                    <button type="submit" class="account-form-submit-button">Update Profile</button>
                </form>
            </div>
            <div class="account-section-right-block">
                <a href="{{ route('account-profile') }}" class="active">Profile</a>
                <a href="{{ route('account-password') }}">Password</a>
                <a href="{{ route('account-notifications') }}">Notification Preferences</a>
            </div>
        </div>
    </div>
@endsection
