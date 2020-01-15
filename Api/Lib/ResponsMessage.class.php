<?php
namespace Api\Lib;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//use Gy_Library\CusSession;

/**
 * Description of DataProcessor
 *
 * @author hardy
 */
trait ResponseMessage{
    /**
     * 成功返回分页数据
     * @param array $data  部分数据的列表
     * @param int $count   数据的总数据
     * @param int $page_number 分页数
     * @param string $message  提示信息
     * @param array $extraValue 扩展的返回值
     */
    public function responseDataList($data=[], $count=0,$page_number=0, $message='成功', $extraValue = []){
        if ($count !== 0 || $page_number !== 0 ){
            //总数
            $jsonData['count'] = $count;
            //分页数
            $jsonData['page_size'] = $page_number;
        }
        //当前记录列表
        if(empty($data)){
            $jsonData['list'] = [];
        }else{
            $jsonData['list'] = $data;
        }
        foreach ($extraValue as $key => $value){
            $jsonData[$key] = $value;
        }
        $this->response($message, 1, $jsonData);
    }
    /**
     * 成功，返回一条信息记录
     * @param array $data
     * @param string $message
     */
    public function responseSuccess($data=[], $message='成功'){
        $this->response($message, 1, $data);
    }
    /**
     * 失败
     * @param string $message       错误信息
     * @param array $data           可带数据
     */
    public function responseFail($message='失败',$data = []){
        $this->response($message,0,$data);
    }
    /**
     * 错误
     * @param string $message
     * @param array $data
     */
    public function responseError($message='访问出错了，请重试',$data = []){
        $this->response($message,0,$data, 401);
    }
//    /**
//     * 获得session ID -》 用户id
//     * @return mixed
//     */
//    public function getUserId(){
//        $user = CusSession::get(C('AUTH_ID'));
//        return $user['id'];
//    }
}
