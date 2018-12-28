<?php require 'alert.php';?>
<div class="row-fluid">
    <div class="box span12">
        <div class="box-header">
            <h2><i class="icon-edit"></i>Book Create</h2>
            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="icon-wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <form class="form-horizontal" method="post" action="<?php
            if(isset($data)){
                echo site_url("Book/update");
            }else{
                echo site_url("Book/insert");
            }?>">
                <fieldset><br>
                    <div class="control-group" hidden>
                        <label class="control-label" for="focusedInput">Id</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="focusedInput" type="text" name="id" maxlength="12" value="<?php if(isset($data)){echo $data->id;}?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="focusedInput">User id</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="focusedInput" type="text" name="user_id" maxlength="10" value="<?php if(isset($data)){echo $data->user_id;}?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="focusedInput">Room number</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="focusedInput" type="text" name="room_number" maxlength="10" value="<?php if(isset($data)){echo $data->room_number;}?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="focusedInput">Day</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="focusedInput" type="text" name="day" maxlength="10" value="<?php if(isset($data)){echo $data->day;}?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="focusedInput">Total money</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="focusedInput" type="text" name="total_money" maxlength="11" value="<?php if(isset($data)){echo $data->total_money;}?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="date01">Date input</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge datepicker" id="date01" value="12/01/2018" name="check_in_time" value="<?php if(isset($data)){echo $data->check_in_time;}?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="date02">Date input</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge datepicker" id="date02" value="12/01/2018" name="check_out_time" value="<?php if(isset($data)){echo $data->check_out_time;}?>">
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