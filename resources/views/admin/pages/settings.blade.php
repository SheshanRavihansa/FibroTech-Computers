@extends('layouts.admin')
@section('main-content')
    <div class="container-fluid pt-4 px-4">
        <div class="col-sm-12">
            <div class="bg-secondary rounded h-100 p-4">
                {{-- <h6 class="mb-4">Floating Label</h6> --}}
                <form>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                            <option selected="">Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <label for="floatingSelect">Works with selects</label>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"
                            style="height: 156px;"></textarea>
                        <label for="floatingTextarea">Comments</label>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
