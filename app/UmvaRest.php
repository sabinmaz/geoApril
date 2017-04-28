<?php
/**
 * Created by PhpStorm.
 * User: sabin
 * Date: 4/28/2017
 * Time: 12:31 PM
 */

namespace GEO;


use GuzzleHttp\Client;

class UmvaRest extends Client
{
    private $uri='http://api.umva.org';

  public function __construct(array $config = [])
  {
      $config['base_uri']=$this->uri;
      parent::__construct($config);
  }
}