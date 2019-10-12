<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('adminResource/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('adminResource/css/style.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('adminResource/css/style-responsive.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('adminResource/css/theme/default.css') }}" rel="stylesheet" id="theme" />
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
    <style>
        table tr td{  border: none !important;  }
        #type-of-text table tr td:first-child{  padding-top: 18px;  width: 50px;  }
        #type-of-text table tr td:first-child span{  border:1px solid;padding: 3px 5px;}
    </style>
</head>

<body>
<!-- begin #content -->
<div id="page-container" class="page-container">
    <!-- begin #content -->
    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">

                <h4 class="panel-title">Goods Show</h4>
            </div>
            <div class="profile-container">
                <div class="profile-section">
                    <div class="profile-right" style="margin-left: 10%">
                        <!-- begin profile-info -->
                        <div class="profile-info">
                            <!-- begin table -->
                            <div class="table-responsive" style="float: left">

                                <table class="table table-profile">
                                    <tbody>
                                    <tr class="highlight">
                                        <td class="field">Goods Name</td>
                                        <td>{{$data['name']}}</td>
                                    </tr>
                                    <tr class="divider">
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr>
                                        <td class="field" style="width: 142px">Goods Price</td>
                                        <td>{{$data['price']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="field" style="width: 142px" >Category</td>
                                        <td>{{$data['category_name']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="field" style="width: 142px" >Created At</td>
                                        <td>{{$data['created_at']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="field" style="width: 142px" >Updated At</td>
                                        <td>{{$data['updated_at']}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-4" style="width: 60%">
                                <h4 class="title">Images</h4>
                                <!-- begin  scrollbar -->

                                <div data-scrollbar="true" data-height="280px" style="display:contents;" class="bg-silver">
                                    <div class="profile-image" style="height:auto" >
                                        @if(!empty($data['images']))
                                                <img src="{{$data['images']}}"  style="width: 50%;float: left;margin-left: 1%;margin-top: 1%;height: 60%"/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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

<script>
    layui.use('layer', function(){
        var layer = layui.layer;
    });
    $('.profile-image img').click(function(){
        var img=$(this)[0].src;
        layer.open({
            type: 1,
            title: false,
            closeBtn: 0,
            area: '516px',
            skin: 'layui-layer-nobg', //没有背景色
            shadeClose: true,
            content: '<img src='+img+' width="100%">'
        });
    });


</script>

</body>
</html>
