<div class="row header-room">
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
            <li><a href="#">客房展示</a></li>
            <li><a href="">联系我们</a></li>
            <li><a href="">关于我们</a></li>
            <li data-toggle="modal" data-target="#register">注册</li>
            <li data-toggle="modal" data-target="#login">登录</li>
            <li class="pic dropdown">
                <img src="<?php echo base_url('public/home/img/rooms/room1.jpg'); ?>" alt="" width="45px" height="45px" class="dropdown-toggle" data-toggle="dropdown">
                <div class="dropdown-menu user-menu">
                    <a href="#" class="dropdown-item">退出登录</a>
                </div>
            </li>
        </ul>
    </div>
    <div class="bg-img">
        <div class="imgs">
            <img src="<?php echo base_url('public/home/img/rooms/room1.jpg'); ?>" alt="" width="440px"
                 height="300px">
            <img src="<?php echo base_url('public/home/img/rooms/room1.jpg'); ?>" alt="" width="440px"
                 height="300px">
            <img src="<?php echo base_url('public/home/img/rooms/room1.jpg'); ?>" alt="" width="440px"
                 height="300px">
            <img src="<?php echo base_url('public/home/img/rooms/room1.jpg'); ?>" alt="" width="440px"
                 height="300px">
            <img src="<?php echo base_url('public/home/img/rooms/room1.jpg'); ?>" alt="" width="440px"
                 height="300px">
        </div>
    </div>

</div>
<div class="row content">
    <div class="list">
        <div class="col-1"></div>
        <ul class="col-5 list-left">
            <li><a href="">详情</a></li>&nbsp;·&nbsp;
            <li><a href="">评价</a></li>
        </ul>
        <ul class="col-5 list-right">
            <li><a href=""><i class="fa fa-share-square-o"></i>&nbsp;分享</a></li>&nbsp;&nbsp;&nbsp;
            <li><a href=""><i class="fa fa-heart-o"></i>&nbsp;保存</a></li>
        </ul>
        <div class="col-1"></div>
    </div>
    <div class="details">
        <div class="col-1"></div>
        <div class="col-6 details-left">
            <h2><strong>无敌海景家庭房</strong></h2>
            <p>
                <span><i class="fa fa-home"></i> 1间卧室</span>&nbsp;&nbsp;
                <span><i class="fa fa-bed"></i> 2张床</span>&nbsp;&nbsp;
                <span><i class="fa fa-bath"></i> 1间卫生间</span>&nbsp;&nbsp;
                <span><i class="fa fa-users"></i> 最多住4人</span>&nbsp;&nbsp;
            </p>

            <div class="comment">
                <form action="" method="post" id="comment-reply">
                    <div class="comment-box">
                        <button type="submit"><i class="fa fa-paper-plane"></i></button>
                        <textarea type="text" name="" id="comment-textarea" maxlength="388"
                                  placeholder="轻轻的我来了，留下了我的话题。"></textarea>
                    </div>
                    <div class="comment-link-img">
                        <i class="fa fa-smile-o comment-fa-smile-o"></i>

                        <i class="fa fa-image comment-fa-image"></i>
                        <input type="file" id="comment-fa-image" style="display: none">
                    </div>
                    <div class="prompt-dialog-box">
                        <div class="point-to"></div>
                        <ul class="dialog-content">
                            <li class="face_1"></li>
                            <li class="face_2"></li>
                            <li class="face_3"></li>
                            <li class="face_4"></li>
                            <li class="face_5"></li>
                            <li class="face_6"></li>
                            <li class="face_7"></li>
                            <li class="face_8"></li>
                            <li class="face_9"></li>
                            <li class="face_10"></li>
                            <li class="face_11"></li>
                            <li class="face_12"></li>
                        </ul>
                    </div>
                </form>
                <div class="comment-speech">
                    <div class="comment-box">
                        <span class="comment-box-btn">评论</span>
                        <div>
                            <span class="comment-box-join"><i>231</i>人参与</span>
                            &nbsp;
                            &nbsp;
                            <span class="comment-box-speech"><i>21</i>人评论</span>
                        </div>
                    </div>
                    <div class="comment-line"></div>
                </div>
                <ul class="comment-list">
                    <form action="" method="post" id="reply">
                        <div class="reply-box">
                            <button type="submit"><i class="fa fa-paper-plane"></i></button>
                            <textarea type="text" name="" id="reply-textarea" maxlength="388"
                                      placeholder="我的想法是："></textarea>
                        </div>
                        <div class="reply-link-img">
                            <i class="fa fa-smile-o reply-fa-smile-o"></i>

                            <i class="fa fa-image reply-fa-image"></i>
                            <input type="file" id="reply-fa-image" style="display: none">
                        </div>
                        <div class="reply-prompt-dialog-box">
                            <div class="reply-point-to"></div>
                            <ul class="reply-dialog-content">
                                <li class="face_1"></li>
                                <li class="face_2"></li>
                                <li class="face_3"></li>
                                <li class="face_4"></li>
                                <li class="face_5"></li>
                                <li class="face_6"></li>
                                <li class="face_7"></li>
                                <li class="face_8"></li>
                                <li class="face_9"></li>
                                <li class="face_10"></li>
                                <li class="face_11"></li>
                                <li class="face_12"></li>
                            </ul>
                        </div>
                    </form>
                    <li>
                        <div class="user-header">
                            <img src="<?php echo base_url('public/home/img/rooms/room1.jpg'); ?>" alt=""
                                 width="40px" height="40px">
                        </div>
                        <ul class="user-body">
                            <li class="user-body-top">
                                <a href="" class="user-body-top-name">GPC</a>
                                <span class="user-body-top-time">2017年5月4日 22:18</span>
                            </li>
                            <li class="user-body-content">

                            </li>
                            <li class="user-body-bottom">
                                <span class="reply-btn">回复</span>
                                <i class="fa fa-thumbs-o-up">&nbsp;1</i>
                                <i class="fa fa-thumbs-o-down">&nbsp;32</i>
                            </li>
                            <hr>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-4 details-right">
            <ul class="pay">
                <li class="pay-header">
                    <h4><i class="fa fa-rmb"></i>367</h4><span>每晚</span>
                </li>
                <li class="pay-content">
                    <form action="" method="post">
                        <br>
                        <p class="date-p">日期</p>
                        <div class="input-daterange input-group" id="datepicker">
                            <label for="start">
                                <input type="text" class="input-sm form-control" id="start" name="start">
                            </label>
                            <i class="fa fa-long-arrow-right"></i>
                            <label for="end">
                                <input type="text" class="input-sm form-control" id="end" name="end">
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="sel1">房客</label>
                            <select class="form-control" id="sel1">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                            </select>
                        </div>
                        <p class="price"><span>总价</span><span><i class="fa fa-rmb"></i>336</span></p>
                        <button class="btn btn-price" type="submit">预定</button>
                    </form>
                </li>
                <li class="pay-bottom">

                </li>
            </ul>
        </div>
        <div class="col-1"></div>
    </div>
</div>
