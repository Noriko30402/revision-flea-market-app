<?php

namespace App\Actions\Fortify;

use App\Http\Requests\RegisterRequest; // RegisterRequestのインポート
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        // $request = app(RegisterRequest::class);
        // $request->merge($input);
        // $validated = $request->validated(); // validated()を使用


        // Validator::make($input, [
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => [
        //         'required',
        //         'string',
        //         'email',
        //         'max:255',
        //         Rule::unique(User::class),
        //     ],
        //     'password' => $this->passwordRules(),
        // ])->validate();

        $request = app(RegisterRequest::class);
        $request->merge($input);

        // validate()を呼び出す前に引数を渡す
        $validated = $request->validated(); // validated()を使用

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        // メール認証
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify', now()->addMinutes(60), ['id' => $user->id]
        );

        // Mail::to($user->email)->send(new VerifyEmail($verificationUrl));

        return $user;
    }
}
