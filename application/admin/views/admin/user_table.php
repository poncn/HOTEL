<div class="row-fluid">
    <div class="box span12">
        <div class="box-header" data-original-title="">
            <h2><i class="icon-user"></i><span class="break"></span>Users Table</h2>
            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="icon-wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Identity card</th>
                    <th>Phone</th>
                    <th>Head portrait</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if(isset($users)):foreach ($users as $user):?>
                    <tr>
                        <td><?php echo $user->id;?></td>
                        <td class="center"><?php echo $user->username;?></td>
                        <td class="center"><?php echo $user->password;?></td>
                        <td class="center"><?php echo $user->identity_card;?></td>
                        <td class="center"><?php echo $user->phone;?></td>
                        <td class="center"><?php echo $user->head_portrait;?>
                        <td class="center">
                            <a class="btn btn-info" href="<?php echo site_url('User/userData').'/'.$user->id;?>">
                                <i class="icon-edit "></i>
                            </a>
                            <a class="btn btn-danger" href="javascript:void(0);" onclick="userDelete(this,<?php echo $user->id;?>)">
                                <i class="icon-trash "></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach;endif;?>
                </tbody>
            </table>
        </div>
    </div><!--/span-->

</div><!--/row-->

<script type="text/javascript" charset="utf-8">

    function userDelete(obj, userId){
        var thisObj = $(obj);
        var userItem = thisObj.parent().parent();

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('User/userDelete'); ?>",
            data: {'userId': userId},
            dataType: "JSON",
            timeout: 3000
        }).done(function(retData){
            if(0 === retData.errorCode){
                userItem.fadeOut("fast", function(){
                    $(this).remove();
                });
            }
        })

    }
</script>