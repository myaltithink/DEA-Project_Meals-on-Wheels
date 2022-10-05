@extends('MealManagement.MealProposal.meal-proposal-template')
@section('main')
    <div class = "row h-100">
        <div class = "col-md-2 col-0"></div>
        <div class = "col-md-8 col-12">
           <div class = "card shadow-sm p-3">
               <h1 class="text-uppercase text-center">Add meal</h1>
                <form class="row gy-3">
                    <div class = "col-12">
                        <label  class = "fw-bold" for = "meal_name">Meal Name</label>
                        <input class="form-control w-100" name = "meal_name">
                    </div>
                    <div class = "col-12">
                        <label  class = "fw-bold" for = "meal_image">Meal Image</label>
                        <input class="form-control w-100" name = "meal_image" type="file">
                    </div>
                    <div class = "col-12">
                        <label  class = "fw-bold" for = "ingredients">Ingredients</label>
                        <textarea class="form-control w-100" name = "ingredients" style="height: 10rem"></textarea>
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
