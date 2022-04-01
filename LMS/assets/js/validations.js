var elapsedTime = 0;
jQuery(function() {
  if (jQuery('#exam-time-left').length && EXAM_TIME_LEFT) 
  {
    updateExamTimer();  
  }
});

function updateExamTimer() 
{
  var timeLeft = EXAM_TIME_LEFT - elapsedTime;
  elapsedTime += 1;
  var minutes = Math.floor(timeLeft / 60);
  var seconds = timeLeft % 60;
  var hours = Math.floor(minutes / 60);
  var minutes = minutes % 60;

  if (hours < 10) { hours = '0' + hours; }
  if (minutes < 10) { minutes = '0' + minutes; }
  if (seconds < 10) { seconds = '0' + seconds; }
  if (timeLeft <= 0) 
  {
    alert('El tiempo ha finalizado, seras redireccionado a los examenes en linea');
    $('#subbutton').trigger('click');
  } 
  else 
  {
    jQuery('#exam-time-left').val(hours + ':' + minutes + ':' + seconds);
    setTimeout('updateExamTimer()', 1000);
  }
}