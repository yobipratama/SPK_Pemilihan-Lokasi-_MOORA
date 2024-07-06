<!--**********************************
    Sidebar start
***********************************-->
<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <li>
                <a class="has-arrows" href="/">
                    <i class="icon icon-app-store"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            @if (auth()->check() && auth()->user()->role->name == 'admin')
                <li>
                    <a class="has-arrows" href="{{ route('admin.owner.index') }}">
                        <i class="icon icon-app-store"></i>
                        <span class="nav-text">User</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrows" href="{{ route('admin.kriteria.index') }}">
                        <i class="icon icon-app-store"></i>
                        <span class="nav-text">Kriteria</span>
                    </a>
                </li>
            @endif

            @if (auth()->check() && auth()->user()->role->name == 'user')
                <li>
                    <a class="has-arrows" href="{{ route('user.alternatif.index') }}">
                        <i class="icon icon-app-store"></i>
                        <span class="nav-text">Lokasi</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrows" href="{{ route('user.penilaian.index') }}">
                        <i class="icon icon-app-store"></i>
                        <span class="nav-text">Penilaian</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrows" href="{{ route('user.penilaian.history') }}">
                        <i class="icon icon-app-store"></i>
                        <span class="nav-text">Riwayat Penilaian</span>
                    </a>
                </li>
            @endif


        </ul>
    </div>
</div>
<!--**********************************
    Sidebar end
***********************************-->
