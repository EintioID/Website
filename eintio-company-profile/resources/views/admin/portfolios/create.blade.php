<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs text-slate-400 mb-1.5">Beranda / Portofolio / Tambah</p>
            <h2 class="text-xl font-bold text-brand-dark tracking-tight">Tambah Portofolio</h2>
        </div>
    </x-slot>

    @include('admin.portfolios.partials.styles')

    <form action="{{ route('admin.portfolios.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.portfolios.partials.form')
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        revealObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1, rootMargin: '0px 0px -30px 0px' });
            document.querySelectorAll('.reveal').forEach((el) => revealObserver.observe(el));
        });
    </script>
</x-app-layout>