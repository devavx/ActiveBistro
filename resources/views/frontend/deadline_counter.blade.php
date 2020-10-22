<li class="nav-item">
	@if($deadline>=$current)
		<span class="header-time-slot nav-link text-color text-center border rounded-lg"><b>Delivery Deadline:</b> <span class="timer_span">{{date('d M | g A',$deadline)}}</span></span>
	@else
		@if($difference>86400)
			<span class="header-time-slot nav-link text-color text-center border rounded-lg"><b>Delivery Deadline:</b> <span class="timer_span">{{date('d M | g A',$deadline)}}</span></span>
		@elseif($difference>43200&&$difference<=86400)
			<span class="header-time-slot nav-link text-color text-center border rounded-lg"><b>Delivery Deadline:</b> <span class="timer_span">{{\App\Core\Primitives\Time::toDuration($difference)}}</span></span>
		@elseif($difference>0&&$difference<=43200)
			<span class="header-time-slot nav-link text-color text-center border rounded-lg"><b>Delivery Deadline:</b> <span class="timer_span">{{\App\Core\Primitives\Time::toDuration($difference)}}</span></span>
		@else
			<span class="header-time-slot nav-link text-color text-center border rounded-lg"><b>Delivery Deadline:</b> <span class="timer_span">Delivered</span></span>
		@endif
	@endif
</li>