<?php require 'inc/alert.php';?>
<div class="row-fluid">
    <div class="box span12">
        <div class="box-header">
            <h2><i class="icon-edit"></i>Admin Create</h2>
            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="icon-wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <form class="form-horizontal" method="post" action="<?php
            if(isset($data)){
                echo site_url("Admin/update").'/'.$data->id;
            }else{
                echo site_url("Admin/insert");
            }?>" enctype="multipart/form-data">
                <fieldset><br>
                    <div class="control-group">
                        <label class="control-label" for="username">Username</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="username" type="text" name="username" maxlength="12" value="<?php if(isset($data)){echo $data->username;}?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="password">Password</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="password" type="password" name="password" maxlength="12" value="">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="rePassword">Repeat password</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="rePassword" type="password" name="rePassword" maxlength="12" value="">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="head_portrait">Head portrait file</label>
                        <div class="controls">
                            <input class="input-file uniform_on" id="head_portrait" type="file" name="head_portrait" >
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
