<?php
namespace Home\Model;
use Think\Model;
class TestModel extends Model//TOrderToday 等于t_order_today表
{
    protected $tableName        =   'test';
    protected $_validate = array(     array('verify','require','验证码必须！'),
        array('name','','帐号名称已经存在！',0,'unique',1),
        array('number',array(1,2,3),'值的范围不正确！',2,'in'),
      );

    /*
     * 插入数据库
     * $data_array['name'] = "分类6";
        $data_array['pid'] = 6;
        $data_array['number'] = 6;

        $data_array1['name'] = "分类7";
        $data_array1['pid'] = 7;
        $data_array1['number'] = 7;
        $insert_array[] = $data_array;
        $insert_array[] = $data_array1;
        $result = $test_obj->add_data($insert_array);
     */
    public function add_data($data_array){
        if(is_array($data_array)){
            foreach($data_array as $key=>$value){
                $this->add($value);
            }
        }
    }

    /*
     * 更新数据库
     *  $data_array['number'] = 2;
        $data_array['id'] = 12;
        $result = $test_obj->update_data($data_array);
     */
    public function update_data($data_array){
        $this->save($data_array);
    }

    public function delete_data($id){
        $this->where("id=$id")->delete();
    }
}
?>