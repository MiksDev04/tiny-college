<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between px-3 py-2 ">
            <a class="navbar-brand fs-4 fw-bold text-primary" href="#">Tiny College</a>

            <div class="d-flex align-items-center gap-2">
                <!-- Sun Icon -->
                <svg id="sunIcon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-sun" viewBox="0 0 16 16">
                    <path d="M8 4.5a3.5 3.5 0 1 1 0 7 3.5 3.5 0 0 1 0-7z" />
                    <path d="M8 0a.5.5 0 0 1 .5.5v2A.5.5 0 0 1 8 3a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 8 0zM8 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm7.5-5a.5.5 0 0 1-.5.5h-2A.5.5 0 0 1 13 8a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zM12.364 3.636a.5.5 0 0 1 .707 0l1.414 1.414a.5.5 0 0 1-.707.707L12.364 4.343a.5.5 0 0 1 0-.707zM3.636 12.364a.5.5 0 0 1 .707 0L5.757 13.78a.5.5 0 1 1-.707.707L3.636 13.07a.5.5 0 0 1 0-.707zM12.364 12.364a.5.5 0 0 1 0 .707l-1.414 1.414a.5.5 0 1 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zM3.636 3.636a.5.5 0 0 1 0 .707L2.222 5.757a.5.5 0 1 1-.707-.707L2.93 3.636a.5.5 0 0 1 .707 0z" />
                </svg>

                <!-- Toggle Switch -->
                <div class="form-check form-switch m-0">
                    <input class="form-check-input" type="checkbox" id="themeToggle" style="cursor: pointer;">
                </div>

                <!-- Moon Icon -->
                <svg id="moonIcon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-moon" viewBox="0 0 16 16">
                    <path d="M6 0a7 7 0 0 0 0 14c3.222 0 6.066-2.045 6.849-5.001C9.889 9.866 6 6.556 6 0z" />
                </svg>
            </div>
        </div>


        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="?page=includes/home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=includes/contact">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/tiny-college/account/login.php" onclick="return confirm('Are you sure you want to logout?');">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    const themeToggle = document.getElementById('themeToggle');
    const html = document.documentElement;
    const sunIcon = document.getElementById('sunIcon');
    const moonIcon = document.getElementById('moonIcon');

    function applyTheme(theme) {
        html.setAttribute('data-bs-theme', theme);
        localStorage.setItem('theme', theme);
        sunIcon.classList.toggle('active', theme === 'light');
        moonIcon.classList.toggle('active', theme === 'dark');
        themeToggle.checked = theme === 'dark';
    }

    // Load initial theme
    const savedTheme = localStorage.getItem('theme') || 'light';
    applyTheme(savedTheme);

    themeToggle.addEventListener('change', () => {
        const newTheme = themeToggle.checked ? 'dark' : 'light';
        applyTheme(newTheme);
    });
</script>