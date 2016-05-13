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
		function dich(e)
		{
			$('#translation').hide();
			s=getSelectionText();
			if(s!="")
			{
			 //alert(s);
			 //var s=document.getElementById("txt").value;
			 
			 $.ajax({
					url: 'http://www.frengly.com/',		
					data: {
						src: 'en',
						dest: 'vi',
						text: s,
						outformat: 'json',
						email: 'amy.suong93@gmail.com',
						password: "suongnguyen93"
					},			    	    	    
					success: function(data){
						if(data.translation!=undefined)
						{
							var s = getSelectionCoords();
							$('#translated').text(data.translation);
							$('#translation').css({
								    top: s.y	+"px",
	    							left: s.x	+"px",
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

		document.onmouseup =dich;
		document.ondblclick=dich;
	</script>

	<script type="text/javascript">
        function check_longin(e){
            if (e)
            {
                window.location = 'test/dauvao/mini_test';

            }
            else
            {
                alert('Bạn phải đăng nhập trước khi làm bài');
                window.location = 'login/login';
            }
        }

    </script>

	<span id="translation" class="hint-table hint-popover below " style="top: 20px; left: 62px;"><div class="inner "><div class="content"><table><thead>
		<tr></tr></thead><tbody>

		<tr><td id="translated"></td></tr></tbody></table></div></div></span>
	

    