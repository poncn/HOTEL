<?php require 'alert.php';?>
<div class="row-fluid">
    <div class="box span12">
        <div class="box-header">
            <h2><i class="icon-edit"></i>Comment Create</h2>
            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="icon-wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <form class="form-horizontal" method="post" action="<?php
            if(isset($data)){
                echo site_url("Comment/update"). '/' . $data->id;
            }else{
                echo site_url("Comment/insert");
            }?>">

                <fieldset><br>
                    <div class="control-group">
                        <label class="control-label" for="content1">Content</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="content1" type="text" name="content" value="<?php if(isset($data)){echo $data->content;}?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="positive">Positive</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="positive" type="text" name="positive" value="<?php if(isset($data)){echo $data->positive;}?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="negative">Negative</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="negative" type="text" name="negative" value="<?php if(isset($data)){echo $data->negative;}?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="time">Time</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="time" type="text" name="time" value="<?php if(isset($data)){echo $data->time;}?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="username">Username</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="username" type="text" name="username" maxlength="9" value="<?php if(isset($data)){echo $data->username;}?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="room_number">Room number</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="room_number" type="text" name="room_number" maxlength="4" value="<?php if(isset($data)){echo $data->room_number;}?>">
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