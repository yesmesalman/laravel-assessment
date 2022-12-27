@extends('layouts.dashboard')

@section('content')
<div class="container mt-2">
    @auth
    <div class="d-flex flex-row-reverse py-3 pr-3 bg-light">
        <a class="btn btn-primary" href="{{ route('films.create') }}">Create New Film</a>
    </div>
    @endauth
    <div class="row justify-content-start films-list mt-3 @guest mt-5 @endguest mb-5"></div>
</div>
@endsection

@section('footer-scripts')
<script>
    $(document).ready(function() {
        $.ajax({
            type: 'get',
            url: '{{ route("films.index") }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function(e) {
                let html = "";

                if (e.status) {
                    e.data.forEach(element => {
                        let rating = element.rating
                        let genresHtml = ''

                        element.genres.forEach(x => {
                            genresHtml += `<span class="badge badge-warning">${x.genre}</span>`
                        });

                        html += `<div class="col-md-3 mb-3">
                                    <div class="card film-card">
                                        <div class="card-header">
                                            <img class="card-img-top" src="${element.photo}" alt="Card image cap">
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-1">${genresHtml}</div>
                                            <div>
                                                <i class='fa fa-star ${rating >= 1 ? 'fa-star-active' : ''}'></i>
                                                <i class='fa fa-star ${rating >= 2 ? 'fa-star-active' : ''}'></i>
                                                <i class='fa fa-star ${rating >= 3 ? 'fa-star-active' : ''}'></i>
                                                <i class='fa fa-star ${rating >= 4 ? 'fa-star-active' : ''}'></i>
                                                <i class='fa fa-star ${rating >= 5 ? 'fa-star-active' : ''}'></i>
                                            </div>
                                            <h5 class="card-title">${element.name}</h5>
                                            <p class="card-text">${element.description}</p>
                                            <a href="/films/${element.slug}" class="btn btn-primary">View Film</a>
                                        </div>
                                    </div>
                                </div> `
                    });
                }

                $('.films-list').html(html)
            }
        });
    });
</script>
@endsection