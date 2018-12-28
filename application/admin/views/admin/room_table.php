<div class="row-fluid">
    <div class="box span12">
        <div class="box-header" data-original-title="">
            <h2><i class="icon-user"></i><span class="break"></span>Rooms Table</h2>
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
                    <th>Number</th>
                    <th>State</th>
                    <th>Grade</th>
                    <th>Introduce</th>

                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if(isset($rooms)):foreach ($rooms as $room):?>
                    <tr>
                        <td><?php echo $room->number;?></td>

                        <td class="center"><?php echo $room->state;?></td>
                        <td class="center"><?php echo $room->grade;?></td>
                        <td class="center"><?php echo $room->introduce;?>

                        <td class="center">
                            <a class="btn btn-info" href="<?php echo site_url('Room/create').'/'.$room->number;?>">
                                <i class="icon-edit "></i>
                            </a>
                            <a class="btn btn-danger" href="javascript:void(0);" onclick="Delete(this,<?php echo $room->number;?>)">
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

    function roomDelete(obj, roomId){
        var thisObj = $(obj);
        var roomItem = thisObj.parent().parent();

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Room/roomDelete'); ?>",
            data: {'roomId': roomId},
            dataType: "JSON",
            timeout: 3000
        }).done(function(retData){
            if(0 === retData.errorCode){
                roomItem.fadeOut("fast", function(){
                    $(this).remove();
                });
            }
        })

    }
</script>