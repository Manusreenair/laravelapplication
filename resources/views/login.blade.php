<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>|Login|</title>
</head>
<style>
	.login-form
	{
		width:340px;
		margin:150px auto;
	}
	.login-form form
	{
		margin-bottom:15px;
		background:#f7f7f7;
		box-shadow:0px 2px 2px rgba(0,0,0,0.3);
		padding:30px;
	}
	.login-form h2
	{
		margin:0 0 15px;
	}
	.form-ctrl, .btn
	{
		min-height:38px;
		border-radius:2px;
	}
	.btn
	{
		font-size:15px;
		font-weight:bold;
	}
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
  <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ $message }}</strong>
</div>
@endif
<body>

	<div class="login-form">
		<div id="response">
		</div>
		<form id="login">
			<h2 class="text-center">Login</h2>
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Email" id="email" required="required">
			</div>
			<div class="form-group">
				<input type="password" class="form-control" placeholder="Password" id="password" required="required">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-block">Login</button>
			</div>
		</form>
	</div>
</body>
<script>
$(document).ready(function()
{
	$('#login').on('submit',function(e)
	{
		e.preventDefault();
		var email=$('#email').val();
		var password=$('#password').val();
		$.ajaxSetup({
    		beforeSend: function(xhr, type) 
    		{
	        	if (!type.crossDomain) 
	        	{
	            	xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
	        	}
    		},
		});
		if(email!="" && password!="")
		{
			$.ajax({
				type:"POST",
				url:"{{route('loginApi')}}",
				dataType:"json",
				data:{email:email,password:password},
				success:function(data)
				{
					if(data.status==1)
					{
							
						window.location.href="{{route('showDashboard')}}"
  					} else if(data.status==0)
  					{
  						$('#response').animate({
							height:'+=72px'
						},300);
						$('<div class="alert alert-danger">'+'<button type="button" class="close" data-dismiss="alert">'+'&times;</button>'+data.message+'</div>').hide().appendTo('#response').fadeIn(1000);
						$(".alert").delay(3000).fadeOut("normal",
							function(){
								$(this).remove();
							});
						$('#response').delay(4000).animate({
							height:'-=72px'
						},300);
						
  					}

				}

			});
		}
	});

});
</script>
</html>