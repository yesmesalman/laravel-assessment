@extends('layouts.dashboard')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 film-view">
            <div>
                <div>
                    <i class='fa fa-star @if($film->rating >= 1) fa-star-active @endif'></i>
                    <i class='fa fa-star @if($film->rating >= 2) fa-star-active @endif'></i>
                    <i class='fa fa-star @if($film->rating >= 3) fa-star-active @endif'></i>
                    <i class='fa fa-star @if($film->rating >= 4) fa-star-active @endif'></i>
                    <i class='fa fa-star @if($film->rating >= 5) fa-star-active @endif'></i>
                </div>
                <h1>{{ $film->name }}</h1>
                <div class="mb-3">
                    @foreach($film->genres as $genre)
                    <span class="badge badge-warning">{{ $genre->genre }}</span>
                    @endforeach
                </div>
                <p><strong>Description: </strong> {{ $film->description }}</p>
            </div>
            <div class="comments-box mt-5 mb-5 d-none">
                <h5>Comments:</h5>
                <div class="comment-list"></div>
            </div>
            @auth
            <div class="post-comments-box mt-5 mb-5 py-3 px-3 bg-light">
                <h5>Post a comment</h5>
                <form id="comment-form" method="POST" action="{{ route('comments.store') }}">
                    <div class="alert alert-danger d-none fails-alert"></div>
                    <div class="alert alert-success d-none success-alert"></div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" type="text" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <textarea id="comment" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Comment</button>
                    </div>
                </form>
            </div>
            @endauth

        </div>
        <div class="col-md-4">
            <img class="film-view-image" src="{{ asset($film->photo) }}" alt="Card image cap">
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
<script>
    $(document).ready(function() {

        function loadComments() {
            $.ajax({
                type: 'get',
                url: '{{ route("comments.index") }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    film_id: "{{ $film->id }}"
                },
                dataType: 'json',
                success: function(e) {
                    if (e.status && e.data.length > 0) {
                        $('.comments-box').removeClass('d-none')
                        var html = ''

                        e.data.forEach(element => {
                            console.log("element", element)
                            html += `
                            <div class="card comment mb-2">
                                <div class="card-body py-3 px-3 d-flex flex-column">
                                    <span class="datetime">${element.created_at}</span>
                                    <span class="author">${element.name}</span>
                                    <span class="comment-message">${element.comment}</span>
                                </div>
                            </div>
                        `;
                        })

                        $('.comment-list').html(html)
                    }
                }
            });
        }

        loadComments();

        $('#comment-form').on('submit', function(e) {
            e.preventDefault();

            let url = $(this).attr('action');

            let formData = new FormData();
            formData.append('name', $('#name').val())
            formData.append('comment', $('#comment').val())
            formData.append('film_id', "{{ $film->id }}")

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                url,
                type: 'POST',
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                success: function(e) {
                    $('.fails-alert').addClass('d-none')
                    $('.success-alert').addClass('d-none')

                    if (e.status) {
                        $('#comment-form')[0].reset()
                        loadComments()
                        $('.success-alert').removeClass('d-none')
                        $('.success-alert').html(e.message)
                    } else {
                        $('.fails-alert').removeClass('d-none')
                        $('.fails-alert').html(e.message)
                    }
                },
            });
        });
    });
</script>
@endsection
