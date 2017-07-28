<?php if (!defined('THINK_PATH')) exit();?><script src="./Public/js/jquery.min.js"></script>
<script>
    $(document).ready(function(){

    });
</script>
789
<?php echo ($test); ?>
<br>
<?php if(is_array($test_array)): foreach($test_array as $k=>$value): echo ($k); ?>|<?php echo ($value); ?><br><?php endforeach; endif; ?>
<table>
    <tr><td>id<td><td>名称</td><td>pid</td><td>number</td></tr>
    <?php if(is_array($data_array)): foreach($data_array as $k=>$value): ?><tr><td><?php echo ($value['id']); ?><td><td><?php echo ($value['name']); ?></td><td><?php echo ($value['pid']); ?></td><td><?php echo ($value['number']); ?></td></tr><?php endforeach; endif; ?>
</table>
<?php echo (TEST_DEFINE); ?>
<?php echo ($_SERVER['SCRIPT_FILENAME']); ?>
<?php echo ($_GET['id']); ?>
<?php echo ((isset($_GET['id']) && ($_GET['id'] !== ""))?($_GET['id']):"名称为空"); ?>
<?php
if(0){ ?>
abc
<?php
 }else{ ?>
df
<?php
} ?>
<?php if(($test) == "22"): ?>hha<?php endif; ?>
<?php if($show_array['name'] == 'wl'): ?>ThinkPHP
    <?php else: ?> other Framework<?php endif; ?>
<?php if($show_array['number']['code'] == '2928'): ?>2928
    <?php elseif($show_array['number']['code'] == '02122928'): ?>
    show_array_value2
    <?php elseif($show_array['number']['code'] == $test): ?>
    show_array_value3
    <?php else: ?>
    not2928<?php endif; ?>
<?php switch($show_array['name']): case "wl": ?>value1<?php break;?>
    <?php case "2": ?>value2<?php break;?>
    <?php default: ?>default<?php endswitch;?>

<?php if( $show_array['number']['code'] == '2928' ) echo 'phptag' ; ?>

<?php if(in_array(($test), is_array($test_array)?$test_array:explode(',',$test_array))): ?>in在范围内<?php endif; ?>

<?php $_RANGE_VAR_=is_array($test_array)?$test_array:explode(',',$test_array);if($test>= $_RANGE_VAR_[0] && $test<= $_RANGE_VAR_[1]):?>between在范围内<?php endif; ?>
<?php  echo '{$Think.config.CUSTOM.'.$key.'}'; ?>

<img src="./Public/Img/next.jpg">