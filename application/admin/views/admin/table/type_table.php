<div class="row-fluid">
    <div class="box span12">
        <div class="box-header" data-original-title="">
            <h2><i class="icon-user"></i><span class="break"></span>Types Table</h2>
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
                    <th>Type</th>
                    <th>Unit price</th>
                    <th>Bedroom</th>
                    <th>Bed</th>
                    <th>Toilet</th>
                    <th>Num people</th>
                    <th>Pic_1</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if(isset($types)):foreach ($types as $type):?>
                    <tr>
                        <td><?php echo $type->id;?></td>
                        <td class="center"><?php echo $type->type;?></td>
                        <td class="center"><?php echo $type->unit_price;?></td>
                        <td class="center"><?php echo $type->bedroom;?>
                        <td class="center"><?php echo $type->bed;?>
                        <td class="center"><?php echo $type->toilet;?>
                        <td class="center"><?php echo $type->num_people;?>
                        <td class="center"><?php echo $type->pic_1;?>


                        <td class="center">
                            <a class="btn btn-info" href="<?php echo site_url('Type/create').'/'.$type->id;?>">
                                <i class="icon-edit "></i>
                            </a>
                            <a class="btn btn-danger" href="javascript:void(0);" onclick="Delete(this,<?php echo $type->id;?>)">
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

    function Delete(obj, Id){
        var thisObj = $(obj);
        var typeItem = thisObj.parent().parent();

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Type/delete'); ?>",
            data: {'Id': Id},
            dataType: "JSON",
            timeout: 3000
        }).done(function(retData){
            if(0 === retData.errorCode){
                typeItem.fadeOut("fast", function(){
                    $(this).remove();
                });
            }
        })

    }
</script>