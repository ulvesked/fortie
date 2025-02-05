<?php namespace Wetcat\Fortie\Providers\TaxReductions;

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
    'ApprovedAmount',
    'AskedAmount',
    'BilledAmount',
    'CustomerName',
    'Id',
    'PropertyDesignation',
    'ReferenceDocumentType',
    'ReferenceNumber',
    'RequestSent',
    'ResidenceAssociationOrganisationNumber',
    'SocialSecurityNumber',
    'TypeOfReduction',
    'VoucherNumber',
    'VoucherSeries',
    'VoucherYear',
  ];


  protected $writeable = [
    // 'Url',
    // 'ApprovedAmount',
    'AskedAmount',
    // 'BilledAmount',
    'CustomerName',
    // 'Id',
    'PropertyDesignation',
    'ReferenceDocumentType',
    'ReferenceNumber',
    // 'RequestSent',
    'ResidenceAssociationOrganisationNumber',
    'SocialSecurityNumber',
    'TypeOfReduction',
    // 'VoucherNumber',
    // 'VoucherSeries',
    // 'VoucherYear',
  ];


  protected $required_create = [
  ];


  protected $required_update = [
  ];


  /**
   * Override the REST path
   */
  protected $basePath = 'taxreductions';

  /**
   * Filter on referencenumver
   */
  protected $_referencenumber = null;

  /**
   * Retrieves a list of tax reductions.
   *
   * @return array
   */
  public function all ($filter = null, $page = null)
  {
    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath);

    if (!is_null($filter)) {
      $req->filter($filter);
    }

    if (!is_null($page)) {  
      $req->param('page', $page);
    }

    if (!is_null($this->_referencenumber)) {
      $req->param('referencenumber', $this->_referencenumber);
    }
    
    return $this->send($req->build());
  }


  /**
   * Retrieves a single tax reduction.
   *
   * @param $id
   * @return array
   */
  public function find ($id)
  {
    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath)->path($id);

    return $this->send($req->build());
  }


  /**
   * Creates a tax reduction.
   *
   * @param array   $data
   * @return array
   */
  public function create (array $data)
  {
    $req = new FortieRequest();
    $req->method('POST');
    $req->path($this->basePath);
    $req->wrapper('TaxReduction');
    $req->data($data);
    $req->setRequired($this->required_create);

    return $this->send($req->build());
  }


  /**
   * Updates a tax reduction.
   *
   * @param $code
   * @param array   $id
   * @return array
   */
  public function update ($id, array $data)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($id);
    $req->wrapper('TaxReduction');
    $req->setRequired($this->required_update);
    $req->data($data);

    return $this->send($req->build());
  }


  /**
   * Removes a tax reduction.
   *
   * @param $id
   * @return null
   */
  public function delete ($id)
  {
    $req = new FortieRequest();
    $req->method('DELETE');
    $req->path($this->basePath)->path($id);

    return $this->send($req->build());
  }

  public function referencenumber($referencenumber) {
    $this->_referencenumber = $referencenumber;
  }

}
