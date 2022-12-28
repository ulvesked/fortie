<?php namespace Wetcat\Fortie\Providers\VoucherSeries;

/*

   Copyright 2015 Andreas Göransson

   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.

*/

use Wetcat\Fortie\Providers\ProviderBase;
use Wetcat\Fortie\FortieRequest;

class Provider extends ProviderBase {

  protected $attributes = [
    'Url',
    'Code',
    'Description',
    'Manual',
    'NextVoucherNumber',
    'Year',
  ];


  protected $writeable = [
    // 'Url',
    'Code',
    'Description',
    'Manual',
    // 'NextVoucherNumber',
    // 'Year',
  ];


  protected $required_create = [
  ];


  protected $required_update = [
  ];


  /**
   * Override the REST path
   */
  protected $basePath = 'voucherseries';


  /**
   * Retrieves a list of voucher series.
   *
   * @return array
   */
  public function all ($page = null, $year = null)
  {
    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath);

    if (!is_null($year)) {  
      $req->param('financialyear', $year);
    }

    if (! is_null($this->timespan)) {
      $lastModified = date('Y-m-d H:i', strtotime($this->timespan));
      $req->param('lastmodified', $lastModified);
    }

    if (!is_null($page)) {  
      $req->param('page', $page);
    }

    return $this->send($req->build());
  }

  /**
   * Retrieves a single voucher series.
   *
   * @param $code
   * @return array
   */
  public function find ($code, $year = null)
  {
    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath)->path($code);

    if (!is_null($year)) {  
      $req->param('financialyear', $year);
    }
    if (! is_null($this->timespan)) {
      $lastModified = date('Y-m-d H:i', strtotime($this->timespan));
      $req->param('lastmodified', $lastModified);
    }

    return $this->send($req->build());
  }


  /**
   * Creates a voucher series.
   *
   * @param array   $data
   * @return array
   */
  public function create (array $data)
  {
    $req = new FortieRequest();
    $req->method('POST');
    $req->path($this->basePath);
    $req->wrapper('CostCenter');
    $req->data($data);
    $req->setRequired($this->required_create);

    return $this->send($req->build());
  }


  /**
   * Updates a voucher series.
   *
   * @param $code
   * @param array   $data
   * @return array
   */
  public function update ($code, array $data)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($code);
    $req->wrapper('CostCenter');
    $req->setRequired($this->required_update);
    $req->data($data);

    return $this->send($req->build());
  }

}
