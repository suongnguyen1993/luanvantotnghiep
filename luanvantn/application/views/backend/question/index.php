<?php 
echo isset($error)?$error:""; ?>
<section class="content">
          <div class="row">
            <div class="col-xs-12">
            <div class="box">
              <!-- <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Hover Data Table</h3>
                </div> --><!-- /.box-header -->
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                  <div class="form-group text-right">
                  <form id="search-admin" method="post" action="" enctype="multipart/form-data">
                    <div class="col-lg-6">
                      <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search for question">
                        <span class="input-group-btn">
                          <button class="btn btn-default" type="submit">Go!</button>
                        </span>
                      </div><!-- /input-group -->
                    </div>
                  </form>
                                   
                       <a href="admin/question/add" type="button" class="btn btn-success btn-flat"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add</a>                  
                  </div>
                    <thead>
                      <tr>
                        <th>Question</th>
                        <th>Level</th>
                        <th>Image</th>
                        <th>Audio</th>
                        <th style="width: 150px">Created</th>
                        <th style="width: 50px">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($question as $q)
                        { 
                      ?>
                      <tr>
                        <td width="440px">
                        <a href="admin/question/update/<?php echo $q['id'] ?>"><?php if(strlen($q['content']) > 60 ){
                          echo substr($q['content'],0,60)."...";
                          } else echo $q['content'] ?></a>
                        </td>
                        <td><?php echo $q['level'] ?></td>
                        <td><?php echo $q['image'] ?></td>
                        <td><?php echo $q['audio'] ?></td>
                        <td><?php echo $q['created'] ?></td>
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