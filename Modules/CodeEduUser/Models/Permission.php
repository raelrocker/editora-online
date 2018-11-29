<?php

namespace CodeEduUser\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name',
        'descriptions'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
