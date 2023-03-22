@extends('../admin.layouts.master')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="table-data__tool col-12">
                <div class="table-data__tool-left">
                    <div class="overview-wrap">
                        <h2 class="title-1">User List</h2>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-2">
                <form action="{{ route('account#userListPage') }}" class="input-group col-6" method="get">
                    @csrf
                    <input type="text" name='searchKey' class="form-control" placeholder="Search user name . . ." value="{{request('searchKey')}}">
                    <button class="btn btn-outline-danger" type="submit" >Search</button>
                </form>

                <p class="text-primary fs-5 me-4">
                    Total User - {{$users->total()}}
                </p>
            </div>

            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-responsive table-responsive-data2">

                    @if ($users->total() != 0)

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

                                @foreach ($users as $user)
                                    <tr class="tr-shadow">
                                        <td>
                                            @if ($user->image == null)
                                                <img src="{{asset('admin/images/icon/default_user.png')}}" class="rounded float-end" style="width: 80px">
                                            @else
                                                <img src="{{asset('storage/'. $user->image)}}" class="rounded-circle shadow-sm
                                                 float-end" style="height: 80px; width: 80px">
                                            @endif
                                        </td>

                                        <td>
                                            <span>{{$user->name}}</span>
                                        </td>

                                        <td>
                                            {{$user->email}}
                                        </td>

                                        <td class="desc">{{$user->phone}}</td>

                                        <td>{{$user->address}}</td>

                                        <td>
                                            <div class="table-data-feature">

                                                <a href="{{route('account#userRoleChangePage',$user->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Change as admin">
                                                    <i class="fa-solid fa-arrow-right-arrow-left text-success"></i>
                                                </a>

                                                &nbsp;&nbsp;

                                                <a href="{{route('account#userDelete',$user->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="fa-sharp fa-solid fa-trash text-danger"></i>
                                                </a>

                                            </div>
                                        </td>

                                    </tr>

                                    <tr class="spacer"></tr>

                                @endforeach
                            </tbody>
                        </table>

                        @else
                            <div class="col-12 d-flex align-items-center justify-content-center"    style="height: 300px">
                                <p class="text-danger">There is no one user !</p>
                            </div>
                        @endif

                        <div class="mt-2">
                            {{$users->links()}}
                        </div>

                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection
