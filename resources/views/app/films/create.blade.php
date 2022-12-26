@extends('layouts.dashboard')

@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-md-4">
            <h1>Create film</h1>
        </div>
    </div>
    <form id="create-form" method="POST" action="{{ route('films.store') }}" enctype='multipart/form-data'>
        @csrf
        <div class="row mt-2">
            <div class="col-md-8">
                <div class="alert alert-danger d-none fails-alert"></div>
                <div class="alert alert-success d-none success-alert"></div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" id="name" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="ticket_price">Ticket Price:</label>
                            <input id="ticket_price" type="number" class="form-control" name="ticket_price" placeholder="Ticket Price" />
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="description">Description</label>
                        <textarea id="description" class="form-control" name="description" placeholder="Description"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="release_date">Release Date</label>
                        <input id="release_date" type="date" class="form-control" name="release_date" placeholder="Please Date" />
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
                <input name="photo" type="file" class="d-none upload-photo" accept="image/png, image/jpeg" />
                <div class="upload-picture">
                    <h3>Upload Picture</h3>
                    <img src="" class="d-none upload-show" />
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('footer-scripts')
<script>
    $(document).ready(function() {
        $('#create-form').on('submit', function(e) {
            e.preventDefault();

            let url = $(this).attr('action');

            let formData = new FormData();
            formData.append('name', $('#name').val());
            formData.append('ticket_price', $('#ticket_price').val());
            formData.append('description', $('#description').val());
            formData.append('release_date', $('#release_date').val());
            formData.append('rating', $('#rating').val());

            if ($('#genre').val()) {
                $('#genre').val().forEach(e => {
                    formData.append('genre[]', e);
                });
            }

            if ($('.upload-photo') && $('.upload-photo')[0]) {
                formData.append('photo', $('.upload-photo')[0].files[0]);
            }

            function resetForm() {
                $('#create-form')[0].reset();
                $('.upload-picture h3').removeClass('d-none')
                $('.upload-show').addClass('d-none')
                $('.upload-show').attr('src', '');
            }

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
                enctype: 'multipart/form-data',
                success: function(e) {
                    $('.fails-alert').addClass('d-none');
                    $('.success-alert').addClass('d-none');

                    if (e.status) {
                        resetForm()
                        $('.success-alert').removeClass('d-none');
                        $('.success-alert').html(e.message);
                    } else {
                        $('.fails-alert').removeClass('d-none');
                        $('.fails-alert').html(e.message);
                    }
                },
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.upload-picture h3').addClass('d-none')
                    $('.upload-show').removeClass('d-none')
                    $('.upload-show').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).on('click', '.upload-picture', function() {
            $("input[name=photo]").click()
        });

        $(document).on('change', '.upload-photo', function() {
            readURL(this)
        });
    });
</script>
@endsection
