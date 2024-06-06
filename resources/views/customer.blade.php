@extends('layouts.app')

@section('content')
 <!-- Hero Section -->
 <div class="container mt-5">
                <div class="jumbotron text-center bg-light">
                    <h1 class="display-4">Welcome to {{ config('app.name', 'PCI') }}</h1>
                    <p class="lead">Your Trusted Partner in Global Import and Export Solutions</p>
                    <hr class="my-4">
                    <p>Connecting businesses worldwide with reliable and efficient trade services.</p>
                    <a class="btn btn-primary btn-lg" href="{{ route('register') }}" role="button">Get Started</a>
                </div>
            </div>

            <!-- Features Section -->
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Global Reach</h5>
                                <p class="card-text">Expanding your business horizons with our extensive network of international partners.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Efficient Logistics</h5>
                                <p class="card-text">Ensuring timely and safe delivery of your goods across the globe.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Compliance & Security</h5>
                                <p class="card-text">Adhering to international standards and regulations for hassle-free trade.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
