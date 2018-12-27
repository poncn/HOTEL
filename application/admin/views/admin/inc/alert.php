<div class="box-content alerts" >
    <?php
    switch (isset($alert['errorCode']) ?  $alert['errorCode'] : ''):
        case '0': ?>
            <div class="alert alert-error">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Oh snap!</strong>&nbsp;&nbsp;&nbsp;<?php echo $alert['message'] ?>
            </div>
            <?php break;
        case '1': ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Well done!</strong>&nbsp;&nbsp;&nbsp;<?php echo $alert['message'] ?>
            </div>
            <?php break;
        default:
            break;
    endswitch; ?>
</div>