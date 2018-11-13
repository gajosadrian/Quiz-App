<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public function getLoggableAttribute()
    {
        $now = Carbon::now();
        $start = Carbon::createFromTimeString('8:00');
        $end = Carbon::createFromTimeString('20:00');
        if ($now >= $start and $now <= $end) {
            return true;
        }
        return false;
    }

    public function getCorrectQuestionIdsAttribute()
    {
        return getCorrectQuestionIds($this->odpowiedzi ?? []);
    }
}
