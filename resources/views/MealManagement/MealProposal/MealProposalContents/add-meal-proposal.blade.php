@extends('MealManagement.MealProposal.meal-proposal-template')
@section('main')
    <div class = "row h-100">
        <div class = "col-md-2 col-0"></div>
        <div class = "col-md-8 col-12">
           <div class = "card shadow-sm p-3">
                <div class = "alert alert-info">
                    <strong>Separate ingredients by "," (Comma).</strong>
                </div>
               <h1 class="text-uppercase text-center">Add meal</h1>
                <form class="row gy-3" method="POST" action="{{ route('add-meal') }}" enctype="multipart/form-data">
                    @csrf
                    @role('ROLE_PARTNER')
                        <div class = "col-12">
                            <label  class = "fw-bold" for = "employee_name">Employee Name</label>
                            <input class="form-control w-100 @error('employee_name') is-invalid @enderror" name = "employee_name">
                            <div class = "invalid-feedback">
                                @error('employee_name')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    @endrole

                    <div class = "col-12">
                        <label  class = "fw-bold" for = "meal_name">Meal Name</label>
                        <input class="form-control w-100 @error('meal_name') is-invalid @enderror" name = "meal_name">
                        <div class = "invalid-feedback">
                            @error('meal_name')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class = "col-12">
                        <label  class = "fw-bold" for = "meal_image">Meal Image</label>
                        <input class="form-control w-100 @error('meal_image') is-invalid @enderror" name = "meal_image" type="file" accept="image/png, image/gif, image/jpeg">
                        <div class = "invalid-feedback">
                            @error('meal_image')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class = "col-12">
                        <label  class = "fw-bold" for = "ingredients">Ingredients</label>
                        <textarea class="form-control w-100 @error('ingredients') is-invalid @enderror" name = "ingredients" style="height: 10rem"></textarea>
                        <div class = "invalid-feedback">
                            @error('ingredients')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <button class ="btn btn-primary w-100">
                            Submit
                        </button>
                    </div>
                </form>
           </div>
        </div>
        <div class="col-md-2 col-0"></div>
    </div>
@endsection
