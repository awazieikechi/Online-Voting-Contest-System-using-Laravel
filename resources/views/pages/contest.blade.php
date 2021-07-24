@include('layouts.header')

<body>
    @foreach ($posts as $post)
    <div class="modal fade" id="modal{{ $post->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title"></h2><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('storage/contestant/profileimage/' . $post->user->profile_image)  }}" alt="placeholder 960" class="img-fluid" />
                </div>
                <div class="modal-footer"> <button type="button" class="btn btn-link text-gray-600 ms-auto" data-bs-dismiss="modal">Close</button></div>
            </div>
        </div>
    </div>
    @endforeach
    <main>

        <section class="py-2 text-center container">
            <div class="row py-lg-3">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <img src="{{ asset('storage/banner1.jpg')  }}" alt="placeholder 960" class="img-fluid" />
                    <h4> Make sure you read the rules before voting</h4>
                </div>
            </div>
        </section>
        <div class="album py-5 bg-light">
            <div class="container">

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @foreach ($posts as $post)
                    <div class="col">
                        <div class="card shadow-sm">
                            <video src="{{ asset('storage/contestant/video/' . $post->post_url)  }}" controls></video>

                            <div class="card-body">
                                <p class="card-text"><strong>{{$post->user->name}} </strong> </p>
                                <p class="card-text">{{$post->post_description}}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <button type="button" class="btn btn-dark me-2" data-post="{{ $post->id}}" id="{{ $post->id}}">Vote</button>
                                    <small class="text-muted" id="vote-count{{ $post->id}}"> {{ $post->votes()}} vote(s)</small>

                                    <a data-bs-toggle="modal" href="#modal{{ $post->id}}"><img class="rounded-circle" alt="100x100" src="{{ asset('storage/contestant/profileimage/' . $post->user->profile_image)  }}" width="60" height="60"></a>

                                </div>
                                <div id="message{{ $post->id}}"> </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>


    </main>



    @include('layouts.footer')
    <script>
        $(document).ready(function() {
            $("button").click(function(e) {

                var post_id = e.target.id

                //alert();
                $.ajax({
                    url: "{{ url('vote') }}",
                    type: 'POST',
                    data: {
                        "_token": "{{csrf_token()}}",
                        "post_id": post_id,

                    },
                    success: function(data) {
                        console.log(data)
                        console.log(data.post_id)
                        console.log(data.message)
                        console.log(data.count)
                        var message = document.getElementById("message" + data.post_id);
                        var vount_count = document.getElementById("vote-count" + data.post_id);

                        message.innerHTML = data.message
                        vount_count.innerHTML = data.count + " vote(s)"
                    }
                });

            });


        });
    </script>
    @include('layouts.footer_auth_admin_contest')
</body>

</html>