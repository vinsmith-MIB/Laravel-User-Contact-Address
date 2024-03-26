@extends('Addresses\addresess')

@section('updateAddress')
<section id="UpdateAddressForm" class="p-3 p-md-4 p-xl-5 position-fixed top-50 start-50 translate-middle rounded-3 w-75 z-3" style="box-sizing: content-box; display:block;">

    <div class="container">

        <a href="{{ route('addresses.index', ['idContact' => $idContact]) }}">
            <i class="mdi mdi-close position-fixed translate-middle-x end-0 me-5" role="button" style="font-size:large;"></i>
        </a>

        <div class="row">
            <div class="col-12 col-md-6 bsb-tpl-bg-platinum">
                <div class="d-flex flex-column justify-content-center h-100 p-3 p-md-4 p-xl-5">
                    <img class="img-fluid rounded mx-auto my-4" loading="lazy" src="https://img.freepik.com/free-vector/mobile-messaging-modern-communication-technology-online-chatting-sms-texting-modern-leisure-activity-guy-checking-email-inbox-with-smartphone_335657-1584.jpg?t=st=1710794533~exp=1710798133~hmac=7aae6608904397d8fe8e1149486ff2c9dcccc4711aaaf9d67cb6ec3965167f8f&w=1380" width="400" height="300" alt="BootstrapBrain Logo">

                </div>
            </div>
            <div class="col-12 col-md-6 bsb-tpl-bg-lotion">
                <div class="p-3 p-md-4 p-xl-5">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-5">
                                <h2 class="h3">Update Address</h2>
                                <!-- Judul atau deskripsi lain sesuai kebutuhan -->
                            </div>
                        </div>
                    </div>
                    @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                    @endif
                    <form action="{{ route('addresses.update', ['idContact' => $idContact, 'idAddress' => $address->id]) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Gunakan method PUT untuk update -->
                        <div class="form-group">
                            <label for="street">Street</label>
                            <input type="text" class="form-control" id="street" name="street" value="{{ $address->street }}">
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{ $address->city }}">
                        </div>
                        <div class="form-group">
                            <label for="province">Province</label>
                            <input type="text" class="form-control" id="province" name="province" value="{{ $address->province }}">
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" id="country" name="country" value="{{ $address->country }}">
                        </div>
                        <div class="form-group">
                            <label for="postal_code">Postal Code</label>
                            <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ $address->postal_code }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Address</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection