<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            margin: 0;
            padding: 0;
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
            overflow: hidden;
            position: fixed;
            height: 100vh;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar h2 {
            text-align: center;
            padding: 1.5rem 0;
            font-size: 1.5rem;
            border-bottom: 1px solid #334155;
            transition: all 0.3s;
        }

        .sidebar.collapsed h2 {
            opacity: 0;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 1rem 1.5rem;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #cbd5e1;
            display: flex;
            align-items: center;
            transition: color 0.3s;
        }

        .sidebar ul li a:hover {
            color: #fff;
        }

        .sidebar ul li a i {
            font-size: 1.5rem;
            margin-right: 1rem;
            transition: transform 0.3s;
        }

        .sidebar ul li a:hover i {
            transform: scale(1.2);
        }

        .sidebar.collapsed ul li a span {
            display: none;
        }

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

        .main-content h1 {
            font-size: 2.5rem;
            color: #1f2937;
        }

        .toggle-btn {
            background: #1e293b;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background 0.3s;
        }

        .toggle-btn:hover {
            background: #334155;
        }

        /* Cards */
        .card {
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 1.5rem;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card h2 {
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .card p {
            color: #6b7280;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }
    </style>

    <!-- Link to Font Awesome for Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h2>Admin</h2>
        <ul>
            <li><a href="#"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
            <li><a href="#"><i class="fas fa-users"></i><span>Users</span></a></li>
            <li><a href="#"><i class="fas fa-box"></i><span>Products</span></a></li>
            <li><a href="#"><i class="fas fa-calendar-check"></i><span>Reservations</span></a></li>
            <li><a href="#"><i class="fas fa-cog"></i><span>Settings</span></a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
        <button class="toggle-btn" onclick="toggleSidebar()">☰ Menu</button>
        <h1>Dashboard</h1>
        <p>Welcome to the admin panel. Customize it as needed.</p>

        <div class="grid">
            <div class="card">
                <h2>Users</h2>
                <p>Manage users and their roles.</p>
            </div>
            <div class="card">
                <h2>Products</h2>
                <p>Manage your products and inventory.</p>
            </div>
            <div class="card">
                <h2>Reservations</h2>
                <p>Track and manage reservations.</p>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('collapsed');
        }
    </script>
</body>
</html>
