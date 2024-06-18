<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Blog;

class BlogPolicy
{
    public function create(User $user)
    {
        // Autoriser tous les utilisateurs connectés à créer un blog
        return true;
    }

    public function update(User $user, Blog $blog)
    {
        // Autoriser uniquement l'utilisateur propriétaire du blog à le modifier
        return $user->id === $blog->user_id;
    }
}
