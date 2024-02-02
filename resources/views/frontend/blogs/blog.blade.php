@extends('frontend.layouts.app')

@section('content')
@section('id_blog', $blog->id)
<div class="blog-post-area">
    <h2 class="title text-center">Latest From our Blog</h2>
    <div class="single-blog-post">
        <h3>{{ $blog->title }}</h3>
        <div class="post-meta">
            <ul>
                <li><i class="fa fa-user"></i> Mac Doe</li>
                <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
            </ul>
            <!-- <span>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star-half-o"></i>
            </span> -->
        </div>
        <a href="">
            <img src="{{ asset('upload/description/content/' . $blog->image) }}" alt="">
        </a>
        <p>{!! $blog->content !!} </p> <br>

        <div class="pager-area">
            <ul class="pager pull-right">
                @if ($previousBlogId)
                    <li>
                        <a href="{{ url('/view-blog/blog-detail/' . $previousBlogId) }}">Pre</a>
                    </li>
                @endif
                @if ($nextBlogId)
                    <li>
                        <a href="{{ url('/view-blog/blog-detail/' . $nextBlogId) }}">Next</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div><!--/blog-post-area-->
<div class="rate">
    <div class="vote">
        <ul class="ratings">
            <li class="rate-this">Rate this item:</li>
            <li>
                <div class="star_1 ratings_stars">
                    <input value="1" type="hidden">
                </div>
                <div class="star_2 ratings_stars">
                    <input value="2" type="hidden">
                </div>
                <div class="star_3 ratings_stars">
                    <input value="3" type="hidden">
                </div>
                <div class="star_4 ratings_stars">
                    <input value="4" type="hidden">
                </div>
                <div class="star_5 ratings_stars">
                    <input value="5" type="hidden">
                </div>
            <li class="rate-np">{{ $averageRate }}</li>
            </li>
        </ul>
        <ul class="tag">
            <li>TAG:</li>
            <li><a class="color" href="">Pink <span>/</span></a></li>
            <li><a class="color" href="">T-Shirt <span>/</span></a></li>
            <li><a class="color" href="">Girls</a></li>
        </ul>
    </div>
</div>
<div class="socials-share">
    <a href=""><img src="images/blog/socials.png" alt=""></a>
</div><!--/socials-share-->


<!--Comments-->
<div class="response-area">
    <h2>3 RESPONSES</h2>
    <ul class="media-list">

        @foreach ($comments as $comment)
            @if ($comment->level == 0)
                <li class="media" id="{{ $comment->id }}">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="{{ asset('upload/members/avatar/' . $comment->avatar) }}"
                            alt="" width="50" height="50">

                    </a>
                    <div class="media-body">
                        <ul class="sinlge-post-meta">
                            <li><i class="fa fa-user"></i>{{ $comment->name }}</li>
                            <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                            <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                        </ul>
                        <p>{{ $comment->cmt }} </p>
                        <a class="btn btn-primary replayLink" href=""><i class="fa fa-reply"></i>Replay</a>
                    </div>

                </li>

                @foreach ($comments as $childComment)
                    @if ($childComment->level == $comment->id)
                        <li class="media second-media" id="{{ asset('upload/members/avatar/' . $childComment->id) }}"
                            width="50" height="50">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="{{ $childComment->avatar }}" alt="">
                            </a>
                            <div class="media-body">
                                <ul class="sinlge-post-meta">
                                    <li><i class="fa fa-user"></i>{{ $childComment->name }}</li>
                                    <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                                    <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                                </ul>
                                <p>{{ $childComment->cmt }}</p>

                            </div>

                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach
    </ul>
</div><!--/Response-area-->
<div class="replay-box">
    <div class="row">
        <div class="col-sm-12">
            <h2>Leave a replay</h2>

            <div class="text-area">
                <div class="blank-arrow">
                    <label>Your Name</label>
                </div>
                <span>*</span>
                <textarea class='message' name="message" rows="11"></textarea>
                <a class="btn btn-primary" id="cmt" href="">post comment</a>
            </div>
        </div>
    </div>
</div><!--/Repaly Box-->


