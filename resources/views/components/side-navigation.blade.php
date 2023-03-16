<div class="shadow">
    <ul id="side-navigation">
        <li>
            <a 
                class="{{ Route::currentRouteName() == 'home' ? 'active' : '' }}" 
                href="{{ route('home') }}"
            >
                Home
            </a>
        </li>
        <li>
            <a 
                class="{{ in_array(Route::currentRouteName(), 
                            ['employees.index', 'employees.create', 'employees.show', 'employees.edit']
                        ) ? 'active' : '' }}"
                href="{{ route('employees.index') }}">
                Employees
            </a>
        </li>
        <li>
            <a 
                class="{{ Route::currentRouteName() == 'salaries.index' ? 'active' : '' }}"
                href="#"
            >
                Salaries
            </a>
        </li>
        <li>
            <a 
                class="{{ Route::currentRouteName() == 'titles.index' ? 'active' : '' }}"
                href="#"
            >
                Titles
            </a>
        </li>
    </ul>
</div>