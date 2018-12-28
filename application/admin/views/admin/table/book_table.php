<div class="row-fluid">
    <div class="box span12">
        <div class="box-header" data-original-title="">
            <h2><i class="icon-user"></i><span class="break"></span>Books Table</h2>
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
                    <th>Day</th>
                    <th>Total money</th>
                    <th>Check in time</th>
                    <th>Check out time</th>
                    <th>Start time</th>
                    <th>End time</th>

                    <th>Actions</th>

                </tr>
                </thead>
                <tbody>
                <?php if(isset($books)):foreach ($books as $book):?>
                    <tr>
                        <td><?php echo $book->id;?></td>
                        <td class="center"><?php echo $book->day;?></td>
                        <td class="center"><?php echo $book->total_money;?></td>
                        <td class="center"><?php echo $book->check_in_time;?>
                        <td class="center"><?php echo $book->check_out_time;?>
                        <td class="center"><?php echo $book->start_time;?>
                        <td class="center"><?php echo $book->end_time;?>

                        <td class="center">
                            <a class="btn btn-info" href="<?php echo site_url('Book/create').'/'.$book->id;?>">
                                <i class="icon-edit "></i>
                            </a>
                            <a class="btn btn-danger" href="javascript:void(0);" onclick="Delete(this,<?php echo $book->id;?>)">
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
        var bookItem = thisObj.parent().parent();

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Book/delete'); ?>",
            data: {'Id': Id},
            dataType: "JSON",
            timeout: 3000
        }).done(function(retData){
            if(0 === retData.errorCode){
                bookItem.fadeOut("fast", function(){
                    $(this).remove();
                });
            }
        })

    }
</script>