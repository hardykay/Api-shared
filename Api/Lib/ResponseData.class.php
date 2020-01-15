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
trait ResponseData{
    /**
     * @param $id
     * @param mixed|string $model
     */
    public function getOne($id,$model=CONTROLLER_NAME){
        if(is_string($model)){
            $model = D($model);
        }
        $data = $model->getOne($id);
        $this->responseSuccess($data);
    }

    /**
     * 方法使用的 用来以分页形式返回数据列表
     * @param array $map
     * @param string $order
     * @param $model
     * @param array $extraValue
     */
    public function responsePage($map=[], $order = 'id desc',$model=CONTROLLER_NAME, $extraValue = []){
        if(is_string($model)){
            $model = D($model);
        }
        $count = $model->getListForCount($map);
        $per_page = C('HOME_PER_PAGE_NUM', null, false);
        $page = I('get.page', 1);
        $data_list = $model->getListForPage($map, $page, $per_page, $order);
        $this->responseDataList($data_list,$count,$per_page, $extraValue);
    }
    /**
     * @param $model
     * @param $data
     * @return mixed
     */
    public function responseSave(&$data,&$model=CONTROLLER_NAME){
        if(is_string($model)){
            $model = D($model);
        }
        if($model->createSave($data) === false){
            $this->responseFail($model->getError());
        }else{
            $oneData = $model->getOne($data['id']);
            $this->responseSuccess($oneData);
        }
    }

    /**
     * 插入数据库
     * 不支持事务
     * @param $model
     * @param $data
     * @return mixed
     */
    public function responseAdd(&$data,&$model=CONTROLLER_NAME){
        if(is_string($model)){
            $model = D($model);
        }
        $r = $model->createAdd($data);
        if($r === FALSE){
            $this->responseFail($model->getError());
        }else{
            $oneData = $model->getOne($r);
            //返回修改的值
            $this->responseSuccess($oneData);
        }
    }

}
