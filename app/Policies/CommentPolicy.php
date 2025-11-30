<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;

class CommentPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function delete(User $user, Comment $comment): bool
    {
        // Only admins can delete any comment
        return $user->role === 'admin';
    }

    public function update(User $user, Comment $comment): bool
    {
        // Only admins can update any comment
        return $user->role === 'admin';
    }

    public function view(User $user, Comment $comment): bool
    {
        // Only admins can view any comment
        return $user->role === 'admin';
    }
}
