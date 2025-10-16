{{-- WRAPPER PRINCIPALE: Sostituisce .jumbotron e aggiunge spaziatura --}}
<div class="p-4 sm:p-6 lg:p-8">

    {{-- HEADER LEZIONE: Sostituisce .text-center --}}
    <div class="text-center mb-8">
        {{-- TITOLO: Sostituisce .display-4.mb-3 --}}
        <h1 class="text-4xl font-extrabold text-gray-800 mb-4">{{ $title }}</h1>

        @if(!empty($description))
            {{-- DESCRIZIONE: Sostituisce .lead --}}
            <p class="text-xl text-gray-600 max-w-4xl mx-auto">{{ $description }}</p>

            {{-- SEPARATORE: Sostituisce .hr.my-4 --}}
            <hr class="my-6 border-gray-300">
        @endif
    </div>

    {{-- CONTENUTO LEZIONE: Sostituisce .lesson-content.mt-4 --}}
    <div class="lesson-content space-y-6">
        @foreach($lessons as $lesson)
            {{-- TITOLO SEZIONE: Sostituisce .mt-3 --}}
            <h4 class="text-2xl font-semibold text-gray-700 pt-4 border-t border-gray-100">{{ $lesson['title'] }}</h4>

            {{-- BLOCCO CODICE: Tailwind per preformatted text --}}
            <pre class="bg-gray-900 text-green-400 p-4 rounded-lg overflow-x-auto shadow-inner text-sm">
                <code>{{ $lesson['code'] }}</code>
            </pre>
        @endforeach
    </div>

    {{-- FOOTER: Sostituisce .mt-4.text-center --}}
    <footer class="mt-8 pt-4 border-t border-gray-200 text-center text-gray-500 text-sm">
        <small>© 2025 Marco Cerilli — PHP, Symfony &amp; Laravel Specialist</small>
    </footer>
</div>
