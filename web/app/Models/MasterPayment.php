<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPayment extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

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
            return url('uploads/bank/logo/default.png');
        }

        if ( !file_exists(public_path('uploads/bank/logo/' . $this->logo)) ) {
            return url('uploads/bank/logo/default.png');
        } else {
            return url('uploads/bank/logo/' . $this->logo);
        }
    }
}