@extends('admin.Layouts.layoutmaster')

@section('body')
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>{{ Session::get('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <strong>{{ Session::get('error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
        </div>
    @endif
    {{-- <a href="{{ route('user.create') }}"><button type="button" class="btn btn-success">Add</button></a> --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data Table</h4>
                        <div class="table-responsive">
                            <div class="scroll-wrap">
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>Code Tour</th>
                                            <th>Name</th>
                                            <th>quantity_child</th>
                                            <th>quantity_adult</th>
                                            <th>Total Quantity</th>
                                            <th>unit_price_child</th>
                                            <th>unit_price_adult</th>
                                            <th>total_price</th>
                                            <th>date_of_booking</th>
                                            <th>date_of_payment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $booking)
                                            <tr>
                                                <td>{{ $booking->code->code }}</td>

                                                <td>{{ $booking->user->name }}</td>
                                                <td>{{ $booking->quantity_child }}</td>
                                                <td>{{ $booking->quantity_adult }}</td>
                                                <td>{{ $booking->quantity }}</td>
                                                <td>{{ $booking->unit_price_child }}</td>
                                                <td>{{ $booking->unit_price_adult }}</td>
                                                <td>{{ $booking->total_price }}</td>
                                                <td>{{ $booking->date_of_booking }}</td>
                                                <td>{{ $booking->date_of_payment }}</td>
                                            </tr>
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
    </div>
@endsection
