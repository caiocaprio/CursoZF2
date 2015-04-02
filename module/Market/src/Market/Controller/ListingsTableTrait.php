<?php
/**
 * Created by PhpStorm.
 * User: caio.caprio
 * Date: 02/04/2015
 * Time: 10:57
 */

namespace Market\Controller;


trait ListingsTableTrait
{
    private $listingsTable;

    public  function setListingsTable($listingsTable)
    {
        $this->listingsTable = $listingsTable;
    }
} 