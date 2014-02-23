// handle clicking of buttons in the admin matches area
$(document).ready(function(){
  $('.approve').click(function(){
  	$.get('ad_approve.php', { recruitID: $(this).attr('id')} )
  	.success(function() {alert('recruit approved'); })
  	.error(function() {alert('recruit approve fail'); });
  })
});

$(document).ready(function(){
  $('.reject').click(function(){
  	$.get('ad_reject.php', { recruitID: $(this).attr('id')} )
  	.success(function() {alert('recruit rejected'); })
  	.error(function() {alert('recruit reject fail'); });
  })
});

$(document).ready(function(){
  $('.neutral').click(function(){
    $.get('ad_neutral.php', { recruitID: $(this).attr('id')} )
    .success(function() {alert('recruit neutral dismissed'); })
    .error(function() {alert('recruit neutral fail'); });
  })
});