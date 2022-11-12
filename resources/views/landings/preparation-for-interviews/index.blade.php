<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>PrepHouse</title>

        <link href="{{ asset('css/landings/preparation-for-interviews/preparation_for_interviews.css') }}" rel="stylesheet">
        <link href="{{ asset('css/common.css') }}" rel="stylesheet">
        <link href="{{ asset('css/notifications/notifications.css') }}" rel="stylesheet">
    </head>
    <body data-home-page="PrepHouse.html" data-home-page-title="PrepHouse" class="u-body">
        <div id="app">
            <div class="top-menu-block">
                <img alt="logo" src="{{ asset('images/landings/preparation-for-interviews/logo.svg') }}" class="logo desktop">
                <img alt="logo" src="{{ asset('images/landings/preparation-for-interviews/logo_mobile.svg') }}" class="logo mobile">

                @guest
                <div class="auth-block">
                    <a class="log-in" href="{{ route('login') }}">Log In</a>
                    <a class="sign-up" href="{{ route('register') }}">Sign Up</a>
                </div>
                @endguest
            </div>

            <div class="description-block">
                <div class="description-text-block">
                    <div class="large-description">Preparation for interviews with the best specialists<div class="small-description">Improve your interviewing skills by sharing real life experiences and interests in a secure online environment.</div></div>
                </div>
                <div class="description-images-block">
                    <img class="desktop" alt="" src="{{ asset('images/landings/preparation-for-interviews/description_image.svg') }}">
                    <img class="mobile" alt="" src="{{ asset('images/landings/preparation-for-interviews/description_image_mobile.svg') }}">
                </div>
            </div>

            <div class="how-its-work-block">
                <div class="small-label">How it works?</div>
                <div class="large-label">Simple and fast</div>
                <div class="scheme-block">
                    <div class="scheme-block-first-line">
                        <div class="scheme-item">
                            <img alt="" src="{{ asset('images/landings/preparation-for-interviews/scheme_Icon_1.svg') }}">
                            <div class="scheme-item-label">Submit</div>
                            <div class="scheme-item-description">You submit a job description of a position you are applying for</div>
                        </div>
                        <div class="arrow">
                            <img alt="" src="{{ asset('images/landings/preparation-for-interviews/scheme_arrow_right.svg') }}">
                        </div>
                        <div class="scheme-item">
                            <img alt="" src="{{ asset('images/landings/preparation-for-interviews/scheme_Icon_2.svg') }}">
                            <div class="scheme-item-label">Analyze</div>
                            <div class="scheme-item-description">We analyze the position requirements</div>
                        </div>
                        <div class="arrow">
                            <img alt="" src="{{ asset('images/landings/preparation-for-interviews/scheme_arrow_right.svg') }}">
                        </div>
                        <div class="scheme-item">
                            <img alt="" src="{{ asset('images/landings/preparation-for-interviews/scheme_Icon_2.svg') }}">
                            <div class="scheme-item-label">Interview</div>
                            <div class="scheme-item-description">We conduct the interview in a time window that works for you</div>
                        </div>

                        <img alt="" src="{{ asset('images/landings/preparation-for-interviews/scheme_large_arrow.svg') }}" class="scheme-arrow">
                    </div>
                    <div class="scheme-block-second-line">
                        <div class="scheme-item">
                            <img alt="" src="{{ asset('images/landings/preparation-for-interviews/scheme_Icon_3.svg') }}">
                            <div class="scheme-item-label">Real interview</div>
                            <div class="scheme-item-description">You go to the real interview prepared and confident</div>
                        </div>
                        <div class="arrow">
                            <img alt="" src="{{ asset('images/landings/preparation-for-interviews/scheme_arrow_left.svg') }}">
                        </div>
                        <div class="scheme-item">
                            <img alt="" src="{{ asset('images/landings/preparation-for-interviews/scheme_Icon_4.svg') }}">
                            <div class="scheme-item-label">Sare Video</div>
                            <div class="scheme-item-description">We provide you with feedback and suggestions on how to improve</div>
                        </div>
                        <div class="arrow">
                            <img alt="" src="{{ asset('images/landings/preparation-for-interviews/scheme_arrow_left.svg') }}">
                        </div>
                        <div class="scheme-item">
                            <img alt="" src="{{ asset('images/landings/preparation-for-interviews/scheme_Icon_5.svg') }}">
                            <div class="scheme-item-label">Feedback</div>
                            <div class="scheme-item-description">We provide you with feedback and suggestions on how to improve</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pricing-block">
                <div class="small-label">Pricing</div>
                <div class="large-label">Choose the right plan</div>
                <div class="pricing-items">
                    <div class="pricing-item">
                        <div class="pricing-item-label">Screening call</div>
                        <div class="pricing-item-description">You get calls from recruters but nobody invites you for the interview? Probably you say something wrong! Let us help you</div>
                        <div class="pricing-item-price">$25</div>
                        <div class="pricing-item-offers">
                            <div class="pricing-item-offer"><img class="offer-check" alt="" src="{{ asset('images/landings/preparation-for-interviews/checklist_green.svg') }}"><div>10-15 min screening phone call</div></div>
                            <div class="pricing-item-offer"><img class="offer-check" alt="" src="{{ asset('images/landings/preparation-for-interviews/checklist_green.svg') }}"><div>We ask questions based on the position you are upplying</div></div>
                            <div class="pricing-item-offer"><img class="offer-check" alt="" src="{{ asset('images/landings/preparation-for-interviews/checklist_green.svg') }}"><div>We provide feedback</div></div>
                            <div class="pricing-item-offer"><img class="offer-check" alt="" src="{{ asset('images/landings/preparation-for-interviews/checklist_green.svg') }}"><div>We send you personalized learning materials</div></div>
                        </div>
                        <div class="pricing-item-select-button">Book your screening call</div>
                    </div>
                    <div class="pricing-item best-price">
                        <div class="pricing-item-label">Live interview</div>
                        <div class="pricing-item-description">You get calls from recruters but nobody invites you for the interview? Probably you say something wrong! Let us help you</div>
                        <div class="pricing-item-price">$50</div>
                        <div class="pricing-item-offers">
                            <div class="pricing-item-offer"><img class="offer-check" alt="" src="{{ asset('images/landings/preparation-for-interviews/checklist_white.svg') }}"><div>30-40 min video interview</div></div>
                            <div class="pricing-item-offer"><img class="offer-check" alt="" src="{{ asset('images/landings/preparation-for-interviews/checklist_white.svg') }}"><div>We ask questions based on the position you are upplying</div></div>
                            <div class="pricing-item-offer"><img class="offer-check" alt="" src="{{ asset('images/landings/preparation-for-interviews/checklist_white.svg') }}"><div>We provide feedback how to improve</div></div>
                            <div class="pricing-item-offer"><img class="offer-check" alt="" src="{{ asset('images/landings/preparation-for-interviews/checklist_white.svg') }}"><div>Write your text here</div></div>
                            <div class="pricing-item-offer"><img class="offer-check" alt="" src="{{ asset('images/landings/preparation-for-interviews/checklist_white.svg') }}"><div>We send you interview recording personalized learning materials</div></div>
                        </div>
                        <div class="pricing-item-select-button">Book your live interview</div>
                    </div>
                    <div class="pricing-item">
                        <div class="pricing-item-label">Self-paced interview</div>
                        <div class="pricing-item-description">You get calls from recruters but nobody invites you for the interview? Probably you say something wrong! Let us help you</div>
                        <div class="pricing-item-price">$20</div>
                        <div class="pricing-item-offers">
                            <div class="pricing-item-offer"><img class="offer-check" alt="" src="{{ asset('images/landings/preparation-for-interviews/checklist_green.svg') }}"><div>20 most common interview questions</div></div>
                            <div class="pricing-item-offer"><img class="offer-check" alt="" src="{{ asset('images/landings/preparation-for-interviews/checklist_green.svg') }}"><div>Record your answer how would you answer during the interview</div></div>
                            <div class="pricing-item-offer"><img class="offer-check" alt="" src="{{ asset('images/landings/preparation-for-interviews/checklist_green.svg') }}"><div>We provide writen feedback based on our answers</div></div>
                            <div class="pricing-item-offer"><img class="offer-check" alt="" src="{{ asset('images/landings/preparation-for-interviews/checklist_green.svg') }}"><div>We suggest how to improve</div></div>
                        </div>
                        <div class="pricing-item-select-button">Pay and complete any time</div>
                    </div>
                </div>
                <div class="pricing-bottom-arc"></div>
            </div>

            <div class="feedback-block">
                <div class="small-label">Testimonials</div>
                <div class="large-label">Words from satisfied users</div>
                <div class="feedback-items">
                    <div class="feedback-items-line">
                        <div class="feedback-item" data-visible="true">
                            <img alt="" src="{{ asset('images/landings/preparation-for-interviews/feedback_icon.svg') }}">
                            <div class="feedback-item-description">111 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the, when.</div>
                            <img alt="" src="{{ asset('images/landings/preparation-for-interviews/feedback_test.png') }}" class="feedback-item-avatar">
                            <div class="feedback-item-name">Name Name<br>2022-02-02</div>
                        </div>
                        <div class="feedback-item" data-visible="true">
                            <img alt="" src="{{ asset('images/landings/preparation-for-interviews/feedback_icon.svg') }}">
                            <div class="feedback-item-description">222 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the, when.</div>
                            <img alt="" src="{{ asset('images/landings/preparation-for-interviews/feedback_test.png') }}" class="feedback-item-avatar">
                            <div class="feedback-item-name">Name Name<br>2022-02-02</div>
                        </div>
                        <div class="feedback-item" data-visible="true">
                            <img alt="" src="{{ asset('images/landings/preparation-for-interviews/feedback_icon.svg') }}">
                            <div class="feedback-item-description">333 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the, when.</div>
                            <img alt="" src="{{ asset('images/landings/preparation-for-interviews/feedback_test.png') }}" class="feedback-item-avatar">
                            <div class="feedback-item-name">Name Name<br>2022-02-02</div>
                        </div>
                        <div class="feedback-item" data-visible="true">
                            <img alt="" src="{{ asset('images/landings/preparation-for-interviews/feedback_icon.svg') }}">
                            <div class="feedback-item-description">444 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the, when.</div>
                            <img alt="" src="{{ asset('images/landings/preparation-for-interviews/feedback_test.png') }}" class="feedback-item-avatar">
                            <div class="feedback-item-name">Name Name<br>2022-02-02</div>
                        </div>
                        <div class="feedback-item" data-visible="true">
                            <img alt="" src="{{ asset('images/landings/preparation-for-interviews/feedback_icon.svg') }}">
                            <div class="feedback-item-description">555 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the, when.</div>
                            <img alt="" src="{{ asset('images/landings/preparation-for-interviews/feedback_test.png') }}" class="feedback-item-avatar">
                            <div class="feedback-item-name">Name Name<br>2022-02-02</div>
                        </div>
                        <div class="feedback-item" data-visible="true">
                            <img alt="" src="{{ asset('images/landings/preparation-for-interviews/feedback_icon.svg') }}">
                            <div class="feedback-item-description">666 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the, when.</div>
                            <img alt="" src="{{ asset('images/landings/preparation-for-interviews/feedback_test.png') }}" class="feedback-item-avatar">
                            <div class="feedback-item-name">Name Name<br>2022-02-02</div>
                        </div>
                    </div>
                </div>
                <div class="navigation">
                    <img alt="" src="{{ asset('images/landings/preparation-for-interviews/feedback_pagination_arrow_left.svg') }}" class="go-left">
                    <img alt="" src="{{ asset('images/landings/preparation-for-interviews/feedback_pagination_arrow_right.svg') }}" class="go-right">
                </div>
            </div>

            <div class="submit-form-block">
                <div class="label">Register to save your progress</div>
                <div class="description">Enter your email to receive updates!</div>
                <form method="post" action="{{ route('save-interview-request') }}">
                    @csrf
                    <label>Name</label>
                    @error('name')
                    <span class="invalid-name error-alert-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <input name="name" class="form-name">

                    <label>Email</label>
                    @error('email')
                    <span class="invalid-email error-alert-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <input name="email" class="form-email">

                    <label>Message</label>
                    @error('text')
                    <span class="invalid-text error-alert-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <textarea name="text" class="form-message"></textarea>
                    <button class="form-submit-button" type="submit">Subscribe</button>
                </form>
            </div>

            <div class="footer">
                <div class="socials">
                    <a href=""><img alt="" src="{{ asset('images/landings/preparation-for-interviews/twitter.svg') }}"></a>
                    <a href=""><img alt="" src="{{ asset('images/landings/preparation-for-interviews/facebook.svg') }}"></a>
                    <a href=""><img alt="" src="{{ asset('images/landings/preparation-for-interviews/instagramm.svg') }}"></a>
                </div>
                <div class="copyright">Copyright (C) {{ date("Y") }} PREPHouse.</div>
            </div>
        </div>

        <div id="notifications"></div>

        <script src="{{ asset('js/functions.js') }}"></script>
        <script src="{{ asset('js/landings/preparation-for-interviews/slider.js') }}"></script>
        <script src="{{ asset('js/notifications/notifications.js') }}"></script>
    </body>
</html>
