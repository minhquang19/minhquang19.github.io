@extends('layouts.base')
@section('title', 'Blog Details')
@section('active_blog', 'active-page')
@section('content')
    <main>
        <section class="breadcrumb-area d-flex align-items-center position-relative bg-img-center"
                 style="background-image: url(&quot;/assets/img/bg/breadcrumb-02.jpg&quot;);">
            <div class="container">
                <div class="breadcrumb-content text-center">
                    <h1>Blog Details</h1>
                    <ul class="list-inline">
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li>
                            <i class="fas fa-angle-double-right"></i></i>
                        </li>
                        <li>Blog Details</li>
                    </ul>
                </div>
            </div>
            <h1 class="big-text">Room</h1>
        </section>
        <section class="blog-details-wrapper section-padding section-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="post-details">
                            <div class="entry-header">
                                <div class="post-thumb">
                                    <img src="/upload/blog/{{$detail->image}}" alt="Image">
                                </div>
                                <ul class="entry-meta list-inline">
                                    <li>
                                        <a href="">
                                            <i class="fas fa-user-alt"></i>{{$detail->creator}}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="single-blog.html">
                                            <i class="far fa-calendar-alt"></i>{{$detail->created_at}}
                                        </a>
                                    </li>
                                </ul>
                                <h2 class="entry-title">{{$detail->title}} </h2>
                            </div>
                            <div class="entry-content">
                                {!! $detail->content !!}
                                <div class="entry-gallery-img">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <figure class="entry-media-img">
                                                <img src="/upload/blog/{{$detail->image}}" alt="Image">
                                            </figure>
                                        </div>
                                        <div class="col-md-6">
                                            <figure class="entry-media-img">
                                                <img src="/upload/blog/{{$detail->image}}" alt="Image">
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                                <blockquote>
                                    {{$detail->note}}
                                </blockquote>
                            </div>
                            <div class="entry-footer d-flex justify-content-md-between">
                                <ul class="social-share list-inline">
                                    <li class="title">Share</li>
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-google-plus-g"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="sidebar-wrap">
                            <div class="widget search-widget">
                                <h4 class="widget-title">Search Here</h4>
                                <form>
                                    <input type="text" placeholder="Seacrh Keywords">
                                    <button>
                                        <i class="fas fa-search"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="widget recent-news avson-go-top">
                                <h4 class="widget-title">Latest News</h4>
                                <ul>
                                    @foreach($random as $item)
                                        <li>
                                            <div class="recent-post-img">
                                                <img src="/upload/blog/{{$item->image}}" alt="Image">
                                            </div>
                                            <div class="recent-post-desc">
                                                <h6>
                                                    <a href="{{route('blog.show',$item->id)}}">{{$item->title}}</a>.
                                                </h6>
                                                <span class="date">{{$item->created_at}}</span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="widget banner-widget avson-go-top"
                                 style="background-image: url(&quot;/assets/img/blog/sidebar-banner.jpg&quot;);">
                                <h2>Booking Your Latest apartment</h2>
                                <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit sed do eiusmod tempor
                                    incididunt ut labore </p>
                                <a class="btn filled-btn" href="/room-details">BOOK NOW
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
