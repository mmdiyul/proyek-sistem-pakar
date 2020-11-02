<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiseaseRules extends Model
{
    use SoftDeletes;

    protected $table = 'disease_rules';

    protected $fillable = [
        'code',
        'disease_id'
    ];
}
