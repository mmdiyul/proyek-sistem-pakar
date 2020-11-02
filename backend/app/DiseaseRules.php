<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Diseases;
use App\Symptoms;
use App\DiseaseRuleSymptoms;

class DiseaseRules extends Model
{
    use SoftDeletes;

    protected $table = 'disease_rules';

    protected $fillable = [
        'code',
        'disease_id'
    ];

    public function disease()
    {
        return $this->belongsTo(Diseases::class, 'disease_id');
    }

    public function symptoms()
    {
        return $this->belongsToMany(Symptoms::class, DiseaseRulesSymptoms::class, 'disease_rule_id', 'symptoms_id');
    }
}
