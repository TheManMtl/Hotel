<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Your Reserved Rooms
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="container my-5">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

                @foreach( $reserves as $room )

                    <div class="col-md-4">
                        <div class="card shadow h-100">
                            <img class="bd-placeholder-img card-img-top" src="{{ asset( $room['roomData']['img'] ) }}" alt="{{ $room['roomData']['title'] }}">
                            <div class="card-body">
                                <p class="card-text">{{ $room['roomData']['title'] }}</p>
                                <p>{{ $room['roomData']['descr'] }}</p>
                                
                                <strong class="text-body-secondary">Cost: {{ $room['cost'] }}</strong>

                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <small class="badge badge-sm bg-success mb-3">{{ date( 'Y/m/d' , strtotime($room['checkin']) ) }}</small>
                                    <small class="badge badge-sm bg-danger mb-3">{{ date( 'Y/m/d' , strtotime($room['checkout']) ) }}</small>    
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            
            </div>

        </div>

    </div>

</x-app-layout>
