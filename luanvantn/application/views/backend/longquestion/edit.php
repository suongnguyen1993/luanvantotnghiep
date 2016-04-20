<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
  <?php echo validation_errors()?>
  <form id="frm-admin" method="post" action="">
                    
            <div class="box box-info">
                 <div class="box-header">
                 <h3 class="box-title">Long Question</h3>                  
                </div>
                <div class="box-body pad">
                    <textarea id="long_content" name="long_content" rows="10" cols="80" placeholder='Add long question'><?php echo $long_question['long_content'] ?></textarea>
                </div>
                </div>
                    <div class="form-group text-right">
                      <button type="submit" class="btn btn-success btn-flat"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Save</button>
                      <button type="reset" class="btn btn-success btn-flat reset"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Reset</button>
                      <a href="admin/longquestion/index" class="btn btn-success"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Return</a>
                    </div>     
  </form>
</div>
<section class="content">
          <div class="row">
            <div class="col-xs-9">
            <div class="box-header">
                       <h4 class="box-title">List Question</h4>
                                    <!-- tools box -->                       
            </div>
            <div class="box">
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                  <div class="form-group text-right">
                       <a href="admin/question/add" type="button" class="btn btn-success btn-flat"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add</a>                  
                  </div>
                    <thead>
                      <tr>
                        <th>Question</th>                        
                        <th style="width: 50px">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($question as $q)
                        { 
                      ?>                      
                      <tr>
                      
                        <td width="440px">
                        <a href="admin/question/update/<?php echo $q['id'] ?>"><?php echo $q['content'] ?></a>
                        </td>
                        
                        <td>
                        <a href="admin/question/update/<?php echo $q['id'] ?>"><i class="fa fa-wrench"></i></a>
                          <a onclick="del(<?php echo $q['id'] ?>)"><i class="fa fa-trash"></i></a>
                        </td>
                       
                      </tr>
                        <?php } ?>      
                    </tbody>                    
                  </table>
                </div>
              </div>

    <?php echo (isset($list_pagination))?$list_pagination:"" ?>
   <script type="text/javascript">
     function del(id){
        var msg = "Are you sure to delete this question ?";
        var baseurl = "";
        if(confirm(msg))
        {
            window.location = baseurl + "admin/question/delete/" + id;
        }
     }
   </script>