<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Purchase;
use CodeIgniter\API\ResponseTrait;
use http\Client\Curl\User;

class PurchaseApiController extends BaseController
{
    use ResponseTrait;
    // insert purchase
    public function create()
    {
        $model = new Purchase();
        $nvp['user_id'] = $this->request->getPost('user_id');
        $nvp['cake_id'] = $this->request->getPost('cake_id');
        $exists = $model->where('cake_id',$nvp['cake_id'])->where('user_id',$nvp['user_id'])->countAllResults();
        if ($exists == 0)
        {
            $model->insert($nvp);
            $response = [
                'status'   => 201,
                'error'    => null,
                'messages' => [
                    'success' => 'Purchased successfully'
                ]
            ];
        }
        else
        {
            $response = [
                'status'   => 201,
                'error'    => null,
                'messages' => [
                    'success' => 'Already Purchased'
                ]
            ];
        }
        return $this->respondCreated($response);
    }
    public function check($cake_id=null,$user_id = null)
    {
        $model = new Purchase();
        $exists = $model->where('user_id',$user_id)->where('cake_id',$cake_id)->countAllResults();
        if ($exists == 0)
        {
            $response = [
                'status'   => 200,
                'purchased' => false
            ];
        }
        else
        {
            $response = [
                'status'   => 200,
                'purchased' => true
            ];
        }
        return $this->respondCreated($response);
    }
}
