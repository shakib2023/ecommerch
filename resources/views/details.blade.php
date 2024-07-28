@extends('layouts.app')
@section('title')
    {{'Details'}}
@endsection
@push('custom.style')
    <style>
        .button-group {
            margin-bottom: 20px;
        }

        .btn-primary {
            color: #fff;
            background-color: #337ab7;
            border-color: #2e6da4;
        }
    </style>
    <style>

        button {
            -moz-appearance: none;
            -webkit-appearance: none;
            appearance: none;
            font-size: 14px;
            padding: 4px 8px;
            color: rgba(0, 0, 0, 0.85);
            background-color: #fff;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 4px;
        }

        button:hover,
        button:focus,
        button:active {
            cursor: pointer;
            background-color: #ecf0f1;
        }

        .comment-thread {
            width: 700px;
            max-width: 100%;
            margin: auto;
            background-color: #fff;
            border: 1px solid transparent; /* Removes margin collapse */
        }

        .m-0 {
            margin: 0;
        }

        .sr-only {
            position: absolute;
            left: -10000px;
            top: auto;
            width: 1px;
            height: 1px;
            overflow: hidden;
        }

        /* Comment */

        .comment {
            position: relative;
            margin: 20px auto;
        }

        .comment-heading {
            display: flex;
            align-items: center;
            height: 50px;
            font-size: 14px;
        }

        .comment-voting {
            width: 20px;
            height: 32px;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 4px;
        }

        .comment-voting button {
            display: block;
            width: 100%;
            height: 50%;
            padding: 0;
            border: 0;
            font-size: 10px;
        }

        .comment-info {
            color: rgba(0, 0, 0, 0.5);
            margin-left: 10px;
        }

        .comment-author {
            color: rgba(0, 0, 0, 0.85);
            font-weight: bold;
            text-decoration: none;
        }

        .comment-author:hover {
            text-decoration: underline;
        }

        .replies {
            margin-left: 20px;
        }

        .comment-border-link {
            display: block;
            position: absolute;
            top: 50px;
            left: 0;
            width: 12px;
            height: calc(100% - 50px);
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            background-color: rgba(0, 0, 0, 0.1);
            background-clip: padding-box;
        }

        .comment-border-link:hover {
            background-color: rgba(0, 0, 0, 0.3);
        }

        .comment-body {
            padding: 0 20px;
            padding-left: 28px;
        }

        .replies {
            margin-left: 28px;
        }

        details.comment summary {
            position: relative;
            list-style: none;
            cursor: pointer;
        }

        details.comment summary::-webkit-details-marker {
            display: none;
        }

        details.comment:not([open]) .comment-heading {
            border-bottom: 1px solid rgba(0, 0, 0, 0.2);
        }

        .comment-heading::after {
            display: inline-block;
            position: absolute;
            right: 5px;
            align-self: center;
            font-size: 12px;
            color: rgba(0, 0, 0, 0.55);
        }

        details.comment[open] .comment-heading::after {
            content: "Click to hide";
        }

        details.comment:not([open]) .comment-heading::after {
            content: "Click to show";
        }

        @media screen and (-ms-high-contrast: active), (-ms-high-contrast: none) {
            /* Resets cursor, and removes prompt text on Internet Explorer */
            .comment-heading {
                cursor: default;
            }

            details.comment[open] .comment-heading::after,
            details.comment:not([open]) .comment-heading::after {
                content: " ";
            }
        }

        .reply-form textarea {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            font-size: 16px;
            width: 100%;
            max-width: 100%;
            margin-top: 15px;
            margin-bottom: 5px;
        }

        .d-none {
            display: none;
        }

        .comment-section {
            max-height: 258px;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 10px;
        }
    </style>
@endpush

@section('content')

    @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{session()->get('success')}}
        </div>
    @endif

    <div id="home">

        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h2>{{$blog_details->blog_title}}</h2>
                    @php
                        echo $blog_details->details

                    @endphp
                </div>

                <div class="col-lg-4">
                    <img src="{{$blog_details->blog_image}}" alt="">
                </div>

                <div class="row d-flex mt-3">
                    <div class="col-auto">
                        Price: <span><del>TK {{$blog_details->product_actual_price}}</del></span>
                    </div>
                    <div class="col-auto">
                        <span
                            class="badge rounded-pill text-bg-primary">Offer Price: TK {{$blog_details->product_offer_price}}</span>
                    </div>
                </div>

            </div>

            <div class="row mt-3">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <form id="orderPlacedForm" method="post"
                                  action="{{route('orderProduct',$blog_details->id)}}">
                                @csrf
                                <input type="hidden" name="offerPrice" value="{{$blog_details->product_offer_price}}"
                                       class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Quantity</label>
                                            <input type="number" name="quantity" class="form-control"
                                                   id="exampleInputEmail1" aria-describedby="emailHelp">

                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Total Price</label>
                                            <input type="number" name="totalPriceQuantity" class="form-control"
                                                   id="exampleInputEmail1" aria-describedby="emailHelp">

                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                                    <textarea name="address" class="form-control" id="exampleFormControlTextarea1"
                                              rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Phone Number</label>
                                    <input type="text" name="phoneNumber" class="form-control" id="exampleInputEmail1"
                                           aria-describedby="emailHelp">

                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                           aria-describedby="emailHelp">

                                </div>
                                @if(auth()->user())
                                    <button type="submit" class="btn btn-primary submit">Order Now</button>
                                @else
                                    <button type="button" class="btn" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                        SignIn
                                    </button>
                                @endif
                            </form>
                        </div>
                    </div>

                </div>

                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <h6>Product Comments</h6>
                                @if(!empty($blog_details->comments))
                                    <div class="comment-section">
                                        <div class="comment-thread">
                                            <!-- Comment 1 start -->
                                            @foreach($blog_details->comments as $key => $comment)
                                                <details open class="comment" id="comment-{{$key}}">
                                                    <a href="#comment-{{$key}}" class="comment-border-link">
                                                        <span class="sr-only">Jump to comment-{{$key}}</span>
                                                    </a>
                                                    <summary>
                                                        <div class="comment-heading">
                                                            <div class="comment-info">
                                                                <a href="#"
                                                                   class="comment-author">{{$comment->user->name}}</a>
                                                                <p class="m-0">
                                                                    {{\Illuminate\Support\Carbon::parse($comment->created_at)->diffForHumans()}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </summary>

                                                    <div class="comment-body">
                                                        <p>
                                                            {{$comment->comment}}
                                                        </p>
                                                        @if(auth()->user())
                                                            <button type="button" data-toggle="reply-form" data-commentId="{{$comment->id}}"
                                                                    data-target="comment-{{$key}}-reply-form">Reply
                                                            </button>

                                                            <!-- Reply form start -->
                                                            <form method="post" action="{{route('product-comment')}}" class="reply-form d-none"
                                                                  id="comment-{{$key}}-reply-form">
                                                                @csrf
                                                                <input type="hidden" name="productId" value="{{$blog_details->id}}">
                                                                <input type="hidden" name="parent_id" value="{{$comment->id}}">
                                                                <input type="hidden" name="userId"
                                                                       value="{{auth()->user() !== null?auth()->user()->id:''}}">
                                                                <textarea placeholder="Reply to comment" name="post_comment"
                                                                          rows="4"></textarea>
                                                                <button type="submit">Submit</button>
                                                                <button type="button" data-toggle="reply-form"
                                                                        data-target="comment-{{$key}}-reply-form">Cancel
                                                                </button>
                                                            </form>
                                                            <!-- Reply form end -->
                                                        @endif

                                                    </div>
                                                    @if(!empty($comment->childComment))
                                                        @foreach($comment->childComment as $childKey => $childComment)
                                                            <div class="replies">
                                                                <!-- Comment 2 start -->
                                                                <details open class="comment"
                                                                         id="comment-{{$childKey}}">
                                                                    <a href="#comment-{{$childKey}}"
                                                                       class="comment-border-link">
                                                                        <span
                                                                            class="sr-only">Jump to comment-{{$childKey}}</span>
                                                                    </a>
                                                                    <summary>
                                                                        <div class="comment-heading">

                                                                            <div class="comment-info">
                                                                                <a href="#"
                                                                                   class="comment-author">{{$childComment->user->name}}</a>
                                                                                <p class="m-0">
                                                                                    {{\Illuminate\Support\Carbon::parse($childComment->created_at)->diffForHumans()}}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </summary>

                                                                    <div class="comment-body">
                                                                        <p>
                                                                            {{$childComment->comment}}
                                                                        </p>

                                                                        @if(auth()->user())
                                                                            <button type="button"
                                                                                    data-toggle="reply-form-child" data-childComment="{{$childComment->id}}"
                                                                                    data-target="comment-child-{{$childComment->id}}-reply-form">
                                                                                Reply
                                                                            </button>

                                                                            <!-- Reply form start -->
                                                                            <form method="post" action="{{route('product-comment')}}"
                                                                                  class="reply-form d-none"
                                                                                  id="comment-child-{{$childComment->id}}-reply-form">
                                                                                @csrf
                                                                                <input type="hidden" name="productId" value="{{$blog_details->id}}">
                                                                                <input type="hidden" name="parent_id" value="{{$comment->id}}">
                                                                                <input type="hidden" name="userId"
                                                                                       value="{{auth()->user() !== null?auth()->user()->id:''}}">
                                                                                <textarea placeholder="Reply to comment" name="post_comment"
                                                                                          rows="4"></textarea>
                                                                                <button type="submit">Submit</button>
                                                                                <button type="button"
                                                                                        data-toggle="reply-form"
                                                                                        data-target="comment-2-reply-form">
                                                                                    Cancel
                                                                                </button>
                                                                            </form>
                                                                            <!-- Reply form end -->
                                                                        @endif

                                                                    </div>
                                                                </details>
                                                                <!-- Comment 2 end -->
                                                            </div>
                                                        @endforeach

                                                    @endif

                                                </details>
                                            @endforeach

                                            <!-- Comment 1 end -->
                                        </div>
                                    </div>
                                @endif

                                <form class="mt-2" action="{{route('product-comment')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="productId" value="{{$blog_details->id}}">
                                    <input type="hidden" name="userId"
                                           value="{{auth()->user() !== null?auth()->user()->id:''}}">
                                    <div class="form-group">
                                        <textarea required class="form-control status-box" name="post_comment" rows="3"
                                                  placeholder="Enter your comment here..."></textarea>
                                    </div>

                                    <div class="button-group pull-right">
                                        @if(auth()->user())
                                            <div class="button-group pull-right">
                                                <button type="submit" class="btn cmt-btn btn-primary">Post</button>
                                            </div>
                                        @else
                                            <div class="button-group pull-right">
                                                <button type="button" class="btn" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal">
                                                    SignIn
                                                </button>
                                            </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@push('custom.script')
    <script>
        let offerPrice = `{{$blog_details->product_offer_price}}`
        document.querySelector('input[name="quantity"]').addEventListener('input', (event) => {

            let quantity = event.target.closest('.form-control').value
            if (quantity > 0) {
                let totalCountOfQuantity = parseInt(offerPrice) * parseInt(quantity);

                document.querySelector('input[name="totalPriceQuantity"]').value = totalCountOfQuantity
            } else {
                event.target.closest('.form-control').value = 1
            }


        });

        document.querySelector('.submit').addEventListener('click', (event) => {
            event.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "You want to place the order!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, order it!"
            }).then((result) => {
                if (result.isConfirmed) {

                    document.querySelector('#orderPlacedForm').submit()
                }
            });
        })

        document.addEventListener("click", function (event) {
                var target = event.target;
                var replyForm;
                if (target.matches("[data-toggle='reply-form']")) {
                    replyForm = document.getElementById(target.getAttribute("data-target"));
                    replyForm.classList.toggle("d-none");
                }
                if (target.matches("[data-toggle='reply-form-child']")) {
                    let childReplyForm = document.getElementById(target.getAttribute("data-target"));
                    console.log(childReplyForm,'childReplyForm')
                    childReplyForm.classList.toggle("d-none");
                }
            },
            false
        );

    </script>

@endpush
