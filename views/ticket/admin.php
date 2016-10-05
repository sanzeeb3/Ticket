<div class="container">
	<div class="row">
		<div class="col-sm-7">
			<div id="result">
                <h3>Search Results</h3>
                <table id="tableid2"  class='table'>
                    <thead><tr><td>S.N.</td><td>Name</td><td>Ticket Type</td><td>Seat</td><td>Date Booked</td><td>Ticket Status</td><td>Options</td></tr>
                    </thead>
                    <tbody id="searchtable">
                    </tbody>
                </table>
        	</div>
                <h2>All Records</h2>
                <table id="tableid" class="table">
                    <thead><tr><td>S.N.</td><td>Name</td><td>Ticket Type</td><td>Seat</td><td>Date Booked</td><td>Ticket Status</td><td>Options</td></tr>
                    </thead>
                    <?php $i=0;?> 
                    <?php foreach($allresults as $result):?>
                        <tbody>
                        <tr><td><?php $i++; echo $i;?></td>
                        <td><?php echo $result->user->name;?></td>
                        <td>
                            <?php if($result->seat->type==1)
                            {
                                echo "Business";
                            }
                            if($result->seat->type==2)
                            {
                                echo "Economy";
                            }
                            ?>                                
                        </td>
                        <td><?php echo $result->seat->seat;?></td>
                        <td><?php echo $result->date_booked;?></td>
                        <td></td>
                        <td><a href="" class="remove" data-id="<?php echo $result->id;?>">Cancel ticket</a></td>
                        </tr>
                        </tbody>
                    <?php endforeach;?>
                </table>  

		</div>

		<div class="col-sm-5">
			<h2>Search Details</h2>
			<form class="formclass" method="POST" action="<?php echo Yii::$app->request->baseUrl;?>/ticket/show/" role="form" id="show-form" >
		    	<label>Flight Date:</label><input type="date" class="form-control" name="flightdate" id="flightdate" placeholder="Flight Date"><br><br>
	     		<label>Ticket Type:</label>
	     			<select id="type" name="type" class="form-control">
                    	<option value="">--Select ticket type--<br>
                    	<option value="1">Business<br>
                    	<option value="2">Economy<br><br><br>                                  
                	</select>  <br><br>
			    <label>Seat No.:</label><input type="text" class="form-control" name="seat" id="seat" placeholder="Seat Number"><br><br><label>Name:</label><input type="name" class="form-control" name="name" id="name" placeholder="Name"><br><br>
        	    <button type="submit" class="btn btn-info">View Details</button> 
        	    
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">

$('#result').hide();     

$(document).on('submit', '#show-form', function (e) 
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
                if(res.status == true)
                {
           
            		var results=''; 		

       	        	for(var i=0;  i<res.display.length;  i++) 
                	{    
                		if(res.display[i].type=='1')
            			{	
            				var b="Business";
            			}
            			if(res.display[i].type=='2')
            			{
            				var b="Economy";
            			}

   						results +='<tr>'+
                                  '<td>'+(i+1)+'</td>'+
                                  '<td>'+res.display[i].name+'</td>'+
                                  '<td>'+b+'</td>'+
                                  '<td>'+res.display[i].seat+'</td>'+
                                  '<td>'+res.display[i].date_booked+'</td>'+
                                  '<td></td>'+
                                  '<td><a href="" class="remove" data-id='+res.display[i].id+'>Cancel ticket</a></td>'+
                                  '</tr>';

                    	$('#searchtable').html(results);
                        $('#result').show();     
                	}
                }

                else
                {
                    swal("Sorry!", "Record doesnot exist.!", "error");
                    $('#result').hide();
                }
                
            }
    });       
});

$(document).on('click', '.remove', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    swal({
            title: "Are you sure!",
            text: "You cannot undone this.",
            type: "error",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes!",
            showCancelButton: true,
        },
        function(isConfirm) {
            if(isConfirm)
            {
                $.ajax({
                    type: "POST",
                    url: "<?php echo Yii::$app->request->baseUrl;?>"+'/ticket/cancel',
                    data: {id:id},
                    success: function (data) {
                        var res = $.parseJSON(data);
                        if(res == true) {
                            swal("Ticket Cancelled!", "", "success");
                        }
                        else
                        {
                            swal("Something goes wrong! please retry!","","error");
                        }
                    }
                });
            }

        }
    );
});


</script>