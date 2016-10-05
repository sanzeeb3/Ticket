
<div class="container">
	<div class="row">
		<div class="col-sm-12">			
			<form method="POST" action="" role="form" class="form-inline">
				<label>First Name:</label><input type="name" class="form-control" id="fname">
				<label>Last Name:</label><input type="name" class="form-control" id="lname">
				<button class="btn btn-primary" id="add">Add</button>
			</form>
		</div>
	</div>
</div>
<br><br>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<table class="table table-bordered" id="table">
				<thead><tr><td>S.N.</td><td>First Name</td><td>Last Name</td><td>Options</td></tr></thead>
				<tbody id="tbody">
				</tbody>
			</table>
			<div id="result">
			</div>
		</div>
	</div>
</div>	

<script>
$('table').hide();

$(function(){

	var i=0;
	$(document).on('click', '#add', function (e) 
	{ 
		e.preventDefault();
	
		$('table').show();
		var fname=$('#fname').val();
		var lname=$('#lname').val();
		if(fname=='' || lname=='')
		{
			swal('Both fields are required!');
		}
		else
		{
			i++;
			$('#tbody').append('<tr><td>'+i+'</td><td>'+fname+'</td><td>'+lname+'</td><td><button class="view btn btn-info">Details</button> <button class="delete btn btn-info">Delete</button></td></tr>');
			$('#showf').append(fname);
			$('#showl').append(lname);
		}

   		document.getElementById('fname').value = "";
   		document.getElementById('lname').value = "";
	});

	$(document).on('click', '.view', function (e) 
	{ 
		$('#result').show();
	     var tr = $(this).closest('tr');
    	 var firstName = tr.find('td').eq(1).text();
	     var lastName = tr.find('td').eq(2).text();

   	 	$('#result').html('First Name:'+firstName+'<br>Last Name:'+lastName+'');
	});

	$(document).on('click', '.delete', function (e) 
	{ 
		var tr = $(this).closest('tr');
	    tr.remove();
	    $('#result').hide();
    });

});

</script>


<!-- more on closet http://www.w3schools.com/jquery/tryit.asp?filename=tryjquery_traversing_closest -->
<!-- more on eq() https://api.jquery.com/eq/ -->