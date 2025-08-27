<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UserObserver
{
    /**
     * Handle the User "creating" event.
     */
    public function creating(User $user): void
    {
        // Auto-generate a UUID if not present
        if (empty($user->uuid)) {
            $user->uuid = Str::uuid();
        }
        
        // Hash password if it's not already hashed
        if ($user->isDirty('password') && !empty($user->password)) {
            $user->password = bcrypt($user->password);
        }
        
        Log::info('User creating', ['email' => $user->email]);
    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        Log::info('User created successfully', ['id' => $user->id, 'email' => $user->email]);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        Log::info('User updated', ['id' => $user->id, 'email' => $user->email]);
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        Log::info('User deleted', ['id' => $user->id, 'email' => $user->email]);
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        Log::info('User restored', ['id' => $user->id, 'email' => $user->email]);
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        Log::info('User force deleted', ['id' => $user->id, 'email' => $user->email]);
    }
}
