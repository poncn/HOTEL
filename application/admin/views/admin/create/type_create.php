<?php require 'alert.php';?>
<div class="row-fluid">
    <div class="box span12">
        <div class="box-header">
            <h2><i class="icon-edit"></i>Type Create</h2>
            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="icon-wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <form class="form-horizontal" method="post" action="<?php
            if(isset($data)){
                echo site_url("Type/update"). '/' . $data->id;
            }else{
                echo site_url("Type/insert");
            }?>" enctype="multipart/form-data">
                <fieldset><br>
                    <div class="control-group">
                        <label class="control-label" for="type">Type</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="type" type="text" name="type" maxlength="20" value="<?php if(isset($data)){echo $data->type;}?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="unit_price">Unit price</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="unit_price" type="text" name="unit_price" maxlength="12" value="<?php if(isset($data)){echo $data->unit_price;}?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="bedroom">Bedroom</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="bedroom" type="text" name="bedroom" maxlength="12" value="<?php if(isset($data)){echo $data->bedroom;}?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="bed">Bed</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="bed" type="text" name="bed" maxlength="12" value="<?php if(isset($data)){echo $data->bed;}?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="toilet">Toilet</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="toilet" type="text" name="toilet" maxlength="12" value="<?php if(isset($data)){echo $data->toilet;}?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="num_people">Num people</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="num_people" type="text" name="num_people" maxlength="12" value="<?php if(isset($data)){echo $data->num_people;}?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="pic_1">pic 1 file</label>
                        <div class="controls">
                            <input class="input-file uniform_on" id="pic_1" type="file" name="pic_1">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="pic_2">pic 2 file</label>
                        <div class="controls">
                            <input class="input-file uniform_on" id="pic_2" type="file" name="pic_2">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="pic_3">pic 3 file</label>
                        <div class="controls">
                            <input class="input-file uniform_on" id="pic_3" type="file" name="pic_3">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="pic_4">pic 4 file</label>
                        <div class="controls">
                            <input class="input-file uniform_on" id="pic_4" type="file" name="pic_4">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="pic_5">pic 5 file</label>
                        <div class="controls">
                            <input class="input-file uniform_on" id="pic_5" type="file" name="pic_5">
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