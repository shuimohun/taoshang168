<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Operation_AdvsTypeModel extends Operation_AdvsType
{

    /**
     * 读取分页列表
     *
     * @param  int $type_id 主键值
     * @return array $rows 返回的查询内容
     * @access public
     */
    public function getTypeBrandList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
    {
        return $this->listByWhere($cond_row, $order_row, $page, $rows);
    }

    public function getBrandType($cond_row = array(), $order_row = array())
    {
        $brand = $this->getByWhere($cond_row);

        if (!$brand)
        {
            return array();
        }

        $type_id = array_column($brand, 'type_id');

        /*$Goods_TypeModel = new Goods_TypeModel();
        $type_cond_row['type_id:IN'] = $type_id;
        $type_row = $Goods_TypeModel->getByWhere($type_cond_row);

        if(!$type_row)
        {
            return array();
        }*/

        $Goods_CatModel             = new Goods_CatModel();
        $cat_cond_row['type_id:IN'] = $type_id;
        $cat_row                    = $Goods_CatModel->getByWhere($cat_cond_row);
        if (!$cat_row)
        {
            return array();
        }

        return $cat_row;
    }

    public function getName($id = null)
    {

        if(is_array($id))
        {
            $data = array();
            foreach($id as $key => $value)
            {
                $sql = "select name from YLB_advs where id=$value";

                $data[] = $this->sql->getRow($sql);
            }

            return $data;
        }
        else
        {
            //获取group_id
            $sql = "select group_id from YLB_advs_con ";

            $data = $this->sql->getAll($sql);

            //设置一个空数组存储name的值
            $id = array();
            //设置一个空数组存储name的值
            $arr = array();
            if(!empty($data))
            {
                //循环遍历取name
                foreach($data as $key => $value)
                {
                    $id[] = $value['group_id'];
                }

                if(!empty($id))
                {
                    foreach($id as $key => $value)
                    {
                        //拼接select语句
                        $sql = "select name from YLB_advs where id = ".$value;
                        //查询一行数据拼接
                        $content=$this->sql->getAll($sql);
                        //遍历$content
                        foreach($content as $keys => $values)
                        {
                            $arr[] = $values;
                        }
                    }

                    return $arr;
                }
            }
            else
            {
                return '条件错误';
            }
        }

    }

    public function getTypeList()
    {
      $data = array_merge($this->getByWhere(array(),array('id'=>'DESC')));
      return $data;
    }

    public function getBaseList()
    {
        $sql  = 'select * from YLB_shop_base';

        $data = $this->sql->getAll($sql);

        return $data;
    }

    public function selectGid($id)
    {
        $sql = "select * from YLB_shop_base where shop_id=$id";

        $data = $this->sql->getAll($sql);

       if($data)
       {
           return $data;
       }else
       {
           return;
       }
    }

    public function selectSid($id)
    {
        $sql = "select * from YLB_advs where id=$id";

        $data = $this->sql->getAll($sql);

        if($data)
        {
            return $data;
        }else{
            retrun ;
        }
    }

    //通用方法根据主键id查询后面广告位内容
    public function mainChild($id)
    {
        if(is_int($id))
        {
            $sql = "select * from YLB_advs where id = $id";
            $fcont = $this->sql->getRow($sql);
            if(empty($fcont))
            {
                return false;
            }
            else
            {
                $sql = "select * from YLB_advs_con where group_id = $id";
                $data = $this->sql->getAll($sql);
                return $data;
            }
        }
        else
        {
            return false;
        }
    }

}

?>