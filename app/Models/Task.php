<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Define the primary key, as it's not the default 'id'
    protected $primaryKey = 'TASK_ID';

    // Disable timestamps if 'UPDATED_AT' column is not present
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'TITLE',
        'DESCRIPTION',
        'COMPLETED',
        'PREORITY',
        'PROGRESS',
        'ASSIGNED_TO',
        'CREATED_BY',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'CREATED_AT' => 'datetime',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'CREATED_AT',
    ];
}
