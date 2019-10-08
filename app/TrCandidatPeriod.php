<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrCandidatPeriod extends Model
{
    public $incrementing = false;

    public function candidat()
    {
        return $this->belongsTo('App\MaCandidat', 'candidat_id');
    }

    public function period()
    {
        return $this->belongsTo('App\MaPeriod', 'period_id');
    }
}
