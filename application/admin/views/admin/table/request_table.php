<div class="row-fluid">
    <div class="box span12">
        <div class="box-header" data-original-title="">
            <h2><i class="icon-user"></i><span class="break"></span>Request Table</h2>
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
                    <th>flow_id</th>
                    <th>request_client_id</th>
                    <th>uaername</th>
                    <th>request_time</th>
                    <th>signature</th>
                    <th>request_state</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($request as $v):?>
                    <tr>
                        <td><?php echo $v->flow_id;?></td>
                        <td><?php echo $v->request_client_id;?></td>
                        <td class="center"><?php echo $v->username;?></td>
                        <td class="center"><?php echo $v->request_time;?></td>
                        <td class="center"><?php echo $v->signature;?></td>
                        <td class="center"><?php echo $v->request_state;?></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div><!--/span-->
</div><!--/row-->