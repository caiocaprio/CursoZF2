<?php
/**
 * Created by PhpStorm.
 * User: caio.caprio
 * Date: 30/03/2015
 * Time: 11:15
 */

namespace Application\Helper;


use Zend\View\Helper\AbstractHelper;

class LeftLinks extends AbstractHelper{

    public  function __invoke($values, $urlPrefix)
    {
        $html = '<ul style="list-style-type:none;">'.PHP_EOL;
        foreach($values as $item)
        {
            $html.=sprintf("<li><a href=\"%s/%s\">%s</a></li>\n",$urlPrefix, $item, $item);
        }
        $html.="</ul>".PHP_EOL;
        return $html;
    }

} 