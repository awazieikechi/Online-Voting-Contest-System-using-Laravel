@include('layouts.sidebar_auth_admin_contest')
<main class="content">

    <div class="card border-0 shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded">
                    <thead class="thead-light">
                        <tr>
                            <th class="border-0 rounded-start">#</th>
                            <th class="border-0">Name</th>
                            <th class="border-0">Votes</th>

                        </tr>
                    </thead>
                    <tbody>
                        <!-- Item -->
                        @foreach ($posts as $post)
                        <tr>
                            <td><a href="#" class="text-primary fw-bold">{{ $post->id}}</a> </td>
                            <td class="fw-bold d-flex align-items-center">
                                <img class="rounded-circle" alt="100x100" src="{{ asset('storage/contestant/profileimage/' . $post->user->profile_image)  }}" data-mdb-img="{{ asset('storage/contestant/profileimage/' . $post->user->profile_image)  }}" data-holder-rendered="true" width="60" height="60">
                                <span class="ps-2">{{$post->user->name}}</span>
                            </td>
                            <td>
                                {{ $post->votes()}}
                            </td>

                        </tr>
                        @endforeach
                        <!-- End of Item -->


                    </tbody>
                </table>
            </div>
        </div>
    </div>


</main>

@include('layouts.footer_auth_admin_contest')