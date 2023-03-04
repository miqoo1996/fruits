@extends('layouts.app')
@section('content')
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <span class="subheading">Fruits / Home</span>
                    <h2 class="mb-4">Fruits</h2>
                </div>
            </div>
        </div>
        <div class="container">
          <div class="row">
              <form action="{{route('fruits')}}">
                  <div class="form-group">
                      <label class="form-label" for="form1">Search by Name and Family</label>

                      <div class="d-flex align-items-center justify-content-center" style="column-gap: 30px;">
                          <div>
                              <input type="search" id="form1" class="form-control" name="search_term" value="{{ $searchTerm }}"/>
                          </div>
                          <div>
                              <button type="submit" class="btn btn-primary">Search</button>
                          </div>
                      </div>
                  </div>
              </form>
              <table class="table">
                  <thead class="thead-primary">
                  <tr>
                      <th scope="col">#</th>
                      <th scope="col">Genus</th>
                      <th scope="col">Name</th>
                      <th scope="col">Family</th>
                      <th scope="col">Order</th>
                      <th scope="col">Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($fruits as $fruit)
                      <tr>
                          <th scope="row">{{$fruit->id}}</th>
                          <td>{{$fruit->genus}}</td>
                          <td>{{$fruit->name}}</td>
                          <td>{{$fruit->family}}</td>
                          <td>{{$fruit->order}}</td>
                          <td>
                              <button type="button"
                                      class="btn btn-primary favoriteButton"
                                      style="{{ $fruit->is_favorite ? 'display:none' : '' }};"
                                      data-toggle="modal" data-target="#favoriteModal"
                                      data-id="{{$fruit->id}}" >
                                  Add to favorites
                              </button>

                              <button type="button"
                                      class="btn btn-danger removeFavoriteButton"
                                      style="{{ !$fruit->is_favorite ? 'display:none' : '' }};;"
                                      data-toggle="modal" data-target="#removeFavoriteModal"
                                      data-id="{{$fruit->id}}" >
                                  Remove from favorites
                              </button>
                          </td>
                      </tr>
                  @endforeach
                  </tbody>
              </table>
              <div class="d-flex justify-content-center">
                  {!! $fruits->links() !!}
              </div>
          </div>
        </div>
    </section>


    <!-- Modal Add to Favorites -->
    <div class="modal fade favoriteModal" id="favoriteModal" tabindex="-1" role="dialog" aria-labelledby="favoriteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="favoriteModalLabel">Are you sure?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <form id="fruit-add-favorites-form" action="{{route('favorite.add')}}" method="post">
                        @method('PATCH')
                        @csrf
                        <input type=hidden name="id" id="favoriteId">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Remove from Favorites -->
    <div class="modal fade removeFavoriteModal" id="removeFavoriteModal" tabindex="-1" role="dialog" aria-labelledby="favoriteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Are you sure?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <form id="remove-favorites-form" action="{{route('favorite.remove')}}" method="post">
                        @method('DELETE')
                        @csrf
                        <input type=hidden name="id" id="removeFavoriteId">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('bottom-scripts')
    <script src="{{ asset('js/fruits.js') }}"></script>
@endsection
