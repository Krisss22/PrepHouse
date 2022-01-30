<form class="auth-page-main-block-form auth-page-sign-up-form" method="POST" action="{{ route('register') }}">
    @csrf
    <div class="form-row">
        <div class="auth-page-sign-up-form-name-block">
            <label>First Name @error('name')<span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror</label>
            <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        </div>
        <div class="auth-page-sign-up-form-surname-block">
            <label>Surname @error('surname')<span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror</label>
            <input id="surname" type="text" class="@error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>
        </div>
    </div>
    <div class="form-row">
        <label>Job Title @error('job_title')<span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror</label>
        <input id="job-title" type="text" class="@error('job_title') is-invalid @enderror" name="job_title" value="{{ old('job_title') }}" required autocomplete="job-title" autofocus>
    </div>
    <div class="form-row">
        <label>Email @error('email')<span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror</label>
        <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    </div>
    <div class="form-row">
        <label>Create password @error('password')<span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror</label>
        <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
    </div>
    <div class="form-row">
        <label>Confirm password @error('password_confirmation')<span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror</label>
        <input id="password-confirm" type="password" class="@error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="password-confirm">
    </div>
    <div class="form-row auth-page-remember-me-row">
        <div class="auth-page-remember-me-block">
            <input id="auth-page-remember-me" type="checkbox" checked>
            <label for="auth-page-remember-me" class="auth-page-remember-me-checkbox"></label>
        </div>
        <div class="auth-page-remember-me-text">Remember Me</div>
    </div>
    <div class="form-row">
        <button type="submit" class="auth-page-main-block-form-submit-button">Sign Up</button>
    </div>
    <div class="form-row auth-page-form-other-info-block">
        By clicking on Sign Up, you agree to Live The Lingo's <a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy</a>
    </div>
</form>
