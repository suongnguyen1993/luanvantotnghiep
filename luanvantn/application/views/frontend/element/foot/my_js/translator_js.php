<script language="javascript">
    	

    	var selectedText = '';
    	var translatedText = '';
    	

		function dich(e)
		{
			


			$('#translation').hide();
			s=getSelectionText();
			if(s != "")
			{

			 $.ajax({
					url: '<?php base_url() ?>translate/translate/index/'+s,		
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
    				url = '<?php base_url() ?>vocabulary/voca/index/'+ selectedText +'/'+ translatedText;
    				alert(url);
    				
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

		<div id="saved" class="toolbar"><button id="btnSaved" type="button" class="btn btn-sx btn-primary">Lưu</button></div>
		</div></div></span>