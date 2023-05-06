<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EditableParameter extends Model
{
  /**
  * The table associated with the model.
  *
  * @var string
  */
  protected $table = 'EditableParameter';

  /**primary key associated with the model.
  *
  * @var string
  */
  protected $primaryKey ='idParam';

  /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
   public $timestamps = false;

  protected $attributes = [
    'plancher',
    'plafond',
    'levierEBM',
    'prixTermeEsperance',
    'prixTermeEcartType',
    'prixSpotEsperance',
    'prixSpotEcartType',
    'spread',
    'surveyLink',
  ];

  protected $fillable = [
        'plancher',
        'plafond',
        'levierEBM',
        'prixTermeEsperance',
        'prixTermeEcartType',
        'prixSpotEsperance',
        'prixSpotEcartType',
        'spread'
    ];
}
