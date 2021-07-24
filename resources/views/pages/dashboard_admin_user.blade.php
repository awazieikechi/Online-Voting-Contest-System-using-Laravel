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
                            <th class="border-0">Email</th>
                            <th class="border-0">Votes</th>

                        </tr>
                    </thead>
                    <tbody>
                        <!-- Item -->
                        @foreach ($users as $user)
                        <tr>
                            <td><a href="#" class="text-primary fw-bold">{{$user->id}}</a> </td>
                            <td class="fw-bold d-flex align-items-center">

                                <span class="ps-2">{{$user->name}}</span>
                            </td>
                            <td>

                                <span class="ps-2">{{$user->email}}</span>
                            </td>
                            <td>
                                {{ $user->votes()}}
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