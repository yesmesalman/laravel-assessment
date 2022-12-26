@extends('layouts.dashboard')

@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-md-4">
            <h1>Create film</h1>
        </div>
    </div>
    <form>
        <div class="row mt-2">
            <div class="col-md-8">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" placeholder="Name" id="name" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="ticket_price">Ticket Price:</label>
                            <input type="number" class="form-control" name="ticket_price" placeholder="Ticket Price" required />
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" placeholder="Description" required></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="release_date">Release Date</label>
                        <input type="date" class="form-control" name="release_date" placeholder="Please Date" required />
                    </div>
                    <div class="col">
                        <label for="rating">Rating:</label>
                        <select id="rating" class="form-control" name="rating">
                            <option value="" disabled selected>Select Rating</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-group">
                            <label for="genre">Genre:</label>
                            <select id="genre" class="form-control" name="genre[]" multiple>
                                <option value="" disabled selected>Select Genre</option>
                                <option value="Comedy">Comedy</option>
                                <option value="Fighting">Fighting</option>
                                <option value="Horror">Horror</option>
                                <option value="Romantic">Romantic</option>
                                <option value="Story Based">Story Based</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <button class="btn btn-primary">Create new film</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <h1>asa</h1>
            </div>
        </div>
    </form>
</div>
@endsection