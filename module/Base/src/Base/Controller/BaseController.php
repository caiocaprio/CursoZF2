<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Base\Controller;

use Zend\Log\Logger;
use Zend\Log\Writer\Db;
use Zend\Mvc\Controller\AbstractActionController;


class BaseController extends AbstractActionController{

    private $logger;

    public function __construct()
    {
        //$this->teste = 0;
        //$this->createLogDb();
    }

    private function configLogger()
    {
        if(!isset($this->logger))
        {
            $this->logger = new Logger();
            //$this->logger->addWriter('stream', null, array('stream' => 'php://output'));
            $this->logger->addWriter('stream', null, array('stream' => 'data/application-2.log'));
        }

        return $this->logger;
    }


    public function createLog()
    {
        $log = $this->configLogger();
        $log->log(Logger::INFO, 'Informational message');
    }

    public function createLogDb(String $msg = null)
    {
        /*
         *  $params = array ('host'     => '127.0.0.1',
                 'username' => 'malory',
                 'password' => '******',
                 'dbname'   => 'camelot');
            $db = Zend_Db::factory('PDO_MYSQL', $params);

            $columnMapping = array('lvl' => 'priority', 'msg' => 'message');
            $writer = new Zend_Log_Writer_Db($db, 'log_table_name', $columnMapping);

            $logger = new Zend_Log($writer);
            $logger->info('Informational message');*/


        //$this->logger = new Logger();

       // $adapter = $this->getServiceLocator()->get('general-adapter');
        //$db = new Zend\Db\Adapter\Adapter($dbconfig);


        /*$data = array(  'type'=>'INFO',
                        'log'=>'sucesso!'
        );

        $map = array(
            'message'   => 'logs',
            'extra' => $data
        );

        $writer = new \Zend\Log\Writer\Db($adapter, 'logs', $map);
        $this->logger->addWriter($writer);
        $this->logger->info($map['message'], $map['extra']);*/
    }




}

