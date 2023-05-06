<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
  /**
  * The table associated with the model.
  *
  * @var string
  */
  protected $table = 'Message';

  /**primary key associated with the model.
  *
  * @var string
  */
  protected $primaryKey ='idMessage';

  /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
   public $timestamps = false;

   protected $fillable = [
         'nameMessage',
         'descriptionMessage',
         'ecartGlobalMin',
         'ecartGlobalMax',
     ];
}
