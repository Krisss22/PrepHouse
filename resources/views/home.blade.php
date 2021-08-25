@extends('layouts.app')

@section('content')
    <div class="home-head-block">
        <div class="home-menu-block">
            <div class="icon">
                <svg width="193" height="61" viewBox="0 0 193 61" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M50.6833 21.0958H58.9641C59.9499 21.0958 60.8371 21.2683 61.6257 21.6134C62.4308 21.9584 63.1127 22.4267 63.6713 23.0181C64.2463 23.5932 64.6817 24.275 64.9775 25.0637C65.2897 25.8359 65.4457 26.6574 65.4457 27.5282C65.4457 28.399 65.2897 29.2205 64.9775 29.9927C64.6817 30.7649 64.2463 31.4468 63.6713 32.0383C63.1127 32.6133 62.4308 33.0734 61.6257 33.4184C60.8371 33.7634 59.9499 33.9359 58.9641 33.9359H55.8095V38.3474H50.6833V21.0958ZM57.929 29.9681C58.619 29.9681 59.1695 29.7298 59.5802 29.2534C60.0074 28.7769 60.221 28.2018 60.221 27.5282C60.221 26.8546 60.0156 26.2795 59.6048 25.803C59.1941 25.3266 58.6437 25.0883 57.9536 25.0883H55.8095V29.9681H57.929ZM67.2658 21.0958H75.5466C76.5324 21.0958 77.4196 21.2683 78.2083 21.6134C79.0133 21.9584 79.6952 22.4267 80.2538 23.0181C80.8289 23.5932 81.2642 24.275 81.56 25.0637C81.8722 25.8359 82.0282 26.6574 82.0282 27.5282C82.0282 28.7112 81.7489 29.7956 81.1903 30.7814C80.6317 31.7672 79.8595 32.5394 78.8737 33.098L82.324 38.3474H76.2859L73.3532 33.9359H72.392V38.3474H67.2658V21.0958ZM74.5115 29.9681C75.2015 29.9681 75.752 29.7298 76.1627 29.2534C76.5899 28.7769 76.8035 28.2018 76.8035 27.5282C76.8035 26.8546 76.5981 26.2795 76.1874 25.803C75.7766 25.3266 75.2262 25.0883 74.5361 25.0883H72.392V29.9681H74.5115ZM89.6003 24.9405V27.9472H95.589V31.6193H89.6003V34.5028H95.589V38.3474H84.4741V21.0958H95.589V24.9405H89.6003ZM98.4332 21.0958H106.714C107.7 21.0958 108.587 21.2683 109.376 21.6134C110.181 21.9584 110.863 22.4267 111.421 23.0181C111.996 23.5932 112.432 24.275 112.727 25.0637C113.04 25.8359 113.196 26.6574 113.196 27.5282C113.196 28.399 113.04 29.2205 112.727 29.9927C112.432 30.7649 111.996 31.4468 111.421 32.0383C110.863 32.6133 110.181 33.0734 109.376 33.4184C108.587 33.7634 107.7 33.9359 106.714 33.9359H103.559V38.3474H98.4332V21.0958ZM105.679 29.9681C106.369 29.9681 106.919 29.7298 107.33 29.2534C107.757 28.7769 107.971 28.2018 107.971 27.5282C107.971 26.8546 107.766 26.2795 107.355 25.803C106.944 25.3266 106.394 25.0883 105.704 25.0883H103.559V29.9681H105.679ZM125.712 30.7814H117.677V38.3474H115.435V21.0958H117.677V28.7605H125.712V21.0958H127.954V38.3474H125.712V30.7814ZM139.786 38.7417C138.406 38.7417 137.165 38.4953 136.064 38.0024C134.963 37.493 134.027 36.8194 133.255 35.9815C132.499 35.1435 131.916 34.1824 131.505 33.098C131.094 32.0136 130.889 30.8882 130.889 29.7216C130.889 28.5551 131.094 27.4296 131.505 26.3452C131.916 25.2609 132.499 24.2997 133.255 23.4618C134.027 22.6238 134.963 21.9584 136.064 21.4655C137.165 20.9562 138.406 20.7015 139.786 20.7015C141.166 20.7015 142.406 20.9562 143.507 21.4655C144.608 21.9584 145.536 22.6238 146.292 23.4618C147.064 24.2997 147.656 25.2609 148.066 26.3452C148.477 27.4296 148.683 28.5551 148.683 29.7216C148.683 30.8882 148.477 32.0136 148.066 33.098C147.656 34.1824 147.064 35.1435 146.292 35.9815C145.536 36.8194 144.608 37.493 143.507 38.0024C142.406 38.4953 141.166 38.7417 139.786 38.7417ZM139.786 36.7208C140.788 36.7208 141.692 36.5237 142.497 36.1294C143.318 35.735 144.008 35.2175 144.567 34.5767C145.125 33.9195 145.553 33.1719 145.848 32.334C146.16 31.4961 146.317 30.6253 146.317 29.7216C146.317 28.818 146.16 27.9472 145.848 27.1092C145.553 26.2549 145.125 25.5073 144.567 24.8665C144.008 24.2093 143.318 23.6918 142.497 23.3139C141.692 22.9196 140.788 22.7224 139.786 22.7224C138.767 22.7224 137.855 22.9196 137.05 23.3139C136.245 23.6918 135.555 24.2093 134.98 24.8665C134.421 25.5073 133.986 26.2549 133.674 27.1092C133.378 27.9472 133.23 28.818 133.23 29.7216C133.23 30.6253 133.378 31.4961 133.674 32.334C133.986 33.1719 134.421 33.9195 134.98 34.5767C135.555 35.2175 136.245 35.735 137.05 36.1294C137.855 36.5237 138.767 36.7208 139.786 36.7208ZM151.412 21.0958H153.654V32.753C153.654 33.2952 153.745 33.8045 153.925 34.281C154.106 34.7574 154.353 35.1764 154.665 35.5379C154.993 35.8993 155.388 36.1869 155.848 36.4004C156.308 36.614 156.817 36.7208 157.376 36.7208C157.951 36.7208 158.468 36.614 158.928 36.4004C159.405 36.1869 159.807 35.8993 160.136 35.5379C160.465 35.1764 160.719 34.7574 160.9 34.281C161.081 33.8045 161.171 33.2952 161.171 32.753V21.0958H163.414V32.753C163.414 33.5745 163.274 34.3467 162.995 35.0696C162.715 35.7925 162.313 36.4251 161.787 36.9673C161.261 37.5095 160.621 37.9449 159.865 38.2735C159.126 38.5856 158.296 38.7417 157.376 38.7417C156.472 38.7417 155.651 38.5856 154.911 38.2735C154.188 37.9449 153.564 37.5095 153.038 36.9673C152.529 36.4251 152.126 35.7925 151.831 35.0696C151.551 34.3467 151.412 33.5745 151.412 32.753V21.0958ZM168.513 32.8516C168.513 34.0345 168.866 34.9792 169.573 35.6857C170.279 36.3758 171.224 36.7208 172.407 36.7208C173.409 36.7208 174.231 36.458 174.871 35.9322C175.512 35.4064 175.833 34.6917 175.833 33.7881C175.833 33.2623 175.734 32.8269 175.537 32.4819C175.34 32.1368 175.077 31.8493 174.748 31.6193C174.436 31.3728 174.083 31.1839 173.688 31.0525C173.311 30.9046 172.933 30.7731 172.555 30.6581C171.783 30.4117 171.051 30.157 170.361 29.8941C169.671 29.6313 169.063 29.3109 168.538 28.933C168.028 28.5387 167.626 28.054 167.33 27.4789C167.034 26.9039 166.886 26.1809 166.886 25.3101C166.886 24.6201 167.018 23.9957 167.281 23.4371C167.56 22.8785 167.938 22.3938 168.414 21.9831C168.891 21.5723 169.458 21.2601 170.115 21.0465C170.772 20.8165 171.487 20.7015 172.259 20.7015C173.048 20.7015 173.771 20.8329 174.428 21.0958C175.085 21.3423 175.652 21.6955 176.128 22.1556C176.605 22.6156 176.983 23.1742 177.262 23.8314C177.541 24.4722 177.681 25.1869 177.681 25.9756H175.438C175.422 24.9898 175.134 24.2011 174.576 23.6096C174.033 23.0181 173.278 22.7224 172.308 22.7224C171.355 22.7224 170.583 22.9524 169.992 23.4125C169.417 23.8725 169.129 24.5051 169.129 25.3101C169.129 25.7866 169.219 26.1892 169.4 26.5178C169.581 26.8299 169.819 27.101 170.115 27.331C170.411 27.5446 170.747 27.7336 171.125 27.8979C171.52 28.0458 171.922 28.1772 172.333 28.2922C172.99 28.5058 173.656 28.744 174.329 29.0069C175.019 29.2698 175.644 29.5984 176.202 29.9927C176.761 30.387 177.213 30.8717 177.558 31.4468C177.903 32.0054 178.075 32.7037 178.075 33.5416C178.075 34.3795 177.919 35.1271 177.607 35.7843C177.311 36.4251 176.901 36.9673 176.375 37.4109C175.849 37.8545 175.233 38.1831 174.526 38.3967C173.82 38.6267 173.056 38.7417 172.234 38.7417C171.396 38.7417 170.616 38.6103 169.893 38.3474C169.17 38.0681 168.538 37.682 167.995 37.1891C167.47 36.6798 167.051 36.0636 166.739 35.3407C166.426 34.6014 166.27 33.7716 166.27 32.8516H168.513ZM183.406 23.1167V28.7605H190.849V30.7814H183.406V36.3265H190.849V38.3474H181.163V21.0958H190.849V23.1167H183.406Z" fill="white"/>
                    <path d="M43.2045 0.0150196C36.1991 -0.232756 29.3408 2.59796 24.385 7.55376L14.9665 16.9723C12.4241 19.5147 10.4429 22.649 9.23715 26.0363C8.03138 29.4237 7.5865 33.1049 7.95062 36.6819L8.06385 37.7943L27.3884 23.4224L45.8431 0.0150196H43.2045Z" fill="#F7B631"/>
                    <path d="M45.8437 0.0148926L8.06445 37.7941L9.17684 37.9073C9.98748 37.9898 10.8029 38.0308 11.6197 38.0308C14.4067 38.0308 17.2027 37.5534 19.8224 36.6208C23.2098 35.415 26.3441 33.4338 28.8865 30.8914L38.305 21.473C43.2609 16.5171 46.0914 9.65767 45.8437 2.65345V0.0148926H45.8437Z" fill="#F89258"/>
                    <path d="M18.6527 25.9806C18.2885 22.4036 18.7334 18.7224 19.9392 15.335C20.8343 12.8204 22.0569 10.3955 23.6671 8.27246L18.3961 13.5434C16.7859 15.6665 15.5634 18.0914 14.6683 20.6059C13.4625 23.9933 13.0176 27.6744 13.3818 31.2515L13.495 32.3639L17.7174 30.0885L18.7659 27.093L18.6527 25.9806Z" fill="#FFD782"/>
                    <path d="M22.3217 27.3296C21.505 27.3296 20.6895 27.2886 19.8789 27.2061L18.7665 27.0928L13.4956 32.3637L14.608 32.477C15.4186 32.5595 16.234 32.6004 17.0508 32.6004C19.8379 32.6004 22.6339 32.123 25.2536 31.1904C28.2805 30.113 31.0515 28.3089 33.5345 26.2441L38.3055 21.4732C38.3164 21.4623 38.3268 21.4511 38.3376 21.4402C36.0433 23.3829 33.3297 24.9209 30.5245 25.9195C27.9048 26.852 25.1088 27.3296 22.3217 27.3296Z" fill="#D56F35"/>
                    <path d="M31.9586 11.9536L3.66867 40.2436L0.00341797 45.8559L15.2382 31.9721L32.9322 12.9272L31.9586 11.9536Z" fill="#ECF3FB"/>
                    <path d="M0 45.8525L32.9238 12.9287L33.8972 13.9021L0.973403 46.8259L0 45.8525Z" fill="#E0E6F5"/>
                </svg>
            </div>
            <div class="menu">
                <a class="menu-item"><div>Course Gallery</div></a>
                @guest
                    <a class="menu-item log-in-button" href="{{ route('login') }}"><div>Sign In</div></a>
                    <a class="menu-item sign-in-button" href="{{ route('register') }}"><div>Sign Up</div></a>
                @else
                    <a class="menu-item log-in-button" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><div>Sign Out</div></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endguest
                <a class="menu-item"><div>En</div></a>
            </div>
        </div>
        <div class="home-head-content-block">
            <div class="home-head-content-left-block">
                <div class="home-head-content-left-first-rectangle">
                    <div>Your personal coach</div>
                    <svg width="541" height="98" viewBox="0 0 541 98" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.41663 10.7812L532.583 0.78125C537.232 0.78125 541 4.36623 541 8.78564V89.7769C541 94.1976 537.229 97.7812 532.583 97.7812L8.41663 77.7812C3.76825 77.7812 0 74.1963 0 69.7769V18.7856C0 14.3649 3.77079 10.7812 8.41663 10.7812Z" fill="#4780D8"/>
                    </svg>
                </div>
                <div class="home-head-content-left-second-rectangle">
                    <div>Over 1000 interview questions</div>
                    <svg width="540" height="109" viewBox="0 0 540 109" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.1" fill-rule="evenodd" clip-rule="evenodd" d="M529.102 24.7812L10.8976 0.78125C4.87903 0.78125 0 4.36623 0 8.78564V100.777C0 105.198 4.88232 108.781 10.8976 108.781L529.102 96.7812C535.121 96.7812 540 93.1963 540 88.7769V32.7856C540 28.3649 535.118 24.7812 529.102 24.7812Z" fill="white"/>
                    </svg>
                </div>
                <div class="home-head-content-left-text-block">
                    <p>We created unique and comprehensive quizzes and courses for better preparation for your upcoming interview. Select your desired title and start a quiz to see how close you are to pass this interview.  It is 100% free, you will see your results immediately after completion. </p>
                </div>
                <div class="home-head-content-left-buttons-block">
                    <a class="home-head-content-left-start-quiz-button">
                        <div class="home-head-content-left-start-quiz-button-svg">
                            <svg width="40" height="41" viewBox="0 0 40 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="20" cy="20.7812" r="20" fill="white"/>
                                <path d="M17.2244 13.6258C16.4149 13.1712 15.3953 13.4682 14.947 14.2892C14.8095 14.5411 14.7373 14.8244 14.7373 15.1123V26.8298C14.7373 27.7682 15.4874 28.529 16.4128 28.529C16.6968 28.529 16.9761 28.4558 17.2246 28.3162L27.6557 22.4567C28.4652 22.002 28.7579 20.9679 28.3096 20.147C28.1572 19.868 27.9306 19.6382 27.6555 19.4837L17.2244 13.6258Z" fill="#F7B631"/>
                            </svg>
                        </div>
                        <div class="home-head-content-left-start-quiz-button-text">Start Quiz</div>
                    </a>
                    <a href="/share-question" class="home-head-content-left-share-question-button">
                        <div class="home-head-content-left-share-question-button-svg">
                            <svg width="40" height="41" viewBox="0 0 40 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="20" cy="20.7812" r="20" fill="white"/>
                                <path d="M18.0472 22.1412C18.0472 21.4372 18.2552 20.7652 18.6712 20.1252C19.1032 19.4852 19.5672 18.9732 20.0632 18.5892C20.5592 18.1892 21.0152 17.7252 21.4312 17.1972C21.8632 16.6692 22.0792 16.1412 22.0792 15.6132C22.0792 15.0532 21.8872 14.6212 21.5032 14.3172C21.1192 14.0132 20.5832 13.8612 19.8952 13.8612C18.5512 13.8612 17.5992 14.5732 17.0392 15.9972L14.2072 14.3652C14.6872 13.1812 15.4472 12.2692 16.4872 11.6292C17.5432 10.9732 18.7192 10.6452 20.0152 10.6452C21.4712 10.6452 22.7272 11.0692 23.7832 11.9172C24.8552 12.7492 25.3912 13.9012 25.3912 15.3732C25.3912 16.0452 25.2472 16.6692 24.9592 17.2452C24.6872 17.8212 24.3512 18.3172 23.9512 18.7332C23.5672 19.1332 23.1752 19.5172 22.7752 19.8852C22.3912 20.2372 22.0552 20.6052 21.7672 20.9892C21.4952 21.3732 21.3592 21.7572 21.3592 22.1412H18.0472ZM21.1432 27.4932C20.7432 27.8933 20.2632 28.0933 19.7032 28.0933C19.1432 28.0933 18.6632 27.8933 18.2632 27.4932C17.8632 27.0932 17.6632 26.6132 17.6632 26.0532C17.6632 25.4932 17.8632 25.0132 18.2632 24.6133C18.6632 24.2132 19.1432 24.0132 19.7032 24.0132C20.2632 24.0132 20.7432 24.2132 21.1432 24.6133C21.5432 25.0132 21.7432 25.4932 21.7432 26.0532C21.7432 26.6132 21.5432 27.0932 21.1432 27.4932Z" fill="#1C3A67"/>
                            </svg>
                        </div>
                        <div class="home-head-content-left-share-question-button-text">Share question</div>
                    </a>
                </div>
            </div>
            <div class="home-head-content-right-block">
                <div class="home-head-content-screen">
                    <img src="../../storage/images/home/home-head-content-screen.png">
                </div>
            </div>
        </div>
    </div>
    <div class="home-middle-block">
        <div class="home-middle-block-title">Pick A desired job title</div>
        <div class="home-middle-block-description">You will be ask to answer different question same as you are on a real interview</div>
        <a class="home-middle-block-button"><p>View all Jobs</p></a>

        <div class="home-middle-block-jobs-list">
            <div class="home-middle-block-jobs-list-item">
                <div class="job-item-questions-count">78 questions</div>
                <div class="job-item-title">Java Automation Engineer</div>
                <div class="job-item-description">You will be asked to answer most common 20-30 interview questions.</div>
                <img class="job-item-play-icon" src="../../storage/images/home/job_item_play_icon.svg">
            </div>
            <div class="home-middle-block-jobs-list-item">
                <div class="job-item-questions-count">78 questions</div>
                <div class="job-item-title">Java Automation Engineer</div>
                <div class="job-item-description">You will be asked to answer most common 20-30 interview questions.</div>
                <img class="job-item-play-icon" src="../../storage/images/home/job_item_play_icon.svg">
            </div>
            <div class="home-middle-block-jobs-list-item">
                <div class="job-item-questions-count">78 questions</div>
                <div class="job-item-title">Java Automation Engineer</div>
                <div class="job-item-description">You will be asked to answer most common 20-30 interview questions.</div>
                <img class="job-item-play-icon" src="../../storage/images/home/job_item_play_icon.svg">
            </div>
            <br>
            <div class="home-middle-block-jobs-list-item">
                <div class="job-item-questions-count">78 questions</div>
                <div class="job-item-title">Java Automation Engineer</div>
                <div class="job-item-description">You will be asked to answer most common 20-30 interview questions.</div>
                <img class="job-item-play-icon" src="../../storage/images/home/job_item_play_icon.svg">
            </div>
            <div class="home-middle-block-jobs-list-item">
                <div class="job-item-questions-count">78 questions</div>
                <div class="job-item-title">Java Automation Engineer</div>
                <div class="job-item-description">You will be asked to answer most common 20-30 interview questions.</div>
                <img class="job-item-play-icon" src="../../storage/images/home/job_item_play_icon.svg">
            </div>
            <div class="home-middle-block-jobs-list-item">
                <div class="job-item-questions-count">78 questions</div>
                <div class="job-item-title">Java Automation Engineer</div>
                <div class="job-item-description">You will be asked to answer most common 20-30 interview questions.</div>
                <img class="job-item-play-icon" src="../../storage/images/home/job_item_play_icon.svg">
            </div>
        </div>

        <div class="home-middle-block-how-it-work-block">
            <img src="../../storage/images/home/how-it-work.png">
        </div>

        <div class="home-middle-block-share-question-block">
            <div class="home-middle-block-share-question-block-title">Have interview question you want to share?</div>
            <div class="home-middle-block-share-question-block-description">
                 We will be glad to hear that!
                <p>
                 Click this button to submit one or more super interesting question from your expirience.
                </p>
            </div>
            <a class="home-middle-block-share-question-block-button">
                <div class="home-middle-block-share-question-block-button-svg">
                    <svg width="40" height="41" viewBox="0 0 40 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="20" cy="20.7812" r="20" fill="white"/>
                        <path d="M18.0472 22.1412C18.0472 21.4372 18.2552 20.7652 18.6712 20.1252C19.1032 19.4852 19.5672 18.9732 20.0632 18.5892C20.5592 18.1892 21.0152 17.7252 21.4312 17.1972C21.8632 16.6692 22.0792 16.1412 22.0792 15.6132C22.0792 15.0532 21.8872 14.6212 21.5032 14.3172C21.1192 14.0132 20.5832 13.8612 19.8952 13.8612C18.5512 13.8612 17.5992 14.5732 17.0392 15.9972L14.2072 14.3652C14.6872 13.1812 15.4472 12.2692 16.4872 11.6292C17.5432 10.9732 18.7192 10.6452 20.0152 10.6452C21.4712 10.6452 22.7272 11.0692 23.7832 11.9172C24.8552 12.7492 25.3912 13.9012 25.3912 15.3732C25.3912 16.0452 25.2472 16.6692 24.9592 17.2452C24.6872 17.8212 24.3512 18.3172 23.9512 18.7332C23.5672 19.1332 23.1752 19.5172 22.7752 19.8852C22.3912 20.2372 22.0552 20.6052 21.7672 20.9892C21.4952 21.3732 21.3592 21.7572 21.3592 22.1412H18.0472ZM21.1432 27.4932C20.7432 27.8933 20.2632 28.0933 19.7032 28.0933C19.1432 28.0933 18.6632 27.8933 18.2632 27.4932C17.8632 27.0932 17.6632 26.6132 17.6632 26.0532C17.6632 25.4932 17.8632 25.0132 18.2632 24.6133C18.6632 24.2132 19.1432 24.0132 19.7032 24.0132C20.2632 24.0132 20.7432 24.2132 21.1432 24.6133C21.5432 25.0132 21.7432 25.4932 21.7432 26.0532C21.7432 26.6132 21.5432 27.0932 21.1432 27.4932Z" fill="#1C3A67"/>
                    </svg>
                </div>
                <div class="home-middle-block-share-question-block-button-text">Share question</div>
            </a>
            <div class="home-middle-block-share-question-block-image">
                <img src="../../storage/images/home/share_question_image.svg">
            </div>
        </div>

        <div class="home-middle-block-lectures-block">
            <div class="home-middle-block-lectures-block-title">Modules Lectures</div>
            <div class="home-middle-block-lectures-block-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
            <a class="home-middle-block-lectures-block-button"><p>View all Lectures</p></a>
            <div class="home-middle-block-lectures-block-list">
                <div class="home-middle-block-lectures-block-list-item">
                    <div class="home-middle-block-lectures-block-list-item-info">3 videos * 2 articles * 1 book</div>
                    <div class="home-middle-block-lectures-block-list-item-title">Watch Java tutorial</div>
                    <div class="home-middle-block-lectures-block-list-item-description">Sample text.  the text box. Click again or double click to start editing the text.</div>
                    <img class="home-middle-block-lectures-block-list-item-play-icon" src="../../storage/images/home/job_item_play_icon.svg">
                </div>
                <div class="home-middle-block-lectures-block-list-item">
                    <div class="home-middle-block-lectures-block-list-item-info">3 videos * 2 articles * 1 book</div>
                    <div class="home-middle-block-lectures-block-list-item-title">Watch Java tutorial</div>
                    <div class="home-middle-block-lectures-block-list-item-description">Sample text.  the text box. Click again or double click to start editing the text.</div>
                    <img class="home-middle-block-lectures-block-list-item-play-icon" src="../../storage/images/home/job_item_play_icon.svg">
                </div>
                <div class="home-middle-block-lectures-block-list-item">
                    <div class="home-middle-block-lectures-block-list-item-info">3 videos * 2 articles * 1 book</div>
                    <div class="home-middle-block-lectures-block-list-item-title">Watch Java tutorial</div>
                    <div class="home-middle-block-lectures-block-list-item-description">Sample text.  the text box. Click again or double click to start editing the text.</div>
                    <img class="home-middle-block-lectures-block-list-item-play-icon" src="../../storage/images/home/job_item_play_icon.svg">
                </div>
                <div class="home-middle-block-lectures-block-list-item">
                    <div class="home-middle-block-lectures-block-list-item-info">3 videos * 2 articles * 1 book</div>
                    <div class="home-middle-block-lectures-block-list-item-title">Watch Java tutorial</div>
                    <div class="home-middle-block-lectures-block-list-item-description">Sample text.  the text box. Click again or double click to start editing the text.</div>
                    <img class="home-middle-block-lectures-block-list-item-play-icon" src="../../storage/images/home/job_item_play_icon.svg">
                </div>
            </div>
        </div>

        <div class="home-middle-block-materials-block">
            <img src="../../storage/images/home/discoverImg.png" class="home-middle-block-materials-block-image">
            <div class="home-middle-block-materials-block-title"><p>All usefull materials in one place</p></div>
            <div class="home-middle-block-materials-block-description"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p></div>
            <a class="home-middle-block-materials-block-button"><p>Open Course Gallery</p></a>
        </div>

        <div class="home-middle-block-feedback-block">
            <div class="home-middle-block-feedback-block-left">
                <div class="home-middle-block-feedback-block-left-text-list">
                    <div data-feedback-id="0" class="home-middle-block-feedback-block-left-text-list-item active">
                        <div class="home-middle-block-feedback-block-left-text">
                            <img src="../../storage/images/home/quotes.png" class="home-middle-block-feedback-block-left-text-quotes">
                            1When someone does something that they know that they shouldn’t do, did they really have a choice.
                        </div>
                        <div data-feedback-id="0" class="home-middle-block-feedback-block-left-description">Natasha Kucherenko, Ukraine</div>
                    </div>
                    <div data-feedback-id="1" class="home-middle-block-feedback-block-left-text-list-item">
                        <div class="home-middle-block-feedback-block-left-text">
                            <img src="../../storage/images/home/quotes.png" class="home-middle-block-feedback-block-left-text-quotes">
                            2When someone does something that they know that they shouldn’t do, did they really have a choice.
                        </div>
                        <div data-feedback-id="0" class="home-middle-block-feedback-block-left-description">Natasha Kucherenko, Ukraine</div>
                    </div>
                    <div data-feedback-id="2" class="home-middle-block-feedback-block-left-text-list-item">
                        <div class="home-middle-block-feedback-block-left-text">
                            <img src="../../storage/images/home/quotes.png" class="home-middle-block-feedback-block-left-text-quotes">
                            3When someone does something that they know that they shouldn’t do, did they really have a choice.
                        </div>
                        <div data-feedback-id="0" class="home-middle-block-feedback-block-left-description">Natasha Kucherenko, Ukraine</div>
                    </div>
                    <div data-feedback-id="3" class="home-middle-block-feedback-block-left-text-list-item">
                        <div class="home-middle-block-feedback-block-left-text">
                            <img src="../../storage/images/home/quotes.png" class="home-middle-block-feedback-block-left-text-quotes">
                            4When someone does something that they know that they shouldn’t do, did they really have a choice.
                        </div>
                        <div data-feedback-id="0" class="home-middle-block-feedback-block-left-description">Natasha Kucherenko, Ukraine</div>
                    </div>
                </div>
                <div class="home-middle-block-feedback-block-left-images-list">
                    <img data-feedback-id="0" src="../../storage/images/home/example-photo-1.png" class="home-middle-block-feedback-block-left-images-list-item active">
                    <img data-feedback-id="1" src="../../storage/images/home/example-photo-2.png" class="home-middle-block-feedback-block-left-images-list-item">
                    <img data-feedback-id="2" src="../../storage/images/home/example-photo-3.png" class="home-middle-block-feedback-block-left-images-list-item">
                    <img data-feedback-id="3" src="../../storage/images/home/example-photo-4.png" class="home-middle-block-feedback-block-left-images-list-item">
                </div>
            </div>
            <div class="home-middle-block-feedback-block-right">
                <img data-feedback-id="0" src="../../storage/images/home/example-photo-1.png" class="home-middle-block-feedback-block-right-image active">
                <img data-feedback-id="1" src="../../storage/images/home/example-photo-2.png" class="home-middle-block-feedback-block-right-image">
                <img data-feedback-id="2" src="../../storage/images/home/example-photo-3.png" class="home-middle-block-feedback-block-right-image">
                <img data-feedback-id="3" src="../../storage/images/home/example-photo-4.png" class="home-middle-block-feedback-block-right-image">
            </div>
        </div>

        <div class="home-middle-block-email-form-block">
            <div class="home-middle-block-email-form-block-title">Sign Up to save your progress</div>
            <div class="home-middle-block-email-form-block-description">Some text...</div>
            <a href="/register" class="home-middle-block-email-form-block-button">Subscribe</a>
        </div>
    </div>
    <div class="home-bottom-block">
        <div class="home-bottom-socials">
            <a><img src="../../storage/images/home/twiter-icon.png"></a>
            <a><img src="../../storage/images/home/facebook-icon.png"></a>
            <a><img src="../../storage/images/home/instagram-icon.png"></a>
        </div>
        <div class="home-bottom-copyright">Copyright (C) 2021 PREPHouse.</div>
    </div>
@endsection
