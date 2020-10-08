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
$('.datepicker').datepicker({
weekStart:1,
color: 'red',
startDate: $fromDate,
autoclose: true,
format: 'dd-mm-yyyy',
});


// }).then(function(response){})
// .catch(function(response){});
// $('#deleteit').modal('hide');
// });

});
