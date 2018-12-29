<?php require 'alert.php';?>
<div class="row-fluid">
    <div class="box span12">
        <div class="box-header">
            <h2><i class="icon-edit"></i>Room Create</h2>
            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="icon-wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <form class="form-horizontal" method="post" action="<?php
            if(isset($data)){
                echo site_url("Room/update"). '/' . $data->id;
            }else{
                echo site_url("Room/insert");
            }?>">
                <fieldset><br>
                    <div class="control-group">
                        <label class="control-label" for="id1">ID</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="id1" type="text" name="id" value="<?php if(isset($data)){echo $data->id;}?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="introduce">Introduce</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="introduce" type="text" name="introduce" maxlength="12" value="<?php if(isset($data)){echo $data->introduce;}?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="type_id">Type id</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="type_id" type="text" name="type_id" maxlength="12" value="<?php if(isset($data)){echo $data->type_id;}?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="grade">Room grade</label>
                        <div class="controls">
                            <select id="grade" name="grade">
                                <option value="5" <?php if(isset($data)&&$data->grade==5){echo 'selected';}?>>5 分
                                <option value="4.5" <?php if(isset($data)&&$data->grade==4.5){echo 'selected';}?>>4.5 分
                                <option value="4" <?php if(isset($data)&&$data->grade==4){echo 'selected';}?>>4 分
                                <option value="3.5" <?php if(isset($data)&&$data->grade==3.5){echo 'selected';}?>>3.5 分
                                <option value="3" <?php if(isset($data)&&$data->grade==3){echo 'selected';}?>>3 分
                                <option value="2.5" <?php if(isset($data)&&$data->grade==2.5){echo 'selected';}?>>2.5 分
                                <option value="2" <?php if(isset($data)&&$data->grade==2){echo 'selected';}?>>2 分
                                <option value="1.5" <?php if(isset($data)&&$data->grade==1.5){echo 'selected';}?>>1.5 分
                                <option value="1" <?php if(isset($data)&&$data->grade==1){echo 'selected';}?>>1 分
                                <option value="0.5"  <?php if(isset($data)&&$data->grade==0.5){echo 'selected';}?>>0.5 分
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">room state</label>
                        <div class="controls">
                            <label class="radio">
                                <input type="radio" name="state" id="optionsRadios1" value="1" <?php if(isset($data)&&$data->state==1){echo 'checked';}?>>
                                有人入住
                            </label>

                            <label class="radio">
                                <input type="radio" name="state" id="optionsRadios2" value="0" <?php if(isset($data)&&$data->state==0){echo 'checked';}?>>
                                无人入住
                            </label>
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