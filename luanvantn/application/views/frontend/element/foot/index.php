	<!-- jQuery -->
	<script type="text/javascript" src="<?php echo base_url(); ?>/public/user/js/jquery.js"></script>
	<!-- bootstrap.min -->
    <script type="text/javascript" src="<?php echo base_url(); ?>/public/user/js/bootstrap.min.js"></script>
	<!-- lightbox -->
    <script type="text/javascript" src="<?php echo base_url(); ?>/public/user/js/lightbox.min.js"></script>
	<!-- wow.min -->
    <script type="text/javascript" src="<?php echo base_url(); ?>/public/user/js/wow.min.js"></script>
	<!--main -->
    <script type="text/javascript" src="<?php echo base_url(); ?>/public/user/js/main.js"></script>
    <!-- dich nghia tu vựng -->
    <script language="javascript">
    	var clickingSaved = false;

    	var selectedText = '';
    	var translatedText = '';
    	

		function dich(e)
		{
			if(clickingSaved) return;


			$('#translation').hide();
			s=getSelectionText();
			if(s != "")
			{

			 $.ajax({
					url: '/luanvantotnghiep/luanvantn/translate/translate/index/'+s,		
					data: {},			    	    	    
					success: function(data){
						if(data!=undefined)
						{
							selectedText = s;
							translatedText = data;
							var ss = getSelectionCoords();
							$('#translated').text(data);
							$('#translation').css({
								    top: ss.y	+"px",
	    							left: ss.x	+"px",
	    							display: "block"
							});
						}	    
						//alert(data.translation);
						//$('#responseDiv').html(data.text+' = '+data.translation);
					},
					error: function (errormessage) {
						$('#responseDiv').html(errormessage);
					}
				});
				}
		}
		function getSelectionText() {
		    var text = "";
		    if (window.getSelection) {
		        text = window.getSelection().toString();
		    } else if (document.selection && document.selection.type != "Control") {
		        text = document.selection.createRange().text;
		    }
		    return text;
		}

		function getSelectionCoords() {
		     var r=window.getSelection().getRangeAt(0).getBoundingClientRect();
    		 var relative=document.body.parentNode.getBoundingClientRect();
		     return { y: r.bottom -relative.top, 
		    		 x: r.left -relative.left 
		    	   };
		}

		$(document).ready(function(){
			$('#btnSaved').click(function(){
    			
    			if(selectedText != "" && translatedText !="")
    			{
    				clickingSaved = true;
    				url = '';
	    			$.get(url,function(result){
						if(result == 1)
						{
							alert('Luu thanh cong');
						}
						else
						{
							alert('Luu that bai');
						}
						clickingSaved = false;	
					});
    			}
    

    			
    		});
    		document.onmouseup =dich;
			document.ondblclick=dich;
		});

		
	</script>

	<span id="translation" class="hint-table hint-popover below " style="top: 20px; left: 62px;"><div class="inner "><div class="content"><table><thead>
		<tr></tr></thead><tbody>

		<tr><td id="translated"></td></tr></tbody></table>

		<div id="saved" class="toolbar"><button id="btnSaved" type="button" class="btn btn-sx btn-primary">Luu</button></div>
		</div></div></span>
	
	<script type="text/javascript" >
		$('.check_login').click(function(){
			var href = $(this).data('href');
			var url = '<?php echo base_url() ?>' + 'login/login/check_login';
			$.get(url,function(result){
				if(result == 1)
				{
					window.location = href;
				}
				else
				{
					if(confirm('Ban chua dang nhap, ban co muon qua trang dang nhap ?'))
					{
						window.location = 'login/login';
					}
				}
			});
		});
	</script>
    