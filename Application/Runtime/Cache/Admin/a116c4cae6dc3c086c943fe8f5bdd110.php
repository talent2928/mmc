<?php if (!defined('THINK_PATH')) exit();?>789
<?php echo ($test); ?>
<br>
<?php if(is_array($test_array)): foreach($test_array as $k=>$value): echo ($k); ?>|<?php echo ($value); ?><br><?php endforeach; endif; ?>

{/foreach}