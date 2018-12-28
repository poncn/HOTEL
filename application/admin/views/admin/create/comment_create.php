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
                echo site_url("Comment/update");
            }else{
                echo site_url("Comment/insert");
            }?>">

                <fieldset><br>
                    <div class="control-group" hidden>
                        <label class="control-label" for="focusedInput">Id</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="focusedInput" type="text" name="id" maxlength="12" value="<?php if(isset($data)){echo $data->id;}?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="focusedInput">Username</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="focusedInput" type="text" name="content" maxlength="12" value="<?php if(isset($data)){echo $data->content;}?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="focusedInput">Positive</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="focusedInput" type="text" name="positive" maxlength="12" value="<?php if(isset($data)){echo $data->positive;}?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="focusedInput">Negative</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="focusedInput" type="text" name="negative" maxlength="18" value="<?php if(isset($data)){echo $data->negative;}?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="focusedInput">Time</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="focusedInput" type="text" name="time" maxlength="11" value="<?php if(isset($data)){echo $data->time;}?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="focusedInput">Username</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="focusedInput" type="text" name="username" maxlength="18" value="<?php if(isset($data)){echo $data->username;}?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="focusedInput">Room number</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="focusedInput" type="text" name="room_number" maxlength="11" value="<?php if(isset($data)){echo $data->room_number;}?>">
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