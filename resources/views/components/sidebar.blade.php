<!-- Tombol Hamburger (hanya muncul di mobile) -->
<div class="md:hidden p-4">
    <button id="menu-toggle" class="text-white">
        <span class="material-symbols-rounded text-3xl">menu</span>
    </button>
</div>

<!-- Sidebar -->
<aside id="sidebar"
    class="fixed top-0 left-0 h-full w-64 bg-white dark:bg-gray-800 shadow-md py-6 px-4 transform -translate-x-full md:translate-x-0 transition-transform duration-300 z-50 md:static md:block">

    <div class="text-pink-500 font-bold text-2xl text-center mb-10">Paud Gemilang</div>
    <nav class="space-y-3 text-sm text-gray-600 dark:text-gray-300">
        <a href="{{ url('/dashboard') }}"
            class="sidebar-link flex items-center gap-3 py-2 px-3 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition-colors duration-200">
            <span class="material-symbols-rounded">dashboard</span>Dashboard</a>
        <a href="{{ url('/absensi') }}"
            class="sidebar-link flex items-center gap-3 py-2 px-3 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition-colors duration-200">
            <span class="material-symbols-rounded">person</span>Absen</a>
        <a href="{{ url('/rekapabsen') }}"
            class="sidebar-link flex items-center gap-3 py-2 px-3 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition-colors duration-200">
            <span class="material-symbols-rounded">how_to_reg</span>Rekap Absen</a>
        <a href="{{ url('/rapor') }}"
            class="sidebar-link flex items-center gap-3 py-2 px-3 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition-colors duration-200">
            <span class="material-symbols-rounded">bar_chart</span>Nilai Rapot</a>
        <a href="{{ url('/dataguru') }}"
            class="sidebar-link flex items-center gap-3 py-2 px-3 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition-colors duration-200">
            <span class="material-symbols-rounded">person_add</span>Tambah Data Guru</a>
        <a href="{{ url('/datasiswa') }}"
            class="sidebar-link flex items-center gap-3 py-2 px-3 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition-colors duration-200">
            <span class="material-symbols-rounded">group_add</span>Tambah Data Siswa</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="flex items-center gap-3 text-red-500 py-2 px-3 rounded-lg hover:bg-red-100 hover:text-red-700 w-full text-left transition-colors duration-200">
                <span class="material-symbols-rounded">logout</span>Keluar
            </button>
        </form>
    </nav>
</aside>

<!-- Overlay background (optional) -->
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-40 md:hidden"></div>


<script>
// Ambil elemen
const menuToggle = document.getElementById('menu-toggle');
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('overlay');

// Toggle sidebar saat tombol diklik
if (menuToggle && sidebar && overlay) {
    menuToggle.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    });

    // Klik overlay untuk tutup sidebar
    overlay.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });
}

// Highlight menu aktif
const sidebarLinks = document.querySelectorAll('.sidebar-link');
const currentPath = window.location.pathname;

sidebarLinks.forEach(link => {
    const linkPath = new URL(link.href).pathname;
    if (currentPath === linkPath || currentPath.startsWith(linkPath + '/')) {
        link.classList.add('bg-gray-100', 'text-gray-900', 'font-semibold');
        link.classList.remove('hover:bg-gray-100', 'hover:text-gray-900');
    }
});
</script>