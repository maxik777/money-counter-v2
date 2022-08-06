<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spends extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'spends';

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $visible = [
        'name',
        'price',
        'user_id',
        'created_at'
    ];
    protected $fillable = [
        'name',
        'price',
        'user_id',
        'created_at'
    ];
    public $timestamps = true;

}
