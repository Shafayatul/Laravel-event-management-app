/**
* AJAX TUTORIAL
*/
$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});


$( document ).ready(function() {
    $('.admin-status-change').click(function(){
    	var id = $(this).attr("id");
    	var currentType = $(this).attr("current-type");
    	var myJsonData = {id: id, currentType: currentType}
		$.post('/users/postAjaxChangeStatus', myJsonData, function(response) {
			if(response.data=="success"){
				location.reload();
			}else{
				alert(response.data);
			}
		});
    });
    $('.admin-delete').click(function(){
    	var id = $(this).attr("id");
    	var myJsonData = {id: id}
		$.post('/users/postAjaxDelete', myJsonData, function(response) {
			if(response.data=="success"){
				$('#row-'+id).remove();
			}else{
				alert(response.data);
			}
		});
    });

    $('.event-delete').click(function(){
      var id = $(this).attr("id");

      var myJsonData = {id: id}
      $.post('/events/postAjaxDelete', myJsonData, function(response) {
        if(response.data=="success"){
          $('#row-'+id).remove();
        }else{
          alert(response.data);
        }
      });
    });  

    
    $('.delegate-delete').click(function(){
      var id = $(this).attr("id");

      var myJsonData = {id: id}
      $.post('/delegates/postAjaxDelete', myJsonData, function(response) {
        if(response.data=="success"){
          $('#row-'+id).remove();
        }else{
          alert(response.data);
        }
      });
    });  

    
    $('.pass-delete').click(function(){
      var id = $(this).attr("id");
      var myJsonData = {id: id}
      $.post('/passes/postAjaxDelete', myJsonData, function(response) {
        if(response.data=="success"){
          $('#row-'+id).remove();
        }else{
          alert(response.data);
        }
      });
    });  

    
    $('.event-admin-change').click(function(){
      var user_id = $(this).attr("user-id");
      var current_status = $(this).attr("current-status");
      var event_id = $(this).attr("event-id");
      var myJsonData = {user_id: user_id, current_status: current_status, event_id: event_id};
      $.post('/events/changeAdmin', myJsonData, function(response) {
        if(response.data=="success"){
          location.reload();
        }else{
          alert(response.data);
        }
      });
    });  


    
    $('.check-in').click(function(){
      var id = $(this).attr("id");
      var myJsonData = {id: id};
      $.post('/bookings/checkedIn', myJsonData, function(response) {
        if(response.data=="success"){
          $('#action-'+id).html('<span class="label label-success">Checked In</span>');
          //change number at the top
          $("#delegates_sign_in").text(parseInt($("#delegates_sign_in").text())+1);
          $("#delegates_pending").text(parseInt($("#delegates_pending").text())-1);

        }else{
          alert(response.data);
        }
      });
    });  


    
    $('.check-out').click(function(){
      var id = $(this).attr("id");
      var myJsonData = {id: id};
      $.post('/bookings/checkedOut', myJsonData, function(response) {
        if(response.data=="success"){
          $('#action-'+id).html('<span class="label label-danger">Checked Out</span>');
        }else{
          alert(response.data);
        }
      });
    });  



    
    $('.pass_change').change(function(){
      var id = $(this).val();
      var myJsonData = {id: id};
      $.post('/passes/passAmount', myJsonData, function(response) {
        $('.pass_amount').val(response.data);
      });
    });  



    // tooltip
    $('[data-toggle="tooltip"]').tooltip(); 


});