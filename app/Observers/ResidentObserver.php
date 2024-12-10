<?php

namespace App\Observers;

use App\Models\Resident;
use App\Models\ResidentLog;

class ResidentObserver
{
    /**
     * Handle the Resident "created" event.
     */
    public function created(Resident $resident): void
    {
        //
    }

    /**
     * Handle the Resident "updated" event.
     */
    public function updated(Resident $resident): void
    {
        $changes = $resident->getChanges();
        $original = $resident->getOriginal();

        foreach($changes as $field => $new_value) {
            ResidentLog::create([
                'resident_id' => $resident->resident_id,
                // 'official_id' => Auth::id(),
                'field_changed' => $field,
                'old_value' => $original[$field] ?? null,
                'new_value' => $new_value,
                'action' => 'update',
                'timestamp' => now(),
            ]);
        }
    }

    /**
     * Handle the Resident "deleted" event.
     */
    public function deleted(Resident $resident): void
    {
        //
    }

    /**
     * Handle the Resident "restored" event.
     */
    public function restored(Resident $resident): void
    {
        //
    }

    /**
     * Handle the Resident "force deleted" event.
     */
    public function forceDeleted(Resident $resident): void
    {
        //
    }
}
