<script type="text/javascript" src="<?php echo base_url(); ?>/public/user/js/countdown/dist/jquery.countdown.js"></script>

    <script type="text/javascript">
      $(document).ready(function(){

        function get2hoursFromNow(){
          return new Date(new Date().valueOf() + 0.01 * 60 * 60 * 1000);
        }

        $('div#clock').countdown(get2hoursFromNow(), function(event){
          $(this).html(event.strftime('%H:%M:%S'));
          
        });
      });
    </script>