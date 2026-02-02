<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecurityLog extends Model
{
    protected $fillable = ['user_id', 'action', 'ip_address', 'details'];

    protected $casts = [
        'details' => 'array',
    ];

    public static function record($action, $details = null)
    {
        return self::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'ip_address' => request()->ip(),
            'details' => $details,
        ]);
    }
}
