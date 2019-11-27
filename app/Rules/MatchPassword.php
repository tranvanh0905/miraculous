<?php

namespace App\Rules;

use App\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class MatchPassword implements Rule
{
    protected $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user  = User::where('email', $this->email)->first();
        if ($user != null){
            return Hash::check($value, $user->password);
        }else{
            return redirect(route('login'));
        }

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Mật khẩu bạn đã nhập không chính xác !';
    }
}
