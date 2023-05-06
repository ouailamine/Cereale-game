<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HistoricTerm extends Model
{
  /**
  * The table associated with the model.
  *
  * @var string
  */
  protected $table = 'HistoricTermPrice';

  /**primary key associated with the model.
  *
  * @var string
  */
  protected $primaryKey ='idHistoricTermPrice';

  /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
   public $timestamps = false;
   
   protected $fillable = [
     'dateHistoricTermPrice',
     'termPrice'
   ];
}
