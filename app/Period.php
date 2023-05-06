<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
  /**
  * The table associated with the model.
  *
  * @var string
  */
  protected $table = 'Period';

  /**primary key associated with the model.
  *
  * @var string
  */
  protected $primaryKey ='idPeriod';

  /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
   public $timestamps = false;

   protected $fillable = [
     'numberPeriod',
     'isSold',
     'contratPosition',
     'idGame',
     'priceTermPeriod',
     'priceSpotPeriod',
     'gainCumul',
     'priceGap',
     'globalGap'
   ];
}
