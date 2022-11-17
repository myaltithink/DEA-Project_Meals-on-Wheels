@extends('layouts.base')
@section('content')

<style>


.form-control:focus {
    box-shadow:#14213d;
    border-color: #14213d;
}

.profile-button {
    background: rgb(31, 36, 116);
    box-shadow: none;
    border: none
}

.profile-button:hover {
    background: #14213d
}

.profile-button:focus {
    background: #14213d;
    box-shadow: none
}

.profile-button:active {
    background: #14213d;
    box-shadow: none
}

.back:hover {
    color: #14213d;
    cursor: pointer
}

.labels {
    font-size: 11px
}

.add-experience:hover {
    background: #14213d;
    color: #fff;
    cursor: pointer;
    border: solid 1px #14213d;
}

</style>

<div class="container rounded bg-white mt-5 mb-5" >
    <div class="row">

        <div class="col-md-5 border-right" >
            <div class="p-3 py-5" style=" margin-left:24%;
            padding: 10px;  width: 200%; border-radius: 60px;
             box-shadow: 0px 0px 1em 1em rgba(184, 184, 192, 0.521);">

                <h1 style=" color: #0077b6; font-size: 50px;">MarryMeals</h1>
                <h3  style=" color: #03045e; font-size: 20px;">Update Partner's Information</h3>
                <div class="alert alert-primary" role="alert">
                    This page is aunthorized only for MaryMeals Admin!
                </div>

                <div class="row mt-2" >
                    <div class="col-md-6" ><label class="labels">Partner Name</label><input type="text" class="form-control" placeholder="enter partners name" value=""></div>
                    <div class="col-md-6"><label class="labels">Registered by</label><input type="text" class="form-control" value="" placeholder="registered by "></div>
                    <div class="col-md-6"><label class="labels">Partner Address</label><input type="text" class="form-control" placeholder="enter partner address" value=""></div>

                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Update Profile</button></div>
            </div>
        </div>

    </div>
</div>
</div>
</div>


@endsection
