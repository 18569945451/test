<?php if(old('status') == 1): ?>
    <script>
        var index = parent.layer.getFrameIndex(window.name);
        parent.layer.close(index);
        parent.location.reload()
    </script>
<?php endif; ?>
<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo e(config('app.name', 'Laravel')); ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo e(asset('resources/bower_components/bootstrap/dist/css/bootstrap.min.css')); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('resources/bower_components/font-awesome/css/font-awesome.min.css')); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo e(asset('resources/bower_components/Ionicons/css/ionicons.min.css')); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('resources/dist/css/AdminLTE.min.css')); ?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo e(asset('resources/dist/css/skins/_all-skins.min.css')); ?>">
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
                        <form role="form" id="merchant_edit" method="post" action="<?php echo e(url('goods/edit',$data->id)); ?>" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
                            <!-- text input -->
                            <div class="form-group <?php if($errors->has('name')): ?>has-error <?php endif; ?>">
                                <?php if($errors->has('name')): ?> <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>Goods Name</label><?php else: ?><label>Goods Name</label><?php endif; ?>
                                <input type="text" name="name" class="form-control" value="<?php echo e($data->name); ?>">
                                <?php if($errors->has('name')): ?> <span class="help-block"><?php echo e($errors->first('name')); ?></span> <?php endif; ?>
                            </div>

                            <div class="form-group <?php if($errors->has('images')): ?>has-error <?php endif; ?>">
                                <?php if($errors->has('images')): ?> <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>Goods Image</label><?php else: ?><label>Goods Image</label><?php endif; ?>
                                <div class="fileinput fileinput-new" data-provides="fileinput" id="uploadImageDiv">
                                    <div class="fileinput-new thumbnail" id="prompt" style="width: 200px; height: 150px;">
                                        <img src="<?php echo e($data->images); ?>" alt="" id="img" style="width: 200px;height: 140px" />
                                    </div>
                                    <span class="btn default btn-file">
                                                <span class="fileinput-new btn btn-warning btn-sm">Update</span>
                                                <input type="file" onchange="changepic(this)" accept="image/jpg,image/jpeg,image/png,image/PNG" name="images" id="images" />
                                            </span>
                                </div>
                                <?php if($errors->has('images')): ?> <span class="help-block"><?php echo e($errors->first('images')); ?></span> <?php endif; ?>
                            </div>

                            <div class="form-group <?php if($errors->has('price')): ?>has-error <?php endif; ?>">
                                <?php if($errors->has('price')): ?> <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>Goods Price</label><?php else: ?><label>Goods Price</label><?php endif; ?>
                                <input type="text" name="price" class="form-control" value="<?php echo e($data->price); ?>">
                                <?php if($errors->has('price')): ?> <span class="help-block"><?php echo e($errors->first('price')); ?></span> <?php endif; ?>
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
<script src="<?php echo e(asset('resources/bower_components/jquery/dist/jquery.min.js')); ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo e(asset('resources/bower_components/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
<!-- FastClick -->
<script src="<?php echo e(asset('resources/bower_components/fastclick/lib/fastclick.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset('resources/dist/js/adminlte.min.js')); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo e(asset('resources/dist/js/demo.js')); ?>"></script>
<!-- layer -->
<script src="<?php echo e(asset('resources/plugins/layer/layer.js')); ?>"></script>
<script src="<?php echo e(asset('resources/plugins/jquery-from/jquery.form.js')); ?>"></script>
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
</script><?php /**PATH D:\phpstudy_pro\WWW\test\resources\views/Admin/edit.blade.php ENDPATH**/ ?>