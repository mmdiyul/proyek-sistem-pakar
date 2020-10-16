<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Symptoms extends Model
{
    use SoftDeletes;

    protected $table = 'symptoms';

    protected $fillable = [
        'code',
        'name'
        
    ];
}