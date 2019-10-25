<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('resources/plugins/bootstrap-table/bootstrap-table.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Permission List</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Permission List</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <div id="toolbar" class="btn-group">
                                <button class="btn btn-success" id="add">Add New</button>
                            </div>
                            <table id="table"></table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('resources/plugins/bootstrap-table/bootstrap-table.min.js')); ?>"></script>
<script src="<?php echo e(asset('resources/plugins/bootstrap-table/locale/bootstrap-table-en-US.min.js')); ?>"></script>
<script src="<?php echo e(asset('resources/plugins/layer/layer.js')); ?>"></script>
<script>
    var table;
    //初始化bootstrap-table的内容
    function initMainTable () {
        //记录页面bootstrap-table全局变量table，方便应用
        var queryUrl = '/permission';
        table = $('#table').bootstrapTable({
            url: queryUrl,                      //请求后台的URL（*）
            method: 'GET',                      //请求方式（*）
            toolbar: '#toolbar',              //工具按钮用哪个容器
            striped: true,                      //是否显示行间隔色
            cache: true,                       //是否使用缓存，默认为true，所以一般情况下需要设置一下这个属性（*）
            pagination: true,                   //是否显示分页（*）
            sortable: true,                     //是否启用排序
            sortOrder: "asc",                   //排序方式
            sidePagination: "server",           //分页方式：client客户端分页，server服务端分页（*）
            pageNumber: 1,                      //初始化加载第一页，默认第一页,并记录
            pageSize: 10,                     //每页的记录行数（*）
            pageList: [10, 25, 50, 100],        //可供选择的每页的行数（*）
            search: true,                      //是否显示表格搜索
            showColumns: true,                  //是否显示所有的列（选择显示的列）
            showRefresh: true,                  //是否显示刷新按钮
            //minimumCountColumns: 1,             //最少允许的列数
            clickToSelect: true,                //是否启用点击选中行
            uniqueId: "id",                     //每一行的唯一标识，一般为主键列
            cardView: false,                    //是否显示详细视图
            detailView: false,                  //是否显示父子表
            //得到查询的参数
            queryParams : function (params) {
                //这里的键的名字和控制器的变量名必须一直，这边改动，控制器也需要改成一样的
                return {
                    limit: params.limit,                         //页面大小
                    page: (params.offset / params.limit) + 1,   //页码
                    sort: params.sort,      //排序列名
                    order: params.order, //排位命令（desc，asc）
                    keyword: params.search //排位命令（desc，asc）
                };
            },
            columns: [{
                checkbox: false,
                visible: false
            }, {
                field: 'id',
                title: 'ID',
                sortable: true
            },{
                field: 'name',
                title: 'name',
                sortable: true
            }, {
                field: 'display_name',
                title: 'display_name',
                sortable: false
            },{
                field: 'description',
                title: 'description',
                sortable: false
            },{
                field: 'created_at',
                title: 'Created At',
                sortable: true
            }, {
                field: 'updated_at',
                title: 'Updated At',
                sortable: true
            },{
                field: 'id',
                title: 'Action',
                formatter:function(id){
                   return `<button type="button" onclick="edit(${id})" class="btn btn-info btn-sm">Edit</button>`
                    +`<button type="button" style="margin-left: 5px" onclick="destroy(${id})" class="btn btn-danger btn-sm">Delete</button>`
                    //+`<button type="button" style="margin-left: 5px" onclick="show(${id})" class="btn btn-primary btn-sm">Show</button>`
                }
            }]
        });

    }
    initMainTable();
    $('#add').click(function(){
        layer.open({
            type: 2,
            title: 'Add Goods',
            shadeClose: true,
            shade: 0.8,
            area: ['60%', '60%'],
            btn:['Submit','Closed'],
            yes:function(index,layero){
                var iframeWin = window[layero.find('iframe')[0]['name']]; //得到iframe页的窗口对象，执行iframe页的方法：iframeWin.method();
                iframeWin.merchantAdd();
            },
            content: '/permission/create'
        });
    });
    //编辑
    function edit(id){
        layer.open({
            type: 2,
            title: 'Edit Goods',
            shadeClose: true,
            shade: 0.8,
            area: ['60%', '60%'],
            btn:['Submit','Closed'],
            yes:function(index,layero){
                var iframeWin = window[layero.find('iframe')[0]['name']]; //得到iframe页的窗口对象，执行iframe页的方法：iframeWin.method();
                iframeWin.merchantEdit(id);
            },
            content: '/permission/'+id
        });
    }
    //展示
    function show(id){
        layer.open({
            type: 2,
            title: 'Food Show',
            shadeClose: true,
            shade: 0.8,
            area: ['60%', '60%'],
            btn:['Closed'],
            content: '/permission/show/'+id,
        });
    }
    //删除
    function destroy(id) {
        var queryUrl = '/permission/'+id;
        //询问框
        layer.confirm('Are you sure you want to delete it?',{title:'Info',
            btn: ['Yes','No'] //按钮
        },function(){
            $.ajax({
                type: "DELETE",
                url: queryUrl,
                data: {
                    _token:'<?php echo e(csrf_token()); ?>'
                },
                dataType: "json",
                success: function (msg) {
                    if (msg.code == 200) {
                        layer.msg(msg.message, {icon: 1,time: 2000});
                        location.reload()
                    } else {
                        layer.msg(msg.message, {icon: 2, time: 2000})
                    }
                }
            });
        });
    }
    //通知
    <?php if(session()->has('flash_notification.message')): ?>
    $.gritter.add({
        title: 'Notice!',
        text: 'Success',
        sticky: true,
        time: '',
        class_name: 'my-sticky-class'
    });
    <?php endif; ?>


</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\phpstudy_pro\WWW\test\resources\views/Permission/pay.blade.php ENDPATH**/ ?>