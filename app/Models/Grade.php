<?php

namespace App\Models;
use Spatie\Translatable\HasTranslations;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model 
{
	use HasTranslations;
	public $translatable = ['Name'];
    protected $fillable=['Name','Note'];
    protected $table = 'Grades';
    public $timestamps = true;

}