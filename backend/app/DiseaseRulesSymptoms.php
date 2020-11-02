<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class DiseaseRulesSymptoms extends Model
{
    public $timestamps = false;
    protected $table = 'disease_rules_symptoms';

    protected $fillable = [
        'disease_rule_id',
        'symptoms_id'
    ];
}
