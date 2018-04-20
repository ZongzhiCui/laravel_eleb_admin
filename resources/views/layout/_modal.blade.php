<!-- Modal -->
<div data-backdrop="static" class="modal fade bs-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button id="btn_close" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">会员登录!</h4>
            </div>
            <br>
            <form action="{{route('login')}}" id="myform" method="post">
                <div class="modal-body">
                    <div class="input-group">
                        <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                        <input type="text" required name="name" value="{{old('name')}}" class="form-control" placeholder="管理员名" aria-describedby="sizing-addon2">
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></span>
                        <input type="password" required name="password" value="{{old('password')}}" class="form-control" placeholder="密码" aria-describedby="sizing-addon2">
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon" id="sizing-addon3"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></span>
                        <input id="captcha" class="form-control" name="captcha" placeholder="不区分大小写">
                    </div>
                        <img class="thumbnail captcha" src="{{ captcha_src('inverse') }}" onclick="this.src='/captcha/inverse?'+Math.random()" title="点击图片重新获取验证码">

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" value="1"> 记住密码
                        </label>
                    </div>
                    <hr>
                    {{ csrf_field() }}
                    <button id="btn1" type="submit" class="btn btn-success btn-block">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>