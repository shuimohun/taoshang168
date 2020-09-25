<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class TestCtl extends Controller
{
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);
        $this->initData();
    }

    public function jl()
    {
        include $this->view->getView();
    }

    public function vr()
    {
        include $this->view->getView();
    }

    public function vrr()
    {
        include $this->view->getView();
    }


    public function j()
    {
        include $this->view->getView();
    }

    public function index()
    {
        include $this->view->getView();

        /*$Cache = YLB_Cache::create('default');
        $site_index_key = sprintf('%s|%s|%s', YLB_Registry::get('server_id'), 'site_index',  isset($_COOKIE['sub_site_id']) ? $_COOKIE['sub_site_id'] : 0);

        if (!$Cache->start($site_index_key))
        {
            $this->is_index = 1;
            $this->initData();


            include $this->view->getView();
            $Cache->_id = $site_index_key;
            $Cache->end($site_index_key);
        }*/
    }

    public function catList()
    {
        $id = request_int('id');

        if ($id){
            $YLB_Page = new YLB_Page();
            $page     = request_int('page',1);
            $rows     = request_int('rows',24);

            $GoodsCatModel = new Goods_CatModel();
            $cat = $GoodsCatModel->getOne($id);
            if ($cat) {
                if ($cat['cat_parent_id'] == 0) {

                    $sub_row = $GoodsCatModel->getByWhere(['cat_parent_id'=>$id]);
                    if ($sub_row) {
                        $id = array_keys($sub_row);
                        $data = $GoodsCatModel->listByWhere(['cat_parent_id:IN'=>$id],[],$page,$rows);
                        $count = $GoodsCatModel->getRowCount(['cat_parent_id:IN'=>$id]);
                        $cat['sub'] = sprintf("共%s属%s种",count($id),$count);
                    } else {
                        $cat['sub'] = '共0属';
                    }
                } else {
                    $data = $GoodsCatModel->listByWhere(['cat_parent_id'=>$id],[],$page,$rows);
                    $cat_parent = $GoodsCatModel->getOneByWhere(['cat_id'=>$cat['cat_parent_id']]);
                    if ($cat_parent) {
                        $cat['parent'] = $cat_parent;
                        $sub_row = $GoodsCatModel->getByWhere(['cat_parent_id'=>$cat_parent['cat_id']]);
                    }
                    $count = $GoodsCatModel->getRowCount(['cat_parent_id'=>$id]);
                    $cat['sub'] = sprintf("共%s种",$count);
                }

                $YLB_Page->nowPage    = $page;
                $YLB_Page->listRows   = $rows;
                $YLB_Page->totalPages = $data['total'];
                $data['page_nav']     = $YLB_Page->promptII();

            } else {
                $this->view->setMet('error');
            }
        } else {
            $this->view->setMet('error');
        }

        include $this->view->getView();
    }

    public function detail()
    {
        $id = request_int('id');
        if ($id > 0) {
            $GoodsCatModel = new Goods_CatModel();

            //判断是否是最后一级
            //是否有子类
            $sub_id = $GoodsCatModel->getRowCount(['cat_parent_id'=>$id]);
            if ($sub_id) {
                location_to(YLB_Registry::get('url') . '?ctl=Index&met=catList&id=' . $id);
            } else {
                $cat = $GoodsCatModel->getOne($id);
                if ($cat) {
                    $parent_cat_row = $GoodsCatModel->getAllParentCat($id);
                    if (isset($parent_cat_row[1]) && $parent_cat_row[1]['cat_id'] != $id) {
                        $p_cat = $parent_cat_row[1];
                    }
                    $parent_cat_row = array_reverse($parent_cat_row);
                    if (isset($parent_cat_row[0]) && $parent_cat_row[0]['cat_id'] != $id) {
                        $g_cat = $parent_cat_row[0];
                        $sub_row = $GoodsCatModel->getByWhere(['cat_parent_id'=>$g_cat['cat_id']]);
                    }
                } else {
                    $this->view->setMet('error');
                }
            }
        } else {
            $this->view->setMet('error');
        }

        include $this->view->getView();
    }

    public function map()
    {
        $type = request_string('type','w');
        if ('g' == $type){
            $CountryBaseModel = new Country_BaseModel();
            $country = $CountryBaseModel->getAllCountry();

            $name_map = [];
            foreach ($country as $key => $value){
                $name_map[$value['country_name']] = $value['country_name_ch'];
            }
            $name_map = json_encode($name_map);

            $this->view->setMet('globe');
        } else if ('w' == $type) {
            $CountryBaseModel = new Country_BaseModel();
            $country = $CountryBaseModel->getAllCountry();

            $cat_id = request_int('cid');
            $cat_country_row = [38=>1];
            if ($cat_id) {
                //查询分类 分布
            }

            $source = [];
            foreach ($country as $key => $value){
                $source[$key]['id']      = $value['country_id'];
                $source[$key]['name']    = $value['country_name'];
                $source[$key]['name_ch'] = $value['country_name_ch'];
                if (isset($cat_country_row[$value['country_id']])) {
                    $source[$key]['value'] = 1;
                }
            }
            $source = json_encode(array_values($source));
            $this->view->setMet('world');
        } else if ('c' == $type) {

            $District = new Base_DistrictModel();
            $district = $District->getByWhere(['district_parent_id'=>0]);

            $cat_id = request_int('cid');
            $cat_china_row = [1=>1,2=>1,5=>1];
            if ($cat_id) {
                //查询分类 分布
            }

            $source = [];
            foreach ($district as $key => $value){
                $source[$key]['id'] = $value['district_id'];
                $source[$key]['name'] = $value['district_name'];
                if (isset($cat_china_row[$value['district_id']])) {
                    $source[$key]['value'] = 1;
                }
            }
            $source = json_encode(array_values($source));

            $this->view->setMet('china');
        }

        include $this->view->getView();
    }

    public function setDistribution()
    {
        $this->page = 'formSelects';
        include $this->view->getView();
    }

    public function starbucks()
    {
        $CountryBaseModel = new Country_BaseModel();
        $country = $CountryBaseModel->getAllCountry();

        $source = [];
        foreach ($country as $key => $value){
            $source[$key]['id']      = $value['country_id'];
            $source[$key]['name']    = $value['country_name'];
            $source[$key]['name_ch'] = $value['country_name_ch'];
            $source[$key]['value']   = 0;
        }
        $source = json_encode(array_values($source));










        $AntCatModel = new Ant_CatModel();
        $this->cat = $AntCatModel->getByWhere(['cat_p_id'=>0]);








        include $this->view->getView();
    }

    public function getCat()
    {
        $data = [];
        $cat_id = request_int('id');
        /*
        if ($cat_id){
            $GoodsCatModel = new Goods_CatModel();
            $sub_cat = $GoodsCatModel->getCatChild($cat_id);

            if ($sub_cat) {
                $data['cat'] = $sub_cat;
            }
            $CatDistributionModel = new Cat_DistributionModel();
            $distribution = $CatDistributionModel->getOne($cat_id);

            if ($distribution) {
                $world = explode(',',$distribution['world']);
                $china = explode(',',$distribution['china']);

                $CountryBaseModel = new Country_BaseModel();
                $country = $CountryBaseModel->getAllCountry();

                $source = [];
                foreach ($country as $key => $value){
                    $source[$key]['id']      = $value['country_id'];
                    $source[$key]['name']    = $value['country_name'];
                    $source[$key]['name_ch'] = $value['country_name_ch'];
                    if (in_array($value['country_id'],$world)){
                        $source[$key]['value']   = 1;
                    }else{
                        $source[$key]['value']   = 0;
                    }
                }

                $data['world'] = array_values($source);
            }
        }*/



        $AntCatModel = new Ant_CatModel();
        $data['cat'] = $AntCatModel->getByWhere(['cat_p_id'=>$cat_id]);





        if ('json' == $this->typ){
            $this->data->addBody(1,$data);
        }
    }



    public function addAntFamily()
    {
        /*$data = [
            '蛮蚁亚科'=>'Agroecomyrmecinae',
            '钝猛蚁亚科'=>'Amblyoponinae',
            '原奥猛蚁亚科'=>'Aneuretinae',
            '臭蚁亚科'=>'Dolichoderinae',
            '行军蚁亚科'=>'Dorylinae',
            '刺猛蚁亚科'=>'Ectatomminae',
            '蚁亚科'=>'Formicinae',
            '异猛蚁亚科'=>'Heteroponerinae',
            '细蚁亚科'=>'Leptanillinae',
            '异种蚁亚科'=>'Martialinae',
            '蜜蚁亚科'=>'Myrmeciinae',
            '切叶蚁亚科'=>'Myrmicinae',
            '拟猛蚁亚科'=>'Paraponerinae',
            '猛蚁亚科'=>'Ponerinae',
            '卷尾猛蚁亚科'=>'Proceratiinae',
            '伪切叶蚁亚科'=>'Pseudomyrmecinae',
        ];

        $AntCatModel = new Ant_CatModel();
        foreach ($data as $k => $v) {
            $genera_filed['cat_p_id'] = 0;
            $genera_filed['cat_name'] = $v;
            $genera_filed['cat_name_ch'] = $k;
            $genera_filed['user_id'] = 10001;
            $genera_filed['user_name'] = 'admin';
            //$AntCatModel->addCat($genera_filed);
        }*/
    }

    public function addAntGenera()
    {
        /*set_time_limit(0);
        $data = [
            '1'=>'Agroecomyrmecinae',
            '2'=>'Amblyoponinae',
            '3'=>'Aneuretinae',
            '4'=>'Dolichoderinae',
            '5'=>'Dorylinae',
            '6'=>'Ectatomminae',
            '7'=>'Formicinae',
            '8'=>'Heteroponerinae',
            '9'=>'Leptanillinae',
            '10'=>'Martialinae',
            '11'=>'Myrmeciinae',
            '12'=>'Myrmicinae',
            '13'=>'Paraponerinae',
            '14'=>'Ponerinae',
            '15'=>'Proceratiinae',
            '16'=>'Pseudomyrmecinae',
        ];
        $AntCatModel = new Ant_CatModel();

        $Cache     = YLB_Cache::create('base');
        $cache_key = "genera|";
        foreach ($data as $key => $value){
            $genera_data = get_url("http://www.antmaps.org/api/v01/genera.json?subfamily=$value");
            if ($genera_data && $genera_data['genera']){
                foreach ($genera_data['genera'] as $k => $v){
                    $cache_key .= $v['key'];
                    if (!$Cache->get($cache_key)){
                        $genera_filed = [];
                        $genera_filed['cat_p_id'] = $key;
                        $genera_filed['cat_name'] = $v['key'];
                        $genera_filed['user_id']  = 10001;
                        $genera_filed['user_name'] = 'admin';
                        $flag = $AntCatModel->addCat($genera_filed);
                        if ($flag){
                            $Cache->save(1, $cache_key);
                        }
                    }
                }
            }
        }

        $this->data->addBody(1,[]);*/

    }

    public function addAntSpecies()
    {
        /*set_time_limit(0);

        $page = request_int('page',1);

        $AntCatModel = new Ant_CatModel();
        $data = $AntCatModel->listByWhere(['cat_p_id:>'=>0],['cat_id'=>'asc'],$page,50);

        $Cache     = YLB_Cache::create('base');
        $cache_key = "species|";

        foreach ($data['items'] as $key => $value) {
            $species_data = get_url("http://www.antmaps.org/api/v01/species.json?genus=" . $value['cat_name']);
            if ($species_data && $species_data['species']){
                foreach ($species_data['species'] as $k => $v){
                    $cache_key .= $v['display'];
                    if (!$Cache->get($cache_key)){
                        $id = $AntCatModel->getKeyByWhere(['cat_name'=>$v['display']]);
                        if ($id){
                            $species_filed['cat_p_id'] = $value['cat_id'];
                            $species_filed['cat_name'] = $v['display'];
                            $species_filed['user_id']  = 10001;
                            $species_filed['user_name'] = 'admin';
                            $flag = $AntCatModel->addCat($species_filed);
                            if ($flag){
                                $Cache->save(1, $cache_key);
                            }
                        }
                    }
                }
            }
        }

        $this->data->addBody(1,[]);*/

    }










    public function ant()
    {
        include $this->view->getView();
    }

    public function taxa()
    {
        include $this->view->getView();
    }





    public function rSlider()
    {
        echo '      
{
    "code":0,
    "data":{
        "slider":[
            {
                "linkUrl":"https://www.zhenzihan.com/shop/shop/static/default/images/2.jpg",
                "picUrl":"https://www.zhenzihan.com/shop/shop/static/default/images/2.jpg",
                "id":18504
            },
            {
                "linkUrl":"https://www.zhenzihan.com/shop/shop/static/default/images/2.jpg",
                "picUrl":"https://www.zhenzihan.com/shop/shop/static/default/images/2.jpg",
                "id":18584
            },
            {
                "linkUrl":"https://www.zhenzihan.com/shop/shop/static/default/images/2.jpg",
                "picUrl":"https://www.zhenzihan.com/shop/shop/static/default/images/2.jpg",
                "id":18499
            },
            {
                "linkUrl":"https://www.zhenzihan.com/shop/shop/static/default/images/2.jpg",
                "picUrl":"https://www.zhenzihan.com/shop/shop/static/default/images/2.jpg",
                "id":18575
            },
            {
                "linkUrl":"https://www.zhenzihan.com/shop/shop/static/default/images/2.jpg",
                "picUrl":"https://www.zhenzihan.com/shop/shop/static/default/images/2.jpg",
                "id":18579
            }
        ]
    }
}';
        die;
    }

    public function rIndex()
    {
        echo '{
	"msg": "",
	"code": 1,
	"data": {
		"video1": {
		    "title":"花束系列",
			"pageNumber": 1,
			"visitCount": 0,
			"dateRange": null,
			"totalPage": 0,
			"pageSize": 10,
			"keyword": "",
			"list": [{
				"createTime": null,
				"name": "视频1",
				"description": "描述",
				"updateTime": null,
				"id": 1,
				"type": 1,
				"url": "http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
			}, {
				"createTime": null,
				"name": "视频1",
				"description": "描述",
				"updateTime": null,
				"id": 7,
				"type": 1,
				"url": "http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
			}],
			"orderField": "",
			"totalCount": 0,
			"orderDesc": false
		},
		"video2": {
		"title":"花束系列2",
			"pageNumber": 1,
			"visitCount": 0,
			"dateRange": null,
			"totalPage": 0,
			"pageSize": 10,
			"keyword": "",
			"list": [{
				"createTime": null,
				"name": "视频2",
				"description": "描述",
				"updateTime": null,
				"id": 2,
				"type": 2,
				"url": "http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
			}, {
				"createTime": null,
				"name": "视频1",
				"description": "描述",
				"updateTime": null,
				"id": 3,
				"type": 2,
				"url": "http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
			}, {
				"createTime": null,
				"name": "视频1",
				"description": "描述",
				"updateTime": null,
				"id": 4,
				"type": 2,
				"url": "http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
			}],
			"orderField": "",
			"totalCount": 0,
			"orderDesc": false
		},
		"video5": {
		"title":"花束系列3",
			"pageNumber": 1,
			"visitCount": 0,
			"dateRange": null,
			"totalPage": 0,
			"pageSize": 10,
			"keyword": "",
			"list": [{
				"createTime": null,
				"name": "视频1",
				"description": "描述",
				"updateTime": null,
				"id": 10,
				"type": 5,
				"url": "http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
			}],
			"orderField": "",
			"totalCount": 0,
			"orderDesc": false
		},
		"video6": {
		"title":"花束系列4",
			"pageNumber": 1,
			"visitCount": 0,
			"dateRange": null,
			"totalPage": 0,
			"pageSize": 10,
			"keyword": "",
			"list": [{
				"createTime": null,
				"name": "视频1",
				"description": "描述",
				"updateTime": null,
				"id": 11,
				"type": 6,
				"url": "http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
			}],
			"orderField": "",
			"totalCount": 0,
			"orderDesc": false
		},
		"video3": {
		"title":"花束系列5",
			"pageNumber": 1,
			"visitCount": 0,
			"dateRange": null,
			"totalPage": 0,
			"pageSize": 10,
			"keyword": "",
			"list": [{
				"createTime": null,
				"name": "视频1",
				"description": "描述",
				"updateTime": null,
				"id": 5,
				"type": 3,
				"url": "http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
			}, {
				"createTime": null,
				"name": "视频1",
				"description": "描述",
				"updateTime": null,
				"id": 6,
				"type": 3,
				"url": "http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
			}],
			"orderField": "",
			"totalCount": 0,
			"orderDesc": false
		},
		"video4": {
		"title":"花束系列6",
			"pageNumber": 1,
			"visitCount": 0,
			"dateRange": null,
			"totalPage": 0,
			"pageSize": 10,
			"keyword": "",
			"list": [{
				"createTime": null,
				"name": "视频1",
				"description": "描述",
				"updateTime": null,
				"id": 8,
				"type": 4,
				"url": "http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
			}, {
				"createTime": null,
				"name": "视频1",
				"description": "描述",
				"updateTime": null,
				"id": 9,
				"type": 4,
				"url": "http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
			}],
			"orderField": "",
			"totalCount": 0,
			"orderDesc": false
		},
		"video9": {
		"title":"花束系列7",
			"pageNumber": 1,
			"visitCount": 0,
			"dateRange": null,
			"totalPage": 0,
			"pageSize": 10,
			"keyword": "",
			"list": [{
				"createTime": null,
				"name": "",
				"description": "",
				"updateTime": null,
				"id": 16,
				"type": 9,
				"url": ""
			}],
			"orderField": "",
			"totalCount": 0,
			"orderDesc": false
		},
		"video7": {
		"title":"花束系列8",
			"pageNumber": 1,
			"visitCount": 0,
			"dateRange": null,
			"totalPage": 0,
			"pageSize": 10,
			"keyword": "",
			"list": [{
				"createTime": null,
				"name": "视频1",
				"description": "描述",
				"updateTime": null,
				"id": 12,
				"type": 7,
				"url": "http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
			}, {
				"createTime": null,
				"name": "视频1",
				"description": "描述",
				"updateTime": null,
				"id": 14,
				"type": 7,
				"url": "http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
			}],
			"orderField": "",
			"totalCount": 0,
			"orderDesc": false
		},
		"newVideo": {
		"title":"花束系列9",
			"pageNumber": 1,
			"visitCount": 0,
			"dateRange": null,
			"totalPage": 0,
			"pageSize": 10,
			"keyword": "",
			"list": [{
				"createTime": null,
				"name": "视频1",
				"description": "描述",
				"updateTime": null,
				"id": 1,
				"type": 1,
				"url": "http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
			}, {
				"createTime": null,
				"name": "视频2",
				"description": "描述",
				"updateTime": null,
				"id": 2,
				"type": 2,
				"url": "http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
			}, {
				"createTime": null,
				"name": "视频1",
				"description": "描述",
				"updateTime": null,
				"id": 3,
				"type": 2,
				"url": "http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
			}],
			"orderField": "",
			"totalCount": 0,
			"orderDesc": false
		},
		"video8": {
		"title":"花束系列10",
			"pageNumber": 1,
			"visitCount": 0,
			"dateRange": null,
			"totalPage": 0,
			"pageSize": 10,
			"keyword": "",
			"list": [{
				"createTime": null,
				"name": "视频1",
				"description": "描述",
				"updateTime": null,
				"id": 13,
				"type": 8,
				"url": "http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
			}, {
				"createTime": null,
				"name": "视频1",
				"description": "描述",
				"updateTime": null,
				"id": 15,
				"type": 8,
				"url": "http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
			}],
			"orderField": "",
			"totalCount": 0,
			"orderDesc": false
		}
	}
}';
        die;
    }

    public function rLogin()
    {
        $code = request_string('code');
        $url = 'https://api.weixin.qq.com/sns/jscode2session?appid=wxa3a9f1c8fc5313b2&secret=99bc6feffdd553cd0913409454a11ad9&js_code='.$code.'&grant_type=authorization_code';

        echo file_get_contents($url);die;

    }

    public function rImages()
    {
        echo '{
    "msg":"",
    "code":1,
    "data":[
        {
            "title":"最新更新",
            "pageNumber":1,
            "visitCount":0,
            "dateRange":null,
            "totalPage":0,
            "pageSize":10,
            "keyword":"",
            "list":[
                {
                    "createTime":"",
                    "name":"2222222222",
                    "description":"",
                    "updateTime":"",
                    "id":11,
                    "type":6,
                    "url":"http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
                },
                {
                    "createTime":"",
                    "name":"标题标题打发打发分",
                    "description":"",
                    "updateTime":"",
                    "id":12,
                    "type":6,
                    "url":"http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
                },
                {
                    "createTime":"",
                    "name":"标题标题打发打发分",
                    "description":"",
                    "updateTime":"",
                    "id":13,
                    "type":6,
                    "url":"http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
                },
                {
                    "createTime":"",
                    "name":"标题标题打发打发分",
                    "description":"",
                    "updateTime":"",
                    "id":14,
                    "type":6,
                    "url":"http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
                },
                {
                    "createTime":"",
                    "name":"标题标题打发打发分",
                    "description":"",
                    "updateTime":"",
                    "id":15,
                    "type":6,
                    "url":"http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
                },
                {
                    "createTime":"",
                    "name":"标题标题打发打发分",
                    "description":"",
                    "updateTime":"",
                    "id":16,
                    "type":6,
                    "url":"http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
                },
                {
                    "createTime":"",
                    "name":"标题标题打发打发分",
                    "description":"",
                    "updateTime":"",
                    "id":17,
                    "type":6,
                    "url":"http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
                },
                {
                    "createTime":"",
                    "name":"标题标题打发打发分",
                    "description":"",
                    "updateTime":"",
                    "id":18,
                    "type":6,
                    "url":"http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
                },
                {
                    "createTime":"",
                    "name":"标题标题打发打发分",
                    "description":"",
                    "updateTime":"",
                    "id":19,
                    "type":6,
                    "url":"http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
                },
                {
                    "createTime":"",
                    "name":"标题标题打发打发分",
                    "description":"",
                    "updateTime":"",
                    "id":12,
                    "type":6,
                    "url":"http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
                },
                {
                    "createTime":"",
                    "name":"标题标题打发打发分",
                    "description":"",
                    "updateTime":"",
                    "id":22,
                    "type":6,
                    "url":"http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
                }
            ],
            "orderField":"",
            "totalCount":0,
            "orderDesc":false
        },
        {
            "title":"花束系列",
            "pageNumber":1,
            "visitCount":0,
            "dateRange":null,
            "totalPage":0,
            "pageSize":10,
            "keyword":"",
            "list":[
                {
                    "createTime":"2018-11-29 00:00",
                    "name":"222222222",
                    "description":"dddddddddddsa",
                    "updateTime":"2018-11-16 00:00",
                    "id":1,
                    "type":1,
                    "url":"http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
                },
                {
                    "createTime":"2018-11-06 00:00",
                    "name":"aasd",
                    "description":"dfds",
                    "updateTime":"",
                    "id":2,
                    "type":1,
                    "url":"http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
                }
            ],
            "orderField":"",
            "totalCount":0,
            "orderDesc":false
        },
        {
            "title":"商业用花",
            "pageNumber":1,
            "visitCount":0,
            "dateRange":null,
            "totalPage":0,
            "pageSize":10,
            "keyword":"",
            "list":[
                {
                    "createTime":"",
                    "name":"",
                    "description":"",
                    "updateTime":"",
                    "id":10,
                    "type":5,
                    "url":"http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
                },
                {
                    "createTime":"",
                    "name":"",
                    "description":"",
                    "updateTime":"",
                    "id":13,
                    "type":5,
                    "url":"http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
                }
            ],
            "orderField":"",
            "totalCount":0,
            "orderDesc":false
        },
        {
            "title":"艺术插花",
            "pageNumber":1,
            "visitCount":0,
            "dateRange":null,
            "totalPage":0,
            "pageSize":10,
            "keyword":"",
            "list":[

            ],
            "orderField":"",
            "totalCount":0,
            "orderDesc":false
        },
        {
            "title":"花盒",
            "pageNumber":1,
            "visitCount":0,
            "dateRange":null,
            "totalPage":0,
            "pageSize":10,
            "keyword":"",
            "list":[
                {
                    "createTime":"",
                    "name":"",
                    "description":"",
                    "updateTime":"",
                    "id":8,
                    "type":4,
                    "url":"http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
                },
                {
                    "createTime":"",
                    "name":"",
                    "description":"",
                    "updateTime":"",
                    "id":9,
                    "type":4,
                    "url":"http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
                },
                {
                    "createTime":"",
                    "name":"",
                    "description":"",
                    "updateTime":"",
                    "id":14,
                    "type":4,
                    "url":"http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
                }
            ],
            "orderField":"",
            "totalCount":0,
            "orderDesc":false
        },
        {
            "title":"手工课",
            "pageNumber":1,
            "visitCount":0,
            "dateRange":null,
            "totalPage":0,
            "pageSize":10,
            "keyword":"",
            "list":[
                {
                    "createTime":"",
                    "name":"",
                    "description":"",
                    "updateTime":"",
                    "id":6,
                    "type":3,
                    "url":"http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
                },
                {
                    "createTime":"",
                    "name":"",
                    "description":"",
                    "updateTime":"",
                    "id":7,
                    "type":3,
                    "url":"http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
                },
                {
                    "createTime":"",
                    "name":"",
                    "description":"",
                    "updateTime":"",
                    "id":12,
                    "type":3,
                    "url":"http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
                }
            ],
            "orderField":"",
            "totalCount":0,
            "orderDesc":false
        },
        {
            "title":"微景观",
            "pageNumber":1,
            "visitCount":0,
            "dateRange":null,
            "totalPage":0,
            "pageSize":10,
            "keyword":"",
            "list":[
                {
                    "createTime":"2018-11-16 00:00",
                    "name":"",
                    "description":"",
                    "updateTime":"",
                    "id":3,
                    "type":2,
                    "url":"http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
                },
                {
                    "createTime":"",
                    "name":"",
                    "description":"",
                    "updateTime":"",
                    "id":4,
                    "type":2,
                    "url":"http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
                },
                {
                    "createTime":"",
                    "name":"",
                    "description":"",
                    "updateTime":"",
                    "id":5,
                    "type":2,
                    "url":"http://www.bjhypx.com/imageRepository/ffa094d4-25d4-4675-b097-1ab44dc23a15.jpg"
                }
            ],
            "orderField":"",
            "totalCount":0,
            "orderDesc":false
        }
    ]
}';die;
    }



}

?>