<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //vote
        $('.ratings_stars').hover(
            // Handles the mouseover
            function() {
                $(this).prevAll().andSelf().addClass('ratings_hover');
                // $(this).nextAll().removeClass('ratings_vote'); 
            },
            function() {
                $(this).prevAll().andSelf().removeClass('ratings_hover');
                // set_votes($(this).parent());
            }
        );
        // Check login
        var checkLogin = "{{ Auth::Check() }}";


        $('.ratings_stars').click(function() {

            // alert("kiểm tra login" + checkLogin);

            if (checkLogin) {
                var id_user = "{{ Auth::id() }}"
                var rate = $(this).find("input").val();
                var id_blog = @yield('id_blog', 'default_value_if_not_defined');

                // console.log(rate);
                // console.log(id_blog);
                // console.log(id_user);

                if ($(this).hasClass('ratings_over')) {
                    $('.ratings_stars').removeClass('ratings_over');
                    $(this).prevAll().andSelf().addClass('ratings_over');
                } else {
                    $(this).prevAll().andSelf().addClass('ratings_over');
                }

                // phan tich xem rate co gi? de tao table co đung?
                // id, rate, id_blog, id_user
                // dung ajax gui qua controller va insert table rate
                $.ajax({
                    type: 'POST',
                    url: '{{ url('/view-blog/blog-detail/rate') }}',
                    data: {
                        rate: rate,
                        id_blog: id_blog,
                        id_user: id_user,
                    },
                    success: function(data) {
                        console.log(data.message);
                        console.log(data.rate);

                        $('.rate-np').val(data.rate);
                    }
                });


            } else {
                alert("vui long login de rate");
            }

        });

        // click tag <a> to reply
        var level = '0';
        $(document).on('click', '.replayLink', function(e) {
            console.log('Click event triggered on replayLink');
            e.preventDefault(); 
            $('.message').focus();
            // nếu click reply thì level = id cmt cha
            var commentId = $(this).closest('li.media').attr('id');
            console.log('Comment ID:', commentId);
            level = commentId;

        });
        //cmt
        $('.message').click(function() {
            if (!checkLogin) {
                alert("Dang nhap de comment");
            }
        });
        $('.message').on('input', function() {
            if (!checkLogin) {
                alert("Dang nhap de comment");
                $(this).val('');
            }
        });
        $('#cmt').click(function(e) {
            e.preventDefault();
            if (!checkLogin) {
                alert("Dang nhap de post comment");
            } else {

                var cmt = $('.message').val();;
                var id_blog = @yield('id_blog', 'default_value_if_not_defined');
                // console.log(id_blog,id_user,name,avatar,cmt);
                $.ajax({
                    type: 'POST',
                    url: '{{ url('/view-blog/blog-detail/comment') }}',
                    data: {
                        cmt: cmt,
                        id_blog: id_blog,
                        level: level,
                    },
                    success: function(res) {
                        var baseAvatarUrl = "{{ url('upload/members/avatar/') }}" +
                                "/" + res.data.avatar;
                            console.log(baseAvatarUrl);
                        if (res.data.level == '0') {
                                console.log('ID_CMT' + res.data.id);
                            var html =

                                '<li class="media" id="'+res.data.id +'">' +
                                '<a class="pull-left" href="#">' +
                                '<img class="media-object" src="' + baseAvatarUrl +
                                '" alt="" width="50" height="50">' +
                                '</a>' +
                                '<div class="media-body">' +
                                '<ul class="sinlge-post-meta">' +
                                '<li><i class="fa fa-user"></i>' + res.data.name + '</li>' +
                                '<li><i class="fa fa-clock-o"></i> 1:33 pm</li>' +
                                '<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>' +
                                '</ul>' +
                                '<p>' + res.data.cmt + '</p>' +
                                '<a class="btn btn-primary replayLink" href=""><i class="fa fa-reply"></i>Replay</a>' +
                                '</div>' +
                                '</li>'

                            $('.media-list').append(html);

                        } else {
                            var html =
                                '<li class="media second-media">' +
                                '<a class="pull-left" href="#">' +
                                '<img class="media-object" src="' + baseAvatarUrl +
                                '" alt="" width="50" height="50">' +

                                '</a>' +
                                '<div class="media-body">' +
                                '<ul class="sinlge-post-meta">' +
                                '<li><i class="fa fa-user"></i>' + res.data.name + '</li>' +
                                '<li><i class="fa fa-clock-o"></i> 1:33 pm</li>' +
                                '<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>' +
                                '</ul>' +
                                '<p>' + res.data.cmt + ' </p>' +

                                '</div>' +
                                '</li>'
                            $('#' + res.data.level).append(html);
                            level = '0';
                            $('.message').val('');

                        }



                    }
                });

            }
        });

    });
</script>

@endsection
