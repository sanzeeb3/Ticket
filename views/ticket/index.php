
<div class="container">
    <div class="row">
        <div class="col-sm-5">
            <form class="formclass" method="POST" action="<?php echo Yii::$app->request->baseUrl;?>/ticket/book/" role="form" id="register-form" >

                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Welcome!</strong> Fill up the details to book a ticket.
                </div>

                <label>Name:</label><input type="name" class="form-control" name="name" id="name" placeholder="Name"><br><br>
                <label>Contact Number:</label><input type="text" class="form-control" name="contact" id="contact" placeholder="Contact Number"><br><br>

                <label>Ticket Type:</label><br>
                <select id="type" class="form-control">
                    <option value="">--Select ticket type--<br>
                    <option value="1">Business<br>
                    <option value="2">Economy<br><br><br>                                  
                </select>  <br><br>
                <label>Flight Date:</label><input type="date" class="form-control" name="flightdate" id="flightdate" placeholder="Flight Date"><br><br>


                <label>Seats Available:</label><br>
                <div id="info"><i>Select Ticket Type and Flight Date</i></div>                    
                        <select name="seats[]" class="multiselect" id="seats" multiple>
                        </select><br><br>

                <label>Registration:</label>
                <div class="thumbnail">
                    This field is particularly important if you want to cancel the tickets, delay the flight date and for information about flight, weather. Use these credidentals to login and get full features.<br><br>
                    <label>Username:</label><input type="name" class="form-control" name="username" id="username" placeholder="Username"><br>
                    <label>Password:</label><input type="password" class="form-control" name="password" id="password" placeholder="Password"><br>
                </div>
                <button type="submit" class="btn btn-info">Book</button>
            </form>
        </div>
    </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Hurry up!! Hurry Up!!</h4>
            </div>
            <div class="modal-body">
                <p>Book Now. Do good, be good.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>

$(window).load(function(){
        $('#myModal').modal('show');
});


$(document).on('click', '.close', function (e) 
{         
    e.preventDefault();
    $('.alert').remove();
           
});


$('#seats').hide();
$("#type, #flightdate").change(function (e) {
  
   $.ajax({
        type:"POST",
        url:"<?php echo Yii::$app->request->baseUrl;?>/ticket/getseats",
        data:{  type:$("#type").val(),
                flightdate:$("#flightdate").val()
             },
        
        success: function(response){
            var res=$.parseJSON(response);
            if(res.status == true)
            {
                var seat='';

                for(var i=0;  i<res.getseats.length;  i++) 
                {                    
                    seat += '<option value='+res.getseats[i].seat_id+'>'+res.getseats[i].seat+'</option>';

                    $('#seats').html(seat); 
                    $('#seats').show(); 
                    $('#info').hide(); 
                }
                    $('.multiselect').selectpicker('refresh');
            }
            else
            {
                console.log('ooopps! something went wrong');
            }
        }

    }); 
});

$(document).on('submit', '#register-form', function (e) 
{         
    e.preventDefault();
    var frm = $(this);
    $.ajax({
        type: frm.attr('method'),
        url: frm.attr('action'),
        data: frm.serialize(),
        success: function (data)
            {
                var res = $.parseJSON(data);
                if(res == true)
                {
                    swal({
                        title: "You have successfully booked a ticket.",
                        type: "success",
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "OK!",
                        closeOnConfirm: false
                    });    
                }

                else
                {
                    swal("Opps!", "Something went wrong!", "error");
                }
                
            }
    });       
});  
  
</script>