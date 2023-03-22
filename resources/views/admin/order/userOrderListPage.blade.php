@extends('../admin.layouts.master')

@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">

        <div class="container-fluid pb-3">
            <div class="overview-wrap">
                <h2 class="title-1">User Order List</h2>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">

            <form action="{{route('order#filterUserOrderStatus')}}" method="get" class="input-group ms-3" style="width: 225px">
                @csrf
                <select class="form-select" name="filterStatus">
                    <option value="" @if (request('filterStatus') == '') selected @endif>All</option>
                    <option value="0" @if (request('filterStatus') == '0') selected @endif>Pending</option>
                    <option value="1" @if (request('filterStatus') == '1') selected @endif>Accepted</option>
                    <option value="2" @if (request('filterStatus') == '2') selected @endif>Rejected</option>
                </select>
                <button type="submit" class="input-group-text btn btn-danger text-light">Search</button>
            </form>

            <p class="text-primary fs-5 pe-3">
                Total Order - {{count($userOrderList)}}
            </p>

        </div>

        <div class="col-lg-12 table-responsive mb-4">
            @if (count($userOrderList) != 0)
                <table class="table table-light shadow-sm table-borderless table-hover text-center table-orderList">
                    <thead class="thead-dark">
                        <tr>
                            <th class="align-middle">User Name</th>
                            <th class="align-middle">Total Amount</th>
                            <th class="align-middle">Order Date</th>
                            <th class="align-middle">Order Code</th>
                            <th class="align-middle">Status</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($userOrderList as $OrderList)
                            <tr>
                                <td class="align-middle"> {{$OrderList->user_name}} </td>
                                <td class="align-middle"> {{$OrderList->final_total_price}} Kyats </td>
                                <td class="align-middle"> {{$OrderList->created_at->format('d - F - Y')}} </td>
                                <td class="align-middle">
                                    <a href="{{route('order#userOrderListDetails_ManagePage',[$OrderList->id,$OrderList->order_code] )}}" class="text-primary">{{$OrderList->order_code}}</a>
                                </td>
                                <td class="align-middle">
                                    @if ($OrderList->status == 0)
                                        <span class="fs-6" style="color: rgb(233, 200, 15)">
                                            <i class="fa-solid fa-clock"></i>
                                            Pending
                                        </span>
                                    @elseif ($OrderList->status == 1)
                                        <span class="fs-6" style="color: rgb(8, 121, 8)">
                                            <i class="fa-solid fa-check"></i>
                                            Accepted
                                        </span>
                                    @elseif ($OrderList->status == 2)
                                        <span class="fs-6" style="color: rgb(233, 10, 10)">
                                            <i class="fa-sharp fa-solid fa-triangle-exclamation"></i>
                                            Reject
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="col-12 d-flex align-items-center justify-content-center" style="height: 300px">
                    <p class="text-danger">There is no one order !</p>
                </div>
            @endif
            <div class="mt-2">
                {{ $userOrderList->links() }}
            </div>
        </div>
    </div>

    {{--Change Order Status Dialog --}}
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true"       aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5">Change Order Status</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body my-1">
                <select class="form-select">
                    <option value="desc">Pending</option>
                    <option value="asc">Success</option>
                    <option value="desc">Reject</option>
                </select>
            </div>
            <div class="modal-footer">
              <button class="btn btn-dark" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Save Status</button>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection

