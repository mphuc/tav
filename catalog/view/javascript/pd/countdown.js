 $(function() {
    $('[data-countdown]').each(function() {
         var $this = $(this), finalDate = $(this).data('countdown');
            $this.countdown(finalDate, function(event) {
            $this.html(event.strftime('<div class="countdown-section"> <div class="countdown-amount">%D</div> <div class="countdown-period">Days</div> </div> <div class="countdown-section sep"> : </div> <div class="countdown-section"> <div class="countdown-amount">%H</div> <div class="countdown-period">Hours</div> </div> <div class="countdown-section sep"> : </div> <div class="countdown-section"> <div class="countdown-amount">%M</div> <div class="countdown-period">Minutes</div> </div><div class="countdown-section sep"> : </div><div class="countdown-section"> <div class="countdown-amount">%S</div> <div class="countdown-period">Second</div> </div>'));
            
        });
    });
 });
