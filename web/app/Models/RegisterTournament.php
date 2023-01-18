<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterTournament extends Model
{
    use HasFactory;

     /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The relationships include.
     *
     * @var array
     */
    protected $with = ['tournament', 'club'];

    public function tournament()
    {
        return $this->hasOne('App\Models\Tournament', 'id', 'tournament_id');
    }
    
    public function club()
    {
        return $this->hasOne('App\Models\Club', 'id', 'club_id');
    }
}