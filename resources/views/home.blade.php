@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="tab">
                    @can('manage1-users')
                    <button class="tablinks" onclick="openCity(event, 'London')">Tab 1</button>
                    @endcan
                    @can('manage-users')
                    <button class="tablinks" onclick="openCity(event, 'Paris')">Tab 2</button>
                    <button class="tablinks" onclick="openCity(event, 'Tokyo')">Tab 3</button>
                    @endcan
                    @can('delete-users')
                    <button class="tablinks" onclick="openCity(event, 'Bangi')">Tab 4</button>
                    <button class="tablinks" onclick="openCity(event, 'Kajang')">Tab 5</button>
                    @endcan
                    </div>
                    <div id="London" class="tabcontent">
                    <h3>
                    <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-7">
                        <h4>Products In Our Store</h4>
                    </div>
                </div>
                <hr>
                <div class="row">
                    @foreach($products as $pro)
                        <div class="col-lg-3">
                            <div class="card" style="margin-bottom: 20px; height: auto;">
                                <img src="/images/{{ $pro->image_path }}"
                                     class="card-img-top mx-auto"
                                     style="height: 150px; width: 150px;display: block;"
                                     alt="{{ $pro->image_path }}"
                                >
                                <div class="card-body">
                                    <a href=""><h6 class="card-title">{{ $pro->name }}</h6></a>
                                    <p>RM{{ $pro->price }}</p>
                                    <form action="{{ route('cart.store') }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $pro->id }}" id="id" name="id">
                                        <input type="hidden" value="{{ $pro->name }}" id="name" name="name">
                                        <input type="hidden" value="{{ $pro->price }}" id="price" name="price">
                                        <input type="hidden" value="{{ $pro->image_path }}" id="img" name="img">
                                        <input type="hidden" value="{{ $pro->slug }}" id="slug" name="slug">
                                        <input type="hidden" value="1" id="quantity" name="quantity">
                                        <div class="card-footer" style="background-color: white;">
                                              <div class="row">
                                                <button class="btn btn-secondary btn-sm" class="tooltip-test" title="add to cart">
                                                    <i class="fa fa-shopping-cart"></i> add to cart
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

                    </h3>
  
                    </div>

                    <div id="Paris" class="tabcontent">
                    <h3>Tab 2</h3>
  
                    </div>

                    <div id="Tokyo" class="tabcontent">
                    <h3>Tab 3</h3>
  
                    </div>

                    <div id="Bangi" class="tabcontent">
                    <h3>Tab 4</h3>
  
                    </div>
                    <div id="Kajang" class="tabcontent">
                    <h3>Tab 5</h3>
  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
