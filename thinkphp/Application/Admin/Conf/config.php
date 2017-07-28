<?php
return ENV=='online'
    ?
    array('LOAD_EXT_CONFIG' => 'configOnline')
    :
    array('LOAD_EXT_CONFIG' => 'configDev')
    ;