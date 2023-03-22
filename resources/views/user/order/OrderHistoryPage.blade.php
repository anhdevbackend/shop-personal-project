@extends('user.layouts.master')

@section('content')

    <div class="container-fluid pt-3 pb-3 d-flex flex-row">
        <a href="{{ route('main#homePage') }}">
            <i class='bx bx-arrow-back fs-3 text-dark'></i>
        </a>
        <h4 class="ms-2 text-dark">My Order List</h4>
    </div>
    <div class="container-fluid row">
        <div class="col-lg-8 table-responsive mb-4">
            <table class="table table-borderless table-hover text-center mb-0" style="background-color: rgb(236, 234, 234)">
                <thead class="thead-dark">
                    <tr>
                        <th class="align-middle">Order Code</th>
                        <th class="align-middle">Total Amount</th>
                        <th class="align-middle">Date</th>
                        <th class="align-middle">Status</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($myOrderList as $List)
                        <tr>
                            <td class="align-middle">
                                <a href="{{route('order#OrderProductHistoryListPage',$List->order_code)}}" style="color: blue">{{$List->order_code}}</a>
                            </td>
                            <td class="align-middle"> {{$List->final_total_price}} Kyats</td>
                            <td class="align-middle"> {{$List->created_at->format('d - F - Y')}} </td>
                            <td class="align-middle">
                                @if ($List->status == 0)
                                    <button class="btn btn-warning rounded" style="width: 80px">Pending</button>
                                @elseif ($List->status == 1)
                                    <button class="btn btn-success rounded" style="width: 80px">Success</button>
                                @elseif ($List->status == 2)
                                    <button class="btn btn-danger rounded" style="width: 80px">Reject</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-3">
                {{ $myOrderList->links() }}
            </div>
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary">STATUS PROCESS</span></h5>
            <div class="bg-light p-4 mb-4">
                <div class="d-flex justify-content-start mb-3">
                    <p class="text-warning fs-6">Pending-</p>
                    <P class="ms-1">means we are start preparing your order now.</P>
                </div>
                <div class="d-flex justify-content-start mb-3">
                    <p class="text-success fs-6">Success-</p>
                    <P class="ms-1">means your order is ready to deliver.</P>
                </div>
                <div class="d-flex justify-content-start mb-3">
                    <p class="text-danger fs-6">Reject-</p>
                    <P class="ms-1">means there is product that you ordered is unavailable.if you have any problem with your orders you can contact to 'customer service'.</P>
                </div>
            </div>
        </div>
    </div>

@endsection
