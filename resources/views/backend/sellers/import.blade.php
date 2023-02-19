@extends('backend.layouts.app')

@section('content')

  
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6"><strong>{{translate('Upload Seller CSV File')}}</strong></h5>
        </div>
        <div class="card-body">
            <form class="form-horizontal" action="{{ route('sellers.importpost') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-9">
                        <div class="custom-file">
    						<label class="custom-file-label">
    							<input type="file" name="bulk_file" class="custom-file-input" required>
    							<span class="custom-file-name">{{ translate('Choose File')}}</span>
    						</label>
    					</div>
                    </div>
                </div>
                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-info">{{translate('Upload CSV')}}</button>
                </div>
            </form>
        </div>
    </div>

@endsection
