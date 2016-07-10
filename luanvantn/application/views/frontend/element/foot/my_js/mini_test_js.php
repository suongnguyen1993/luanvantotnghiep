<script type="text/javascript" src="<?php echo base_url(); ?>public/user/js/countdown/dist/jquery.countdown.js"></script>

    <script type="text/javascript">
      $(document).ready(function(){
        var countdownFnc = function(){
            $('div#clock').countdown(get2hoursFromNow(), function(event){
              $miliSecond = event.finalDate.getTime()-event.timeStamp;
              if($miliSecond > 60000)
              {
                // $(this).html(event.strftime('%H:%M')); 
                $(this).html(event.strftime('%H:%M:%S')); 
              }
              else
              {
                if($miliSecond > 10000)
                {
                  $(this).html(event.strftime('%H:%M:%S'));
                }
                else
                {
                  $(this).html(event.strftime('%H:%M:%S')).addClass('closeToFinish');
                }
                 
              }
              
              if(event.type=='finish')
              {
                  $('#form-fulltest').submit();
              }
            });
        }

        // đồng hồ đếm ngược 2h
        function get2hoursFromNow(){
          return new Date(new Date().valueOf() + 1 * 60 * 60 * 1000);
          // return new Date(new Date().valueOf() +  12 * 1000);
        }

        if(!__submit)
        {

          $('#ready').modal('show');
          $('#turnbackBtn').click(function(){
              window.location = 'index';
          });
          $('button[aria-label="Close"]').click(function(){
              window.location = 'index';
          });
          $('input[type="submit"]').click(function(){
           
              if(confirm('Vẫn còn thời gian làm bài, bạn có chắc muốn hoàn thành bài thi không?'))
              {
                 $('#form-fulltest').submit();  
              }
              return false;
          });
          $('#okBtn').click(function(){
              $('#ready').modal('hide');
              
              countdownFnc();
          });
        }
        //end đếm ngược


        //lấy vị trí y của đồng hồ
        var offsetYOfClock = $('#fix-clock').offset().top||0;

        //bắt sự kiện thanh trượt
        $(window).scroll(function(){
            if(offsetYOfClock > window.scrollY)
            {
              $('#fix-clock').removeClass('fixed-clock');                
            }
            else
            {
              $('#fix-clock').addClass('fixed-clock');
            }
        });
        //end sự kiện thanh trượt

      });

      //Sau khi submit, se hien bang Modal thong bao ra
      if(__submit)
      {
        $(window).load(function(){
          $('#myModal').modal('show');
        });
      }
    </script>