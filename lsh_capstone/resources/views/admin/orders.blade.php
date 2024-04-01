@extends('admin.layout.app')

@section('heading', 'Customer Orders')

@section('main_content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="example1">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Order No</th>
                                        <th>Payment Method</th>
                                        <th>Booking Date</th>
                                        <th>Paid Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->order_no }}</td>
                                        <td>{{ $row->payment_method }}</td>
                                        <td>{{ $row->booking_date }}</td>
                                        <td>₱{{ number_format($row->paid_amount, 2) }}</td>
                                        <td class="pt_10 pb_10">
                                            <a href="{{ route('admin_invoice',$row->id) }}" class="btn btn-primary mb-md-0 mb-1">Detail</a>
                                            <a href="{{ route('admin_order_delete',$row->id) }}" class="btn btn-danger mb-md-0 mb-1" onClick="return confirm('Are you sure you want to delete order?');">Delete</a>
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
