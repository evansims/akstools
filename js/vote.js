// handle clicking of buttons in the admin matches area
$(document).ready(function(){
  $('.voteUp').click(function(){
  	$.get('voteUp.php', { recruitID: $(this).attr('id')} )
  	.success(function() {alert('voted up'); })
  	.error(function() {alert('error with vote'); });
  })
});

$(document).ready(function(){
  $('.voteDown').click(function(){
  	$.get('voteDown.php', { recruitID: $(this).attr('id')} )
  	.success(function() {alert('voted down'); })
  	.error(function() {alert('error with vote'); });
  })
});