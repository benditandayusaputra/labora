<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tournament extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'division' => 'array',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['logo_url'];

    /**
     * Get the Logo Url
     *
     * @return string
     */
    public function getLogoUrlAttribute()
    {
        if ( is_null($this->logo) ) {
            return url('uploads/tournament/logo/default.png');
        }

        if ( !file_exists(public_path('uploads/tournament/logo/' . $this->logo)) ) {
            return url('uploads/tournament/logo/default.png');
        } else {
            return url('uploads/tournament/logo/' . $this->logo);
        }
    }
}