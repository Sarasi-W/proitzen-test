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
                            ['employees.index', 'employees.create', 'employees.show', 'employees.edit', 'employees.search']
                        ) ? 'active' : '' }}"
                href="{{ route('employees.index') }}">
                Employees
            </a>
        </li>
        <li>
            <a 
                class="{{ in_array(Route::currentRouteName(), 
                            ['salaries.index', 'salaries.search']
                        ) ? 'active' : '' }}"
                href="{{ route('salaries.index') }}"
            >
                Salaries
            </a>
        </li>
        <li>
            <a 
                class="{{ in_array(Route::currentRouteName(), 
                            ['titles.index', 'titles.search']
                        ) ? 'active' : '' }}"
                href="{{ route('titles.index') }}"
            >
                Titles
            </a>
        </li>
    </ul>
</div>