<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_mobile' => 'required|string|min:6|max:13',
            'password' => 'required|string',
            'mobile_country_code' => 'required',
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    // public function authenticate()
    // {
    //     $this->ensureIsNotRateLimited();

    //     if (!Auth::attempt($this->only('user_mobile', 'password'), $this->filled('remember'))) {
    //         RateLimiter::hit($this->throttleKey());

    //         throw ValidationException::withMessages([
    //             'user_mobile' => __('auth.failed'),
    //         ]);
    //     }

    //     RateLimiter::clear($this->throttleKey());
    // }
    public function authenticate()
    {
        $this->ensureIsNotRateLimited();

        $credentials = $this->only('user_mobile', 'password');
        $mobileCountryCode = $this->input('mobile_country_code');

        // Fetch user by mobile number
        $user = \App\Models\User::where('user_mobile', $credentials['user_mobile'])->first();

        if (!$user || $user->user_mobile_cc !== $mobileCountryCode) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'user_mobile' => __('auth.failed'),
            ]);
        }

        if (!Auth::attempt($credentials, $this->filled('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'user_mobile' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited()
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'user_mobile' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey()
    {
        return Str::lower($this->input('user_mobile')) . '|' . $this->ip();
    }
}
