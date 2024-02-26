<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Checkout form
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="container">
            <div class="row justify-content-center">
                @if ($errors->any())
                    @foreach( $errors->all() as $error )
                        <div class="col-md-4 text-center">
                            <p class="text-danger">{{$error}}</p>
                        </div>
                    @endforeach
                @endif
                
            </div>
        </div>

        <div class="container">

            <main>

                <div class="row g-5">
                    <div class="col-md-5 col-lg-4 order-md-last">
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                    <h6 class="my-0">{{ $room['title'] }}</h6>
                                    <small class="text-body-secondary">{{ $room['descr'] }}</small>
                                </div>
                                <span class="text-body-secondary">Type: {{ $room['type'] }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                <h6 class="my-0">Price</h6>
                                <small class="text-body-secondary">per day</small>
                                </div>
                                <span class="text-body-secondary" id="price">${{ $room['price'] }}</span>
                            </li>
                        </ul>

                    </div>

                    <div class="col-md-7 col-lg-8">
                        <h4 class="mb-3">Check-in/Check-out</h4>
                        <form method="post" action="{{ route( 'book', [ 'id'=> $room['id'] ] ) }}">

                            @csrf

                            <div class="row g-3">

                                <div class="col-sm-6">
                                    <label for="checkin" class="form-label">Check-in Date</label>
                                    <input min="{{ date('Y-m-d') }}" type="date" class="form-control" id="checkin" name="checkin" required>
                                </div>

                                <div class="col-sm-6">
                                    <label for="checkout" class="form-label">Check-out Date</label>
                                    <input min="{{ date('Y-m-d') }}" type="date" class="form-control" id="checkout" name="checkout" required>
                                </div>


                                <hr class="my-4">

                                <button class="w-100 btn btn-primary btn-lg" type="submit">Book the room</button>

                            </div>
                            
                        </form>
                    </div>

                </div>

            </main>

        </div>

    </div>

    <script>
        const perDay = {{ $room['price'] }}
        function calculateDays() {
            var startDate = new Date(document.getElementById("checkin").value);
            var endDate = new Date(document.getElementById("checkout").value);

            // Calculate the time difference in milliseconds
            var timeDiff = endDate.getTime() - startDate.getTime();

            // Convert the time difference to days
            var daysDiff = Math.floor(timeDiff / (1000 * 3600 * 24));

            if( daysDiff > 0 ){
                document.getElementById('price').innerText = '$' + daysDiff*perDay
            }       
        }

        document.getElementById("checkin").addEventListener("input", calculateDays);
        document.getElementById("checkout").addEventListener("input", calculateDays);
  </script>

</x-app-layout>