@extends('layouts.base')
@section('content')
<section class="about-area" id="Donation">

		<ul class="about-content">
			<li class="about-left">
            </li>
			<li class="about-right">
				<h3>Transaction ID: <br> <?php echo $_GET['paymentId']?></h3>
            
                <br>
				<p><strong>Please do take a screenshot for emergency purposes.</strong> We are greatly pleased by your unending kindness. Rest assured that the lended hand will
                    reach the people with needs. The organization expresses their deepest gratitude
                </p>
                 <a class="banner-btn" href="{{ url('/donation') }}">Go back</a>
	
			</li>
		</ul>
	</section>
    @endsection
@push('styles')
    @vite(['resources/css/Success.css'])
@endpush