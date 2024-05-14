<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{ route('dashboard') }}">
          <i class="bi bi-grid"></i>
          <span>{{ __('Dashboard') }}</span>
        </a>
      </li>
      @can('view permission')
      <li class="nav-item">
        <a class="nav-link " href="{{ url('permissions') }}">
          <i class="bi bi-power"></i>
          <span>{{ __('Permissions') }}</span>
        </a>
      </li>
      @endcan
      @can('view role')
      <li class="nav-item">
        <a class="nav-link " href="{{ url('roles') }}">
          <i class="bi bi-person-check"></i>
          <span>{{ __('Roles') }}</span>
        </a>
      </li>
      @endcan
      @can('view user')
      <li class="nav-item">
        <a class="nav-link " href="{{ url('users') }}">
          <i class="bi bi-person-plus"></i>
          <span>{{ __('Users') }}</span>
        </a>
      </li>
      @endcan

      <li class="nav-item">
        <a class="nav-link " href="{{ url('creditor_offices') }}">
          <i class="bi bi-building"></i>
          <span>{{ __('Creditor Offices') }}</span>
        </a>
      </li>


      @can('view client')
      <li class="nav-item">
        <a class="nav-link " href="{{ url('clients') }}">
          <i class="bi bi-people"></i>
          <span>{{ __('Clients') }}</span>
        </a>
      </li>
      @endcan

      @can('view application')
      <li class="nav-item">
        <a class="nav-link " href="{{ url('applications') }}">
          <i class="bi bi-people"></i>
          <span>{{ __('Applications') }}</span>
        </a>
      </li>
      @endcan

    </ul>

  </aside>