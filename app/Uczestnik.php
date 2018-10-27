<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Uczestnik extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'uczestnicy';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'odpowiedzi' => 'array',
    ];
}
