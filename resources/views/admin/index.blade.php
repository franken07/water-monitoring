<!------admin panel na orig ------->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  <style>
    body {
      margin: 0;
      font-family: 'Arial', sans-serif;
      background: #f4f6f9;
      display: flex;
      min-height: 100vh;
      overflow-x: hidden;
    }
    /* Sidebar */
    .sidebar {
      width: 250px;
      background: #1e293b;
      color: #fff;
      transition: all 0.3s;
      position: fixed;
      height: 100vh;
      box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    }
    .sidebar.collapsed { width: 80px; }
    .sidebar h2 {
      text-align: center;
      padding: 1.5rem 0;
      font-size: 1.5rem;
      border-bottom: 1px solid #334155;
    }
    .sidebar ul { list-style: none; padding: 0; margin: 0; }
    .sidebar ul li { padding: 1rem 1.5rem; }
    .sidebar ul li a {
      text-decoration: none;
      color: #cbd5e1;
      display: flex; align-items: center;
      transition: color 0.3s;
    }
    .sidebar ul li a:hover { color: #fff; }
    .sidebar ul li a i {
      font-size: 1.3rem;
      margin-right: 1rem;
    }
    .sidebar.collapsed ul li a span { display: none; }

    /* Main Content */
    .main-content {
      margin-left: 250px;
      padding: 2rem;
      width: calc(100% - 250px);
      transition: all 0.3s;
    }
    .collapsed ~ .main-content {
      margin-left: 80px;
      width: calc(100% - 80px);
    }
    .toggle-btn {
      background: #1e293b;
      color: white;
      border: none;
      padding: 10px 15px;
      cursor: pointer;
      border-radius: 5px;
      margin-bottom: 1rem;
    }

    /* Cards + Grid */
    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
      margin-top: 20px;
    }
    .card {
      background: white;
      border-radius: 12px;
      padding: 1.2rem;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .card h3 { margin-bottom: 0.5rem; font-size: 1.1rem; }
    .card p { color: #6b7280; }

    /* Tables */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }
    th, td {
      padding: 8px 12px;
      border-bottom: 1px solid #e5e7eb;
      text-align: left;
    }
    th { background: #f9fafb; }
    tr:hover { background: #f1f5f9; }

    /* Quick Links */
    .quick-links { list-style: none; padding: 0; margin: 0; }
    .quick-links li { margin-bottom: 10px; }
    .quick-links a { text-decoration: none; color: #007bff; font-weight: 500; }
    .quick-links a:hover { text-decoration: underline; }
  </style>

  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <h2>Admin</h2>
    <ul>
      <li><a href="{{ route('admin.index') }}"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
      <li><a href="{{ route('admin.users.index') }}"><i class="fas fa-users"></i><span>Users</span></a></li>
      <li><a href="{{ route('admin.user_logins.index') }}"><i class="fas fa-sign-in-alt"></i><span>User Logins Request</span></a></li>
      <li><a href="{{ url('/') }}"><i class="fas fa-arrow-left"></i><span>Back</span></a></li>
    </ul>
  </div>

  <!-- Main Content -->
  <div class="main-content" id="main-content">
    <button class="toggle-btn" onclick="toggleSidebar()">☰ Menu</button>
    <h1>Dashboard</h1>
    <p>Welcome back, Admin 👋 Here’s what’s happening today.</p>

    <!-- Stats -->
    <div class="grid">
      <div class="card"><h3>Total Users</h3><p><b>{{ $totalUsers }}</b></p></div>
      <div class="card"><h3>Active Users</h3><p><b>{{ $activeUsers }}</b></p></div>
    </div>

    <!-- Recent Users -->
    <div class="card" style="margin-top:20px;">
      <h3>Recently Registered Users</h3>
      <table>
        <thead><tr><th>Name</th><th>Email</th><th>Date Joined</th></tr></thead>
        <tbody>
          @forelse($recentUsers as $u)
            <tr>
              <td>{{ $u['name'] }}</td>
              <td>{{ $u['email'] }}</td>
              <td>{{ $u['createdAt'] }}</td>
            </tr>
          @empty
            <tr><td colspan="3">No users found.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Recent Logins -->
    <div class="card" style="margin-top:20px;">
      <h3>Recent Logins</h3>
      <table>
        <thead><tr><th>Name</th><th>Email</th><th>Last Login</th></tr></thead>
        <tbody>
          @forelse($recentLogins as $u)
            <tr>
              <td>{{ $u['name'] }}</td>
              <td>{{ $u['email'] }}</td>
              <td>{{ $u['lastLogin'] ?? 'Never' }}</td>
            </tr>
          @empty
            <tr><td colspan="3">No login activity yet.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <script>
    function toggleSidebar() {
      document.getElementById('sidebar').classList.toggle('collapsed');
    }
  </script>
</body>
</html>
