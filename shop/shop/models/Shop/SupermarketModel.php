<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}
/**
 *@author weidp
 */

class Shop_SupermarketModel extends Shop_Supermarket
{

    public function getLifeContent($i=0,$page_html,$gid=array())
    {

        $preg = "/(gid|goods_id)(=|\()([\"|']?)([^\"'>|\)]+())/i";
        preg_match_all($preg,$page_html,$match);
        $gid = $match[4];


        /*global $gid;
        $jud   = substr($page_html,strpos($page_html,'gid=')+4);
        $str   = substr($page_html,strpos($page_html,'gid='));
        $arr   = substr($str,0,strpos($str,'"'));
        $gid[$i] = substr($arr,strpos($arr,'=')+1);
        $i++;
        if(strpos($jud,'gid='))
        {
            $this->getLifeContent($i,$jud);
        }*/

        return $gid;
    }

}