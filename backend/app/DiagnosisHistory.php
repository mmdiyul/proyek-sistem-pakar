<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\DiagnosisHistorySymptoms;
use App\Symptoms;

class DiagnosisHistory extends Model
{
    use SoftDeletes;

    protected $table = 'diagnosis_history';

    protected $fillable = [
        'disease_id',
        'created_by'
    ];

    public function symptoms_diagnosis_history()
    {
        return $this->hasMany(DiagnosisHistorySymptoms::class, 'diagnosis_history_id');
    }

    public function symptoms()
    {
        return $this->belongsToMany(Symptoms::class, DiagnosisHistorySymptoms::class, 'diagnosis_history_id', 'symptoms_id');
    }
}