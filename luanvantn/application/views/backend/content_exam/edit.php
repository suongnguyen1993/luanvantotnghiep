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
            
                <div class="col-lg-6">
                <h3>Part 1</h3>
                                 </div>
                                 
                    <a href="admin/question/add/<?php echo $exam['id'] ?>" type="button" class="btn btn-success btn-flat" <?php echo isset($show1)?$show1:""; ?>><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add</a>
                                 </div>
                    <thead>
                      <tr>
                        <th>question</th>
                        <th width="150px">level</th>
                        <th style="width: 150px">Created</th>
                        <th style="width: 50px">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                   <?php foreach($question_part1 as $part1)
                   { ?>
                      <tr>
                        <td >
                          <a href="admin/question/update/<?php echo $part1['id'] ?>"><?php if(strlen($part1['content']) > 200 ){
                          echo substr($part1['content'],0,200)."...";
                          } else echo $part1['content'] ?></a>
                        </td>
                        <td >
                          <a href="admin/question/update/<?php echo $part1['id'] ?>"> <?php switch ($part1['level']) {
                          case '1':
                            echo "Easy";
                            break;
                          case '2':
                            echo "Medium";
                            break;
                          case '3':
                            echo "Difficult";
                            break;                        
                        }
                         ?></a>
                        </td>          
                        <td><?php echo $part1['created']?></td>
                        <td>
                          <a href="admin/question/update/<?php echo $part1['id'] ?>"<i class="fa fa-wrench"></i></a>
                          <a onclick="del(<?php echo $part1['id'] ?>)"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr> 
                    <?php } ?>
                                     
                    </tbody>                    
                  </table>
                </div>

              </div>

            <div class="row">
              <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                  <div class="form-group text-right">
                  
                  <div class="col-lg-6">
                  <h3>Part 2</h3>
                </div>

                                 
                    <a href="admin/question/add/<?php echo $exam['id'] ?>" type="button" class="btn btn-success btn-flat" <?php echo isset($show2)?$show2:""; ?>>
                    <span class="glyphicon glyphicon-plus" aria-hidden="true" >
                      
                    </span>Add</a>
                                 </div>
                    <thead>
                      <tr>
                        <th>question</th>
                        <th width="150px">level</th>
                        <th style="width: 150px">Created</th>
                        <th style="width: 50px">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                   <?php foreach($question_part2 as $part2)
                   { ?>
                      <tr>
                        <td >
                          <a href="admin/question/update/<?php echo $part2['id'] ?>"><?php if(strlen($part2['content']) > 200 ){
                          echo substr($part2['content'],0,200)."...";
                          } else echo $part2['content'] ?></a>
                        </td>
                        <td >
                          <a href="admin/question/update/<?php echo $part2['id'] ?>"> <?php switch ($part2['level']) {
                          case '1':
                            echo "Easy";
                            break;
                          case '2':
                            echo "Medium";
                            break;
                          case '3':
                            echo "Difficult";
                            break;                        
                        }
                         ?></a>
                        </td>          
                        <td><?php echo $part2['created']?></td>
                        <td>
                          <a href="admin/question/update/<?php echo $part2['id'] ?>"<i class="fa fa-wrench"></i></a>
                          <a onclick="del(<?php echo $part2['id'] ?>)"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr> 
                    <?php } ?>
                    </tbody>                    
                  </table>
                </div>   
              </div>
            <div class="row">
              <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                  <div class="form-group text-right">
                  
                  <div class="col-lg-6">
                  <h3>Part 3</h3>
                </div>
                <a href="admin/longquestion/add/<?php echo $exam['id'] ?>" type="button" class="btn btn-success btn-flat"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add</a>
                                 </div>
                    <thead>
                       <tr>
                        <th>question</th>
                        <th width="150px">level</th>
                        <th style="width: 150px">Created</th>
                        <th style="width: 50px">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($question_part3 as $part3)
                   { ?>
                      <tr>
                        <td >
                          <a href="admin/question/update/<?php echo $part3['id'] ?>"><?php if(strlen($part3['content']) > 200 ){
                          echo substr($part3['content'],0,200)."...";
                          } else echo $part3['content'] ?></a>
                        </td>
                        <td >
                          <a href="admin/question/update/<?php echo $part3['id'] ?>"> <?php switch ($part3['level']) {
                          case '3':
                            echo "Easy";
                            break;
                          case '2':
                            echo "Medium";
                            break;
                          case '3':
                            echo "Difficult";
                            break;                        
                        }
                         ?></a>
                        </td>          
                        <td><?php echo $part3['created']?></td>
                        <td>
                          <a href="admin/question/update/<?php echo $part3['id'] ?>"<i class="fa fa-wrench"></i></a>
                          <a onclick="del(<?php echo $part3['id'] ?>)"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr> 
                    <?php } ?> 
                    </tbody>                    
                  </table>
                </div>   
              </div>

              <div class="row">
              <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                  <div class="form-group text-right">
                  
                    <div class="col-lg-6">
                    <h3>Part 4</h3>
                   </div>
                    <a href="admin/longquestion/add/<?php echo $exam['id'] ?>" type="button" class="btn btn-success btn-flat"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add</a>
                 </div>
                    <thead>
                       <tr>
                        <th>question</th>
                        <th width="150px">level</th>
                        <th style="width: 150px">Created</th>
                        <th style="width: 50px">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($question_part4 as $part4)
                   { ?>
                      <tr>
                        <td >
                          <a href="admin/question/update/<?php echo $part4['id'] ?>"><?php if(strlen($part4['content']) > 200 ){
                          echo substr($part4['content'],0,200)."...";
                          } else echo $part4['content'] ?></a>
                        </td>
                        <td >
                          <a href="admin/question/update/<?php echo $part4['id'] ?>"> <?php switch ($part4['level']) {
                          case '4':
                            echo "Easy";
                            break;
                          case '2':
                            echo "Medium";
                            break;
                          case '3':
                            echo "Difficult";
                            break;                        
                        }
                         ?></a>
                        </td>          
                        <td><?php echo $part4['created']?></td>
                        <td>
                          <a href="admin/question/update/<?php echo $part4['id'] ?>"<i class="fa fa-wrench"></i></a>
                          <a onclick="del(<?php echo $part4['id'] ?>)"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr> 
                    <?php } ?>      
                    </tbody>                    
                  </table>
                </div>   
              </div>

              <div class="row">
              <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                  <div class="form-group text-right">
                  
                  <div class="col-lg-6">
                  <h3>Part 5</h3>
                 </div>
                <a href="admin/question/add/<?php echo $exam['id'] ?>" type="button" class="btn btn-success btn-flat"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add</a>
                                 </div>
                    <thead>
                      <tr>
                        <th>question</th>
                        <th width="150px">level</th>
                        <th style="width: 150px">Created</th>
                        <th style="width: 50px">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($question_part5 as $part5)
                   { ?>
                      <tr>
                        <td >
                          <a href="admin/question/update/<?php echo $part5['id'] ?>"><?php if(strlen($part5['content']) > 200 ){
                          echo substr($part5['content'],0,200)."...";
                          } else echo $part5['content'] ?></a>
                        </td>
                        <td >
                          <a href="admin/question/update/<?php echo $part5['id'] ?>"> <?php switch ($part5['level']) {
                          case '5':
                            echo "Easy";
                            break;
                          case '2':
                            echo "Medium";
                            break;
                          case '3':
                            echo "Difficult";
                            break;                        
                        }
                         ?></a>
                        </td>          
                        <td><?php echo $part5['created']?></td>
                        <td>
                          <a href="admin/question/update/<?php echo $part5['id'] ?>"<i class="fa fa-wrench"></i></a>
                          <a onclick="del(<?php echo $part5['id'] ?>)"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr> 
                    <?php } ?>    
                    </tbody>                    
                  </table>
                </div>   
              </div>

              <div class="row">
              <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                  <div class="form-group text-right">
                  
                  <div class="col-lg-6">
                  <h3>Part 6</h3>
                 </div>
                    <a href="admin/longquestion/add/<?php echo $exam['id'] ?>" type="button" class="btn btn-success btn-flat"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add</a>
                 </div>
                    <thead>
                      <tr>
                        <th>question</th>
                        <th width="150px">level</th>
                        <th style="width: 150px">Created</th>
                        <th style="width: 50px">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($question_part6 as $part6)
                   { ?>
                      <tr>
                        <td >
                          <a href="admin/question/update/<?php echo $part6['id'] ?>"><?php if(strlen($part6['content']) > 200 ){
                          echo substr($part6['content'],0,200)."...";
                          } else echo $part6['content'] ?></a>
                        </td>
                        <td >
                          <a href="admin/question/update/<?php echo $part6['id'] ?>"> <?php switch ($part6['level']) {
                          case '6':
                            echo "Easy";
                            break;
                          case '2':
                            echo "Medium";
                            break;
                          case '3':
                            echo "Difficult";
                            break;                        
                        }
                         ?></a>
                        </td>          
                        <td><?php echo $part6['created']?></td>
                        <td>
                          <a href="admin/question/update/<?php echo $part6['id'] ?>"<i class="fa fa-wrench"></i></a>
                          <a onclick="del(<?php echo $part6['id'] ?>)"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr> 
                    <?php } ?>       
                  </table>
                </div>   
              </div>
              <div class="row">
              <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                  <div class="form-group text-right">
                  
                  <div class="col-lg-6">
                  <h3>Part 7</h3>
                 </div>
                    <a href="admin/longquestion/add/<?php echo $exam['id'] ?>" type="button" class="btn btn-success btn-flat"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add</a>
                 </div>
                    <thead>
                       <tr>
                        <th>question</th>
                        <th width="150px">level</th>
                        <th style="width: 150px">Created</th>
                        <th style="width: 50px">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                   <?php foreach($question_part7 as $part7)
                   { ?>
                      <tr>
                        <td >
                          <a href="admin/question/update/<?php echo $part7['id'] ?>"><?php if(strlen($part7['content']) > 200 ){
                          echo substr($part7['content'],0,200)."...";
                          } else echo $part7['content'] ?></a>
                        </td>
                        <td >
                          <a href="admin/question/update/<?php echo $part7['id'] ?>"> <?php switch ($part7['level']) {
                          case '1':
                            echo "Easy";
                            break;
                          case '2':
                            echo "Medium";
                            break;
                          case '3':
                            echo "Difficult";
                            break;                        
                        }
                         ?></a>
                        </td>          
                        <td><?php echo $part7['created']?></td>
                        <td>
                          <a href="admin/question/update/<?php echo $part7['id'] ?>"<i class="fa fa-wrench"></i></a>
                          <a onclick="del(<?php echo $part7['id'] ?>)"><i class="fa fa-trash"></i></a>
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
        var msg = "Are you sure to delete this question?";
        var baseurl = "<?php echo base_url(); ?>";
        if(confirm(msg))
        {
            window.location = baseurl + "admin/question/delete/" + id;
        }
     }
   </script>