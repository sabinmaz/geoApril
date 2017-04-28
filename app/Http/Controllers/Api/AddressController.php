<?php

namespace GEO\Http\Controllers\Api;

use GEO\Models\Country;
use GEO\UmvaRest;
use Illuminate\Http\Request;
use GEO\Http\Controllers\Controller;

class AddressController extends Controller
{
    //

    public function getCountries(Request $request)
    {
        try{
            return Country::all()->toArray();
        }
        catch(\Exception $e)
        {
            throw $e;
        }
    }

    public function getAllCountriesMinData()
    {
        try{
            return Country::all(['id','country_name','iso2','iso3'])->toArray();
        }
        catch(\Exception $e)
        {
            throw $e;
        }
    }

    public function getCountryByName($country)
    {
        try{
            return Country::all()->where('country_name','=',$country)->first()->toArray();
        }
        catch(\Exception $e)
        {
            throw $e;
        }
    }

    public function getProvinceByCountry($country)
    {
        $client=new UmvaRest();

        $country=strtoupper($country);

        $response=$client->get('address_getProvience',
            ['query'=>[
                'country'=>$country,
                'token'=>'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.InVtdmEi.6FKdx5OPZ8knwOeMUTjT-M2j-zG0OD8ntRnpvXXr0VA'
                ]
            ]);
        return $response->getBody()->getContents();
    }

    public function getCommuneByProvince($country,$province)
{
    $client=new UmvaRest();

    $country=strtoupper($country);
    //$province=$province);

    $response=$client->get('address_getCommune',
        ['query'=>[
            'country'=>$country,
            'province'=>$province,
            'token'=>'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.InVtdmEi.6FKdx5OPZ8knwOeMUTjT-M2j-zG0OD8ntRnpvXXr0VA'
        ]
        ]);
    return $response->getBody()->getContents();
}

    public function getZonesByCommune($country,$province,$commune)
    {
        $client=new UmvaRest();

        $country=strtoupper($country);
        //$province=$province);

        $response=$client->get('address_getZone',
            ['query'=>[
                'country'=>$country,
                'province'=>$province,
                'commune'=>$commune,
                'token'=>'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.InVtdmEi.6FKdx5OPZ8knwOeMUTjT-M2j-zG0OD8ntRnpvXXr0VA'
            ]
            ]);
        return $response->getBody()->getContents();
    }

    public function getCollinesByZone($country,$province,$commune,$zone)
    {
        $client=new UmvaRest();

        $country=strtoupper($country);
        //$province=$province);

        $response=$client->get('address_getColline',
            ['query'=>[
                'country'=>$country,
                'province'=>$province,
                'commune'=>$commune,
                'zone'=>$zone,
                'token'=>'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.InVtdmEi.6FKdx5OPZ8knwOeMUTjT-M2j-zG0OD8ntRnpvXXr0VA'
            ]
            ]);
        return $response->getBody()->getContents();
    }
    public function getLocalitiesByColline($country,$province,$commune,$zone,$colline)
    {
        $client=new UmvaRest();

        $country=strtoupper($country);
        //$province=$province);

        $response=$client->get('address_getLocality1',
            ['query'=>[
                'country'=>$country,
                'province'=>$province,
                'commune'=>$commune,
                'zone'=>$zone,
                'colline'=>$colline,
                'token'=>'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.InVtdmEi.6FKdx5OPZ8knwOeMUTjT-M2j-zG0OD8ntRnpvXXr0VA'
            ]
            ]);
        return $response->getBody()->getContents();
    }
}
