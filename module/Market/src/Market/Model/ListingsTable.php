<?php
/**
 * Created by PhpStorm.
 * User: caio.caprio
 * Date: 02/04/2015
 * Time: 10:08
 */

namespace Market\Model;


use Zend\Db\TableGateway\TableGateway;

class ListingsTable extends TableGateway
{

    public static $tableName = "listings";

} 