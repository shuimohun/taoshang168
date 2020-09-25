<?php 
if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author
 * 统计数据初始化
 * 
 */
class TaskCtl extends AdminController{
   
    public function __construct(&$ctl, $met, $typ){
		parent::__construct($ctl, $met, $typ);

	}
    
    /**
     *  分站信息同步
     * 
     */
    public function subsiteInstall(){
        
    }
    
    /**
     *  统计数据同步  会员数据
     */
    private function _memberAnalytics(){
        set_time_limit(0);
        $shop_formvars = array();
        $shop_url = YLB_Registry::get('shop_api_url');
        $shop_key = YLB_Registry::get('shop_api_key');
        $shop_formvars['app_id']    = YLB_Registry::get('shop_app_id');
        $init_rs = get_url_with_encrypt($shop_key, sprintf('%s?ctl=Api_Analysis_Install&met=memberlist&typ=json', $shop_url), $shop_formvars);

        if(isset($init_rs['status']) && $init_rs['status'] == 200){
            $analytics_formvars = array();
            
            $analytics_url = YLB_Registry::get('analytics_api_url');
            $analytics_key = YLB_Registry::get('analytics_api_key');
            $analytics_formvars['app_id']    = YLB_Registry::get('analytics_app_id');
            foreach ($init_rs['data']['data'] as $key => $val){
                $analytics_formvars['userinfo'] = $val;
                $init_rs2 = get_url_with_encrypt($analytics_key, sprintf('%s?ctl=Api_Install&met=memberInstall&typ=json', $analytics_url), $analytics_formvars);
                if(!isset($init_rs2['status']) || $init_rs2['status'] != 200){
                   return array('msg'=>'会员数据添加失败','code'=>250);
                }
            }
            return array('msg'=>'会员数据初始化成功','code'=>200);
        }else{
            return array('msg'=>'会员数据初始化失败','code'=>250);
        }
    } 
    
    /**
     *  统计数据同步  会员数据
     */
    private function _shopAnalytics(){
        set_time_limit(0);
        $shop_formvars = array();
        $shop_url = YLB_Registry::get('shop_api_url');
        $shop_key = YLB_Registry::get('shop_api_key');
        $shop_formvars['app_id']    = YLB_Registry::get('shop_app_id');
        $init_rs = get_url_with_encrypt($shop_key, sprintf('%s?ctl=Api_Analysis_Install&met=shoplist&typ=json', $shop_url), $shop_formvars);
       
        if(isset($init_rs['status']) && $init_rs['status'] == 200){
            $analytics_formvars = array();
            $analytics_url = YLB_Registry::get('analytics_api_url');
            $analytics_key = YLB_Registry::get('analytics_api_key');
            $analytics_formvars['app_id']    = YLB_Registry::get('analytics_app_id');
//            $num = count($init_rs['data']['data']);
            foreach ($init_rs['data']['data'] as $key => $val){
                $analytics_formvars['shopinfo'] = $val;
                $init_rs2 = get_url_with_encrypt($analytics_key, sprintf('%s?ctl=Api_Install&met=shopInstall&typ=json', $analytics_url), $analytics_formvars);
                if(!isset($init_rs2['status']) || $init_rs2['status'] != 200){
                    return array('msg'=>'店铺数据添加失败','code'=>250);
                }
            }
            return array('msg'=>'店铺数据初始化成功','code'=>200);
        }else{
            return array('msg'=>'店铺数据初始化失败','code'=>250);
        }
    } 
    
    /**
     *  统计数据同步  商品数据
     */
    private function _goodsAnalytics(){
        set_time_limit(0);
        $shop_formvars = array();
        $shop_url = YLB_Registry::get('shop_api_url');
        $shop_key = YLB_Registry::get('shop_api_key');
        $shop_formvars['app_id']    = YLB_Registry::get('shop_app_id');
        $init_rs = get_url_with_encrypt($shop_key, sprintf('%s?ctl=Api_Analysis_Install&met=goodslist&typ=json', $shop_url), $shop_formvars);
        if(isset($init_rs['status']) && $init_rs['status'] == 200){
            $analytics_formvars = array();
            $analytics_formvars['goodsinfo'] = $init_rs['data'];
            $analytics_url = YLB_Registry::get('analytics_api_url');
            $analytics_key = YLB_Registry::get('analytics_api_key');
            $analytics_formvars['app_id']    = YLB_Registry::get('analytics_app_id');
            foreach ($init_rs['data']['data'] as $key => $val){
                $analytics_formvars['goodsinfo'] = $val;
                $init_rs2 = get_url_with_encrypt($analytics_key, sprintf('%s?ctl=Api_Install&met=goodsInstall&typ=json', $analytics_url), $analytics_formvars);
                if(!isset($init_rs2['status']) || $init_rs2['status'] != 200){
                    return array('msg'=>'商品数据添加失败','code'=>250);
                }
            }
            return array('msg'=>'商品数据初始化成功','code'=>200);
        }else{
            return array('msg'=>'商品数据初始化失败','code'=>250);
        }
    } 
    
    /**
     *  统计中心初始化
     */
    public function analyticsInstall(){
        set_time_limit(0);
        $log_file = LOG_PATH.'/analytics_install_log.txt';
        if(is_file($log_file)){
            echo '请不要重复初始化，如果需要重新初始化，请删除文件：'.$log_file.'<br/>';
            echo '重复初始化可能造成数据错误，请谨慎操作';exit;
        }
        //初始化会员
        $install_member = $this->_memberAnalytics();
        $msg = $install_member['msg'].'<br/>';
        //初始化店铺
        $install_shop = $this->_shopAnalytics();
        $msg .= $install_shop['msg'].'<br/>';
        //初始化商品
        $install_goods = $this->_goodsAnalytics();
        $msg .= $install_goods['msg'].'<br/>';
        file_put_contents($log_file, $msg);
        echo $msg;exit;
        
    }
    
}

?>

