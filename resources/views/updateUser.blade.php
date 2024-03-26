@extends('home')

@section('updateUser')
<section id="UpdateContactForm" class="p-3 p-md-4 p-xl-5 position-fixed top-50 start-50 translate-middle rounded-3 w-75 z-3" style="box-sizing: content-box; display:block;">

    <div class="container">

        <a href="{{ route('get.contact') }}"><i class="mdi mdi-close position-fixed translate-middle-x end-0 me-5" role="button" style="font-size:large;"></i></a>

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
                                <h2 class="h3">Update </h2>
                                <h3 class="fs-6 fw-normal text-secondary m-0">Enter your details to register</h3>
                            </div>
                        </div>
                    </div>
                    @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                    @endif
                    <form action="{{ route('user.update') }}" method="POST">
                        @csrf
                        @method('PUT') 
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ Auth::user()->username }}">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank to keep current password">
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection