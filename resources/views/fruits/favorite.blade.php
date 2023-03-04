@extends('layouts.app')
@section('content')
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <span class="subheading">Fruits / Favorites</span>
                    <h2 class="mb-4">Favorite Fruits</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="d-flex justify-content-center">
                    {!! $nutrition->links() !!}
                </div>
                <table class="table">
                    <thead class="thead-primary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Genus</th>
                        <th scope="col">Name</th>
                        <th scope="col">Family</th>
                        <th scope="col">Order</th>
                        <th scope="col">Carbohydrates - {{$carbohydrates}}</th>
                        <th scope="col">Protein - {{$protein}}</th>
                        <th scope="col">Fat - {{$fat}}</th>
                        <th scope="col">Calories - {{$calories}}</th>
                        <th scope="col">Sugar - {{$sugar}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($nutrition as $datum)
                        <tr>
                            <th scope="row">{{$datum->fruit->id}}</th>
                            <td>{{$datum->fruit->genus}}</td>
                            <td>{{$datum->fruit->name}}</td>
                            <td>{{$datum->fruit->family}}</td>
                            <td>{{$datum->fruit->order}}</td>
                            <td>{{$datum->carbohydrates}}</td>
                            <td>{{$datum->protein}}</td>
                            <td>{{$datum->fat}}</td>
                            <td>{{$datum->calories}}</td>
                            <td>{{$datum->sugar}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {!! $nutrition->links() !!}
                </div>

            </div>
        </div>
    </section>
@endsection
