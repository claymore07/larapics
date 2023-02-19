<?php

namespace App\Policies;

use App\Enums\Role;
use App\Models\Image;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PolicyForImage
{ 
    use HandlesAuthorization;

    public function update(User $user, Image $image){
        return $user->id === $image->user_id || $user->role === Role::Editor;
    }

    public function delete(User $user, Image $image){
        return $user->id === $image->user_id ;
    }
}
