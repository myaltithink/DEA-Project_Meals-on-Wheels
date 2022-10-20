@extends('layouts.base')
@section('content')
    <div class="d-flex justify-content-center mt-5 mb-5">
        <div class="col-10 col-md-8 col-lg-6">
            <h4>Contact Us</h4>
            <p>You may send us a message using the form below if you have any query or feedback as well if you
                have any
                issues with the website and would like to be address</p>
            <form action="{{ route('send.message') }}" method="POST">

                <div class="form-control border-0 ps-0 pe-0">
                    <label for="email">Email:</label>
                    <input type="text" name="email" class="form-control" required>
                </div>

                <div class="form-control border-0 ps-0 pe-0">
                    <label for="message">Message:</label>
                    <textarea name="message" id="message" cols="30" rows="10" class="form-control" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary w-100 mt-2">Send</button>
                @csrf
            </form>
        </div>
    </div>
@endsection
