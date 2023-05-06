<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
  /**
  * The table associated with the model.
  *
  * @var string
  */
  protected $table = 'Game';

  /**primary key associated with the model.
  *
  * @var string
  */
  protected $primaryKey ='idGame';

  /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
   public $timestamps = false;

   protected $fillable = [
     'nameGame',
     'objectivePrice',
     'dateGame',
     'userId',
     'priceTermGame',
     'priceSpotGame',
     'replay',
   ];
}
