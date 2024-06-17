@extends('layouts.app')
@section('title','Admin')
@section('content')


    <style>
        .list-group-item.active {
            z-index: 2;
            color: #fff;
            background-color: var(--main-color);
            border-color: var(--main-color);
        }
        #sidebarMenu{
            height: 100%;
        }
    </style>

    <div class="container-fluid ps-0">
        <div class="row">
            <!-- Sidebar start -->
            <div class="col-lg-3 pe-0">

                <!-- side navbar start -->
                <nav id="sidebarMenu" class="d-lg-block sidebar bg-white">
                    <div class="position-sticky">
                        <div class="list-group list-group-flush mx-3">

                            <a href="{{url('admin')}}" class="list-group-item list-group-item-action py-2 ripple">
                                <i class="fas fa-chart-area fa-fw me-3"></i><span>All Items</span>
                            </a>

                            <a href="{{url('add-blog')}}" class="list-group-item list-group-item-action py-2 ripple ">
                                <i class="fas fa-chart-area fa-fw me-3"></i><span>Add Item</span>
                            </a>
                            <a href="{{url('update')}}" class="list-group-item list-group-item-action py-2 ripple">
                                <i class="fas fa-chart-area fa-fw me-3"></i><span>Update Item</span>
                            </a>

                            <a href="{{route('show-order-details')}}" class="list-group-item list-group-item-action py-2 ripple active">
                                <i class="fa fa-list-alt me-3"></i><span>Order</span>
                            </a>
                            <a href="{{route('admin.category')}}" class="list-group-item list-group-item-action py-2 ripple">
                                <i class="fa fa-list-alt me-3"></i><span>Category</span>
                            </a>

                            <a type="button" id="userLogout" class="list-group-item list-group-item-action py-2 ripple "
                            ><i class="fa-solid fa-right-from-bracket me-3" style="font-size:20px"></i><span>Logout</span></a
                            >

                        </div>
                    </div>
                </nav>
                <!-- side navbar end -->


            </div>
            <!-- sidebar end -->

            <!-- main content start -->
            <div class="col-lg-9">
                <table class="table table-bordered border-primary">
                    <!-- this is table head -->
                    <thead class="table-dark ">
                    <tr>
                        <th class="th-sm">Id</th>
                        <th class="th-sm">Product Name</th>
                        <th class="th-sm">Quantity</th>
                        <th class="th-sm">Price</th>
                        <th class="th-sm">Address</th>
                        <th class="th-sm">Order Id</th>
                        <th class="th-sm">Phone</th>
                        <th class="th-sm">Action</th>

                    </tr>
                    </thead>
                    <!-- this is table body  end-->

                    <tbody>
                    @foreach ($allOrderDetails as $key => $blog)
                        <tr>
                            <td class="th-sm "><b>{{++$key}}</b></td>
                            <td class="th-sm "><b>{{isset($blog->getProduct->blog_title)&& !empty($blog->getProduct->blog_title)?\Illuminate\Support\Str::limit($blog->getProduct->blog_title,40,'...'):''}}</b></td>
                            <td class="th-sm ">{{$blog->quantity}}</td>
                            <td class="th-sm ">{{$blog->price}}</td>
                            <td class="th-sm ">{{$blog->address}}</td>
                            <td class="th-sm ">{{isset($blog->orderId)&& !empty($blog->orderId)?$blog->orderId:''}}</td>
                            <td class="th-sm ">{{$blog->phone}}</td>

                            <td class="th-sm ">
                                <button onclick="remove_blog({!!$blog->id!!})"  class="btn btn-danger">Delete</button>
                            </td>


                        </tr>
                    @endforeach
                    </tbody>
                    <!-- this is table body  end-->

                </table>

            </div>


            <!-- main content end -->


        </div>

    </div>

    <script>
        const remove_blog = (id) => {

            Swal.fire({
                title: 'Are you sure?',
                text: "Remove Blog",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Remove'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .get("/remove-order", { params: { id: id } })
                        .then(function (response) {

                            if(response.status == 200 && response.data == 1){
                                Swal.fire({
                                    position: 'top-center',
                                    icon: 'success',
                                    title: 'Successfully Delete',
                                    showConfirmButton: false,
                                    timer: 1500
                                })

                                location.reload();

                            }

                        })
                        .catch(function (error) {
                            Swal.fire({
                                position: "top-center",
                                icon: "error",
                                title: "Your form submission is not complete",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        });
                }
            })



        }
    </script>

@endsection()
