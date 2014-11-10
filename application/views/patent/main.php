<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>科研成果管理平台</title>
    <link href="<?=base_url()?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>css/bootstrap-switch.min.css" rel="stylesheet">
    <link href="<?=base_url()?>css/font-awesome.min.css" rel="stylesheet">
    <script src="<?=base_url()?>js/jquery-2.1.1.js"></script>
    <script src="<?=base_url()?>js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>js/bootstrap-switch.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){

      $("#refresh_list").click(function()
      {
        $.get("<?=site_url('patentmanage/show')?>",function(data,status){
          $("#detail").html(data);
        });
      });

      $("#refresh_list").click();

      $("#selectMode").children().eq($("#currentMode").text()).attr("selected","selected");
      $("#selectMode").change(function()
      {
        $("#modeControl").submit();
      });

      $("#remove_record").click(function()
      {
        $("#upload").hide();
        $("#remove").slideToggle();
      });

      $("#upload_file").click(function()
      {
        $("#remove").hide();
        $("#upload").slideToggle();
      });

      $(":submit").click(function()
      {
        if($(event.target).text() == "删除")
        {
          $("#remove").hide();
          var data = {
            number: $("#reinputNumber").val()
          };
          $.post("<?=site_url('patentmanage/delete')?>",data,function(res,status)
            {
              alert(res);
            }); 
        }else if($(event.target).text() == "添加")
        {
          var data = {
            name: $("#inputName").val(),
            register: $("#inputRegister").val(),
            person: $("#inputPerson").val(),
            institute: $("#inputInstitute").val(),
            time: $("#inputTime").val()
          };
          $.post("<?=site_url('patentmanage/add')?>",data,function(res,status)
            {
              alert(res);
            });
        }
        // 刷新一次数据
        $("#refresh_list").click(); 
        return true;
      });
    });
    </script>
  </head>
  <body>
    <?php $this->load->view('template/navbar') ?>

    <div class="container">
      <div class="row">
        <h3 class="text-center">专利信息维护</h3>
        <p hidden id="currentMode"><?php echo $this->session->userdata('mode')?></p>
        <div class="col-md-1 col-md-offset-10 text-right">
          <form action="<?=site_url('modecontroller/changemode')?>" method="post" id="modeControl">
            <select class="form-control" name="mode" id="selectMode">
              <option value="0">查询</option>
              <option value="1">维护</option>
              <option value="2">管理</option>
            </select>
            <input type="text" name="from" value="<?=site_url('patentmanage/index')?>" hidden>
          </form>
        </div>
      </div>
      <hr/>
    <div>
        <a class="btn btn-default" id="refresh_list">刷新列表</a>
        <a class="btn btn-default" data-toggle="modal" data-target="#addModal">添加信息</a>
        <a class="btn btn-default" id="remove_record">删除记录</a>
        <a class="btn btn-default" id="upload_file">上传证明文件</a>
        <a class="btn btn-default" hidden id="addListBtn" data-toggle="modal" data-target="#addList" href="<?=site_url('patentmanage/patentlist')?>">
          添加人员名单
        </a>

          <div class="modal fade" id="addList" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
              </div>
            </div>
          </div>
          
         <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <h4 class="modal-title">添加人员信息</h4>
                </div>
                <div class="modal-body">
                      <form class="form-horizontal">
                          <div class="form-group">
                            <label for="inputName" class="col-sm-3 control-label">专利权名</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="inputName" placeholder="List">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputRegister" class="col-sm-3 control-label">专利权编号</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="inputRegister" placeholder="Register">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputPerson" class="col-sm-3 control-label">专利权人</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="inputPerson" placeholder="Person">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputInstitute" class="col-sm-3 control-label" name="purpose">授予机构</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="inputInstitute" placeholder="Institute">
                            </div>
                          </div>
                           <div class="form-group">
                            <label for="inputTime" class="col-sm-3 control-label" name="news">授予时间</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="inputTime" placeholder="Time">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-2">
                              <button type="submit" class="btn btn-default">添加</button>
                            </div>
                          </div>
                      </form>
                </div>
              </div>
            </div>
          </div>
    </div>
    <br/>
    <div id="remove" hidden>
         <form class="form-inline">
          <div class="form-group">
            <label class="sr-only" for="reinputNumber">编号</label>
            <input type="text" name="number" class="form-control" id="reinputNumber" placeholder="编号">
          </div>
          <button type="submit" class="btn btn-default">删除</button>
        </form>
    </div>
    
    <div class="row" id="upload" hidden>
    <form role="form" class="form-inline" action="<?=site_url('patentfile/file_upload')?>" method="post" enctype="multipart/form-data">
      <div class="form-group col-sm-2">
        <label for="inputFileNumber" class="sr-only">编号</label>
        <input type="text" class="form-control" id="inputFileNumber" placeholder="编号">
      </div>
      <div class="form-group col-sm-2">
        <label for="inputFile" class="sr-only">证明文件</label>
        <input type="file" id="inputFile" name="file">
        <p class="help-block">只支持jpg,png,gif文件</p>
      </div>
      <button type="submit" class="btn btn-default">上传</button>
    </form>
    </div>
    <br/>
    <div id="detail">
    </div> 

    
<?php $this->load->view('template/footer') ?>
  </body>
</html>