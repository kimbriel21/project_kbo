<!DOCTYPE html>
<html>
<head>
	<title>Wallet</title>
	<link rel="stylesheet" href="/assets/bootstrap4/dist/css/bootstrap.min.css">
	

</head>
<body>

<div class="container">
	<div class="d-flex flex-column justify-content-center" style=" text-align: center;">
		<div class="username-wrapper">
			<div style="font-size: 25px;">
				<b>{{$user_key}}</b>
			</div>
			<div class="address-wrapper">
				<div class="address">Your main address ( 0x{{$address}} )</div>
			</div>
		</div>
		<div class="balance-wrapper" >
			<label >Current Balance: &nbsp </label><b class="wallet-balance">{{$balance}}</b> <label style="font-family: sans-serif;">KBO</label>
		</div>
	</div>

	<div class="send-money-wrapper" >
		<label style="font-size: large;"><b>SEND KBO</b></label>
		<form class="form-inline send_coin" method="post" action="/send_coin">
		  
			{{csrf_field()}}
		  <input class="user_key" type="hidden" name="user_key" value="{{$user_key}}">
		  <label class="sr-only" for="inlineFormInputAddress">Name</label>
		  <input type="text" class="form-control mb-2 mr-sm-2" name="address" id="inlineFormInputAddress" placeholder="Address">
		  <label class="sr-only" for="inlineFormInputGroupAmount">Username</label>
		  <div class="input-group mb-2 mr-sm-2">
		    <div class="input-group-prepend">
		      <div class="input-group-text">KBO</div>
		    </div>
		    <input type="number" name="amount" step="any" class="form-control" id="inlineFormInputGroupAmount" placeholder="amount">
		  </div>
		  <button type="submit" class="btn btn-primary mb-2">Send</button>
		</form>
	</div>
 

  <div class="transaction-list-wrapper">
  	<h3>Transaction List</h3>
  	<div class="table-transaction">
	  	
  	</div>
  </div>

</div>
<script
  src="http://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="/assets/bootstrap4/dist/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		send_coin();
		reload_transaction_table($('.user_key').val());
	});

	function send_coin()
	{
		$('.send_coin').submit(function(event) 
		{
			var url_action 	= $(this).attr('action');
			var data_submit = $(this).serialize();
			var user_key 	= $('.user_key').val();
			event.preventDefault();

			$.ajax({
				url: url_action,
				type: 'post',
				data: data_submit,
				success : function(data)
				{
					reload_balance(user_key);
					reload_transaction_table(user_key);
				}
			})
			.done(function() {
				console.log("success");
			});
		});
	}

	function reload_balance(user_key)
	{
		$('.wallet-balance').html('');
		$.ajax({
			url: '/get_wallet_balance/'+user_key,
			type: 'get',
			data: {user_key},
			success : function(data)
			{
				$('.wallet-balance').html(data)
			}
		})
		.done(function() {
			console.log("success");
		});
	}

	function reload_transaction_table(user_key)
	{
		$('.table-transaction').html('');
		$.ajax({
			url: '/get_transaction_list/'+user_key,
			type: 'get',
			data: {user_key},
			success : function(data)
			{
				$('.table-transaction').html(data)
			}
		})
		.done(function() {
			console.log("success");
		});
		
	}
</script>
</body>
</html>