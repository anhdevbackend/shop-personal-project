@extends('../admin.layouts.master')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="table-data__tool col-12">
                <div class="table-data__tool-left">
                    <div class="overview-wrap">
                        <h2 class="title-1">Admin List</h2>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-2">
                <form action="{{ route('account#adminListPage') }}" class="input-group col-6" method="get">
                    @csrf
                    <input type="text" name='searchKey' class="form-control" placeholder="Search admin name . . ." value="{{request('searchKey')}}">
                    <button class="btn btn-outline-danger" type="submit" >Search</button>
                </form>

                <p class="text-primary fs-5 me-4">
                    Total Admin - {{$admins->total()}}
                </p>
            </div>

            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-responsive table-responsive-data2">

                    @if ($admins->total() != 0)

                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>IMAGE</th>
                                    <th>NAME</th>
                                    <th>EMAIL</th>
                                    <th>PHONE</th>
                                    <th>ADDRESS</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($admins as $admin)
                                    <tr class="tr-shadow">
                                        <td>
                                            @if ($admin->image == null)
                                                <img src="{{asset('admin/images/icon/default_user.png')}}" class="rounded float-end" style="width: 80px">
                                            @else
                                                <img src="{{asset('storage/'. $admin->image)}}" class="rounded-circle shadow-sm
                                                 float-end" style="height: 80px; width: 80px">
                                            @endif
                                        </td>

                                        <td>
                                            <span>{{$admin->name}}</span>
                                        </td>

                                        <td>
                                            {{$admin->email}}
                                        </td>

                                        <td class="desc">{{$admin->phone}}</td>

                                        <td>{{$admin->address}}</td>

                                        <td>
                                            @if (Auth::user()->id != $admin->id)
                                                    <div class="table-data-feature">

                                                        <a href="{{route('account#adminRoleChangePage',$admin->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Change as user">
                                                            <i class="fa-solid fa-arrow-right-arrow-left text-success"></i>
                                                        </a>

                                                        &nbsp;&nbsp;

                                                        <a href="{{route('account#adminDelete',$admin->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                            <i class="fa-sharp fa-solid fa-trash text-danger"></i>
                                                        </a>

                                                    </div>
                                            @endif
                                        </td>

                                    </tr>

                                    <tr class="spacer"></tr>

                                @endforeach
                            </tbody>
                        </table>

                        @else
                            <div class="col-12 d-flex align-items-center justify-content-center"    style="height: 300px">
                                <p class="text-danger">There is no one with the name you are searching for !</p>
                            </div>
                        @endif

                        <div class="mt-2">
                            {{$admins->links()}}
                        </div>

                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection
