@extends('frontend.layouts.app')

@section('content')
    <div class="blog-post-area">
        <h2 class="title text-center">Latest From our Blog</h2>
        <!-- <div class="single-blog-post">
            <h3>Girls Pink T Shirt arrived in store</h3>
            <div class="post-meta">
                <ul>
                    <li><i class="fa fa-user"></i> Mac Doe</li>
                    <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                    <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                </ul>
                <span>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-o"></i>
                </span>
            </div>
            <a href="">
                <img src="{{ asset('frontend/images/blog/blog-one.jpg') }}" alt="">
            </a>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
                ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                nulla pariatur.</p>
            <a class="btn btn-primary" href="">Read More</a>
        </div> -->

        @foreach ($blogPosts as $post)
            <div class="single-blog-post">
                <h3>{{ $post->title }}</h3>
                <div class="post-meta">
                    <ul>
                        <li><i class="fa fa-user"></i> Trung Lê </li>
                        <li><i class="fa fa-clock-o"></i> {{ $post->created_at->format('g:i a') }}</li>
                        <li><i class="fa fa-calendar"></i> {{ $post->created_at->format('M d, Y') }}</li>
                    </ul>
                    <span>
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $post->rating)
                                <i class="fa fa-star"></i>
                            @else
                                <i class="fa fa-star-o"></i>
                            @endif
                        @endfor
                    </span>
                </div>
                <a href="">
                    <img src="{{ asset('upload/description/content/' . $post->image) }}" alt="{{ $post->title }}" style="width: 400px; height: 400px;">
                </a>
                <p>{{ $post->description }}</p>
                <a class="btn btn-primary" href="{{ url('/view-blog/blog-detail/'.$post->id) }}">Read More</a>

            </div>
        @endforeach


        <div class="pagination-area">
            <ul class="pagination">
                {{ $blogPosts->links('pagination::simple-bootstrap-4') }}
            </ul>
        </div>
    </div>
    </div>
@endsection
