<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;
    use HasRoles;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'team_id',
        'status_id',
        'title',
        'description',
        'deadline'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

}
