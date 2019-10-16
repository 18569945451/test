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
                        <h3 class="box-title" style="color: red;font-size: 26px;font-weight: bold;">Edit Goods</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form role="form" id="merchant_edit" method="post" action="{{url('goods/edit',$data->id)}}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <!-- text input -->
                            <div class="form-group @if($errors->has('name'))has-error @endif">
                                @if($errors->has('name')) <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>Goods Name</label>@else<label>Goods Name</label>@endif
                                <input type="text" name="name" class="form-control" value="{{$data->name}}">
                                @if($errors->has('name')) <span class="help-block">{{$errors->first('name') }}</span> @endif
                            </div>

                            <div class="form-group @if($errors->has('images'))has-error @endif">
                                @if($errors->has('images')) <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>Goods Image</label>@else<label>Goods Image</label>@endif
                                <div class="fileinput fileinput-new" data-provides="fileinput" id="uploadImageDiv">
                                    <div class="fileinput-new thumbnail" id="prompt" style="width: 200px; height: 150px;">
                                        <img src="{{$data->images}}" alt="" id="img" style="width: 200px;height: 140px" />
                                    </div>
                                    <span class="btn default btn-file">
                                                <span class="fileinput-new btn btn-warning btn-sm">Update</span>
                                                <input type="file" onchange="changepic(this)" accept="image/jpg,image/jpeg,image/png,image/PNG" name="images" id="images" />
                                            </span>
                                </div>
                                @if($errors->has('images')) <span class="help-block">{{$errors->first('images') }}</span> @endif
                            </div>

                            <div class="form-group @if($errors->has('price'))has-error @endif">
                                @if($errors->has('price')) <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>Goods Price</label>@else<label>Goods Price</label>@endif
                                <input type="text" name="price" class="form-control" value="{{$data->price}}">
                                @if($errors->has('price')) <span class="help-block">{{$errors->first('price') }}</span> @endif
                            </div>

                            {{--<div class="form-group @if($errors->has('category_id'))has-error @endif">
                                @if($errors->has('category_id')) <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>Select Category</label>@else<label>Select Category</label>@endif
                                <select name="category_id" id="category_id" class="form-control">
                                    @foreach($category as $val)
                                        @if($data->category_id == $val->id )
                                            <option value="{{$val->id}}" selected>{{$val->name}}</option>
                                        @else
                                            <option value="{{$val->id}}">{{$val->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @if($errors->has('category_id')) <span class="help-block">{{$errors->first('category_id') }}</span> @endif
                            </div>--}}
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
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('resources/dist/js/demo.js') }}"></script>
<!-- layer -->
<script src="{{ asset('resources/plugins/layer/layer.js') }}"></script>
<script src="{{ asset('resources/plugins/jquery-from/jquery.form.js') }}"></script>
</html>
<script>
    function merchantEdit() {
        $("#merchant_edit").submit();

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