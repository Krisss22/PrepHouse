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
        <select id="job-title" name="job_title" class="@error('job_title') is-invalid @enderror" required autofocus>
            <option value="Junior level Developer">Junior level Developer</option>
            <option value="Middle level Developer">Middle level Developer</option>
            <option value="Senior level Developer">Senior level Developer</option>
            <option value="Leading Developer">Leading Developer</option>
            <option value="QA Analyst, Software Tester">QA Analyst, Software Tester</option>
            <option value="QA Engineer">QA Engineer</option>
            <option value="Senior QA Engineer">Senior QA Engineer</option>
            <option value="Automation QA Engineer">Automation QA Engineer</option>
            <option value="Test Lead">Test Lead</option>
            <option value="Automation Test Lead">Automation Test Lead</option>
            <option value="Business Analyst">Business Analyst</option>
            <option value="Senior Business Analyst">Senior Business Analyst</option>
            <option value="Designer">Designer</option>
            <option></option>
        </select>
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
        <input id="password-confirm" type="password" class="@error('password_confirmation') is-invalid @enderror" name="password_confirmation"  disabled required autocomplete="password-confirm">
    </div>
    <div class="form-row auth-page-remember-me-row">
        <div class="auth-page-remember-me-block">
            <input id="auth-page-remember-me" type="checkbox" checked>
            <label for="auth-page-remember-me" class="auth-page-remember-me-checkbox"></label>
        </div>
        <div class="auth-page-remember-me-text">Remember Me</div>
    </div>
    <div class="form-row auth-page-remember-me-row">
        <div class="auth-page-remember-me-block">
            <input id="auth-page-agree-terms" type="checkbox">
            <label for="auth-page-agree-terms" class="auth-page-remember-me-checkbox"></label>
        </div>
        <div class="auth-page-agree-terms-text">Agree with Terms and Conditions</div>
    </div>
    <div class="form-row">
        <button type="submit" class="auth-page-main-block-form-submit-button">Sign Up</button>
    </div>
    <div class="form-row auth-page-form-other-info-block">
        By clicking on Sign Up, you agree to Live The Lingo's <a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy</a>
    </div>
</form>
