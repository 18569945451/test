@if(old('status') == 1)
    <script>
        var index = parent.layer.getFrameIndex(window.name);
        parent.layer.close(index);
        parent.location.reload()
    </script>
@endif
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('resources/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('resources/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('resources/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('resources/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('resources/dist/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/plugins/bootstrap-fileinput/css/fileinput.min.css') }}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title" style="color: red;font-size: 26px;font-weight: bold;">Add Role</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form role="form" method="post" action="{{url('role/add')}}" id="merchant_add" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}" />
                            <!-- text input -->
                            <div class="form-group @if($errors->has('name'))has-error @endif">
                                @if($errors->has('name')) <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Name</label>@else<label> Name</label>@endif
                                <input type="text" name="name" class="form-control" placeholder="name.">
                                @if($errors->has('name')) <span class="help-block">{{$errors->first('name') }}</span> @endif
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="radio" name="display" value="1">
                                        管理员
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label>
                                        <input type="radio" name="display" value="2">
                                        写入者
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label>
                                        <input type="radio" name="display" value="3">
                                        读者
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</body>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('resources/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('resources/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('resources/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('resources/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('resources/plugins/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('resources/dist/js/demo.js') }}"></script>
<!-- layer -->
<script src="{{ asset('resources/plugins/layer/layer.js') }}"></script>
<script src="{{ asset('resources/plugins/jquery-from/jquery.form.js') }}"></script>
</html>
<script>
    function merchantAdd() {
        $("#merchant_add").submit();
    }

    function deleteimg(){
        //将img的src属性赋值为空串
        document.getElementById("img").src = "#";
        //选择文件框的value属性赋值为空串
        document.getElementById("images").value = null;
    }

    function changepic() {
        var reads = new FileReader();
        f = document.getElementById('images').files[0];
        reads.readAsDataURL(f);
        reads.onload = function(e) {
            document.getElementById('img').src = this.result;
            $("#img").css("display", "block");
        }
    }
</script>
