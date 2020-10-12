$(document).ready(function(){

  $('.btn-deleteit').click(function(){
    $('#deleteit').find('form').attr('action',$(this).attr('data-route'))
    $('#deleteit').modal('show');
    $(this).closest('tr').addClass('active');
  });

  $('.btn-openit').click(function(){
    $('#openit').modal('show');
    $(this).closest('tr').addClass('active');
  });

  $('.btn-addit').click(function(){
    $('#addit').modal('show');
  });



$fromDate = new Date();
$('.datepickeryOUNES').datepicker({
weekStart:1,
color: 'red',
startDate: $fromDate,
autoclose: true,
format: 'dd/mm/yyyy',
language: 'nl',
days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"],
months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
monthsShort: ["Jel", "Bur", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
});


// }).then(function(response){})
// .catch(function(response){});
// $('#deleteit').modal('hide');
// });

});
