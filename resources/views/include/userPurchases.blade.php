<h3 class="text-center my-4">Adopotion List</h3>
@if ($userPurchases->isEmpty())
    <p class="text-center">No Pets Found.</p>
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($userPurchases as $purchase)
                <tr>
                    <td>{{ $purchase->name }}</td>
                    <td>{{ $purchase->email }}</td>
                    <td>{{ $purchase->phone }}</td>
                    <td>{{ $purchase->address }}</td>
                    <td>{{ $purchase->prod_name }}</td>
                    <td>
                        <img src="{{ asset('storage/product/' . $purchase->image) }}" alt="{{ $purchase->prod_name }}" class="img-fluid" style="max-width: 100px; max-height: 100px; object-fit: cover;">
                    </td>
                    <th>Pending</th>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

<style>
    .table {
        margin: 20px auto;
        width: 90%;
    }

    .table th, .table td {
        vertical-align: middle; /* Centers the content vertically */
    }

    .table img {
        border-radius: 5px; /* Optional: adds rounded corners to images */
    }
</style>
