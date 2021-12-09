<nav class="navbar navbar-expand-sm navbar-dark bg-gradient-dark shadow sticky-top">
    <a class="navbar-brand mr-0 mr-md-2" href="/">
        <?= $_BRAND ?>
    </a>
    <button class="navbar-toggler border-0 p-0 dropdown-toggle" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
        <i style="font-size:1.25em;" class="fas fa-user-circle"></i>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item px-sm-3">
                <a class="nav-link" href="/example_page">Link 1</a>
            </li>
            <li class="nav-item px-sm-3">
                <a class="nav-link" href="/example_not_authorized">Link 2</a>
            </li>
            <li class="nav-item dropdown px-sm-3">
                <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownId">
                    <a class="dropdown-item" href="/example_page">Link 1</a>
                    <a class="dropdown-item" href="/example_not_authorized">Link 2</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-modal="sign-out" href="#">Sign out</a>
            </li>
        </ul>
    </div>
</nav>
