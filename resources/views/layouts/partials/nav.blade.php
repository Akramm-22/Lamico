<ul class="nav-links">
    <li>
        <a href="{{ route('dashboard') }}"
           class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
           Dashboard
        </a>
    </li>
    <li>
        <a href="{{ route('sensor.index') }}"
           class="{{ request()->routeIs('sensor.*') ? 'active' : '' }}">
           Sensor
        </a>
    </li>
    <li>
        <a href="{{ route('device.index') }}"
           class="{{ request()->routeIs('device.*') ? 'active' : '' }}">
           Device
        </a>
    </li>
</ul>

