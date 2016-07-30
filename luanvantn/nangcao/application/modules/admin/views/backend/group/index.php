<?php if(isset($error) && $error==1){ ?>
<div class="alert alert-success alert-dismissable text-center" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>Add success!</strong>
</div>
<?php }?>
<?php if(isset($error) && $error==2){ ?>
<div class="alert alert-success alert-dismissable text-center" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>Update success!</strong>
</div>
<?php }?>
<?php if(isset($error) && $error==3){ ?>
<div class="alert alert-success alert-dismissable text-center" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>Delete success!</strong>
</div>
<?php }?>
<section class="content">
          <div class="row">
            <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                  <div class="form-group text-right">
                       <a href="admin/group/add" type="button" class="btn btn-success btn-flat"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add</a>
                  </div>
                    <thead>
                      <tr>
                        <th>Group name</th>
                        <th style="width: 150px">Created</th>
                        <th style="width: 50px">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($group as $u)
                      {
                     ?>
                      <tr>
                        <td>
                        <a href="admin/group/update/<?php echo $u['id'] ?>"><?php echo $u['name']; ?></a>
                        </td>
                        <td>
                        <a href="admin/group/update/<?php echo $u['id'] ?>"><?php echo $u['created']; ?></a>
                        </td>
                        
                        <td>
                          <a href="admin/group/update/<?php echo $u['id']; ?>"><i class="fa fa-wrench"></i></a>
                          <a onclick="del(<?php echo $u['id'] ?>)"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr> 
                      <?php } ?>                   
                    </tbody>                    
                  </table>
                </div>
              </div>

  <!--   <ul class="pagination">
    <li class="disabled"><a href="#">«</a></li>
    <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li><a href="#">»</a></li>
     </ul> -->
     <?php echo $list_pagination ?>
   <script type="text/javascript">
     function del(id){
        var msg = "Are you sure to delete this group ?";
        var baseurl = "<?php echo base_url(); ?>";
        if(confirm(msg))
        {
            window.location = baseurl + "admin/group/delete/" + id;
        }
     }
   </script>