<!-- NAVBAR -->
<div class="navbar shadow-sm">
    <div class="navbar-start">

        <!-- MOBILE DROPDOWN -->
        <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M4 6h16M4 12h8m-8 6h16"/>
                </svg>
            </div>

            <ul tabindex="-1"
                class="menu menu-sm dropdown-content rounded-box z-10 mt-3 w-52 p-2 shadow">
                <li><a href="/">Home</a></li>

                <li>
                    <a href="/ideas">Ideas</a>
                    <ul class="p-2">
                        <li><a href="/ideas/create">Create</a></li>
                        <li><a href="/ideas/">List</a></li>
                    </ul>
                </li>

                <li><a href="/about">About</a></li>
                <li><a href="/contact">Contact</a></li>
            </ul>
        </div>

        <a class="btn btn-ghost text-xl">AFTERtheSYNTAX</a>
    </div>

    <!-- DESKTOP MENU -->
    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1">
            <li><a href="/">Home</a></li>

            <li>
                <details>
                    <summary>Ideas</summary>
                    <ul class="p-2 w-40 rounded-box shadow z-100">
                        <li><a href="/ideas">List</a></li>
                        <li><a href="/ideas/create">Create</a></li>
                    </ul>
                </details>
            </li>

            <li><a href="/about">About</a></li>
            <li><a href="/contact">Contact</a></li>
        </ul>
    </div>

    <div class="navbar-end">
        <a class="btn btn-primary">Braised Beef Button</a>
    </div>
</div>
