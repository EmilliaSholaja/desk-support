<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Ticket extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'uuid', 'user_id', 'category_id', 'title', 'message',
        'priority', 'status', 'attachment', 'is_resolved',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(TicketReply::class);
    }

     protected static function booted()
    {
        static::creating(function ($ticket) {
            $ticket->uuid = (string) Str::uuid();
        });
    }

    public function statusColor(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                return match ($attributes['status']) {
                    'open'   => 'bg-green-100 text-green-800',
                    'closed' => 'bg-gray-100 text-gray-800',
                    default  => 'bg-blue-100 text-blue-800',
                };
            }
        );
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function attachments(): HasMany
{
    return $this->hasMany(TicketAttachment::class);
}


}
