@extends('layouts.base')
@section('content')
<section class="about-area" id="Donation">

		<ul class="about-content">
			<li class="about-left">
            </li>
			<li class="about-right">
				<h3>Donation process had been cancelled</h3>
				<p>We are sorry if you have encountered an error
                    during the process of donation. We are on it.
                    However, if it's by decision, even it's only an attempt, 
                    we sure do convey our greatest thanks!</p>
                 <a class="banner-btn" href="{{ url('/donation') }}">Go back</a>
	
			</li>
		</ul>
	</section>
    @endsection
@push('styles')
    @vite(['resources/css/error.css'])
@endpush