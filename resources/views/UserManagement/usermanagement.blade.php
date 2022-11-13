@extends('layouts.base')
@section('content')


<div class="container" id = "table">

    <h1 style=" color: #0077b6; font-size: 75px;">MarryMeals</h1>
    <h3  style=" color: #03045e; font-size: 40px;">User Management</h3>
    <div class="alert alert-primary" role="alert">
        This page is aunthorized only for MaryMeals Admin!
    </div>
    <div class="d-flex justify-content-end">
        <div>
            <select class="form-select px-4 py-2" id = "select-entity">
                <option value="Members"><a href="#">Members</a></option>
                <option value="Caregivers"><a href="#">Caregivers</a></option>
                <option value="Volunteers"><a href="#">Volunteers</a></option>
                <option value="Partner"><a href="#">Partner</a></option>
            </select>
        </div>
    </div>

    <table class="table" id = "entity-table">
        {{-- commented out the sample table for reference: --}}
        {{-- <thead>
          <tr>
            <th scope="col">User ID</th>
            <th scope="col">Full Name</th>
            <th scope="col">Email</th>
            <th scope="col">Gender</th>
            <th scope="col">Birthday</th>
            <th scope="col">Contact</th>
            <th scope="col">Address</th>
            <th scope="col">Functions</th>
          </tr>
        </thead>
        <tbody id = 'user-data-display'>
          <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto@gmail.com</td>
            <td>Male</td>
            <td>12-23-12</td>
            <td>21314132422</td>
            <td>Philippines</td>
            <td>
                <button type="button" class="btn btn-primary" style="border-radius: 25px; width:120px;">Update</button>
                <button type="button" class="btn btn-secondary" style="border-radius: 25px; width:120px;">Delete</button>
            </td>
          </tr>

        </tbody> --}}
      </table>
</div>
{{--
<header>
    <h2 style="background-color: #1d3557;
    padding: 30px;
    text-align: center;
    font-size: 18px;
    color: white;"><i>Meals On Wheels</i><br><i>Meals On Wheels</i><br><i>Meals On Wheels</i></h2>
  </header>

{{-- table for partner user

<div class="partners" style=" margin: 30px; margin-left: 50px;">

    <h3  style=" color: #457b9d; font-size: 40px;">Partners</h3>

      </div>
        <table class="table 2" style=" margin: 50px; margin-left: 50px;">
            <thead>
                <tr>
                  <th scope="col">Partner ID</th>
                  <th scope="col">Partner Name</th>
                  <th scope="col">Registered by</th>
                  <th scope="col">Partner Address</th>
                  <th scope="col">Functions</th>

                </tr>
              </thead>
              <tbody id = 'partner-data-display'>
                <tr>
                  <th scope="row">1</th>
                  <td>ABC Corporation</td>
                  <td>abc@gmail.com</td>
                  <td>Singapore</td>
                  <td><button type="button" class="btn btn-primary" style="border-radius: 25px; width:120px;">Update</button>
                      <button type="button" class="btn btn-secondary" style="border-radius: 25px; width:120px;">Delete</button>
                  </td>
                </tr>

              </tbody>
            </table>
      </div> --}}
      @vite(['resources/js/user-management.js'])

@endsection
