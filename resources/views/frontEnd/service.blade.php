@extends('layouts.base')
@section('title', 'Service')
@section('active_service', 'active-page')
@section('content')
    <main>
        <section class="breadcrumb-area d-flex align-items-center position-relative bg-img-center"
                 style="background-image: url('/assets/img/bg//breadcrumb-01.jpg');">
            <div class="container">
                <div class="breadcrumb-content text-center">
                    <h1>Our Services</h1>
                    <ul class="list-inline">
                        <li><a href="/">Home</a></li>
                        <li><i class="fas fa-angle-double-right"></i></li>
                        <li>Services</li>
                    </ul>
                </div>
            </div>
            <h1 class="big-text">Service</h1>
        </section>
        <section class="wcu-section section-padding">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="section-title">
                            <span class="title-top">Why Choose Us</span>
                            <h1>
                                Since1990 We Provides <br/>
                                Professional Service
                            </h1>
                        </div>
                        <div class="feature-accordion accordion" id="featureAccordion">
                            <div class="card">
                                <div class="card-header">
                                    <button type="button" class="active-accordion" data-toggle="collapse"
                                            data-target="#featureOne">
                                        Why Choose Our Product ?<span class="open-icon"><i class="far fa-eye-slash"></i></span><span
                                            class="close-icon"><i class="icon far fa-eye"></i></span>
                                    </button>
                                </div>
                                <div id="featureOne" class="collapse show" data-parent="#featureAccordion">
                                    <div class="card-body">But must explain to you how all this mistaken idea denounie
                                        pleasure and praising pain was borand omnis dolor Tempbus autem officiis debitis
                                        rerum necessitatibus saepe
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <button type="button" data-toggle="collapse" data-target="#featureTwo">
                                        Meet Respond Testing To Make Build ?<span class="open-icon"><i
                                                class="icon far fa-eye-slash"></i></span><span class="close-icon"><i
                                                icon class="far fa-eye"></i></span>
                                    </button>
                                </div>
                                <div id="featureTwo" class="collapse" data-parent="#featureAccordion">
                                    <div class="card-body">But must explain to you how all this mistaken idea denounie
                                        pleasure and praising pain was borand omnis dolor Tempbus autem officiis debitis
                                        rerum necessitatibus saepe
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <button type="button" data-toggle="collapse" data-target="#featureThree">
                                        CSS Grid Challenge: Build A Template ?<span class="open-icon"><i
                                                class="icon far fa-eye-slash"></i></span><span class="close-icon"><i
                                                class="icon far fa-eye"></i></span>
                                    </button>
                                </div>
                                <div id="featureThree" class="collapse" data-parent="#featureAccordion">
                                    <div class="card-body">But must explain to you how all this mistaken idea denounie
                                        pleasure and praising pain was borand omnis dolor Tempbus autem officiis debitis
                                        rerum necessitatibus saepe
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <button type="button" data-toggle="collapse" data-target="#featureFour">
                                        Dwelling Past The Importance Project ?<span class="open-icon"><i
                                                class="icon far fa-eye-slash"></i></span><span class="close-icon"><i
                                                class=" icon far fa-eye"></i></span>
                                    </button>
                                </div>
                                <div id="featureFour" class="collapse" data-parent="#featureAccordion">
                                    <div class="card-body">But must explain to you how all this mistaken idea denounie
                                        pleasure and praising pain was borand omnis dolor Tempbus autem officiis debitis
                                        rerum necessitatibus saepe
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="feature-accordion-img text-right">
                            <img src="/assets/img/tile-gallery/03.jpg" alt="Image"/>
                            <div class="degin-shape">
                                <div class="shape-one"><img src="/assets/img/shape/11.png" alt="Shape"/></div>
                                <div class="shape-two"><img src="/assets/img/shape/12.png" alt="Shape"/></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="service-section section-padding section-bg avson-go-top">
            <div class="container">
                <div class="section-title text-center">
                    <span class="title-top">Our Services</span>
                    <h1>
                        We Provide Most Exclusive <br/>
                        Hotel &amp; Room Services
                    </h1>
                </div>
                <div class="row">
                    @foreach($service as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-service-box service-white-bg text-center wow fadeIn animated"
                             data-wow-duration="1500ms" data-wow-delay="400ms"
                             style="visibility: visible; animation-duration: 1500ms; animation-delay: 400ms;">
                            <span class="service-counter">{{$loop->index+1}}</span>
                            <div class="service-icon"><i class="service_icon1 {{$item->icon}}"></i></div>
                            <h4>{{$item->name}}</h4>
                            <p>{{$item->description}}</p>
                            <a class="read-more" href="{{route('service.show',$item->id)}}">Read More <i class="fas fa-long-arrow-alt-right"></i></a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
@endsection
