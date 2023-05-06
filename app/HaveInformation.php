<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HaveInformation extends Model
{
  /**
  * The table associated with the model.
  *
  * @var string
  */
  protected $table = 'haveInformation';

  /**primary key associated with the model.
  *
  * @var string
  */
  protected $primaryKey =['idInformation', 'idPeriod'];

  /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
   public $timestamps = false;

   protected $fillable = [
         'idInformation',
         'idPeriod',
     ];
}
