<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class UploadCtl extends YLB_AppController
{
	public $uploadModel = null;
	public $config      = null;
	
	/**
	 * Constructor 用户上传目录 user_id/shop_id/
	 *
	 * @param  string $ctl 控制器目录
	 * @param  string $met 控制器方法
	 * @param  string $typ 返回数据类型
	 * @access public
	 */
	public function __construct(&$ctl, $met, $typ)
	{
		if (request_string('action'))
		{
			$met = request_string('action');
		}

		parent::__construct($ctl, $met, $typ);

		if (!request_string('plantform') && Perm::$login && Perm::$shopId)
		{
			if (Perm::$shopId && Perm::$userId)
			{
				$dir_path = sprintf('/media/%s/%d/%d', YLB_Registry::get('server_id'), Perm::$userId, Perm::$shopId);
			}
			else
			{
				$dir_path = sprintf('/media/%s/%d', YLB_Registry::get('server_id'), Perm::$userId);
			}
		}
		else
		{
			$dir_path = '/media/plantform/' . YLB_Registry::get('server_id');
		}

		$Web_ConfigModel    = new Web_ConfigModel();
		$image_allow_ext    = $Web_ConfigModel->getConfigValue('image_allow_ext');
		$image_max_filesize = $Web_ConfigModel->getConfigValue('image_max_filesize') * 1024;

		$url_prefix = YLB_Registry::get('base_url') . '/' . APP_DIR_NAME . '/data/upload';
		$url_prefix = '';

		/* 上传图片配置项 */
		$this->config = array(
			/* 执行上传图片的action名称 */
			'imageActionName' => 'uploadImage',
			/* 提交的图片表单名称 */
			'imageFieldName' => 'upfile',
			/* 上传大小限制，单位B */
			'imageMaxSize' => $image_max_filesize,
			/* 上传图片格式显示 */
			'imageAllowFiles' => array(
				'.png',
				'.jpg',
				'.jpeg',
				'.gif',
				'.bmp',
			),
			/* 是否压缩图片,默认是true */
			'imageCompressEnable' => true,
			/* 图片压缩最长边限制 */
			'imageCompressBorder' => 1920,
			/* 插入的图片浮动方式 */
			'imageInsertAlign' => 'none',
			/* 图片访问路径前缀 */
			'imageUrlPrefix' => $url_prefix,
			/* 上传保存路径,可以自定义保存路径和文件名格式 */
			/* {filename} 会替换成原文件名,配置这项需要注意中文乱码问题 */
			/* {rand:6} 会替换成随机数,后面的数字是随机数的位数 */
			/* {time} 会替换成时间戳 */
			/* {yyyy} 会替换成四位年份 */
			/* {yy} 会替换成两位年份 */
			/* {mm} 会替换成两位月份 */
			/* {dd} 会替换成两位日期 */
			/* {hh} 会替换成两位小时 */
			/* {ii} 会替换成两位分钟 */
			/* {ss} 会替换成两位秒 */
			/* 非法字符 \ : * ? " < > | */
			/* 具请体看线上文档: fex.baidu.com/ueditor/#use-format_upload_filename */

			'imagePathFormat' => $dir_path . '/image/{yyyy}{mm}{dd}/{time}{rand:6}',

			/* 涂鸦图片上传配置项 */
			'scrawlActionName' => 'uploadScrawl',
			'scrawlFieldName' => 'upfile',
			'scrawlPathFormat' => $dir_path . '/image/{yyyy}{mm}{dd}/{time}{rand:6}',
			'scrawlMaxSize' => 2048000,
			'scrawlUrlPrefix' => $url_prefix,
			'scrawlInsertAlign' => 'none',
			'snapscreenActionName' => 'uploadImage',
			'snapscreenPathFormat' => $dir_path . '/image/{yyyy}{mm}{dd}/{time}{rand:6}',
			'snapscreenUrlPrefix' => $url_prefix,
			'snapscreenInsertAlign' => 'none',
			'catcherLocalDomain' => array(
				'127.0.0.1',
				'localhost',
				'img.baidu.com',
			),
			'catcherActionName' => 'catchImage',
			'catcherFieldName' => 'source',
			'catcherPathFormat' => $dir_path . '/image/{yyyy}{mm}{dd}/{time}{rand:6}',
			'catcherUrlPrefix' => $url_prefix,
			'catcherMaxSize' => 2048000,
			'catcherAllowFiles' => array(
				'.png',
				'.jpg',
				'.jpeg',
				'.gif',
				'.bmp',
			),
			'videoActionName' => 'uploadVideo',
			'videoFieldName' => 'upfile',
			'videoPathFormat' => $dir_path . '/video/{yyyy}{mm}{dd}/{time}{rand:6}',
			'videoUrlPrefix' => $url_prefix,
			'videoMaxSize' => 102400000,
			'videoAllowFiles' => array(
				'.flv',
				'.swf',
				'.mkv',
				'.avi',
				'.rm',
				'.rmvb',
				'.mpeg',
				'.mpg',
				'.ogg',
				'.ogv',
				'.mov',
				'.wmv',
				'.mp4',
				'.webm',
				'.mp3',
				'.wav',
				'.mid',
			),
			'fileActionName' => 'uploadFile',
			'fileFieldName' => 'upfile',
			'filePathFormat' => $dir_path . '/file/{yyyy}{mm}{dd}/{time}{rand:6}',
			'fileUrlPrefix' => $url_prefix,
			'fileMaxSize' => 51200000,
			'fileAllowFiles' => array(
				'.png',
				'.jpg',
				'.jpeg',
				'.gif',
				'.bmp',
				'.flv',
				'.swf',
				'.mkv',
				'.avi',
				'.rm',
				'.rmvb',
				'.mpeg',
				'.mpg',
				'.ogg',
				'.ogv',
				'.mov',
				'.wmv',
				'.mp4',
				'.webm',
				'.mp3',
				'.wav',
				'.mid',
				'.rar',
				'.zip',
				'.tar',
				'.gz',
				'.7z',
				'.bz2',
				'.cab',
				'.iso',
				'.doc',
				'.docx',
				'.xls',
				'.xlsx',
				'.ppt',
				'.pptx',
				'.pdf',
				'.txt',
				'.md',
				'.xml',
				'.cvs',
			),
			'imageManagerActionName' => 'listImage',
			'imageManagerListPath' => $dir_path . '/image/',
			'imageManagerListSize' => 20,
			'imageManagerUrlPrefix' => $url_prefix,
			'imageManagerInsertAlign' => 'none',
			'imageManagerAllowFiles' => array(
				'.png',
				'.jpg',
				'.jpeg',
				'.gif',
				'.bmp',
			),
			'fileManagerActionName' => 'listFile',
			'fileManagerListPath' => $dir_path . '/file/',
			'fileManagerUrlPrefix' => $url_prefix,
			'fileManagerListSize' => 20,
			'fileManagerAllowFiles' => array(
				'.png',
				'.jpg',
				'.jpeg',
				'.gif',
				'.bmp',
				'.flv',
				'.swf',
				'.mkv',
				'.avi',
				'.rm',
				'.rmvb',
				'.mpeg',
				'.mpg',
				'.ogg',
				'.ogv',
				'.mov',
				'.wmv',
				'.mp4',
				'.webm',
				'.mp3',
				'.wav',
				'.mid',
				'.rar',
				'.zip',
				'.tar',
				'.gz',
				'.7z',
				'.bz2',
				'.cab',
				'.iso',
				'.doc',
				'.docx',
				'.xls',
				'.xlsx',
				'.ppt',
				'.pptx',
				'.pdf',
				'.txt',
				'.md',
				'.xml',
			),
		);

		
		//include $this->view->getView();
		$this->uploadModel = new Upload_BaseModel();
	}
	
	
	public function config()
	{
		if ($jsonp_callback = request_string('callback'))
		{
			exit($jsonp_callback . '(' . json_encode($this->config) . ')');
		}
		else
		{
			echo json_encode($this->config);
		}

		die();
	}
	
	/**
	 * 上传图片
	 *
	 * @access public
	 */
	public function uploadImage()
	{
		$config = array(
			"pathFormat" => $this->config['imagePathFormat'],
			"maxSize" => $this->config['imageMaxSize'],
			"allowFiles" => $this->config['imageAllowFiles']
		);
		
		$field_name = $this->config['imageFieldName'];
		
		$this->uploadFile($field_name, $config);
	}
	
	/**
	 * 上传涂鸦
	 *
	 * @access public
	 */
	public function uploadScrawl()
	{
		$config = array(
			"pathFormat" => $this->config['scrawlPathFormat'],
			"maxSize" => $this->config['scrawlMaxSize'],
			"allowFiles" => $this->config['scrawlAllowFiles'],
			"oriName" => "scrawl.png"
		);
		
		$field_name = $this->config['scrawlFieldName'];
		$base64     = "base64";
		
		$this->uploadFile($field_name, $config, $base64);
	}
	
	/**
	 * 上传视频
	 *
	 * @access public
	 */
	public function uploadVideo()
	{
		$config     = array(
		    "videoActionName" => $this->config['uploadVideo'],
			"pathFormat" => $this->config['videoPathFormat'],
			"maxSize" => $this->config['videoMaxSize'],
			"allowFiles" => $this->config['videoAllowFiles']
		);
		$field_name = $this->config['videoFieldName'];
		
		$this->uploadFile($field_name, $config);
	}
	
	/**
	 * 上传文件
	 *
	 * @access public
	 */
	public function uploadFile($field_name = null, $config = array(), $base64 = "upload")
	{
		if (!$field_name || !$config)
		{
			$config = array(
				"pathFormat" => $this->config['filePathFormat'],
				"maxSize" => $this->config['fileMaxSize'],
				"allowFiles" => $this->config['fileAllowFiles']
			);
			
			$field_name = $this->config['fileFieldName'];
		}
		
		/* 生成上传实例对象并完成上传 */
		$up = new YLB_Uploader($field_name, $config, $base64);
		
		$info = $up->getFileInfo();
		
		if ($info['state'] == "SUCCESS")
		{
			//判断文件类型
			if (in_array($info['type'], $this->config['imageAllowFiles']))
			{
				$file_type = 'image';

				//默认把图片添加到默认相册
				$uploadBaseModel = new Upload_BaseModel();

				$user = request_string('user');
				if ( !empty($user) && $user == 'admin' )
				{
					$shop_id = Shop_BaseModel::ADMIN_SHOP_ID;
					$user_id = Shop_BaseModel::ADMIN_USER_ID;
				}
				else
				{
					$shop_id = Perm::$shopId;
					$user_id = Perm::$userId;
				}

				$data                      = array();
				$data['upload_time']       = time();
				$data['upload_url_prefix'] = $info['url_prefix'];
				$data['upload_path']       = $info['url_path'];
				$data['upload_path']       = $info['url'];
				$data['upload_size']       = $info['size'];
				$data['upload_name']       = str_replace($info['type'], '', $info['original']);      // 附件标题
				$data['upload_type']       = $file_type;                                             // 枚举
				$data['upload_mime_type']  = $info['type'];
				$data['album_id']          = Upload_BaseModel::UPLOAD_IMAGE_UNGROUP;                  // 默认添加到未分组里
				$data['user_id']           = $user_id; // 用户id
				$data['shop_id']           = $shop_id; // 店铺id

				$uploadBaseModel->addUpload($data);
			}
			else if(in_array($info['type'], $this->config['videoAllowFiles']))
            {
                $info['url'] = str_replace('/image.php','',$info['url']);
                $info['url_prefix'] = str_replace('/image.php','',$info['url_prefix']);
            }
			else
			{
				$file_type = 'other';
			}

            $info['status'] = 1;
		}
		else
        {
            $info['status'] = 0;
            $info['msg'] = '上传失败';
        }

		/**
		 * 得到上传文件所对应的各个参数,数组结构
		 * array(
		 *     "state" => "",          //上传状态，上传成功时必须返回"SUCCESS"
		 *     "url" => "",            //返回的地址
		 *     "title" => "",          //新文件名
		 *     "original" => "",       //原始文件名
		 *     "type" => ""            //文件类型
		 *     "size" => "",           //文件大小
		 * )
		 */

		/* 返回数据 */
		echo json_encode($info);
		die();
		
	}


	/**
	 * 列出图片-目录读取
	 *
	 * @access public
	 */
	public function listImage()
	{
		$this->lists();
	}

	/**
	 * 列出文件列出图片-目录读取
	 *
	 * @access public
	 */
	public function listFile()
	{
	}

	/**
	 * 抓取远程文件
	 *
	 * @access public
	 */
	public function catchImage()
	{
		set_time_limit(0);
		
		/* 上传配置 */
		$config = array(
			"pathFormat" => $this->config['catcherPathFormat'],
			"maxSize" => $this->config['catcherMaxSize'],
			"allowFiles" => $this->config['catcherAllowFiles'],
			"oriName" => "remote.png"
		);

		$field_name = $this->config['catcherFieldName'];
		
		/* 抓取远程图片 */
		$list = array();
		if (isset($_POST[$field_name]))
		{
			$source = $_POST[$field_name];
		}
		else
		{
			$source = $_GET[$field_name];
		}
		foreach ($source as $img_url)
		{
			$item = new YLB_Uploader($img_url, $config, "remote");
			$info = $item->getFileInfo();
			array_push($list, array(
				"state" => $info["state"],
				'upload_url_prefix' => $info['url_prefix'],
				'upload_path' => $info['url_path'],
				"url" => $info["url"],
				"size" => $info["size"],
				"title" => htmlspecialchars($info["title"]),
				//"original" => htmlspecialchars($info["original"]),
				"source" => htmlspecialchars($img_url)
			));
			
			if ($info['state'] == "SUCCESS")
			{
			}
		}
		
		/* 返回抓取数据 */
		echo json_encode(array(
							 'state' => count($list) ? 'SUCCESS' : 'ERROR',
							 'list' => $list
						 ));
	}

	public function image()
	{
		include $this->view->getView();
	}

	public function cropperImage()
	{
		include $this->view->getView();
	}

	/**
	 * 列表数据
	 *
	 * @access public
	 */
	public function lists()
	{
		$user_id = Perm::$userId;

		$page = request_int('page');
		$rows = request_int('rows');
		$user = request_string('user');

		$cond_row  = array();
		$order_row = array();

		$data = array();

		if ( !empty($user) && $user == 'admin' )
		{
			$cond_row['shop_id'] = Shop_BaseModel::ADMIN_SHOP_ID;
		}
		else
		{
			$cond_row['shop_id'] = Perm::$shopId;
		}


		$param = request_row('param');
		if (!empty($param['album_id']))
		{
			$cond_row['album_id'] = $param['album_id'];
		}
		else
		{
			$cond_row['album_id'] = 0;
		}

		$data = $this->uploadModel->getUploadList($cond_row, $order_row, $page, $rows);

		//分页
		$YLB_Page = new YLB_Page();
		$rows    = $YLB_Page->listRows = 15;
		$YLB_Page->totalRows = $data['totalsize'];
		$page_nav           = $YLB_Page->prompt();
		$data['page_nav']   = $page_nav;

		$this->data->addBody(-140, $data, 'success', 200);
	}

	public function uploadGoodsExcel()
	{
		$config = array(
			"pathFormat" => $this->config['filePathFormat'],
			"maxSize" => $this->config['fileMaxSize'],
			"allowFiles" => array(".xls", ".xlsx", ".csv")
		);

		$field_name = $this->config['imageFieldName'];

		$up = new YLB_Uploader($field_name, $config, "upload");

		$info = $up->getFileInfo();
		
		$this->data->addBody(-140, $info, 'success', 200);
	}

	/**
	 * catch image by excel
	 * @param $image_url
	 * @return array
	 */
	public static function catchImageByExcel( $image_url )
	{
		set_time_limit(0);

		/* 上传配置 */
		$dir_path = sprintf('/media/%s/%d/%d', YLB_Registry::get('server_id'), Perm::$userId, Perm::$shopId);

		$config = array(
			"pathFormat" => $dir_path . '/image/{yyyy}{mm}{dd}/{time}{rand:6}',
			"maxSize" => 2048000,
			"allowFiles" => array(
				'.png',
				'.jpg',
				'.jpeg',
				'.gif',
				'.bmp',
			),
			"oriName" => "remote.png"
		);
		
		$item = new YLB_Uploader($image_url, $config, "remote");
		$info = $item->getFileInfo();

		return $info;
	}

	//淘宝导入 上传主图
	public function uploadTaoBaoImage ()
	{

		$config = array(
			"pathFormat" => $this->config['filePathFormat'],
			"maxSize" => $this->config['fileMaxSize'],
            "allowFiles" => array(".tbi",".jpg",".png",".gif")
		);

		$field_name = $this->config['fileFieldName'];


		/* 生成上传实例对象并完成上传 */
		$up = new YLB_Uploader($field_name, $config, "upload");

		$result_info = $up->getFileInfo();

		if ( $result_info['state'] == "SUCCESS" )
		{
			$original = explode(".", $result_info["original"]);
			array_pop($original);
			$original = implode("", $original);
			$image_url = $result_info['url'];

			$shop_id = Perm::$shopId;
			//替换common
			$goodsCommonModel = new Goods_CommonModel();
			$goods_common_data = $goodsCommonModel->getByWhere( array("common_image" => $original,"shop_id"=>$shop_id,"common_state"=>Goods_CommonModel::GOODS_STATE_OFFLINE) );
			if ($goods_common_data)
			{
			    //此方法只修改一个
				$goods_common_data = current($goods_common_data);
				$common_id = $goods_common_data['common_id'];
                //取出所有与图片名称匹配的
                //$common_id = array_column($goods_common_data,'common_id');
				$goodsCommonModel->editCommon($common_id, array("common_image" => $image_url));
			}
            //替换goods_images
			$goodsImagesModel = new Goods_ImagesModel();
			$goods_image_data = $goodsImagesModel->getByWhere( array("images_image" => $original,"shop_id"=>$shop_id));
			if ($goods_image_data)
			{
			    //此方法只修改一个
				$goods_image_data = current($goods_image_data);
				$images_id = $goods_image_data['images_id'];

				//取出所有与图片名称匹配的
                //$images_id = array_column($goods_image_data,'images_id');

				$goodsImagesModel->editImages( $images_id, array("images_image" => $image_url) );
			}
            //替换goods_base
			$goodsBaseModel = new Goods_BaseModel();
			$goods_data = $goodsBaseModel->getByWhere( array("goods_image" => $original,"shop_id"=>$shop_id) );
			if ($goods_data)
			{
                //此方法只修改一个
				$goods_data = current($goods_data);
				$goods_id = $goods_data['goods_id'];
                //$goods_id = array_column($goods_data,'goods_id');

				$update_goods_data['goods_image'] = $image_url;
				$goodsBaseModel->editBase($goods_id, $update_goods_data, false);
			}



            //判断文件类型
            if (in_array($result_info['type'], $this->config['imageAllowFiles']))
            {
                $file_type = 'image';
            }
            else
            {
                $file_type = 'other';
            }

            $user = request_string('user');
            if ( !empty($user) && $user == 'admin' )
            {
                $shop_id = Shop_BaseModel::ADMIN_SHOP_ID;
                $user_id = Shop_BaseModel::ADMIN_USER_ID;
            }
            else
            {
                $shop_id =Perm::$shopId;
                $user_id = Perm::$userId;
            }

            $data                      = array();
            $data['upload_time']       = get_date_time();
            $data['upload_url_prefix'] = $result_info['url_prefix'];
            $data['upload_path']       = $result_info['url_path'];
            $data['upload_path']       = $result_info['url'];
            $data['upload_size']       = $result_info['size'];
            $data['upload_name']       = str_replace($result_info['type'], '', $result_info['original']);      // 附件标题
            //$data['upload_original'] = str_replace($result_info['type'], '', $result_info['title']);;    // 原附件
            $data['upload_type']      = $file_type;                                             // 枚举
            $data['upload_mime_type'] = $result_info['type'];
            $data['album_id']         = request_int('album_id') ? request_int('album_id') : '0';  // 默认添加到未分组里

            $data['user_id'] = $user_id; // 用户id
            $data['shop_id'] = $shop_id; // 店铺id

            $upload_id = $this->uploadModel->addUpload($data, true);

		}

		$this->data->addBody(-140, $result_info, "success", 200);
	}

    //淘宝导入 上传详情图
    public function uploadTaoBaoImageDetail ()
    {
        $config = array(
            "pathFormat" => $this->config['filePathFormat'],
            "maxSize" => $this->config['fileMaxSize'],
            "allowFiles" => array(".tbi",".jpg",".png",".gif")
        );

        $field_name = $this->config['fileFieldName'];


        /* 生成上传实例对象并完成上传 */
        $up = new YLB_Uploader($field_name, $config, "upload");

        $result_info = $up->getFileInfo();
        $uploadAlbumModel = new Upload_AlbumModel();

        if ( $result_info['state'] == "SUCCESS" )
        {
            $data                      = array();
            $data['upload_time']       = get_date_time();
            $data['upload_url_prefix'] = $result_info['url_prefix'];
            $data['upload_path']       = $result_info['url_path'];
            $data['upload_path']       = $result_info['url'];
            $data['upload_size']       = $result_info['size'];
            $data['upload_name']       = str_replace($result_info['type'], '', $result_info['original']);      // 附件标题
            //$data['upload_original'] = str_replace($result_info['type'], '', $result_info['title']);;    // 原附件
            $data['upload_type']      = 'image';                                             // 枚举
            $data['upload_mime_type'] = $result_info['type'];
            //$data['album_id']         = request_int('album_id') ? request_int('album_id') : '0';  // 默认添加到未分组里
            $data['album_id'] = 1;
            $shop_id = Perm::$shopId;
            $data['user_id'] = Perm::$userId; // 用户id
            $data['shop_id'] = $shop_id; // 店铺id


            $cond_row_ua['album_desc'] = explode('-', $data['upload_name'])[0];
            $cond_row_ua['shop_id'] = $shop_id;
            $upload_album = $uploadAlbumModel->getOneByWhere($cond_row_ua);

            if($upload_album)
            {
                $data['album_id'] = $upload_album['album_id'];
            }
            else
            {
                $ab_data['album_desc'] = $cond_row_ua['album_desc'];
                $ab_data['album_type'] = 'image';
                $ab_data['shop_id']    = $shop_id;

                $data['album_id'] = $uploadAlbumModel->addAlbum($ab_data, true);
            }


            $upload_id = $this->uploadModel->addUpload($data, true);

        }

        $this->data->addBody(-140, $result_info, "success", 200);
    }

    function replace($string,$keyArray,$replacement,$i)
    {
        $result='';
        if($i<(count($keyArray)))
        {
            $strSegArray=explode($keyArray[$i],$string);
            foreach ($strSegArray as $index=>$strSeg)
            {
                $x=$i+1;
                if($index==(count($strSegArray)-1))
                    $result=$result.replace($strSeg,$keyArray,$replacement,$x);
                else
                    $result=$result.replace($strSeg,$keyArray,$replacement,$x).$replacement[$i];
            }
            return $result;
        }
        else
        {
            return $string;
        }
    }

    /*$string=' 键名 数组可以同时含有 integer 和 string 类型的键名，12345678 因为 PHP 实际并不区分索引数组和关联数组。
    如果对给出的值没有指定键名，则取当前最大的整数索引值，而新的键名将是该值加一。如果指定的键名已经有了值，则该值会被覆盖。';

    $keyArray=array('数组','integer','2345','键名');
    $replacement=array('AAAA','BBBB','CCCC','DDDD');

    echo replace($string,$keyArray,$replacement,0);*/

    public function getAlbumList()
    {
        $UploadAlbumModel = new Upload_AlbumModel();

        $YLB_Page = new YLB_Page();
        $rows     = $YLB_Page->listRows = 50;
        $offset  = request_int('firstRow', 0);
        $page    = ceil_r($offset / $rows);

        $condi['shop_id'] = Perm::$shopId;
        $data             = $UploadAlbumModel->getAlbumList($condi,array('album_id'=>'desc'),$page,$rows);

        if ($data)
        {
            $msg    = 'success';
            $status = 200;

            if($page == 1)
            {
                //默认分组 未分组
                $default_album['album_desc']       = '未分组';
                $default_album['album_id']         = 0;
                $default_album['album_is_default'] = 1;
                $default_album['album_type']       = 'image';

                array_unshift($data['items'], $default_album);
            }

            //取出相册图片数量
            $album_ids            = array_column($data['items'], 'album_id');
            $condi['album_id:IN'] = $album_ids;
            if(request_string('recycle') == 1)
            {
                $condi['is_recycle'] = Upload_BaseModel::RECYCLE;
            }
            else
            {
                $condi['is_recycle'] = Upload_BaseModel::NORECYCLE;
            }
            $images               = $this->uploadModel->getByWhere($condi);

            if (empty($images))
            {
                foreach ($data['items'] as $key => $val)
                {
                    $data['items'][$key]['image_num'] = 0;
                }
            }
            else
            {
                foreach ($data['items'] as $key => $val)
                {
                    $image_num = 0;

                    foreach ($images as $k => $v)
                    {
                        if ($val['album_id'] == $v['album_id'])
                        {
                            $image_num += 1;
                            unset($images[$k]);
                        }
                    }
                    if ($image_num == 0)
                    {
                        $data['items'][$key]['image_num'] = 0;
                    }
                    else
                    {
                        $data['items'][$key]['image_num'] = $image_num;
                    }
                }
            }

            $YLB_Page->totalRows = $data['totalsize'];
            $page_nav           = $YLB_Page->prompt();
            $data['page_nav']   = $page_nav;
        }
        else
        {
            $msg    = 'failure';
            $status = 250;
        }

        $this->data->addBody(-140, $data, $msg, $status);
    }
}

?>