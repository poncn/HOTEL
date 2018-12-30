<?php require 'alert.php'; ?>
<div class="row-fluid">
    <div class="box span12">
        <div class="box-header">
            <h2><i class="icon-edit"></i>Client Create</h2>
            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="icon-wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <form class="form-horizontal" method="post" action="<?php
            if (isset($data)) {
                echo site_url("Client/update") . '/' . $data->client_id;
            } else {
                echo site_url("Client/insert");
            } ?>" enctype="multipart/form-data">
                <fieldset><br>
                    <div class="control-group">
                        <label class="control-label" for="client_name">Client id</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="client_name" type="text" name="client_name"
                                   value="<?php if (isset($data)) {
                                       echo $data->client_name;
                                   } ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="client_key">Client key</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="client_key" type="text" name="client_key" value="<?php if (isset($data)) {
                                echo $data->client_key;
                            } ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="client_url">Client url</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="client_url" type="text" name="client_url" value="<?php if (isset($data)) {
                                echo $data->client_url;
                            } ?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="client_state">Client state</label>
                        <div class="controls">
                            <input class="input-file uniform_on" id="client_state" type="text" name="client_state" value="<?php if (isset($data)) {
                                echo $data->client_state;
                            } ?>">
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button class="btn" type="reset">Cancel</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div><!--/span-->

</div><!--/row-->
