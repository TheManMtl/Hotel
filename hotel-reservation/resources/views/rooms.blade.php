<x-public-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Rooms
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container my-5">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

                @foreach( $list as $room )

                    <div class="col-md-4">
                        <div class="card shadow h-100">
                            <img class="bd-placeholder-img card-img-top" src="{{ asset( $room['img'] ) }}" alt="{{ $room['title'] }}">
                            <div class="card-body">
                                <p class="card-text">{{ $room['title'] }}</p>
                                <p>Type: {{ $room['descr'] }}</p>
                                <small class="badge badge-sm bg-info mb-3">Price: ${{ $room['price'] }} per night</small>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="{{ route( 'checkout', [ 'id'=> $room['id'] ] ) }}" type="button" class="btn btn-sm btn-success shadow">Reserve</a>
                                    </div>
                                    <small class="text-body-secondary">person: {{ $room['type'] }}</small>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            
            </div>

        </div>
    </div>
</x-public-layout>