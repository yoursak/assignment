<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Specify the table associated with the model
    protected $table = 'users'; // Change to your actual table name if different

    // Define the primary key, since it's not the default 'id'
    protected $primaryKey = 'USER_ID';

    // Disable default timestamps (created_at, updated_at), as custom ones are being used
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'USER_TYPE',
        'NAME',
        'EMAIL',
        'PASSWORD',
        'CREATED_ON',  // Include custom timestamps in fillable if needed
        'UPDATED_ON',  // Include custom timestamps in fillable if needed
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'PASSWORD',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'CREATED_ON' => 'datetime',
        'UPDATED_ON' => 'datetime',
    ];

    /**
     * Set the password attribute and hash it automatically.
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['PASSWORD'] = bcrypt($value);
    }
}
