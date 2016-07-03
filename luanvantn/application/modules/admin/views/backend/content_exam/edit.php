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
                          <a href="admin/question/update/<?php echo $part1['id'] ?>"> <?php echo $part1['level']
    
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
                          <a href="admin/question/update/<?php echo $part2['id'] ?>"> <?php echo $part1['level']?></a>
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
                <a href="admin/longquestion/add/<?php echo $exam['id'] ?>" type="button" class="btn btn-success btn-flat" <?php echo isset($show3)?$show3:""; ?>> <span class="glyphicon glyphicon-plus" aria-hidden="true">Add</span></a>
                                 </div><thead>
                       <tr>
                        <th>Question</th>
                        <<th>Level</th>
                        <th style="width: 50px">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($question_part3 as $part3)
                   { ?>
                      <tr>
                        <td >
                          <a href="admin/longquestion/update/<?php echo $part3['id'] ?>">
                          <?php if(strlen($part3['long_content']) > 200 ){
                          echo substr($part3['long_content'],0,200)."...";
                          } else echo $part3['long_content'] ?></a>
                        </td>
                                
                         <td >
                          <a href="admin/longquestion/update/<?php echo $part3['id'] ?>"> <?php echo $part3['level']?></a>
                        </td> 
                        <td>
                          <a href="admin/longquestion/update/<?php echo $part3['id'] ?>"<i class="fa fa-wrench"></i></a>
                          <a onclick="long_del(<?php echo $part3['id'] ?>)"><i class="fa fa-trash"></i></a>
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
                    <a href="admin/longquestion/add/<?php echo $exam['id'] ?>" type="button" class="btn btn-success btn-flat" <?php echo isset($show4)?$show4:""; ?>><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add</a>
                 </div>
                    <thead>
                       <tr>
                        <th>question</th>
                        <th style="width: 50px">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($question_part4 as $part4)
                   { ?>
                      <tr>
                        <td >
                          <a href="admin/longquestion/update/<?php echo $part4['id'] ?>"><?php if(strlen($part4['long_content']) > 200 ){
                          echo substr($part4['long_content'],0,200)."...";
                          } else echo $part4['long_content'] ?></a>
                        </td>         
                        <td>
                          <a href="admin/longquestion/update/<?php echo $part4['id'] ?>"<i class="fa fa-wrench"></i></a>
                          <a onclick="long_del(<?php echo $part4['id'] ?>)"><i class="fa fa-trash"></i></a>
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
                          <a href="admin/question/update/<?php echo $part5['id'] ?>"> <?php echo $part5['level'] ?></a>
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
                        <th>Long question</th>
                        <th style="width: 50px">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($question_part6 as $part6)
                   { ?>
                      <tr>
                        <td >
                          <a href="admin/longquestion/update/<?php echo $part6['id'] ?>"><?php if(strlen($part6['long_content']) > 200 ){
                          echo substr($part6['long_content'],0,200)."...";
                          } else echo $part6['long_content'] ?></a>
                        </td>   
                        <td>
                          <a href="admin/question/update/<?php echo $part6['id'] ?>"<i class="fa fa-wrench"></i></a>
                          <a onclick="long_del(<?php echo $part6['id'] ?>)"><i class="fa fa-trash"></i></a>
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
                        <th>Long question</th>
                        <th>Number Question</th>
                        <th style="width: 50px">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                   <?php foreach($question_part7 as $part7)
                   { ?>
                      <tr>
                        <td >
                          <a href="admin/longquestion/update/<?php echo $part7['id'] ?>"><?php if(strlen($part7['long_content']) > 200 ){
                          echo substr($part7['long_content'],0,200)."...";
                          } else echo $part7['long_content'] ?></a>
                        </td>
                        <td>
                           <a href="admin/longquestion/update/<?php echo $part7['id'] ?>"><?php echo $part7['number_question'] ?></a>
                        </td>
                        <td>
                          <a href="admin/question/update/<?php echo $part7['id'] ?>"<i class="fa fa-wrench"></i></a>
                          <a onclick="long_del(<?php echo $part7['id'] ?>)"><i class="fa fa-trash"></i></a>
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
     function long_del(id){
        var msg = "Are you sure to delete this long question?";
        var baseurl = "<?php echo base_url(); ?>";
        if(confirm(msg))
        {
            window.location = baseurl + "admin/longquestion/delete/" + id;
        }
     }
   </script>