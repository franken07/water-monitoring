<!------Users in admin------->
@extends('layouts.admin')

@section('content')
    <style>
    
        table.custom-table {
            width: 100%;
            border-radius: 12px;
            overflow: hidden;
        }

        table.custom-table th, 
        table.custom-table td {
            text-align: center !important;
            vertical-align: middle !important;
            padding: 18px 25px !important;  
        }

        table.custom-table th {
            background: #1e293b;
            color: #fff;
            font-size: 16px;
            letter-spacing: 0.5px;
        }

        table.custom-table td {
            font-size: 15px;
            color: #333;
        }

        table.custom-table tbody tr {
            border-bottom: 1px solid #dee2e6;
        }

        table.custom-table tbody tr:hover {
            background-color: #f8f9fa;
            transition: 0.3s;
        }

        .badge-date {
            font-size: 14px;
            padding: 8px 14px;
            border-radius: 8px;
            background: #eef2ff;
            color: #374151;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }
        .fab-btn {
        padding: 12px 20px;
        border-radius: 50px; 
        background: #28a745; 
        color: white;
        border: none;
        font-size: 16px;
        font-weight: 500;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px; 
        transition: all 0.3s ease;
        margin-top: 20px; 
    }

    .fab-btn:hover {
        background: #218838; 
        transform: scale(1.05);
        cursor: pointer;
    }
    </style>


    <!------Users in admin------->
  <div class="d-flex justify-content-center align-items-center mb-4">
    <h2 class="fw-bold" style="color: #1e293b;">
        <i class="fas fa-users me-2"></i> Firebase Authentication Users
    </h2>
</div>


    <div class="card shadow-lg border-0 rounded-3">
    <div class="card-body p-4">
        @if(isset($users) && count($users) > 0)
            <div class="table-responsive">
                <table class="table custom-table mb-0">
                    <thead>
                        <tr>
                            <th>UID</th>
                            <th>Name</th> 
                            <th>Email</th>
                            <th>Phone</th> 
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="font-monospace small text-muted">{{ $user['uid'] }}</td>
                            <td class="fw-semibold">
                                <i class="fas fa-user text-primary me-2"></i>{{ $user['name'] ?? 'N/A' }}
                            </td>
                            <td class="fw-semibold">
                                <i class="fas fa-envelope text-primary me-2"></i>{{ $user['email'] ?? 'N/A' }}
                            </td>
                            <td class="fw-semibold">
                                <i class="fas fa-phone text-primary me-2"></i>{{ $user['phone'] ?? 'N/A' }}
                            </td>
                            <td><span class="badge-date">{{ $user['createdAt'] ?? 'N/A' }}</span></td>
                            <td>
                                <button type="button"
                                        class="btn btn-sm btn-warning me-1 edit-user-btn"
                                        data-uid="{{ $user['uid'] }}"
                                        data-email="{{ $user['email'] }}"
                                        data-name="{{ $user['name'] }}"
                                        data-phone="{{ $user['phone'] }}">
                                    <i class="fas fa-edit"></i> Edit
                                </button>

                                <form action="{{ route('admin.users.destroy', $user['uid']) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="p-4 text-center">
                <i class="fas fa-exclamation-circle text-muted fa-2x mb-2"></i>
                <p class="text-muted">No users found.</p>
            </div>
        @endif
        </div>
    </div>

       <!-- FAB Create User Button -->
            <button type="button" class="fab-btn" data-bs-toggle="modal" data-bs-target="#createUserModal">
                <i class="fas fa-plus me-2"></i>Create User +
            </button>

<!------------ Modals --------------------------->
    
            <!-- Edit User Modal -->
            <div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="editUserForm" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="uid" id="editUserUid">

                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="displayName" id="editUserName" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="editUserEmail" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="tel" class="form-control" name="phone" id="editUserPhone" 
                                        placeholder="+639XXXXXXXXX" pattern="\+639[0-9]{9}">
                                    <small class="text-muted">Enter phone in format: +639XXXXXXXXX (optional)</small>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Update User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

         

            <!-- Create User Modal -->
            <div class="modal fade" id="createUserModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('admin.users.store') }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title"><i class="fas fa-plus me-2"></i>Create User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="displayName" placeholder="Enter full name" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" name="phone" 
                                        placeholder="+639XXXXXXXXX" pattern="\+639[0-9]{9}" required>
                                    <small class="text-muted">Phone number must be in format: +639XXXXXXXXX</small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="example@email.com" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Enter password" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-success">Create User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



<script>
document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-user-btn');
    const modalEl = document.getElementById('editUserModal');
    const modal = new bootstrap.Modal(modalEl);
    const form = document.getElementById('editUserForm');

    editButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('editUserUid').value = btn.dataset.uid;
            document.getElementById('editUserName').value = btn.dataset.name;
            document.getElementById('editUserEmail').value = btn.dataset.email;
            document.getElementById('editUserPhone').value = btn.dataset.phone;

            form.action = '/admin/users/' + btn.dataset.uid;
            modal.show();
        });
    });
});
</script>
<script>
    // Set form action dynamically when opening modal
    const editUserModal = document.getElementById('editUserModal');
    editUserModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const uid = button.getAttribute('data-uid');
        const name = button.getAttribute('data-name');
        const email = button.getAttribute('data-email');
        const phone = button.getAttribute('data-phone');

        const form = document.getElementById('editUserForm');
        form.action = `/admin/users/update/${uid}`; // POST route for update

        document.getElementById('editUserUid').value = uid;
        document.getElementById('editUserName').value = name ?? '';
        document.getElementById('editUserEmail').value = email ?? '';
        document.getElementById('editUserPhone').value = phone ?? '';
    });
</script>

@endsection
