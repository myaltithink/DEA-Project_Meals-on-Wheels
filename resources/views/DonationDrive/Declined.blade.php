@extends('layouts.base')
@section('content')
<section class="about-area" id="Donation">

		<ul class="about-content">
			<li class="about-left">
            </li>
			<li class="about-right">
				<h3>Donation process had been declined</h3>
				<p>We are sorry if you have encountered any predicament
                    during the process of your donation that may have caused you to change your decision. We are on it.
                    However, if it's by decision,
                    we sure do convey our greatest thanks!</p>
                 <a class="banner-btn" onclick="history.back()">Go back</a>
	
			</li>
		</ul>
	</section>
    @endsection
@push('styles')
    @vite(['resources/css/declined.css'])
@endpush