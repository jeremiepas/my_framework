<?php

  switch ($argv[1]) {
    case 'c':
      $data['name'] = $argv[2];
      $tmp = $data['name'];
      $tmp[0] = strtoupper($tmp[0]);
      $data['nametab'] = $tmp;
      $data['render'] = ($argv[3] !== null && $argv[3] == "rest")? $argv[3] : "render";
      controllerGenerate($data);
      viewsGenerate($data);
    break;
    case 'm':
      $data['name'] = $argv[2];
      $data['name'][0] = strtoupper($data['name'][0]);
      modelGenerate($data);
    break;
    default:
      # code...
      break;
  }
  function modelGenerate($data){
    $myfile = fopen("vendor/jfrp/create/modeldefault.php", "r") or die("Unable to open file!");
    $new_controller = fread($myfile,filesize("vendor/jfrp/create/modeldefault.php"));
    foreach ($data as $key => $value) {
      $regex = '/({{+\s+'.$key.'+\s+}})/';
      $new_controller = preg_replace($regex, $value, $new_controller );
    }
    $newfile = fopen("app/models/".$data['name']."Table.php", "w") or die("Unable to open file!");
    fwrite($newfile, $new_controller);
    fclose($myfile);
    flcolse($newfile);
  }
  function controllerGenerate($data){
    if($data["render"] == "rest" ){
      $data["render"] = '$this->rest($para);';
    }else{
      $data["render"] = '$this->render(\''.$data['name'].':index\', array(\'test\' => 123, \'blate\' => \'bien\'));';
    }
    $myfile = fopen("vendor/jfrp/create/controllerdefault.php", "r") or die("Unable to open file!");
    $new_controller = fread($myfile,filesize("vendor/jfrp/create/controllerdefault.php"));
    foreach ($data as $key => $value) {
      $regex = '/({{+\s+'.$key.'+\s+}})/';
      $new_controller = preg_replace($regex, $value, $new_controller );
    }
    $newfile = fopen("app/controllers/".$data['name'].".php", "w") or die("Unable to open file!");
    fwrite($newfile, $new_controller);
    fclose($myfile);
    fclose($newfile);
  }
  function viewsGenerate($data){
    mkdir ( "app/views/".$data['name']);
    $newfile = fopen("app/views/".$data['name']."/index.html", "w") or die("Unable to open file!");
    fwrite($newfile, "controllers ".$data['name']);
    fclose($myfile);
  }
?>
