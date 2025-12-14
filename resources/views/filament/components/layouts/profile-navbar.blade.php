<div class="flex items-center gap-4">
    <!-- Avatar -->
    <div class="relative">
        <button class="flex items-center focus:outline-none" id="profile-menu-button">
            <img
                class="w-10 h-10 rounded-full border-2 border-gray-300"
                src="{{ auth()->user()->profile_photo_url ?? asset('default-avatar.png') }}"
                alt="{{ auth()->user()->name }}"
            >
        </button>
        <!-- Dropdown -->
        <div id="profile-menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg">
            <div class="p-4 border-b">
                <p class="font-medium">{{ auth()->user()->name }}</p>
                <p class="text-sm text-gray-600">{{ auth()->user()->email }}</p>
            </div>
            <ul class="py-1">
                <li>
                    <a href="{{ route('filament.pages.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Profile
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>

<script>
    document.getElementById('profile-menu-button').addEventListener('click', () => {
        const menu = document.getElementById('profile-menu');
        menu.classList.toggle('hidden');
    });
</script>
