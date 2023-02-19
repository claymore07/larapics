<x-layout title="Account Settings">
    <div class="container py-4">
        <x-flash-message />
        <x-form action="{{ route('settings.update') }}" method="PUT" enctype="multipart/form-data">
            <div class="row gx-5">
                <div class="col-md-6">
                    <fieldset>
                        <legend>Personal Data</legend>
                        <div class="mb-3">
                            <label class="form-label" for="username">Username</label>
                            <input type="text" name="user[username]" id="username"
                            value="{{ old("user.username", $user->username) }}"
                            class="form-control @error('user.username')
                                is-invalid
                            @enderror ">
                            @error('user.username')
                                <div class="invalid-feedback">
                                     {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="name">Full Name</label>
                            <input type="text" name="user[name]" id="name"
                            value="{{ old("user.name", $user->name) }}"
                            class="form-control @error('user.name')
                                is-invalid
                            @enderror ">
                            @error('user.name')
                                <div class="invalid-feedback">
                                     {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="profile_image">Profile Image</label>
                            <input type="file" name="user[profile_image]" id="profile_image"
                            value="{{ old("user.profile_image", $user->profile_image) }}"
                            class="form-control @error('user.profile_image')
                                is-invalid
                            @enderror ">
                            @error('user.profile_image')
                                <div class="invalid-feedback">
                                     {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <img src="{{ $user->profileImageUrl() }}" width="150" alt="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="city">City</label>
                            <input type="text" name="user[city]" id="city"
                            value="{{ old("user.city", $user->city) }}"
                            class="form-control @error('user.city')
                                is-invalid
                            @enderror ">
                            @error('user.city')
                                <div class="invalid-feedback">
                                     {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="country">Country</label>
                            <input type="text" name="user[country]" id="country"
                            value="{{ old("user.country", $user->country) }}"
                            class="form-control @error('user.country')
                                is-invalid
                            @enderror ">
                            @error('user.country')
                                <div class="invalid-feedback">
                                     {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="about_me">About me</label>
                            @error('user.about_me')
                                <div class="invalid-feedback">
                                     {{ $message }}
                                </div>
                            @enderror
                            <textarea name="user[about_me]" id="about_me" rows="3" class="form-control"
                                placeholder="In a few words, tell us about yourself">{{ old("user.about_me", $user->about_me) }}</textarea>
                        </div>
                    </fieldset>
                    <fieldset class="mt-3">
                        <legend>Account</legend>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" name="account[email]" id="email"
                            value="{{ old("account.email", $user->email) }}"
                            class="form-control @error("account.email")
                                is-invalid
                            @enderror">
                            @error("account.email")
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Current Password</label>
                            <input type="password" name="account[password]" id="password" class="form-control @error("account.password")
                                is-invalid
                            @enderror">
                            @error("account.password")
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" name="account[new_password]" id="new_password" class="form-control @error("account.new_password")
                                is-invalid
                            @enderror">
                            @error("account.new_password")
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">New Password confirmation</label>
                            <input type="password" name="account[new_password_confirmation]"
                                id="new_password_confirmation" class="form-control">
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-6">
                    <fieldset>
                        <legend>Cover image</legend>
                        <div class="mb-3">
                            <label class="form-label" for="twitter">Your Cover Image</label>
                            <input type="file" name="user[cover_image]" id="cover_image" value="{{ old("user.cover_image", $user->cover_image) }}"
                            class="form-control @error('user.cover_image')
                                is-invalid
                            @enderror ">
                            @error('user.cover_image')
                                <div class="invalid-feedback">
                                     {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <img src="{{ $user->hasCoverImage() ? $user->coverImageUrl() : "https://via.placeholder.com/600x250&text=Cover Image" }}" class="img-fluid" alt="">
                        </div>
                    </fieldset>
                    <fieldset class="mt-3">
                        <legend>Online Profiles</legend>
                        <div class="mb-3">
                            <label class="form-label" for="facebook">Facebook</label>
                            <input type="text" name="social[facebook]" id="facebook" class="form-control @error('social.facebook') is-invalid @enderror"

                                placeholder="https://www.facebook.com/..."
                                value="{{ old('social.facebook', $user->social->facebook) }}">
                            @error('social.facebook')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="twitter">Twitter</label>
                            <input type="text" name="social[twitter]" id="twitter" class="form-control @error('social.twitter') is-invalid @enderror"
                                placeholder="https://twitter.com/..."
                                value="{{ old('social.twitter', $user->social->twitter) }}">
                            @error('social.twitter')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="instagram">Instagram</label>
                            <input type="text" name="social[instagram]" id="instagram" class="form-control @error('social.instagram') is-invalid @enderror"
                                placeholder="https://www.instagram.com/..."
                                value="{{ old('social.instagram', $user->social->instagram) }}">
                            @error('social.instagram')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="website">Website</label>
                            <input type="text" name="social[website]" id="website" class="form-control @error('social.website') is-invalid @enderror"
                                placeholder="https://..."
                                value="{{ old('social.website', $user->social->website) }}">
                            @error('social.website')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </fieldset>
                    <fieldset class="mt-3">
                        <legend>Options</legend>
                        <div class="mb-3">
                            <label class="form-label">Disable Comments</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="options[disable_comments]"
                                        id="disable_comments_no" value="0"
                                        @if(old('options.disable_comments', $user->setting->disable_comments) == 0) checked @endif>
                                    <label class="form-check-label" for="disable_comments_no">No</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="options[disable_comments]"
                                        id="disable_comments_yes" value="1"
                                        @if(old('options.disable_comments', $user->setting->disable_comments) == 1) checked @endif>
                                    <label class="form-check-label" for="disable_comments_yes">Yes</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Moderate Comments</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="options[moderate_comments]"
                                        id="moderate_comments_no" value="0"
                                        @if(old('options.moderate_comments', $user->setting->moderate_comments) == 0) checked @endif>
                                    <label class="form-check-label" for="moderate_comments_no">No</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="options[moderate_comments]"
                                        id="moderate_comments_yes" value="1"
                                        @if(old('options.moderate_comments', $user->setting->moderate_comments) == 1) checked @endif>
                                    <label class="form-check-label" for="moderate_comments_yes">Yes</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Notifications</label>
                            <div class="form-check">
                                <input type="hidden" name="options[email_notification][new_comment]" value="0">
                                <input class="form-check-input" type="checkbox"
                                    name="options[email_notification][new_comment]" id="email_notification_no" value="1"
                                    @if(old('options.email_notification.new_comment', $user->setting->email_notification['new_comment']) == 1) checked @endif>
                                <label class="form-check-label" for="email_notification_new_comment">Notify me of new
                                    comments</label>
                            </div>
                            <div class="form-check">
                                <input type="hidden" name="options[email_notification][new_image]" value="0">
                                <input class="form-check-input" type="checkbox"
                                    name="options[email_notification][new_image]" id="email_notification_yes" value="1"
                                     @if(old('options.email_notification.new_image', $user->setting->email_notification['new_image']) == 1) checked @endif>
                                <label class="form-check-label" for="disable_comments_new_image">Notify me of new images
                                    uploaded</label>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-center py-3">
                <button class="btn btn-lg btn-success">Save changes</button>
            </div>
        </x-form>
    </div>

</x-layout>
