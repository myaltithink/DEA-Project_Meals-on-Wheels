@extends('layouts.base')
@section('content')
	<section class="banner-area">
		<div class="banner-img"></div>
		<h3>A charity driven community:</h3>
     
		<h1>Meals on <span>wheels</span></h1>
       
        <a class="banner-btn" href="{{ url('#Donation') }}">Lend a hand</a>
	
	</section>
	<section class="about-area" id="Donation">
		<h3 class="section-title">Donation <span>Drive</span></h3>
		<ul class="about-content">
			<li class="about-left"></li>
			<li class="about-right">
				<h2>A whole new smile for the elders</h2>
				<p>This community is transparently driven by charity 
                    and donation drives. All of the hands lend are surely given
                as assistance to those elders that can no longer fend for themselves.
                The organization greatly conveys their deepest gratitude for your
                unending kindness. Thanks you for putting a whole new smile to the elders.</p>
                <form action="{{ url('charge') }}" method="post">
              
                    <input type="text" name="amount" placeholder="Enter amount" class="form-control mb-0" required>
                    <input type="submit" name="submit" value="Send donation" onClick="alert('Confirm donation process by clicking okay')" class="btn btn-primary w-100 mt-3"></input>
                @csrf
                </form>
			</li>
		</ul>
	</section>
    @endsection

@push('styles')
    @vite(['resources/css/donation.css'])
@endpush
