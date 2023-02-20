<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UpdateSettingRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $request = $this;
        $pass = $request['account']['password'];

        return [
            'social.*' => 'nullable|url',
            'options.disable_comments' => 'boolean',
            'options.moderate_comments' => 'boolean',
            'options.email_notification.*' => 'nullable',
            'user.username' => 'required|max:40|unique:users,username,'.auth()->id(),
            'user.name' => 'required|string',
            'user.profile_image' => 'nullable|image',
            'user.cover_image' => 'nullable|image',
            'user.city' => 'nullable|string',
            'user.country' => 'nullable|string',
            'user.about_me' => 'nullable|string',
            // "account.email" => "required|email|unique:users,email,". auth()->id(),
            'account.email' => ['required', 'email', Rule::unique('users', 'email')->ignore(auth()->id())],

            'account.password' => [
                function ($attribute, $value, $fail) {
                    if ($this->account['email'] !== auth()->user()->email ||
                    ! empty($this->account['new_password'])) {
                        if (! Hash::check($value, auth()->user()->password)) {
                            $fail('The password is incorrect');
                        }
                    }
                },
            ],

            'account.new_password' => 'confirmed',
        ];
    }

    public function attributes()
    {
        return [
            'social.facebook' => 'facebook',
            'social.twitter' => 'twitter',
            'social.instagram' => 'instagram',
            'social.website' => 'website',
            'user.username' => 'username',
            'user.name' => 'full name',
            'user.profile_image' => 'profile image',
            'user.cover_image' => 'cover image',
            'user.city' => 'city',
            'user.country' => 'country',
            'user.about_me' => 'Bio',
            'account.email' => 'email',
            'account.password' => 'current password',
            'account.new_password' => 'new password',
        ];
    }

    public function getData()
    {
        $data = $this->validated();
        $directory = User::makeDirectory();

        $directory = $directory.'/user-'.auth()->id(); // users/user-2

        if ($this->hasFile('user.profile_image')) {
            $data['user']['profile_image'] = $this->file('user.profile_image')->store($directory);
        }
        if ($this->hasFile('user.cover_image')) {
            $data['user']['cover_image'] = $this->file('user.cover_image')->store($directory);
        }

        if (! empty($data['account']['password'])) {
            $data['user']['email'] = $data['account']['email'];
        }

        if (! empty($data['account']['new_password'])) {
            $data['user']['password'] = Hash::make($data['account']['new_password']);
        }

        unset($data['account']);

        return $data;
    }
}
