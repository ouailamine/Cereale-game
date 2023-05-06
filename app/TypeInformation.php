<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeInformation extends Model
{
  /**
  * The table associated with the model.
  *
  * @var string
  */
  protected $table = 'TypeInformation';

  /**primary key associated with the model.
  *
  * @var string
  */
  protected $primaryKey ='idTypeInfo';

  /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
   public $timestamps = false;

   protected $fillable = [
         'nameTypeInfo'
     ];
}
