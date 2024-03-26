@extends('home')

@section('addContact')
<section id="ContactForm" class="p-3 p-md-4 p-xl-5 position-fixed top-50 start-50 translate-middle rounded-3 w-75 z-3" style="box-sizing: content-box; display:none;">


    <div class="container">

        <i class="mdi mdi-close position-fixed translate-middle-x end-0 me-5" role="button" style="font-size:large;"></i>

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
                                <h2 class="h3">Registration</h2>
                                <h3 class="fs-6 fw-normal text-secondary m-0">Enter your details to register</h3>
                            </div>
                        </div>
                    </div>
                    @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                    @endif
                    <form action="{{route('create.contact')}}" method="POST">
                    @csrf
                        <div class="row gy-3 gy-md-4 overflow-hidden">
                            <div class="col-12">
                                <label for="first_name" class="form-label">Nama Depan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" required>
                            </div>
                            <div class="col-12">
                                <label for="last_name" class="form-label">Nama Belakang <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" required>
                            </div>
                            <div class="col-12">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
                            </div>
                            <div class="col-12">
                                <label for="phone" class="form-label">No. Handphone <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" name="phone" id="phone" value="" required>
                            </div>
                            <div class="col-12">
                                <div class="d-grid">
                                    <button class="btn bsb-btn-xl btn-primary" type="submit">Sign up</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const showAddContactBtn = document.getElementsByClassName('add-btn')[0];
        const hideContactBtn = document.getElementsByClassName('mdi-close')[0];
        const addContactForm = document.getElementById('ContactForm');

        showAddContactBtn.addEventListener('click', function() {
            addContactForm.style.display = 'block';
            addCSRFToken(); // Panggil fungsi untuk menambahkan CSRF token
        });
        hideContactBtn.addEventListener('click', function() {
            addContactForm.style.display = 'none';
        });

    });
</script>

@endsection