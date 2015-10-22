<?php

/*
 * A tool can use command line to create Controller Model View etc.
 * 
 * @author Piece Chao (趙承瑋)
 * @link https://github.com/piece601/Codeigniter-Pitisan
 * @copyright Copyright (c) 2015, Piece Chao <https://github.com/piece601> 
 */

class Pitisan extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
    if ( ! $this->input->is_cli_request() ) {
      echo "This is command line interface tool.";
      exit();
      return false;
    }
    $this->load->helper('file');
  }

  public function _remap($method, $params = array())
  {
    switch ( $method ) {
      case 'c':
      case 'controller':
        $this->controller(
          isset($params[0]) ? $params[0] : Null,
          isset($params[1]) ? $params[1] : 'MY_Controller'
        );
        break;
      case 'm':
      case 'model':
        $this->model(
          isset($params[0]) ? $params[0] : Null,
          isset($params[1]) ? $params[1] : Null,
          isset($params[2]) ? $params[2] : Null,
          isset($params[3]) ? $params[3] : 'MY_Model'
        );
        break;
      case 'v':
      case 'view':
        $this->view(  isset($params[0]) ? $params[0] : Null, $params);
        break;
      case 'cm':
      case 'mc':
        if ( ! isset($params[0]) ) {
          echo "\n\033[33mUsage:\n\033[0m";
          echo " mc name \n\n";
          echo "\033[33mArguments:\n\033[0m";
          echo " name   The name of the controller class and model class.\n     (use . to seperate sub directory like last example)\n\n";
          break;
        }
        $this->controller($params[0], 'MY_Controller');
        $this->model($params[0], $params[0], $params[0].'Id', 'MY_Model');
        break;
      case 'form':
        if ( ! isset($params[0]) ) {
          echo "請輸入第一個參數來建立 form 的 v \n";
          break;
        }
        $this->_copy(
          $params[0],
          FCPATH.'factory/form/view.php',
          APPPATH.'views/'. str_replace('.', '/', $params[0]) .'.php'
        );
        break;
      case 'formh':
        if ( ! isset($params[0]) ) {
          echo "請輸入第一個參數來建立 formh 垂直的 v \n";
          break;
        }
        $this->_copy(
          $params[0],
          FCPATH.'factory/formh/view.php',
          APPPATH.'views/'. str_replace('.', '/', $params[0]) .'.php'
        );
        break;
      case 'formmuti':
        if ( ! isset($params[0]) ) {
          echo "請輸入第一個參數來建立 formmuti 多檔案上傳 cv \n";
          break;
        }
        // 製作 view
        $this->_copy(
          $params[0],
          FCPATH.'factory/formmuti/view.php',
          APPPATH.'views/'. str_replace('.', '/', $params[0]) .'.php'
        );

        $_PARAM1 = $params[0];
        for ($i=0; $i < strlen( $params[0] ); $i++) {
          if ( $params[0][$i] == '.') {
            $_PARAM1 = substr( $params[0], $i+1);
          }
        }
        $_PARAM1 = ucfirst($_PARAM1);

        // 製作 controller 
        $this->_copy(
          $params[0],
          FCPATH.'factory/formmuti/controller.php',
          APPPATH.'controllers/'. str_replace('.', '/', $params[0]) .'.php',
          'c',
          [
            '_PARAM1' => $_PARAM1,
            '_PARAM2' => str_replace('.', '/', $params[0])
          ]
        );
        break;
      case 'lazyload':
        if ( ! isset($params[0]) ) {
          echo "請輸入第一個參數來建立 lazyload 的範例 v\n";
          break;
        }
        $this->_copy(
          $params[0],
          FCPATH.'factory/lazyload/view.php',
          APPPATH.'views/'. str_replace('.', '/', $params[0]) .'.php'
        );
        break;
      case 'fancybox':
        if ( ! isset($params[0]) ) {
          echo "請輸入第一個參數來建立 fancybox 的範例 v\n";
          break;
        }
        $this->_copy(
          $params[0],
          FCPATH.'factory/fancybox/view.php',
          APPPATH.'views/'. str_replace('.', '/', $params[0]) .'.php'
        );
        break;
      default:
        $this->index();
        break;
    }
    return true;
  }

  protected function _copy($params, $original, $path, $mvc = 'v', $replace = [])
  {
    switch ($mvc) {
      case 'c':
        if ( ! $this->controller($params) ) {
          return;
        }
        break;
      case 'm':
        break;
      case 'v':
        if ( ! $this->view($params, []) ) {
          return;
        }
        break;
      default:
        return;
        break;
    }
    $this->load->helper('file');

    //清空檔案
    $fH = fopen($path, "r+");
    ftruncate($fH, 0);
    fclose($fH);

    $data = file_get_contents($original);
    if ( ! empty($replace) ) {
      foreach ($replace as $key => $value) {
        $data = str_replace($key, $value, $data);
      }
    }
    if ( ! write_file($path, $data) )
    {
      echo '無法寫入檔案!';
      return;
    }
    else
    {
      return;
      echo '檔案寫入完成!';
    }
  }


  // controller creator
  protected function _controller_creator($name, $extendsName)
  {
    $name = explode('/', $name)[count(explode('/', $name))-1]; // Find the end of array
    $data = "<?php\n\nclass ".$name." extends ".$extendsName." {\n";
    $data .= "\n  public function __construct()\n";
    $data .= "  {\n";
    $data .= "    parent::__construct();\n";
    $data .= "  }\n";
    $data .= "}";
    return $data;
  }

  // model creator
  protected function _model_creator($name, $table, $primaryKey, $extendsName)
  {
    $name = explode('/', $name)[count(explode('/', $name))-1]; // Find the end of array
    $data = "<?php\n\nclass ".$name."_model extends ".$extendsName." {\n";
    if ( isset($table) ) {
      $data .= '  protected $table = \''.$table."';\n";
    }
    if ( isset($primaryKey) ) {
      $data .= '  protected $primaryKey = \''.$primaryKey."';\n";
    }
    $data .= "\n  public function __construct()\n";
    $data .= "  {\n";
    $data .= "    parent::__construct();\n";
    $data .= "  }\n";
    $data .= "}";
    return $data;
  }

  // view creator
  protected function _view_creator($params)
  {
    $data = '';
    foreach ($params as $key => $value) {
      $data .= '<?php $this->load->view(\''.str_replace('.','/', $value).'\') ?>'."\n";
    }
    return $data;
  }

  // recursive create folder and return file path
  protected function _folder_creator($fileName, $mvc)
  {
    $folder = APPPATH.$mvc.'/';
    $arrDir = explode('.', $fileName); 
    unset($arrDir[count($arrDir)-1]);
    foreach ( $arrDir as $key => $value) {
      $folder .= $value.'/';
      if ( ! file_exists( $folder ) ) {
        mkdir( $folder );
      }
    }
    $arrDir = explode('.', $fileName);
    switch ( $mvc ) {
      case 'views':
        $arrDir[count($arrDir)-1] = strtolower( $arrDir[count($arrDir)-1] );
        break;
      default:
        $arrDir[count($arrDir)-1] = ucfirst( $arrDir[count($arrDir)-1] );
        break;
    }
    return implode('/', $arrDir);
  }

  public function index()
  {
    echo "\n\033[33mUsage:\n\033[0m";
    echo " controller Create controller\n";
    echo " model    Create model\n";
    echo " view   Create view\n";
    echo " mc   Create controller and model\n";
    echo " form  建立一個 form 的 v\n";
    echo " formh  建立一個垂直 form 的 v\n";
    echo " formmuti  建立一個多檔案上傳 form 的 v\n";
    echo " lazyload  建立一個 lazyload 的範例 v\n";
    echo " fancybox  建立一個 fancybox 的範例 v\n\n";
    return true;
  }

  public function controller($name = Null, $extendsName = 'MY_Controller')
  {
    // No param, Will response help.
    if ( ! isset( $name ) ) {
      echo "\n\033[33mUsage:\n\033[0m";
      echo " controller name [extendsName]\n\n";
      echo "\033[33mArguments:\n\033[0m";
      echo " name   The name of the controller class (use . to seperate sub directory like last example)\n";
      echo " extendsName  This class extends which class\n\n";
      echo "\033[33mExample:\n\033[0m";
      echo " pitisan controller Test\n";
      echo " # Create a Test.php file in controllers folder.\n\n";
      echo " pitisan controller Test MY_Controller\n";
      echo " # Create a Test.php file and extends MY_Controller in controllers folder.\n\n";
      echo " pitisan controller hi.123.Test MY_Controller\n";
      echo " # Create a Test.php file and extends MY_Controller in controllers/hi/123 folder.\n\n";
      return false;
    }
    // Recursive create folder and return path
    $path = $this->_folder_creator($name, 'controllers');

    // File exist.
    if ( file_exists(APPPATH.'controllers/'.$path.'.php') ) {
      echo "This controller file already exists.\n";
      return false;
    }

    // Actually write file.
    if ( ! write_file(APPPATH.'controllers/'.$path.'.php',
                      $this->_controller_creator($path, $extendsName) ) ) {
      echo "Unable to write the file.\n";
      return false;
    }
    echo $path . " controller was created!\n";
    return true;
  }

  public function model($name = Null, $table = Null, $primaryKey = Null, $extendsName = 'MY_Model')
  {
    // No param, Will response help.
    if ( ! isset( $name ) ) {
      echo "\n\033[33mUsage:\n\033[0m";
      echo " model name [table] [primaryKey] [extendsName] \n\n";
      echo "\033[33mArguments:\n\033[0m";
      echo " name   The name of the model class (use . to seperate sub directory like last example)\n";
      echo " table    This class will operate which table\n";
      echo " primaryKey The primary key of table\n";
      echo " extendsName  This class extends which class\n\n";
      echo "\033[33mExample:\n\033[0m";
      echo " pitisan model Test\n";
      echo " # Create a file Test_model.php in models folder.\n\n";
      echo " pitisan model Product products\n";
      echo " # Create a file Product_model.php contain a variable \$table='products' in models folder.\n\n";
      echo " pitisan model User users user_id MY_Model\n";
      echo " # Create a file User_model.php contain 2 variable \$table='users' \$primaryKey='user_id' and extends MY_Model in models folder.\n\n";
      echo " pitisan model some.other.User users user_id MY_Model\n";
      echo " # Create a file User_model.php contain 2 variable \$table='users' \$primaryKey='user_id' and extends MY_Model in models/some.other folder.\n\n";

      return false;
    }
    // Recursive create folder and return path
    $path = $this->_folder_creator($name, 'models');

    // File exist.
    if ( file_exists(APPPATH.'models/'.$path.'_model.php') ) {
      echo "This model file already exists.\n";
      return false;
    }
    // Actually write file.
    if ( ! write_file(APPPATH.'models/'.$path.'_model.php',
                      $this->_model_creator($path, $table, $primaryKey, $extendsName) ) ) {
      echo "Unable to write the file.\n";
      return false;
    }
    echo $path . " model was created!\n";
    return true;
  }

  public function view($name = Null, $params = Null)
  {
    // No param, Will response help.
    if ( ! isset( $name ) ) {
      echo "\n\033[33mUsage:\n\033[0m";
      echo " view name [require_file] [require_file] [require_file] ...more\n\n";
      echo "\033[33mArguments:\n\033[0m";
      echo " name   The name of the view file be create (use . to seperate sub directory like last example)\n";
      echo " require_file Assign will be required file in the view file (use . to seperate sub directory like last example)\n\n";
      echo "\033[33mExample:\n\033[0m";
      echo " pitisan view Test\n";
      echo " # Create a Test.php file in views folder.\n\n";
      echo " pitisan view some.Test\n";
      echo " # Create a Test.php file in views/some folder.\n\n";
      echo " pitisan view Test template.header\n";
      echo " # Create a Test.php file in views folder and this file contain views/template/header.php file.\n\n";
      echo " pitisan view user.index template.header template.footer \n";
      echo " # Create a index.php file in views/user folder and this file contain views/template/header.php and views/template/footer.php file.\n\n";
      return false;
    }
    // Recursive create folder and return path
    $path = $this->_folder_creator($name, 'views');

    // Remove the first param, in order to match the require file.
    unset($params[0]);

    // File exist.
    if ( file_exists(APPPATH.'views/'.$path.'.php') ) {
      echo "This view file already exists.\n";
      return false;
    }

    // Actually write file.
    if ( ! write_file(APPPATH.'views/'.$path.'.php',
                      $this->_view_creator($params) ) ) {
      echo "Unable to write the file.\n";
      return false;
    }
    echo $path . " view was created!\n";
    return true;
  }

}