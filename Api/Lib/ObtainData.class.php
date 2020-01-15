<?php
namespace Api\Lib;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of DataProcessor
 *
 * @author hardy
 */
trait ObtainData{
    /**
     * 获取一条数据
     * @param $id
     * @param $model
     * @return mixed
     */
    public function getOne($id,$model=CONTROLLER_NAME){
        if(is_string($model)){
            $model = D($model);
        }
        return $model->getOne($id);
    }

    /**
     * 方法使用的 用来以分页形式返回数据列表
     * @param array $map
     * @param $count
     * @param string $order
     * @param $model
     * @param int $per_page
     * @return mixed
     */
    public function getListForPage($map=[], $order = 'id desc', &$count=0, &$per_page=0,$model=CONTROLLER_NAME){
        if(is_string($model)){
            $model = D($model);
        }
        $count = $model->getListForCount($map);
        if (empty($per_page)){
            $per_page = C('HOME_PER_PAGE_NUM', null, false);
        }
        $page = I('get.page', 1);
        return $model->getListForPage($map, $page, $per_page, $order);
    }
    /**
     * @param $model
     * @param $data
     * @return mixed
     */
    public function createSave(&$data,&$model=null){
        if (empty($model)){
            $model=CONTROLLER_NAME;
        }
        if(is_string($model)){
            $model = D($model);
        }
        if($model->createSave($data) === false){
            return false;
        }else{
            return $model->getOne($data['id']);
        }
    }

    /**
     * @param $model
     * @param $data
     * @return mixed
     */
    public function createAdd(&$data,&$model=null){
        if (empty($model)){
            $model=CONTROLLER_NAME;
        }
        if(is_string($model)){
            $model = D($model);
        }
        $r = $model->createAdd($data);
        if($r === false){
            return false;
        }else{
            return $model->getOne($r);
        }
    }

}
