<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\QuizAction;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
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

        try {
            session_start();
            if (isset($_SESSION['unlogged_quizzes_id']) && is_array($_SESSION['unlogged_quizzes_id'])) {
                foreach ($_SESSION['unlogged_quizzes_id'] as $quizId) {
                    QuizAction::findOrFail($quizId)->update([
                        'user_id' => $newUser->id
                    ]);
                    $this->redirectTo = route('quiz-statistic', [
                        'quizActionId' => $quizId,
                    ]);
                }
                unset($_SESSION['unlogged_quizzes_id']);
            }
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            throw $exception;
        }

        return $newUser;
    }
}
