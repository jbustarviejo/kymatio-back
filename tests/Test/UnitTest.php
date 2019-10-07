<?php

namespace Test;

/**
 * Class UnitTest
 */
class UnitTest extends \UnitTestCase
{
  public function testCompanyCreation()
  {
      // Test company, if it's being stored properly
      $companyName=uniqid(null, true);
      $companyCIF=uniqid(null, true);
      $companyAddress=uniqid(null, true);

      $company = new Companies();
      $company->name=$companyName;
      $company->cif=$companyCIF;
      $company->address=$companyAddress;
      $company->save();

      $companySaved = Companies::findFirst("id=$company->id");

      $this->assertEquals(
          $companySaved->name,
          $companyName
      );

      $this->assertEquals(
        $companySaved->cif,
        $companyCIF
      );

      $this->assertEquals(
        $companySaved->address,
        $companyAddress
      );

  }

  public function testCompanyCreationWithNull()
  {
      // Test company null fields allowed
      $companyName=uniqid(null, true);
      $companyCIF=null;
      $companyAddress=null;

      $company = new Companies();
      $company->name=$companyName;
      $company->cif=$companyCIF;
      $company->address=$companyAddress;
      $company->save();

      $companySaved = Companies::findFirst("id=$company->id");

      $this->assertEquals(
          $companySaved->name,
          $companyName
      );

      $this->assertEquals(
        $companySaved->cif,
        $companyCIF
      );

      $this->assertEquals(
        $companySaved->address,
        $companyAddress
      );
  }

  public function testGroupCreation()
  {
      // Test group, if it's being stored properly
      $groupName=uniqid(null, true);
      $groupType=uniqid(null, true);
      $groupCompanyId=1;

      $group = new Groups();
      $group->name=$groupName;
      $group->type=$groupType;
      $group->company_id=$groupCompanyId;
      $group->save();

      $groupSaved = Groups::findFirst("id=$group->id");

      $this->assertEquals(
          $groupSaved->name,
          $groupName
      );

      $this->assertEquals(
        $groupSaved->type,
        $groupType
      );

      $this->assertEquals(
        $groupSaved->company_id,
        $groupCompanyId
      );
  }

  public function testGroupCreationWithNull()
  {
      // Test company null fields allowed
      $groupName=uniqid(null, true);
      $groupType=null;
      $groupCompanyId=1;

      $group = new Groups();
      $group->name=$groupName;
      $group->type=$groupType;
      $group->company_id=$groupCompanyId;
      $group->save();

      $groupSaved = Groups::findFirst("id=$group->id");

      $this->assertEquals(
          $groupSaved->name,
          $groupName
      );

      $this->assertEquals(
        $groupSaved->type,
        $groupType
      );

      $this->assertEquals(
        $groupSaved->company_id,
        $groupCompanyId
      );
  }

  public function testEmployeeCreation()
  {
      // Test employee, if it's being stored properly
      $employeeName=uniqid(null, true);
      $employeeSurname=uniqid(null, true);
      $employeeEmail=uniqid(null, true);
      $employeeAddress=uniqid(null, true);
      $employeeRisk=rand(0,100);
      $employeeGroupId=1;

      $employee = new Employees();
      $employee->name=$employeeName;
      $employee->surname=$employeeSurname;
      $employee->email=$employeeEmail;
      $employee->address=$employeeAddress;
      $employee->risk=$employeeRisk;
      $employee->group_id=$employeeGroupId;

      $employee->save();

      $employeeSaved = Employees::findFirst("id=$employee->id");

      $this->assertEquals(
          $employeeSaved->name,
          $employeeName
      );

      $this->assertEquals(
        $employeeSaved->surname,
        $employeeSurname
      );

      $this->assertEquals(
        $employeeSaved->email,
        $employeeEmail
      );

      $this->assertEquals(
        $employeeSaved->address,
        $employeeAddress
      );

      $this->assertEquals(
        $employeeSaved->risk,
        $employeeRisk
      );

      $this->assertEquals(
        $employeeSaved->group_id,
        $employeeGroupId
      );
  }

  public function testEmployeeCreationNullValues()
  {
      // Test employee, null values
      $employeeName=uniqid(null, true);
      $employeeSurname=null;
      $employeeEmail=null;
      $employeeAddress=null;
      $employeeRisk=rand(0,100);
      $employeeGroupId=1;

      $employee = new Employees();
      $employee->name=$employeeName;
      $employee->surname=$employeeSurname;
      $employee->email=$employeeEmail;
      $employee->address=$employeeAddress;
      $employee->risk=$employeeRisk;
      $employee->group_id=$employeeGroupId;

      $employee->save();

      $employeeSaved = Employees::findFirst("id=$employee->id");

      $this->assertEquals(
          $employeeSaved->name,
          $employeeName
      );

      $this->assertEquals(
        $employeeSaved->surname,
        $employeeSurname
      );

      $this->assertEquals(
        $employeeSaved->email,
        $employeeEmail
      );

      $this->assertEquals(
        $employeeSaved->address,
        $employeeAddress
      );

      $this->assertEquals(
        $employeeSaved->risk,
        $employeeRisk
      );

      $this->assertEquals(
        $employeeSaved->group_id,
        $employeeGroupId
      );
  }

}
