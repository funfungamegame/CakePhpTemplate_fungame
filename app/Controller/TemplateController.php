<?php
class TemplateController extends AppController {
	
	public function beforeFilter() {
		//纯服务，不需要view
		$this->autoRender = false;
	}
	
	public function blankApi() {
		$this->response->body("Hello,cakephp.<br>This is in Template api blankApi().<br>");
	}
	
	public function crudApi() {
		//强行指定为post请求，允许get时可以去掉此条件
		if($this->isPost()) {
			fwrite(fopen( "F:\\tmp\\log.txt" , "a" ), "[" .date('Y-m-d H:i:s',time()+60*60*6). "]". "is Post" . "\n" );
			//定义返回值数据
			$ret = array (
					'result' => [ ] 
			);
			
			//请求参数校验
			$check = array (
// 					'app_token' => array (
// 							'required' => true 
// 					),
// 					'push_token' => array (
// 							'required' => true 
// 					),
// 					'uuid' => array (
// 							'required' => true 
// 					) 
			);
			try {
				//请求参数校验
// 				$this->Validation->validate($this->request->data, $check);
		
				//关联model
// 				$classes_model = $this->loadAppModel("[TemplateModel]");
				$classes_model = $this->loadAppModel("TemplateModel");
				


				$s_id=5;
				
				$options = array ();
				$options ['order'] = 'id';
				
				//检索条件"id=5"
				$options ['conditions'] = array("id" => $s_id);
				

				//数据库查询，AppModel.php中自定义了各种crud函数，都可以直接继承使用
				$list = $classes_model->find ( "all", $options );

				foreach ( $list as $row ) {
					if ($row [$classes_model->alias]) {
						$ret [] = $row [$classes_model->alias];
					}
				}

				fwrite(fopen( "F:\\tmp\\log.txt" , "a" ), "[" .date('Y-m-d H:i:s',time()+60*60*6). "]". "crudApi success" . "\n" );
				
				$ret["result"] = "success";
				$this->response->body(json_encode($ret));
				return;
			} catch(ValidationException $vex) {
				fwrite(fopen( "F:\\tmp\\log.txt" , "a" ), "[" .date('Y-m-d H:i:s',time()+60*60*6). "]". "crudApi ValidationException" . "\n" );
				$ret["code"] = $this->ERR_PARAM_NOT_EXISTS;
				$ret["result"] = "error";
				$this->response->body(json_encode($ret));
				return;
			} catch(Exception $ex) {
				fwrite(fopen( "F:\\tmp\\log.txt" , "a" ), "[" .date('Y-m-d H:i:s',time()+60*60*6). "]". "crudApi Exception" . "\n" );
				$ret["code"] = $this->ERR_OTHER;
				$ret["result"] = "error";
				$this->response->body(json_encode($ret));
				return;
			}
		} else {
			fwrite(fopen( "F:\\tmp\\log.txt" , "a" ), "[" .date('Y-m-d H:i:s',time()+60*60*6). "]". "not Post" . "\n" );
			$this->response->statusCode(405);
		}
	}
}