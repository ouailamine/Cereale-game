<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HistoricSpot extends Model
{
  /**
  * The table associated with the model.
  *
  * @var string
  */
  protected $table = 'HistoricSpotPrice';

  /**primary key associated with the model.
  *
  * @var string
  */
  protected $primaryKey ='idHistoricSpotPrice';

  /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
   public $timestamps = false;

   protected $fillable = [
     'dateHistoricSpotPrice',
     'spotPrice'
   ];

}
