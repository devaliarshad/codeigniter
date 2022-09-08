<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Cake;

class CakeController extends BaseController
{
    public function show($id = null)
    {
        $model = new Cake();
        $data = $model->where(['id' =>$id])->first();
        if($data)
        {
            return view('cake',$data);
        }
        else
        {
            return $this->failNotFound('No Cake found');
        }
    }
}
