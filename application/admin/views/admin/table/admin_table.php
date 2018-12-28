<div class="row-fluid">
    <div class="box span12">
        <div class="box-header" data-original-title="">
            <h2><i class="icon-user"></i><span class="break"></span>Admin Table</h2>
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
                    <th>Head Portrait</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($admins as $v):?>
                <tr>
                    <td><?php echo $v->id;?></td>
                    <td class="center"><?php echo $v->username;?></td>
                    <td class="center"><?php echo $v->password;?></td>
                    <td class="center"><?php echo $v->head_portrait;?></td>
                    <td class="center">
                        <a class="btn btn-info" href="<?php echo site_url('Admin/create').'/'.$v->id;?>">
                            <i class="icon-edit "></i>
                        </a>
                        <a class="btn btn-danger" href="javascript:void(0);" onclick="Delete(this,<?php echo $v->id;?>)">
                            <i class="icon-trash "></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div><!--/span-->
</div><!--/row-->

<script type="text/javascript" charset="utf-8">
    function Delete(obj, Id){
        var thisObj = $(obj);
        var Item = thisObj.parent().parent();

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Admin/delete'); ?>",
            data: {'Id': Id},
            dataType: "JSON",
            timeout: 3000
        }).done(function(retData){
            if(0 === retData.errorCode){
                Item.fadeOut("fast", function(){
                    $(this).remove();
                });
            }
        })
    }
</script>