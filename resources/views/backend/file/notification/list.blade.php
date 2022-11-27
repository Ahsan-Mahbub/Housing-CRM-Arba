@extends('backend.layouts.app')
@section('content')
<style type="text/css">
	h4{
	    font-size: 16px;
	    font-weight: 700;
	    color: #176812;
	    margin-bottom: 10px;
	}
	a{
		color: #000;
	}
	hr {
	    margin-top: 0.4rem;
	    margin-bottom: 0.4rem;
	    border: 0;
	    border-top: 1px solid #e4e7ed;
	}
</style>
<div class="container">
	<div class="block">
	    <div class="block-header block-header-default">
	        <h3 class="block-title text-white"><b>Notification</b></h3>
	    </div>
	    <div class="block-content block-content-full">
	    	<?php
				$total_customers = count($customers);
				if($total_customers > 0){
					?>
						@php $sl = 1; @endphp
				    	@foreach($customers as $customer)
				    		<div <?php if($customer->notify_status == 1) {
				    			?>
				    			style="background: #d7d7d7d6;padding: 12px;"
				    			<?php
				    		}else{
				    			?>
				    			style="padding: 12px;"
				    			<?php
				    		} ?>>
				    			<a href="{{route('customer.show',$customer->id)}}"><span class="pb-2">{{$sl++}}. You have Notificated with <b>{{$customer->customer_name}}.</b></span></a>
				    		</div>
				    		<hr>
				    	@endforeach
					<?php
				}else{
					?>
					<span class="text-denger" style="color: #d31c1c; font-weight: 600; font-size: 15px;">Customer Notification is Empty!!</span>
					<?php
				}
			?>
	    </div>
	</div>
</div>
@endsection