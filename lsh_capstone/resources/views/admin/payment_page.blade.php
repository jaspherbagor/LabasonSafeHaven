@extends('admin.layout.app')

@section('heading', 'Edit Payment Page')

@section('main_content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin_payment_page_update')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-4">
                                    <label class="form-label">Heading</label>
                                    <input type="text" class="form-control" name="payment_heading" value="{{ $payment_data->payment_heading }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Status</label>
                                    <select name="payment_status" class="form-control">
                                        <option value="1" @if($payment_data->payment_status === 1) selected @endif>Show</option>
                                        <option value="0" @if($payment_data->payment_status === 0) selected @endif>Hide</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label"></label>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection