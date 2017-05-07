<?php

namespace GEO\Http\Controllers\Api;

use GEO\Models\Country;
use GEO\UmvaRest;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GEO\Http\Controllers\Controller;

class SdfController extends Controller
{
    //
   public function getSdfData($area)
   {
//   {
//     $client=new Client(['base_uri'=>'http://cap-bi.umva.org']);;
//     //$response=$client->get(' http://cap-bi.umva.org/index.php?option=com_api&task=execute&anyparam=demo-network');
//       $response=$client->get('index.php',
//           ['query'=>[
//               'option'=>'com_api',
//                'task'=>'execute',
//               'anyparam'=>'demo-network'
//           ]
//           ]);

    // return $response;

       return [

               ['sdf'=>'population of Town','value'=> '60000'],
           ['sdf'=>'population of village/colline','value'=>  '1800'],
           ['sdf'=>'Main source of income','value'=> 'Agriculture'],
           ['sdf'=>'population of Locality/sou-colline','value'=> '500']
           ];
   }
}
