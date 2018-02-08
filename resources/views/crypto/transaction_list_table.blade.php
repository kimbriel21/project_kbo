<table class="table table-bordered">
	<thead>
		<th class="text-center">#</th>
		<th>Date</th>
		<th>Address</th>
		<th>Type</th>
		<th>Amount</th>
		<th>Fee</th>
		<th>Confirmation</th>
	</thead>
	<tbody>
		@foreach($trasaction_list as $key => $transaction)
		<tr>
			<td class="text-center">{{$count++}}</td>
    	<td>{{ date('n/j/Y h:i a',$transaction['time']) }}</td>
    	<td>0x{{ $transaction['address'] }}</td>
    	<td>{{$transaction['category']}}</td>
    	<td>{{$transaction['amount']}}</td>
    	<td>{{isset($transaction['fee']) ? $transaction['fee']:'0' }}</td>
    	<td>{{$transaction['confirmations']}}</td>
	  </tr>
		@endforeach
	</tbody>
</table>