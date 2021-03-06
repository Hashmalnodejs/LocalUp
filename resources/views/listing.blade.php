@extends('layouts.app')

@section('content')
<div id="component-offers-list" class="pb-5">
    <div class="container">
        <h1>Nos offres de locations</h1>
        <div class="row mt-4" id="accordion">
            <div class="col-lg-6" id="cities">
              <button class="btn btn-primary btn-block collapsed mb-2" data-toggle="collapse" data-target="#collapseCity" aria-expanded="false" aria-controls="collapseCity">
                Filtrer par ville
              </button>
            </div>
            <div class="col-lg-6" id="categories">
              <button class="btn btn-primary btn-block collapsedmb-2" data-toggle="collapse" data-target="#collapseCategory" aria-expanded="false" aria-controls="collapseCategory">
                Filtrer par type
              </button>
            </div>
            <div class="col-12 py-4 text-center">
                <div class="collapse" aria-labelledby="cities" data-parent="#accordion" id="collapseCity">
                    <button class="btn btn-light" data-mixitup-control data-filter="all">Toutes</button>
                    @foreach($cities as $city)
                        <button class="btn btn-light" data-filter=".{{ str_slug($city->label, '-') }}" data-mixitup-control>{{ ucfirst($city->label) }}</button>
                    @endforeach
                </div>
                <div class="collapse" aria-labelledby="categories" data-parent="#accordion" id="collapseCategory">
                    <button class="btn btn-light" data-mixitup-control data-filter="all">Toutes</button>
                    @foreach($categories as $category)
                        <button class="btn btn-light" data-filter=".{{ str_slug($category->label, "-") }}" data-mixitup-control>{{ ucfirst($category->label) }}</button>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row justify-content-center" id="offers_list">
            @foreach($locals as $local)
                <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4 mix {{ str_slug( $local->city->label ) . ' ' . str_slug($local->category->label) }}">
                    <div class="offer">
                        <div class="img-offer">
                            @if($local->image_url)
                                <img src="{{ asset('storage').'/'.$local->image_url }}" class="img-fluid" alt="">
                            @else
                                <img src="https://imgplaceholder.com/500x300" class="img-fluid" alt="">
                            @endif
                        </div>
                        <div class="description-offer text-center p-4 bg-light">
                            <h6 class="text-nowrap">{{ $local->label }}</h6>
                            <h3 class="mt-0">
                              <span class="text-nowrap">{{ $local->category->label }}</span>,<br/>
                              {{ $local->city->label }}
                            </h3>

                            <a href="{{ route('local', ['id' => $local]) }}" class="btn btn-primary">En savoir +</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
     </div>
  </div>
@endsection
