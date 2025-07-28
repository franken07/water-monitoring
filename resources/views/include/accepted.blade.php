<h3 class="text-center my-4">Accepted Adoptions</h3>
@if ($acceptedAdoptions->isEmpty())
    <p class="text-center">No Accepted Pets Found.</p>
@else
    <div class="table-responsive">
        <table class="table table-striped table-bordered text-center">
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Pet Name</th>
                    <th>Image</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($acceptedAdoptions as $adopted)
                <tr>
                    <td>{{ $adopted->name }}</td>
                    <td>{{ $adopted->email }}</td>
                    <td>{{ $adopted->phone }}</td>
                    <td>{{ $adopted->address }}</td>
                    <td>{{ $adopted->prod_name }}</td>
                    <td>
                        <img src="{{ asset('storage/product/' . $adopted->image) }}" alt="{{ $adopted->prod_name }}" class="img-fluid" style="max-width: 100px; max-height: 100px; object-fit: cover;">
                    </td>
                    <td>{{ $adopted->delivery_status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif