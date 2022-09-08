<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Recipe;
use CodeIgniter\API\ResponseTrait;
use App\Models\Cake;

class CakeApiController extends BaseController
{
    use ResponseTrait;
    // all cakes
    public function index()
    {
        $model = new Cake();
        $data = $model->orderBy('id', 'DESC')->findAll();
        return $this->respond($data);
    }
    // show cake cake
    public function show($id = null)
    {
        $model = new Cake();
        $data = $model->where(['id' =>$id])->first();
        if($data)
        {
            return $this->respond($data);
        }
        else
        {
            return $this->failNotFound('No Cake found');
        }

    }
    // insert cake
    public function create()
    {
        $model = new Cake();
        $nvp['name'] = $this->request->getPost('name');
        $nvp['price'] = $this->request->getPost('price');
        $nvp['recipe'] = $this->request->getPost('recipe');
        $model->insert($nvp);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Cake created successfully'
            ]
        ];
        return $this->respondCreated($response);
    }
    // update cake
    public function update($id = null)
    {
        $model = new Cake();
        $data = $this->request->getRawInput();
        $nvp['name'] = $data['name'];
        $nvp['price'] = $data['price'];
        $nvp['recipe'] = $data['recipe'];
        $model->update($id, $nvp);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Cake updated successfully'
            ]
        ];
        return $this->respond($response);
    }
    // delete cake
    public function delete($id = null){
        $model = new Cake();
        $data = $model->where('id', $id)->delete($id);
        if($data){
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Cake deleted successfully'
                ]
            ];
            return $this->respondDeleted($response);
        }
        else
        {
            return $this->failNotFound('No Cake found');
        }
    }
    // search
    public function search(){
        $string = $this->request->getPost('search_value');
        $model = new Cake();
        if ($string != null) {
            $data = $model->like('name',$string,'both')->findAll();
        } else {
            $data = $model->orderBy('id', 'DESC')->findAll();
        }
        return $this->respond($data);
    }
}
