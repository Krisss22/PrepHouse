@extends('layouts.app')

@section('content')
    <div class="container share-question-page-container">
        <div class="share-question-page-logo-block">
            <div>
                <svg width="53" height="54" viewBox="0 0 53 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M49.6519 0.0172608C41.6012 -0.267488 33.7195 2.98563 28.0241 8.68092L17.2003 19.5048C14.2785 22.4266 12.0017 26.0286 10.616 29.9214C9.23031 33.8143 8.71904 38.0447 9.1375 42.1555L9.26763 43.4339L31.4757 26.9174L52.6842 0.0172608H49.6519Z" fill="#F7B631"/>
                    <path d="M52.6846 0.0170898L9.26807 43.4336L10.5464 43.5638C11.478 43.6586 12.4151 43.7057 13.3538 43.7057C16.5567 43.7057 19.7699 43.157 22.7805 42.0853C26.6734 40.6996 30.2753 38.4227 33.1971 35.5009L44.0211 24.6771C49.7165 18.9817 52.9694 11.0987 52.6847 3.04936V0.0170898H52.6846Z" fill="#F89258"/>
                    <path d="M21.4361 29.8571C21.0177 25.7463 21.5289 21.5159 22.9146 17.623C23.9432 14.7332 25.3483 11.9465 27.1988 9.50659L21.1413 15.5641C19.2908 18.004 17.8858 20.7907 16.8572 23.6804C15.4715 27.5733 14.9603 31.8037 15.3787 35.9145L15.5088 37.1929L20.3613 34.578L21.5662 31.1355L21.4361 29.8571Z" fill="#FFD782"/>
                    <path d="M25.6519 31.4078C24.7134 31.4078 23.7762 31.3607 22.8446 31.2659L21.5662 31.1358L15.5088 37.1932L16.7872 37.3233C17.7188 37.4181 18.6558 37.4652 19.5945 37.4652C22.7975 37.4652 26.0106 36.9165 29.0213 35.8448C32.4998 34.6066 35.6843 32.5334 38.5379 30.1605L44.0208 24.6776C44.0333 24.6651 44.0453 24.6522 44.0577 24.6396C41.421 26.8722 38.3025 28.6398 35.0787 29.7873C32.068 30.859 28.8549 31.4078 25.6519 31.4078Z" fill="#D56F35"/>
                    <path d="M36.7279 13.7375L4.21657 46.2489L0.00439453 52.6987L17.5125 36.7431L37.8467 14.8564L36.7279 13.7375Z" fill="#ECF3FB"/>
                    <path d="M0 52.6943L37.8367 14.8577L38.9553 15.9763L1.11865 53.813L0 52.6943Z" fill="#E0E6F5"/>
                </svg>
            </div>
            <div class="share-question-page-logo-block-text">PREPHouse</div>
        </div>

        <div class="share-question-description">Send question to help our project to grow</div>

        <div class="share-question-titles-block">
            @foreach($vacancies as $vacancy)
                <div class="share-question-titles-item share-question-titles-item-color-{{ $titlesColors[rand(0, count($titlesColors) - 1)] }}"><div><span>{{ $vacancy->name }}</span></div></div>
            @endforeach
            <div class="share-question-titles-item share-question-titles-item-color-grey"><div><span>Other</span></div></div>
            @error('title')<span class="invalid-share-question invalid-share-question-title" role="alert">{{ $message }}</span>@enderror
        </div>

        <div class="share-question-form-block">
            <div class="share-question-form-block-title">Ask your question</div>
            <div class="share-question-form-block-other">Don't have any questions? <a href="/register">SignUp</a></div>
            <form class="share-question-form" method="POST" action="{{ route('share-question') }}">
                @csrf
                <div class="form-row hidden">
                    <label class="share-question-form-text-label">Job Title @error('title')<span class="invalid-share-question" role="alert">{{ $message }}</span>@enderror</label>
                    <input type="text" name="title" id="share-question-title" class="share-question-form-text-input">
                </div>
                <div class="form-row">
                    <label class="share-question-form-text-label">Question @error('question')<span class="invalid-share-question" role="alert">{{ $message }}</span>@enderror</label>
                    <input type="text" name="question" class="share-question-form-text-input">
                </div>
                <div class="form-row">
                    <label class="share-question-form-text-label">Answer (optional)</label>
                    <input type="text" name="answer" class="share-question-form-text-input">
                </div>
                <div class="form-row">
                    <label class="share-question-form-text-label">Email @error('email')<span class="invalid-share-question" role="alert">{{ $message }}</span>@enderror</label>
                    <input type="text" name="email" class="share-question-form-text-input">
                </div>
                <div class="form-row">
                    <input type="checkbox" name="send_feedback" id="send_feedback">
                    <label for="send_feedback" class="share-question-form-checkbox-label">We will send you our feedback by mail</label>
                </div>
                <input type="submit" class="share-question-form-send" value="Send question">
                <div class="share-question-form-left-line"></div><div class="share-question-form-middle-line-text">or</div><div class="share-question-form-right-line"></div>
                <a href="/register" class="share-question-form-sign-up">SignUp</a>
            </form>
            <div class="share-question-form-block-footer">Register now to skip adding questions and keep track of your interview/quizes results</div>
        </div>
    </div>
@endsection
