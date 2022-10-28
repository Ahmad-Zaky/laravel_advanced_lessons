<?php

namespace App\Models;

use App\Events\NewCustomerEntryReceivedEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContestEntry extends Model
{
    use HasFactory;

    protected $fillable = [ 'email' ];

    /**
     * Not a big fan of putting events in models as
     * it seems in the controller thats things happen
     * magically, so for dev, readabilty purposes we
     * prefere to puth Event Firing in Controller.
     */
    // protected static function booted() 
    // {
    //     static::created(function ($contestEntry) {
            
    //         // Fire Event to send Email
    //         NewCustomerEntryReceivedEvent::dispatch();
    //     });
    // }
}
