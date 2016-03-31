<?php echo isset($error)?$error:""; ?>

<section class="content">
          <div class="row">
            <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                  <div class="form-group text-right">
                  <form id="search-admin" method="post" action="" enctype="multipart/form-data">
                    <div class="col-lg-6">
                      <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search for username">
                        <span class="input-group-btn">
                          <button class="btn btn-default" type="submit">Go!</button>
                        </span>
                      </div><!-- /input-group -->
                    </div>
                  </form>

                       <a href="admin/admin/add" type="button" class="btn btn-success btn-flat"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add</a>
                  </div>
                    <thead>
                      <tr>
                        <th>Full name</th>
                        <th>Username</th>
                        <th>Email</th>                        
                        <th style="width: 150px">Created</th>
                        <th style="width: 50px">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($admin as $u)
                      {
                     ?>
                      <tr>
                        <td width="300px">
                        <a href="admin/admin/update/<?php echo $u['id'] ?>"><?php if(strlen($u['fullname']) > 80 ){
                          echo substr($u['fullname'],0,80)."...";
                          } else echo $u['fullname'] ?></a>
                        </td>
                        <td>
                        <a href="admin/admin/update/<?php echo $u['id'] ?>"><?php if(strlen($u['username']) > 30 ){
                          echo substr($u['username'],0,30)."...";
                          } else echo $u['username'] ?></a>
                        </td>
                        <td>
                        <a href="mailto: <?php echo $u['email']; ?>"><?php if(strlen($u['email']) > 60 ){
                          echo substr($u['email'],0,60)."...";
                          } else echo $u['email'] ?></a>
                        </td>
                        
                        <td><?php echo $u['created']; ?></td>
                        <td>
                          <a href="admin/admin/update/<?php echo $u['id']; ?>"><i class="fa fa-wrench"></i></a>
                          <a onclick="del(<?php echo $u['id'] ?>)"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr> 
                      <?php } ?>                   
                    </tbody>                    
                  </table>
                </div>
              </div>

   <?php echo (isset($list_pagination))?$list_pagination:""; ?>
   <script type="text/javascript">
     function del(id){
        var msg = "Are you sure to delete this question ?";
        var baseurl = "<?php echo base_url(); ?>";
        if(confirm(msg))
        {
            window.location = baseurl + "admin/admin/delete/" + id;
        }
     }
   </script>