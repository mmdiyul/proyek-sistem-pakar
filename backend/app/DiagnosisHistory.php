<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiagnosisHistory extends Model
{
    use SoftDeletes;

    protected $table = 'diagnosis_history';

    protected $fillable = [
        'disease_id',
    ];
}