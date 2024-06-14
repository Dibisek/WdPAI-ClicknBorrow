<nav>
    <a href="/homepage">
        <img src="public/img/logo_vert.svg" alt="Vertical Logo">
    </a>
    <ul>
        <li>
            <a href="/homepage" class="bar-btn" title="Homepage">
                <i class="fa-solid fa-house"></i>
            </a>
        </li>
        <li>
            <a href="/search" class="bar-btn" title="Search books">
                <i class="fa-solid fa-magnifying-glass"></i>
            </a>
        </li>
        <?php if (isAdmin()): ?>
            <li>
                <a href="/addBook" class="bar-btn" title="Add book">
                    <i class="fa-solid fa-book-medical"></i>
                </a>
            </li>
            <li>
                <a href="/reservationsAdmin" class="bar-btn" title="Show pending reservations">
                    <i class="fa-regular fa-address-card"></i>
                </a>
            </li>
        <?php else: ?>
            <li>
                <a href="/bookmarks" class="bar-btn" title="Bookmarks">
                    <i class="fa-solid fa-book-bookmark"></i>
                </a>
            </li>
            <li>
                <a href="/history" class="bar-btn" title="Reservations history">
                    <i class="fa-regular fa-clock"></i>
                </a>
            </li>
        <?php endif; ?>
        <li>
            <a href="/logout" class="bar-btn" title="Logout">
                <i class="fa-solid fa-door-open"></i>
            </a>
        </li>
    </ul>
</nav>