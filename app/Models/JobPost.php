<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobPost extends Model
{
    use HasFactory;
    use HasRoles;

    protected $fillable = [
        'name',
    ];
    public function properties(): HasMany
    {
        return $this->hasMany(JobPostProperty::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function reportsTo(): BelongsTo
    {
        return $this->belongsTo(JobPost::class,'reports_to_id');
    }
    public function supervise(): HasMany
    {
        return $this->hasMany(JobPost::class);
    }
}
