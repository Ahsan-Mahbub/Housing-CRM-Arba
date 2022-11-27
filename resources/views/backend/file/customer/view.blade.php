@extends('backend.layouts.app')
@section('content')
<style type="text/css">
    .block-content p {
        margin-bottom: 13px;
    }
    .font-w700{
        margin-bottom: 8px;
    }
    .text-title {
        color: #3d7000!important;
        font-weight: 800;
    }
</style>
<div class="container">
    <div class="row justify">
        <div class="col-md-12">
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title text-white">Customer Information</h3>
                </div>
                <div class="block-content">
                    <div class="row">
                        <div class="pt-2 col-6">
                            <p class="text-primary-darker d-block font-w600"><strong class="text-title">Customer Managed By: </strong>{{$customer->user ? $customer->user->name : 'Not Set'}}</p>
                            <p class="text-primary-darker d-block font-w600"><strong class="text-title">Create Date: </strong>
                                <?php
                                    $c_date = date('j F Y',strtotime($customer->created_at))
                                ?>
                                {{$c_date}}
                            </p>
                            <p class="text-primary-darker d-block font-w600"><strong class="text-title">Refference: </strong>{{$customer->reference? $customer->reference->reference_name : 'N/A'}}</p>
                            <p class="text-primary-darker d-block font-w600"><strong class="text-title">Follow Up Time : </strong>
                                @if($customer->remember_time) 
                                <?php
                                    $date = date('j F Y',strtotime($customer->remember_time))
                                ?>
                                {{$date}}
                                @endif
                            </p>
                        </div>

                        <div class="pt-2 col-6">
                            <p class="text-primary-darker d-block font-w600"><strong class="text-title">Customer Name: </strong>{{$customer->customer_name}}</p>
                            <p class="text-primary-darker d-block font-w600"><strong class="text-title">Customer Mobile Number: </strong>{{$customer->phone}}</p>
                            <p class="text-primary-darker d-block font-w600"><strong class="text-title">Customer Email: </strong>{{$customer->email}}</p>
                            <p class="text-primary-darker d-block font-w600"><strong class="text-title">Customer Address: </strong>{{$customer->address}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title text-white">All Notes</h3>
                    <a data-toggle="modal" data-target="#modal-large" class="btn btn-sm btn-alt-info">
                        <i class="fa fa-plus mr-5"></i>Add Another Notes
                    </a>
                </div>
                <div class="block-content">
                    @foreach($notes as $note)
                        <strong class="d-block text-dark pb-2"><strong class="text-title">Create Date : </strong>
                            <?php
                                $date = date('j F Y',strtotime($note->created_at))
                            ?>
                            {{$date}}
                        </strong>
                        <strong class="d-block text-dark pb-2"><strong class="text-title">Flat Name : </strong>
                            {{$note->flat ? $note->flat->flat_name : 'N/A (Defult)'}}
                        </strong>
                        <p class="text-primary-darker d-block font-w600">{{$note->notes}}</p>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title text-white">All Assigning Flat</h3>
                </div>
                <div class="block-content">
                    <div class="table table-responsive">
                        <table class="table table-bordered table-striped table-vcenter">
                            <thead>
                                <tr>
                                    <th class="text-center">Project Name &nbsp;</th>
                                    <th class="text-center">Flat Name &nbsp;</th>
                                    <th class="text-center">Current Status &nbsp;</th>
                                    <th class="text-center">Action &nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assigns as $assign)
                                <tr>
                                    <td class="text-center">{{$assign->project ? $assign->project->project_name : 'N/A'}}</td>
                                    <td class="text-center">{{$assign->flat ? $assign->flat->flat_name : 'N/A'}}</td>
                                    <td class="text-center font-w700 text-success">
                                        {{$assign->type ? $assign->type->type_name : 'N/A'}}
                                    </td>
                                    <td class="text-center icon-statte">
                                        <a href="{{route('flat-assign.show',$assign->id)}}" class="btn btn-circle btn-alt-info mr-5 mb-5">
                                            <i class="fa fa-eye"></i>
                                        </a>
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

<!-- reference add modal -->
<div class="modal show" id="modal-large" tabindex="-1" role="dialog" aria-labelledby="modal-large">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title text-white">Add Notes</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="modal-body">
                        <form action="{{route('note.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="customer_id" value="{{$customer->id}}">
                            <div class="pb-2" style="margin: auto;">
                                <span class="block-title font-w600">Set Follow Up Time :
                                    @if($customer->remember_time) 
                                    <?php
                                        $date = date('j F Y',strtotime($customer->remember_time))
                                    ?>
                                    {{$date}}
                                    @else
                                    <span class="text-danger">Follow Up Time Not Set</span>
                                    @endif
                                </span>
                            </div>
                            <div class="form-group row">
                                <label class="col-12" for="status">Flat Name:</label>
                                <div class="col-lg-12">
                                    <select class="form-control" name="flat_id">
                                        <option value="">Please select</option>
                                        @foreach($assigns as $assign)
                                        <option value="{{$assign->flat_id}}">{{$assign->flat ? $assign->flat->flat_name : 'N/A'}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12" for="reference">Notes: <span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <textarea rows="3" class="js-autocomplete form-control" name="notes" required placeholder="Notes.."></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="status">Update Follow Up Time:</label>
                                    <input type="date" class="js-autocomplete form-control" name="remember_time" required value="{{$customer->remember_time}}">
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-square btn-primary min-width-125 mb-10 mt-20">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end reference add modal -->
@endsection