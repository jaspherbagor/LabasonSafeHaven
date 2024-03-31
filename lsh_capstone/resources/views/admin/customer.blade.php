@extends('admin.layout.app')

@section('heading', 'View Customers')

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
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($customers as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if($row->photo !== '')
                                            <img src="{{ asset('uploads/'.$row->photo) }}" alt="slide_image" class="w_100">
                                            @else
                                            <img src="{{ asset('uploads/default.png') }}" alt="slide_image" class="w_100">
                                            @endif
                                        </td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td>{{ $row->phone }}</td>
                                        <td class="pt_10 pb_10">
                                            <a href="{{ route('admin_faq_edit',$row->id) }}" class="btn btn-primary mb-md-0 mb-1">Edit</a>
                                            <a href="{{ route('admin_faq_delete',$row->id) }}" class="btn btn-danger" onClick="return confirm('Are you sure?');">Delete</a>
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
