<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
  /**
  * The table associated with the model.
  *
  * @var string
  */
  protected $table = 'Information';

  /**primary key associated with the model.
  *
  * @var string
  */
  protected $primaryKey ='idInformation';

  /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
   public $timestamps = false;

   protected $fillable = [
         'deltaInformation',
         'nameInformation',
         'typeInfoId'
     ];
}
