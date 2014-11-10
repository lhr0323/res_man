
    <script type="text/javascript">
    $(document).ready(function()
    {
      $("table tr:gt(0)").click(function()
      {
          var index = $(event.target).index(); //列索引
          var current_mode = $("#currentMode").text();
          if(current_mode == 0)
          {
            return;
          }else if(current_mode == 2)
          {
            var data = { id: $(event.target).parent().children().first().html() };
            $.post("<?=site_url('cooperationmanage/delete')?>",data,function(res,status)
            {
              $("#refresh_list").click();
              alert(res);
            });
            return;
          }else if(current_mode == 1)
          {
            var colname = $(event.target).parent().parent().children().first().children().eq(index).html();//列名
            var value = $(event.target).text();
            var result = prompt("请输入新的"+colname+":",value);
            if(result == "" || result== null) //取消 输入为空 则不修改
              return;
            var opid = $(event.target).parent().children().first().html();
            if(index == 1)
            {
              var data={ id: opid, category: result, which: 'category' };
            }else if(index == 2)
            {
              var data={ id: opid, list: result, which: 'list' };
            }else if(index == 3)
            {
              var data={ id: opid, number: result, which: 'number' };
            }else if(index == 4)
            {
              var data={ id: opid, start: result, which: 'start' };
            }else if(index == 5)
            {
              var data={ id: opid, end: result, which: 'end' };
            }else if(index == 6)
            {
              var data={ id: opid, place: result, which: 'place' };
            }else if(index == 7)
            {
              var data={ id: opid, purpose: result, which: 'purpose' };
            }else if(index == 8)
            {
              var data={ id: opid, report: result, which: 'report' };
            }else if(index == 9)
            {
              var data={ id: opid, url: result, which: 'url' };
            }else if(index == 10)
            {
              var data={ id: opid, news: result, which: 'news' };
            }else if(index == 11)
            {
              var data={ id: opid, picture: result, which: 'picture' };
            }

            $.post("<?=site_url('cooperationmanage/modify')?>",data,function(res,status)
            {
              $("#refresh_list").click();
              alert(res);
            });
          }
      });
    });
    </script>

      <table class="table table-striped table-hover">
        <tbody>
        <tr>
          <td hidden>编号</td>
          <td>类别</td>
          <td>人员清单</td>
          <td>人数</td>
          <td>开始时间</td>
          <td>结束时间</td>
          <td>来访／目的地</td>
          <td>访问目的</td>
          <td>报告名称</td>
          <td>链接</td>
          <td>新闻报道</td>
          <td>照片保留</td>
        </tr>
      <?php foreach($cooperation as $item):?>
        <tr>
          <td hidden><?=$item->id?></td>
          <td><?=$item->category?></td>
          <td><?=$item->list?></td>
          <td><?=$item->number?></td>
          <td><?=$item->start?></td>
          <td><?=$item->end?></td>
          <td><?=$item->place?></td>
          <td><?=$item->purpose?></td>
          <td><?=$item->report?></td>
          <td><?=$item->url?></td>
          <td><?=$item->news?></td>
          <td><?=$item->picture?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
      </table>
