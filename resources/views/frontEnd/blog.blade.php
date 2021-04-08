@extends('layouts.base')
@section('title', 'Blog')
@section('active_blog', 'active-page')
@section('content')
<main>
    <section class="breadcrumb-area d-flex align-items-center position-relative bg-img-center" style="background-image: url('/assets/img/blog/blog-breadcrumb.jpg');">
                <div class="container">
                    <div class="breadcrumb-content text-center">
                        <h1>Blog Gird</h1>
                        <ul class="list-inline">
                            <li><a href="/">Home</a></li>
                            <li><i class="fas fa-angle-double-right"></i></li>
                            <li>Blogs</li>
                        </ul>
                    </div>
                </div>
                <h1 class="big-text">Room</h1>
    </section>
    <section class="blog-wrapper blog-gird-view section-padding section-bg">
        <div class="container">
            <div class="post-loop avson-go-top">
                <div class="row">
                    @foreach($bloglist as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-blog-wrap">
                            <div class="post-thumbnail"><img src="/upload/blog/{{$item->image}}" alt="Image" /></div>
                            <div class="post-desc">
                                <ul class="blog-meta list-inline">
                                    <li>
                                        <a href=""><i class="far fa-calendar-alt"></i>{{$item->created_at}}</a>
                                    </li>
                                </ul>
                                <h3><a href="{{route('blog.show',$item->id)}}">{{$item->title}}</a></h3>
                                <a class="read-more" href="{{route('blog.show',$item->id)}}">Read More <i class="fas fa-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            {{$bloglist->links('vendor.pagination.bootstrap-4')}}
        </div>
    </section>
</main>
@endsection
