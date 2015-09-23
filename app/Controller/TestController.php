<?php
class TestController extends AppController {
	
	public function beforeFilter() {
		//纯服务，不需要view
		$this->autoRender = false;
	}
	
	public function index() {
		$this->response->body("Hello,cakephp.<br>This is in test api index().<br>");
	}
	
	public function getClasses() {
		//这里没有用到
		$ret = array (
				'result' => [ ] 
		);
		
		//关联model
		$classes_model = $this->loadAppModel("TestModel");

		$s_id=5;
		
		$options = array ();
		$options ['order'] = 'id';
		
		//检索条件"id=5"
		$options ['conditions'] = array("id" => $s_id);
		
		$list = $classes_model->find ( "all", $options );
		
		$ret = array ();
		foreach ( $list as $row ) {
			if ($row [$classes_model->alias]) {
				$ret [] = $row [$classes_model->alias];
			}
		}

		$result=$ret[0];
		
		//查询结果数据自动对应数据库中的列名
		$id = $result["id"];
		$name = $result["name"];

		$this->response->body("Hello,cakephp.<br>This is in test api getClasses().<br>search result: id = ".$id." name = ".$name);
	}
}