@extends('backend.layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-6">
			<div class="block">
			    <div class="block-header block-header-default">
			        <h3 class="block-title text-white"><b>Sold Flat Report Table</b></h3>
					<button type="button" class="btn-block-option" onclick="printDiv('printableArea')">
		                <i class="si si-printer"></i> Print List
		            </button>
			    </div>
			    <div class="block-content block-content-full" id="printableArea">
			    	<div class="table table-responsive">
			            <table class="table table-bordered table-striped table-vcenter">
			                <thead>
			                    <tr>
			                        <th class="text-center">S/L &nbsp;</th>
			                        <th class="text-center">Project Name &nbsp;</th>
			                        <th class="text-center">Flat Name &nbsp;</th>
			                        <th class="text-center">Confirmation &nbsp;</th>
			                    </tr>
			                </thead>
			                <tbody>
			                	@php $sl = 1; @endphp
		                    	@foreach($sold_flats as $flat)
			                	<tr>
			                		<td class="text-center">{{$sl++}}</td>
			                		<td class="text-center">{{$flat->project ? $flat->project->project_name : 'N/a'}}</td>
				                	<td class="text-center">{{$flat->flat_name}}</td>
				                	<td class="text-center">
				                		@if($flat->confirmattion == 1)
				                			<span class="badge badge-success">Sold</span>
				                		@else
				                			<span class="badge badge-danger">Unsold</span>
				                		@endif
				                	</td>
			                	</tr>
			                	@endforeach
			                </tbody>
			            </table>
			        </div>
			    </div>
			</div>
		</div>
		<div class="col-6">
			<div class="block">
			    <div class="block-header block-header-default">
			        <h3 class="block-title text-white"><b>Unsold Flat Report Table</b></h3>
			    	<button type="button" class="btn-block-option" onclick="printDiv('printableArea2')">
		                <i class="si si-printer"></i> Print List
		            </button>
			    </div>
			    <div class="block-content block-content-full" id="printableArea2">
			    	<div class="table table-responsive">
			            <table class="table table-bordered table-striped table-vcenter">
			                <thead>
			                    <tr>
			                        <th class="text-center">S/L &nbsp;</th>
			                        <th class="text-center">Project Name &nbsp;</th>
			                        <th class="text-center">Flat Name &nbsp;</th>
			                        <th class="text-center">Confirmation &nbsp;</th>
			                    </tr>
			                </thead>
			                <tbody>
			                	@php $sl = 1; @endphp
		                    	@foreach($un_sold_flats as $flat)
			                	<tr>
			                		<td class="text-center">{{$sl++}}</td>
			                		<td class="text-center">{{$flat->project ? $flat->project->project_name : 'N/a'}}</td>
				                	<td class="text-center">{{$flat->flat_name}}</td>
				                	<td class="text-center">
				                		@if($flat->confirmattion == 1)
				                			<span class="badge badge-success">Sold</span>
				                		@else
				                			<span class="badge badge-danger">Unsold</span>
				                		@endif
				                	</td>
			                	</tr>
			                	@endforeach
			                </tbody>
			            </table>
			        </div>
			    </div>
			</div>
		</div>
	</div>
</div>
@endsection