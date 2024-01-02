@extends('layouts.admin')
@section('title','Edit Para Master')
@section('content')

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Edit Para Master</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.paraMasterList') }}">Para Master List</a></li>
                            <li class="breadcrumb-item active">Edit Para Master</li>
                        </ol>
                    </div>
                    
                </div>
            </div>
        </div>     

        <form class="custom-validation" action="{{ route('admin.updateParaMaster') }}" method="post" id="addParaMaster" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="card">
                        <div class="card-body">

                            <div class="form-group">
                                <span style="color:red;float:right;" class="pull-right">* is mandatory</span>
                            </div>

                            <input type="hidden" name="id" id="id" value="{{ $para->id }}">

                            <div class="form-group mb-3">
                                <label>Para Code<span class="mandatory">*</span></label>
                                <input type="text" class="form-control" name="para_code" placeholder="Para Code" autocomplete="off" value="{{ $para->para_code }}" required/>
                            </div>

                            <div class="form-group mb-3">
                                <label>Para Description<span class="mandatory">*</span></label>
                                <input type="text" class="form-control" name="para_description" placeholder="Para Description" autocomplete="off" value="{{ $para->para_description }}" required/>
                            </div>

                            <div class="button-items">
                                <center>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light mr-1" name="btn_submit" value="save">
                                        Update
                                    </button>
                                    
                                    <a href="{{ route('admin.paraMasterList') }}" class="btn btn-danger waves-effect">
                                        Cancel
                                    </a>
                                </center>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>

@endsection
