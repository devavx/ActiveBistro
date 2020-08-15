<table class="table mb-0">
	<tbody>
	<tr>
		<td><span class="text-primary">Name</span></td>
		<td>{{$plan->name}}</td>
	</tr>
	<tr>
		<td><span class="text-primary">Status</span></td>
		<td>{{$plan->active?'Active':'Inactive'}}</td>
	</tr>
	@foreach($plan->items as $item)
		@if($loop->index==0)
			<tr>
				<td><span class="text-primary">Items</span></td>
				<td>{{$item->name}}</td>
			</tr>
		@else
			<tr>
				<td><span class="text-primary">&nbsp;</span></td>
				<td>{{$item->name}}</td>
			</tr>
		@endif
	@endforeach
	</tbody>
</table>