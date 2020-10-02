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

// }).then(function(response){})
// .catch(function(response){});
// $('#deleteit').modal('hide');
// });

});
