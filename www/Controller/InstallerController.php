<?php

namespace App\Controller;

use App\Core\View;
use App\Core\Auth;
use App\Model\User as UserModel;
use App\Model\Installer as InstallerModel;

use App\Core\Verificator;


class InstallerController {

    protected $pdo;
    
    public function __construct()
    {
       
    }

    public function initproject(){

      $installer = new InstallerModel();

      if( !empty($_POST)){

          $result = Verificator::checkForm($installer->getInstallerForm(), $_POST);
          if (empty($result)) {
              InstallerController::createDatabase($_POST);
          }
      }    

      $view = new View("installer/init", "back");
      $view->assign("installer", $installer);

    }

    public static function createDatabase($data)
    {

      $db_name =  htmlspecialchars($data['db_name']);
      $db_host =  htmlspecialchars($data['db_host']);
      $db_port = $data['db_port'];
      $db_driver =  $data['db_driver']; 
      $db_user =  htmlspecialchars($data['db_user']) ;
      $db_password =  htmlspecialchars($data['db_password']) ;
      $db_prefix =  htmlspecialchars($data['db_prefix']);

      $hostmail = $data['hostmail'];
      $mailusername =  $data['mailusername'];
      $mailpassword =  $data['mailpassword'];
      $setmail =  $data['setmail'];
      $sitename =  $data['sitename'];

      try {

        //$pdo = new \PDO($db_driver.":host=".$db_host.";port=".$db_port, $db_user, $db_password);

        // CREATE DATABASE AND USER

        $pdo = new \PDO($db_driver.":host=".$db_host.";port=".$db_port, 'root', 'password');

        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $pdo->exec("CREATE DATABASE IF NOT EXISTS $db_name");

        $usersql = "CREATE USER '$db_user'@'%' IDENTIFIED BY '$db_password';
          GRANT ALL PRIVILEGES ON $db_name.* TO '$db_user'@'%';";  

        // QUERIES

        $pdo = new \PDO($db_driver.":host=".$db_host.";port=".$db_port, $db_user, $db_password);
        
        $pdo->exec("USE $db_name");

        $sql = file_get_contents('/var/www/html/database-creation.sql');

        $sql = str_replace('prefix_', $db_prefix, $sql);

        $query = $pdo->exec($sql);

        if ($query === false) {
          header("Location: /installer?error=createtables");
          exit();
        }

        $fileContent = '<?php
          define("DBUSER", "'.$db_user.'");
          define("DBPWD", "'.$db_password.'");
          define("DBHOST", "'.$db_host.'");
          define("DBNAME", "'.$db_name.'");
          define("DBPORT", "'.$db_port.'");
          define("DBDRIVER", "'.$db_driver.'");
          define("DBPREFIXE", "'.$db_prefix.'");

          define("HOSTMAIL", "'.$hostmail.'");
          define("MAILUSERNAME", "'.$mailusername.'");
          define("MAILPWD", "'.$mailpassword.'");
          define("SETMAIL", "'.$setmail.'");
          define("SITENAME", "'.$sitename.'");
        ';

        file_put_contents('conf.inc.php',$fileContent);

        header('Location: /');

      } catch (\Exception $e){
        die("Erreur SQL : ".$e->getMessage());
      }

    }

}