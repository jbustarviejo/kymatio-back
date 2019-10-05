<?php

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    /**
     * Welcome and employee list
     */
    public function indexAction()
    {
        $this->view->employees = Employees::find();
    }
}
