<?php namespace Wetcat\Fortie\Providers\Employees;

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
    'EmployeeId',
    'PersonalIdentityNumber',
    'FirstName',
    'LastName',
    'FullName',
    'Address1',
    'Address2',
    'PostCode',
    'City',
    'Country',
    'Phone1',
    'Phone2',
    'Email',
    'EmploymentDate',
    'EmploymentForm',
    'SalaryForm',
    'JobTitle',
    'PersonelType',
    'Inactive',
    'ScheduleId',
    'ForaType',
    'MonthlySalary',
    'HourlyPay',
    'TaxAllowance',
    'TaxTable',
    'TaxColumn',
    'NonRecurringTax',
    'ClearingNo',
    'BankAccountNo',
  ];


  protected $writeable = [
    'EmployeeId',
    'PersonalIdentityNumber',
    'FirstName',
    'LastName',
    // 'FullName',
    'Address1',
    'Address2',
    'PostCode',
    'City',
    'Country',
    'Phone1',
    'Phone2',
    'Email',
    'EmploymentDate',
    'EmploymentForm',
    'SalaryForm',
    'JobTitle',
    'PersonelType',
    'Inactive',
    'ScheduleId',
    'ForaType',
    'MonthlySalary',
    'HourlyPay',
    'TaxAllowance',
    'TaxTable',
    'TaxColumn',
    'NonRecurringTax',
    'ClearingNo',
    'BankAccountNo',
  ];


  protected $required_create = [
  ];


  protected $required_update = [
  ];


  /**
   * Override the REST path
   */
  protected $basePath = 'employees';


  /**
   * Retrieve employment information for all employees.
   *
   * @return array
   */
  public function all ($page = null)
  {
    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath);

    if (!is_null($page)) {  
      $req->param('page', $page);
    }

    return $this->send($req->build());
  }


  /**
   * Retrieves employment information for specified employee.
   *
   * @param $employeeId
   * @return array
   */
  public function find ($employeeId)
  {
    $req = new FortieRequest();
    $req->method('GET');
    $req->path($this->basePath)->path($employeeId);

    return $this->send($req->build());
  }


  /**
   * Creates a new employee.
   *
   * @param array   $data
   * @return array
   */
  public function create (array $data)
  {
    $req = new FortieRequest();
    $req->method('POST');
    $req->path($this->basePath);
    $req->wrapper('Employee');
    $req->data($data);
    $req->setRequired($this->required_create);

    return $this->send($req->build());
  }


  /**
   * Updates employment information.
   *
   * @param $employeeId
   * @param array   $data
   * @return array
   */
  public function update ($employeeId, array $data)
  {
    $req = new FortieRequest();
    $req->method('PUT');
    $req->path($this->basePath)->path($employeeId);
    $req->wrapper('Employee');
    $req->setRequired($this->required_update);
    $req->data($data);

    return $this->send($req->build());
  }

}
