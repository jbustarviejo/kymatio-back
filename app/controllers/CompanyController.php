<?php

use Phalcon\Mvc\Controller;

class CompanyController extends Controller
{
    /**
     * Show companies list
     */
    public function indexAction()
    {
      header('Access-Control-Allow-Origin: *'); //Not secure, but enough for this test scope
      $companies = Companies::find();
      return json_encode($companies);

    }

    /**
     * Register new company or update an existent one
     */
    public function saveAction($id=null)
    {
      header('Access-Control-Allow-Origin: *'); //Not secure, but enough for this test scope
      header("Access-Control-Allow-Methods: POST, DELETE");

      if($id){
        $company = Companies::findFirst("id=$id");
      }else{
        $company = new Companies();
      }

      // Check if request has made with DELETE
      if ($this->request->isDelete()) {
        $success = $company->delete();
      }else{
        try {
          // Store and check for errors
          $success = $company->save(
              $this->request->getPost(),
              ['name', 'cif', 'address']
          );
        } catch (\Exception $e) {
          $success = false;
        }
      }

      if ($success) {
          return json_encode(["ok"=>true]);
      } else {
          return json_encode(["ok"=>false]);
      }
    }
}
