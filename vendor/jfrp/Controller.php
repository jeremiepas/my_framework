<?php
namespace jfrp;

abstract class Controller{
    protected $model;
    protected $method;
    protected static $vars = array();
    protected $layout = "pagedefault";
    public $data;
    public $insert;
    public function __construct(){
        $this->method =  $_SERVER['REQUEST_METHOD'];

        if (isset($_POST)){
            $this->data = $_POST;
        }
        // if($this->method == 'PUT'){
             $this->input = json_decode(file_get_contents('php://input'),true);
        // }
    }
    public function render($filename, $data = ['']) {
        $basekey = [];
        $basekey['maincss'] = 'public/css/main.css';
        $basekey['mainjs'] = 'public/js/main.js';
        $basekey['webroot'] = WEBROOT;
        $basekey['baseaccet'] = explode(":", $filename)[0];
        $content_for_layout  = '';
        $filename = str_replace(':', '/', $filename);
        if(file_exists(ROOT.'app/views/'.$filename.'.html')){
          ob_start();
        	require(ROOT.'app/views/'.$filename.'.html');
        	$content_for_layout = ob_get_clean();
    	   }

         if(file_exists(ROOT.'vendor/jfrp/views.html')){
           ob_start();
           require(ROOT.'vendor/jfrp/views.html');
           $content_for_view = ob_get_clean();
         }

         foreach ($data as $key => $value) {
           $regex = '/({{+\s+'.$key.'+\s+}})/';
           $content_for_layout = preg_replace($regex, $value, $content_for_layout);
         }
           $regex = '/({{+\s+(_)+(.+)+\s+}})/';
           $content_for_layout = preg_replace($regex, '$3', $content_for_layout);

         $basekey['content'] = $content_for_layout;
         foreach ($basekey as $key => $value) {
           $regex = '/({{+\s+'.$key.'+\s+}})/';
           $content_for_view = preg_replace($regex, $value, $content_for_view);
         }

        echo $content_for_view;
	}
    public function renderjson($result) {
        if (!$result) {
          http_response_code(404);
          die('erreur');
        }
        // print results, insert id or affected row count
        if ($this->method == 'GET') {

            echo json_encode($result);
    } elseif ($this->method == 'POST') {
          echo json_encode($result);
      }elseif ($this->method == 'DELETE') {
            echo 'true';
        } else{
          echo json_encode($result);
        }
    }
    public function rest($para){
        $method = $this->method;
        header("Access-Control-Allow-Origin: *");
        switch ($method) {
          case 'GET':
         $result =  $this->model->findOne('id = ?', array($para));
          break;
          case 'POST':
            $result = $this->model->insert($this->input);
          break;
          case 'PUT':
        //   $this->input = json_decode($this->input, true);
            $result = $this->model->update(['id' => $para], $this->input);
          break;
          case 'DELETE':
              $result = $this->model->delete(['id' => $para]);
          break;
        }
        $this->renderjson($result);
    }

}
?>
