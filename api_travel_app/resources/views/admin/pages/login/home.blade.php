@extends('admin.Layouts.layoutmaster')

@section('body')
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-1">
                <div class="card-body">
                    <h3 class="card-title text-white">Booking paid</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{ $data->booking_paid }}</h2>
                        <p class="text-white mb-0">July 2022</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-2">
                <div class="card-body">
                    <h3 class="card-title text-white">Booking not paid</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{ $data->booking_not_paid }}</h2>
                        <p class="text-white mb-0">July 2022</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-3">
                <div class="card-body">
                    <h3 class="card-title text-white">New Customers</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{ $data->new_customer }}</h2>
                        <p class="text-white mb-0">July 2022</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-4">
                <div class="card-body">
                    <h3 class="card-title text-white">Satisfaction</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">
                            {{ $data->total_revenue[0]->booking_paid + $data->total_revenue[0]->booking_not_paid }}</h2>
                        <p class="text-white mb-0">July 2022</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="active-member">
                        <div class="table-responsive">
                            <table class="table table-xs mb-0 ">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Code Tour </th>
                                        <th>Total Booking</th>
                                        <th>Location start</th>
                                        <th>Location end</th>
                                        <th>capacity</th>
                                        <th>Available Capacity</th>
                                    </tr>
                                </thead>
                                <tbody id="mytbody">
                                    <h4 class="title-top" style="float: left">Top 10</h4>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function($) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "GET",
                url: '/admin/hot-tour/',
                dataType: 'json',
                success: function sbv(res) {
                    var your_html = "";
                    var i = 1;
                    $.each(res, function(key, val) {
                        your_html += "<tr>" +
                            "<td>" + i++ + "</td>" +
                            "<td>" + val.tour.map(x => x.code) + "</td>" +
                            "<td>" + val.total_book + "</td>" +
                            "<td>" + val.tour.map(x => x.start_location.name) + "</td>" +
                            "<td>" + val.tour.map(x => x.end_location.name) + "</td>" +
                            "<td>" + val.tour.map(x => x.capacity) + "</td>" +
                            "<td>" + val.tour.map(x => x.available_capacity) + "</td>" +
                            "</tr>"
                        console.log(i);
                        if (i == 11) {
                            return false;
                        }
                    });
                    $("#data").append(your_html);
                    $("#mytbody").html(your_html);
                }
            });
        });
    </script>
@endsection
