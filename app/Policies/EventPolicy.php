<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;

class EventPolicy
{
    public function create(User $user): bool
    {
        return $user->type === User::TYPE_ORGANISER;
    }

    public function update(User $user, Event $event): bool
    {
        return $user->type === User::TYPE_ORGANISER
            && $event->organiser_id === $user->id;
    }

    public function delete(User $user, Event $event): bool
    {
        return $user->type === User::TYPE_ORGANISER
            && $event->organiser_id === $user->id;
    }
}
