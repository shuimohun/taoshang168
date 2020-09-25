<?php
if(!defined('ROOT_PATH'))
{
    exit('No Permission ');
}

class Activity_TempBaseModel extends Activity_TempBase
{
    public  $temp_color = array(
        "red" => array("红色","#fe0071"),
        "skyblue" => array("天蓝","#13eaf4"),
        "green" => array("绿色","#00a895"),
        "gray" => array("蓝色","#c98787"),
        "blue" => array("褐色","#0094ff"),
        "paleblue" => array("黑色","#01b4df"),
        "orange"  => array("橘色","#ff8d00"),
        "lightpink" => array("浅粉","#ff2353"),
        "violet"=> array("紫色","#4e0197")
    );
    public function getTempBaseList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
    {
        return $this->listByWhere($cond_row, $order_row, $page, $rows);
    }

    //查询全部模板，以及颜色
    public function TempColor($id = null)
    {
        $data['color']      = $this->temp_color;
        $TempModel          = new Activity_TempModel();
        if($id){
            $data['layout']     = $TempModel->getByWhere(array('temp_id'=>$id));
        }else{
            $data['layout']     = $TempModel->getByWhere();
        }

        return $data;
    }

}