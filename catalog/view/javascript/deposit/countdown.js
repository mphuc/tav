 $(function() {
    $('[data-countdown]').each(function() {
         var $this = $(this), finalDate = $(this).data('countdown');
            $this.countdown(finalDate, function(event) {
            $this.html(event.strftime('<span style="color:red; font-size:18px;">%M:%S</span>'));
            
        });
    });
 });
