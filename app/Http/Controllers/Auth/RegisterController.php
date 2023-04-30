<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Services\Quiz\QuizService;
use Exception;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'job_title' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return User
     * @throws Exception
     */
    protected function create(array $data): User
    {
        $newUser = User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'job_title' => $data['job_title'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $lastUnloggedQuizId = QuizService::getLastUnloggedQuizActionId();
        if (isset($lastUnloggedQuizId)) {
            QuizService::attachUserForQuizActions($newUser->id);
            $this->redirectTo = route('quiz-statistic', [
                'quizActionId' => $lastUnloggedQuizId,
            ]);
        }

        return $newUser;
    }

    public function showRegistrationForm()
    {
        $this->setPageTitle("Sign Up");

        return $this->view('auth.register');
    }
}
