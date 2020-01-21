  @forelse($data['timeSlots'] as $key => $timeSlot)
	<label class="tag">
		<input type="radio" name="time_slot" value="{{$timeSlot}}">
		<span>{{$timeSlot}}</span>
	</label>
  @empty
 @endforelse