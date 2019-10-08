<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrPeriodVote extends Model
{
    public $incrementing = false;

    public function period()
    {
        return $this->belongsTo('App\MaPeriod', 'period_id');
    }
}
