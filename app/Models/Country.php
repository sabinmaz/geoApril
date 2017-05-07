<?php

namespace GEO\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model  {

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'countries';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['iso2', 'iso3', 'iso_number', 'country_name', 'date_format', 'country_code', 'latitude', 'longitude', 'capital', 'area', 'population', 'gdp', 'tld','currency'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];

}