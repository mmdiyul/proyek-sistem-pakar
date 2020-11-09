<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class DiagnosisHistorySymptoms extends Model
{
    public $timestamps = false;
    protected $table = 'symptoms_diagnosis_history';

    protected $fillable = [
        'symptoms_id',
        'diagnosis_history_id'
    ];
}