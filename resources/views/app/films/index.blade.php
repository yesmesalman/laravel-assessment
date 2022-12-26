@extends('layouts.dashboard')

@section('content')
<div class="container mt-2">
    <div class="d-flex flex-row-reverse py-3 pr-3 mb-3 bg-light">
        <a class="btn btn-primary" href="{{ route('films.create') }}">Create New Film</a>
    </div>
    <div class="row justify-content-center films-list mb-5"></div>
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
                    e.data[1] = e.data[0];
                    e.data[2] = e.data[0];
                    e.data[4] = e.data[0];
                    e.data[3] = e.data[0];
                    e.data.forEach(element => {
                        html += `<div class="col-md-4 mb-3">
                                    <div class="card film-card">
                                        <div class="card-header">
                                            <img class="card-img-top" src="${element.photo}" alt="Card image cap">
                                        </div>
                                        <div class="card-body">
                                            <div>
                                                <i class='fa fa-star'></i>
                                            </div>
                                            <h5 class="card-title">${element.name}</h5>
                                            <p class="card-text">${element.description}</p>
                                            <a href="/films/${element.slug}" class="btn btn-primary">View Details</a>
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