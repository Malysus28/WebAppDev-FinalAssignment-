<?php

namespace App\Policies;
use App\Models\Event;
use App\Models\User;

// my ev policy which is like a security gate. laravel can hook this through authorize 
class EventPolicy
{
    // only organiser can create 
    public function create(User $user): bool
    { return $user->type === User::TYPE_ORGANISER;}

    //only organiser can update and if they want to edit their organiser id must match the user id 
    public function update(User $user, Event $event): bool
    {return $user->type === User::TYPE_ORGANISER
            && $event->organiser_id === $user->id; }

            //only the event can can delete 
    public function delete(User $user, Event $event): bool
    {return $user->type === User::TYPE_ORGANISER
            && $event->organiser_id === $user->id;}
}
