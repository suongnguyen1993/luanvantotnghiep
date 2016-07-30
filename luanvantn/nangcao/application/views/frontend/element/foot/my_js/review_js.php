<script type="text/javascript">
    	var del = function(id)
        {
    		if(!isNaN(id) && id < 1)
    		{
    			alert("id khong hop le");
    		}

    		if(confirm("Bạn có chắc muốn xóa từ này?"))
    		{
    			//fadeOut tao hieu ung tu tu bien mat
    			//Bat su kien sau khi bien mat, thi xoa luon cai the do
    			$.get('<?php echo base_url() ?>/vocabulary/voca/delete_tudien/'+id, function(result){
    				if(result == 1)
    				{
    					$("#wpFocus"+id).fadeOut('slow', function(){
	    				$(this).remove();
	    				});
    				}
    				else
    				{
    					alert("Xóa không thành công!");
    				}
    			})
    		}
    	}
    </script>