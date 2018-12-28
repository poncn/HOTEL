<div class="row-fluid">
    <div class="box span12">
        <div class="box-header" data-original-title="">
            <h2><i class="icon-user"></i><span class="break"></span>Comments Table</h2>
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
                    <th>Content</th>
                    <th>Positive</th>
                    <th>Negative</th>
                    <th>Username</th>
                    <th>Room_number</th>
                    <th>Time</th>

                    <th>Actions</th>

                </tr>
                </thead>
                <tbody>
                <?php if(isset($comments)):foreach ($comments as $comment):?>
                    <tr>
                        <td><?php echo $comment->id;?></td>
                        <td class="center"><?php echo $comment->content;?></td>
                        <td class="center"><?php echo $comment->positive;?></td>
                        <td class="center"><?php echo $comment->negative;?>
                        <td class="center"><?php echo $comment->username;?>
                        <td class="center"><?php echo $comment->room_number;?>
                        <td class="center"><?php echo $comment->time;?>
                        <td class="center">
                            <a class="btn btn-info" href="<?php echo site_url('Comment/commentData').'/'.$comment->id;?>">
                                <i class="icon-edit "></i>
                            </a>
                            <a class="btn btn-danger" href="javascript:void(0);" onclick="commentDelete(this,<?php echo $comment->id;?>)">
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

    function commentDelete(obj, commentId){
        var thisObj = $(obj);
        var commentItem = thisObj.parent().parent();

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Comment/commentDelete'); ?>",
            data: {'commentId': commentId},
            dataType: "JSON",
            timeout: 3000
        }).done(function(retData){
            if(0 === retData.errorCode){
                commentItem.fadeOut("fast", function(){
                    $(this).remove();
                });
            }
        })

    }
</script>