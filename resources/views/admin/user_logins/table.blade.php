<table style="width: 100%; border-collapse: collapse; background: #ffffff; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
    <thead style="background: #1e293b; color: white;">
        <tr>
            <th style="padding: 12px;">UID</th>
            <th style="padding: 12px;">Device ID</th>
            <th style="padding: 12px;">Device Name</th>
            <th style="padding: 12px;">IP Address</th>
            <th style="padding: 12px;">Status</th>
            <th style="padding: 12px;">Timestamp</th>
            <th style="padding: 12px; text-align:center;">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($formattedLogins as $login)
            <tr style="border-bottom: 1px solid #e5e7eb;">
                <td style="padding: 12px;">{{ $login['uid'] }}</td>
                <td style="padding: 12px;">{{ $login['deviceId'] }}</td>
                <td style="padding: 12px;">{{ $login['deviceName'] ?? 'Unknown' }}</td>
                <td style="padding: 12px;">{{ $login['ipAddress'] ?? 'N/A' }}</td>
                <td style="padding: 12px; font-weight: 600; color:
                    {{ $login['status'] == 'approved' ? '#16a34a' : ($login['status'] == 'rejected' ? '#dc2626' : '#f59e0b') }}">
                    {{ ucfirst($login['status']) }}
                </td>
                <td style="padding: 12px;">{{ $login['timestamp'] ?? '—' }}</td>
                <td style="padding: 12px; text-align:center;">
                    @if($login['status'] == 'pending')
                        <form action="{{ route('admin.user_logins.approve', ['uid' => $login['uid'], 'deviceId' => $login['deviceId']]) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" style="background:#16a34a; color:white; border:none; border-radius:6px; padding:6px 12px; cursor:pointer; font-weight:500;">Accept</button>
                        </form>

                        <form action="{{ route('admin.user_logins.reject', ['uid' => $login['uid'], 'deviceId' => $login['deviceId']]) }}" method="POST" style="display:inline; margin-left:6px;">
                            @csrf
                            <button type="submit" style="background:#dc2626; color:white; border:none; border-radius:6px; padding:6px 12px; cursor:pointer; font-weight:500;">Deny</button>
                        </form>
                    @else
                        <em style="color: #6b7280;">Processed</em>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" style="text-align:center; padding: 20px; color: #6b7280;">No pending login requests.</td>
            </tr>
        @endforelse
    </tbody>
</table>
