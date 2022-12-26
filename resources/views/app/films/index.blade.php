@extends('layouts.dashboard')

@section('content')
<div class="container mt-2">
    <div class="d-flex flex-row-reverse py-3 pr-3 bg-light">
        <a class="btn btn-primary" href="{{ route('films.create') }}">Create New Film</a>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card film-card">
                <div class="card-header">
                    <img class="card-img-top" src="https://cdn-images-1.medium.com/max/1600/1*05p0HXx8HN7Lyj2_RO_nFQ.jpeg" alt="Card image cap">
                </div>
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="{{ route('films.show', 'asdasdasd') }}" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
<script>
    jQuery(document).ready(function($) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'get',
            url: '{{ route("films.index") }}',
            dataType: 'json',
            success: function(data) {
                console.log(data)
            }
        });
    });
</script>
@endsection