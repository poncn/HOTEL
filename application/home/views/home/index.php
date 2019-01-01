<div class="row header">
    <div class="nav">
        <div class="col-7 nav-left">
            <a class="fa fa-home logo" href="#"></a>
            <div class="search">
                <i class="fa fa-search"></i>
                <form action="" method="">
                    <label for="search">
                        <input type="search" placeholder="搜索">
                    </label>
                </form>
            </div>
        </div>
        <ul class="col-5 nav-right">
            <li><a href="">客房展示</a></li>
            <li><a href="">联系我们</a></li>
            <li><a href="">关于我们</a></li>
            <?php if(isset($_SESSION['username'])&&isset($_SESSION['head_portrait'])):?>
            <li class="pic dropdown">
                <img src="<?php echo base_url($_SESSION['head_portrait']);?>" alt="" width="45px" height="45px" class="dropdown-toggle" data-toggle="dropdown" >
                <div class="dropdown-menu user-menu">
                    <a href="<?php echo site_url('Login/logout')?>" class="dropdown-item">退出登录</a>
                </div>
            </li>
            <?php else:?>
            <li data-toggle="modal" data-target="#register">注册</li>
            <li data-toggle="modal" data-target="#login">登录</li>
            <?php endif;?>
        </ul>
    </div>
    <div class="bg-content">
        <div class="col-5 welcome-text">
            <p>博文酒家</p><br>
            <p>Welcome you</p><br>
            <div class="discounts"><i class="fa fa-bitcoin"></i>&nbsp;&nbsp;领取￥100优惠券</div>
        </div>
        <div class="col-7"></div>
    </div>
</div>
<div class="row content">
    <div class="col-1"></div>
    <div class="col-10 box">
        <div class="box-one">
            <h3><strong>探索博文</strong></h3>
            <ul class="active">
                <li><img src="<?php echo base_url('public/home/img/rooms/room1.jpg');?>" alt="" width="100px" height="80px"><span>餐馆</span></li>
                <li><img src="<?php echo base_url('public/home/img/rooms/room1.jpg');?>" alt="" width="100px" height="80px"><span>运动</span></li>
                <li><img src="<?php echo base_url('public/home/img/rooms/room1.jpg');?>" alt="" width="100px" height="80px"><span>泳池</span></li>
                <li><img src="<?php echo base_url('public/home/img/rooms/room1.jpg');?>" alt="" width="100px" height="80px"><span>活动</span></li>
            </ul>
        </div>
    </div>
    <div class="col-1"></div>
</div>
<div class="row content">
    <div class="col-1"></div>
    <div class="col-10 box">
        <div class="box-one">
            <h3><strong>观览客房</strong></h3>
            <ul class="rooms">
                <?php foreach ($intro as $v):if($v->state==0):?>
                <li>
                    <a href="<?php echo site_url('Room/index').'/'.$v->id;?>">
                        <img src="<?php echo base_url($v->pic_1);?>" alt="" width="300px" height="200px">
                    </a>
                    <div>
                        <span>每晚￥<?php echo $v->unit_price;?></span>
                        <span>
                            <?php printText($v->grade)?>
                        </span>
                    </div>
                    <p>
                        <span><?php echo $v->introduce;?></span>
                        <span><?php echo $v->type;?></span>
                    </p>
                </li>
                <?php endif; endforeach;?>
            </ul>
        </div>
    </div>
    <div class="col-1"></div>
</div>
