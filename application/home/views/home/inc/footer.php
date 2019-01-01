<div class="row footer">
    <div class="col-1"></div>
    <div class="col-6 ">
        © 2018 bwgl.cn 版权所有&nbsp;
        <img src="<?php echo base_url('public/home/img/put_on_records.png')?>" alt="">
        <a href="https://www.beian.gov.cn">桂公网安备 45031102000011号</a>
        <p>桂林博文酒家服务有限公司</p>
    </div>
    <div class="col-4 footer-right">
        <a href="">条款</a>
        <a href="">网站地图</a>
    </div>
    <div class="col-1"></div>
</div>
<div class="modal fade" id="register">
    <div class="modal-dialog">
        <div class="modal-content">
            <form onsubmit="return false;" method="post" class="register-form">
                <!-- 模态框头部 -->
                <div class="modal-header">
                    <h4 class="modal-title">用户注册</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- 模态框主体 -->
                <div class="modal-body">

                    <label for="username" class="fa fa-user-o"></label>
                    <input class="form-control-lg" id="username" name="username" type="text" placeholder="用户名"><br>
                    <label for="password" class="fa fa-key"></label>
                    <input class="form-control-lg" id="password" name="password" type="password" placeholder="密码"><br>
                    <label for="rePassword" class="fa fa-key"></label>
                    <input class="form-control-lg" id="rePassword" name="rePassword" type="password" placeholder="重复密码"><br>

                </div>

                <!-- 模态框底部 -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" data-dismiss="modal" onclick="register()">注册新用户</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="login">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" class="register-form" onsubmit="return false;">
                <!-- 模态框头部 -->
                <div class="modal-header">
                    <h4 class="modal-title">用户登录</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- 模态框主体 -->
                <div class="modal-body login-body">

                    <label for="login-username" class="fa fa-user-o"></label>
                    <input class="form-control-lg" type="text" placeholder="用户名" id="login-username" name="login-username"><br>
                    <label for="login-password" class="fa fa-key"></label>
                    <input class="form-control-lg" name="login-password" id="login-password" type="password" placeholder="密码"><br>
                </div>
                <!-- 模态框底部 -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" onclick="login()">登录</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<script src="<?php echo base_url('public/home/js/jquery-3.3.1.min.js');?>"></script>
<script src="<?php echo base_url('public/home/js/bootstrap.js');?>"></script>
<script src="<?php echo base_url('public/home/js/bootstrap.bundle.js');?>"></script>
<script src="<?php echo base_url('public/home/js/bootstrap-datepicker.js'); ?>"></script>
<script src="<?php echo base_url('public/home/locales/bootstrap-datepicker.zh-CN.min.js'); ?>"></script>
<script src="<?php echo base_url('public/home/js/comment.js'); ?>"></script>
<script type="text/javascript">
    $('.input-daterange').datepicker({language: "zh-CN"})
</script>
<script type="text/javascript">
    function register() {
        var username = $("#username");
        var password = $("#password");
        var rePassword = $("#rePassword");

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Login/register')?>",
            data: {
                'username': username.val(),
                'password': password.val(),
                'rePassword': rePassword.val()
            },
            dataType: "JSON"
        }).done(function (data) {

        }).always(function (data) {
            if (data) {
                alert(data);
            }
        })
    }
    function login() {
        var loginPsername = $("#login-username");
        var loginPassword = $("#login-password");

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Login/doLogin')?>",
            data: {
                'username': loginPsername.val(),
                'password': loginPassword.val()
            },
            async: false,
            dataType: "JSON"
        }).done(function (data) {
            if (0 === data['errorCode']) {

            }
        }).always(function (data) {
            if (data['message'] && (data['message'].length > 0)) {
                alert(data['message']);
            }
            if (data['redirectUrl'] && (data['redirectUrl'].length > 0)) {
                self.location.href = data['redirectUrl'];
            }
        })
    }
</script>
</body>
</html>