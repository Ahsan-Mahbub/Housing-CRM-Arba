@extends('backend.layouts.app')
@section('content')
<div class="container">
	<div class="row justify">
		<div class="col-xl-10 single-filed">
			<div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title text-white">Stock Clear</h3>
                </div>
                <div class="block-content">
                    <form action="{{route('stock.clear.invoice')}}" method="get">
                        <div class="form-group row">
                            <div class="col-md-6 pt-2">
                            	<label for="status">Project Name: <span class="text-danger">*</span></label>
	                            <div>
	                                <select class="form-control" id="project_id" name="project_id" required="" onchange="getPurcase()">
	                                	<option value="">Please select</option>
	                                	@foreach($projects as $project)
	                                	<option value="{{$project->id}}">{{$project->project_name}}</option>
	                                	@endforeach
	                                </select>
	                            </div>
                            </div>
                            <div class="col-md-6 pt-2">
                            	<label for="status">Invoice or Purchase Code: <span class="text-danger">*</span></label>
	                            <div>
	                                <select class="form-control" name="purchase_code" id="purchase_code" required="">
	                                	<option value="">Please select</option>
	                                </select>
	                            </div>
                            </div>
                        </div>
                        <div class="form-group row pt-3">
                            <div class="col-12 text-center">
                                <button Type="submit" class="btn btn-alt-primary">
                                    Find Item
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
	function getPurcase(){
	    let id = $("#project_id").val();
	    let url = '/admin/purchase-code/'+id;
	    $.ajax({
	        type: "get",
	        url: url,
	        dataType: "json",
	        success: function (response) {
	            let html = '';
	            //console.log(response)
	            html+='<option value="">Please select</option>'
	            response.forEach(element => {
	                html+='<option value='+element.id+'>'+element.purchase_code+'</option>'
	            });
	            $("#purchase_code").html(html);

	        }
	    });
	}
</script>
@endsection