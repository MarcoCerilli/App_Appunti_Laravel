{{-- WRAPPER PRINCIPALE: Sostituisce .jumbotron (lo stile esterno è già nel file wrapper) --}}
<div>
    {{-- HEADER LEZIONE: Sostituisce .text-center --}}
    <div class="text-center mb-8">
        {{-- TITOLO: Sostituisce .display-4.mb-3 --}}
        <h1 class="text-4xl font-extrabold text-gray-800 mb-4">Seeder in Laravel</h1>

        {{-- DESCRIZIONE: Sostituisce .lead --}}
        <p class="text-xl text-gray-600 max-w-4xl mx-auto">I Seeder servono per popolare il database con dati iniziali o di test, come i DataFixtures in Symfony.</p>

        {{-- SEPARATORE: Sostituisce .hr.my-4 --}}
        <hr class="my-6 border-gray-300">
    </div>

    {{-- CONTENUTO LEZIONE: Sostituisce .lesson-content.mt-4 --}}
    <div class="lesson-content space-y-6">
        @php
            $steps = [
                ['Creare un Seeder', 'php artisan make:seeder UserSeeder'],
                ['Esempio di contenuto del Seeder', <<<EOD
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(10)->create();
    }
}
EOD
                ],
                ['Eseguire il Seeder', 'php artisan db:seed --class=UserSeeder'],
                ['Eseguire tutti i seeder', 'php artisan db:seed'],
                ['Esempio con Factory', 'php artisan make:factory UserFactory --model=User']
            ];
        @endphp

        @foreach ($steps as $step)
            {{-- TITOLO SEZIONE: Sostituisce .mt-3 --}}
            <h4 class="text-2xl font-semibold text-gray-700 pt-4 border-t border-gray-100">🔹 {{ $loop->iteration }}️⃣ {{ $step[0] }}</h4>

            {{-- BLOCCO CODICE: Tailwind per preformatted text --}}
            <pre class="bg-gray-900 text-green-400 p-4 rounded-lg overflow-x-auto shadow-inner text-sm">
                <code>{{ $step[1] }}</code>
            </pre>
        @endforeach

        <p class="mt-8 text-gray-700">Nel file <code>database/factories/UserFactory.php</code> puoi definire i dati fittizi con Faker:</p>

        {{-- BLOCCO CODICE FACTORY --}}
        <pre class="bg-gray-900 text-green-400 p-4 rounded-lg overflow-x-auto shadow-inner text-sm"><code>
public function definition(): array
{
    return [
        'name' => fake()->name(),
        'email' => fake()->unique()->safeEmail(),
        'password' => bcrypt('password'),
    ];
}
        </code></pre>

        <p class="text-gray-700">Ora il seeder può usare la factory per generare utenti reali nel database.</p>

        {{-- ------------------------------------------------------------------------------------------------ --}}

        {{-- TABELLA CONFRONTO: Sostituisce .mt-4 e classi table Bootstrap --}}
        <h4 class="text-2xl font-semibold text-gray-700 pt-8 mt-8 border-t border-gray-100">📊 Confronto con Symfony</h4>

        <div class="overflow-x-auto mt-4">
            <table class="min-w-full divide-y divide-gray-200 border border-gray-200 shadow-sm rounded-lg">
                {{-- THEAD: Sostituisce .thead-dark --}}
                <thead class="bg-gray-700 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Laravel (Seeder)</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Symfony (DataFixtures)</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap"><code>php artisan make:seeder UserSeeder</code></td>
                        <td class="px-6 py-4 whitespace-nowrap"><code>php bin/console make:fixture UserFixtures</code></td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap"><code>php artisan db:seed</code></td>
                        <td class="px-6 py-4 whitespace-nowrap"><code>php bin/console doctrine:fixtures:load</code></td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">Integrato con Factory</td>
                        <td class="px-6 py-4 whitespace-nowrap">Richiede Faker o Factory personalizzate</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">Namespace: <code>Database\Seeders</code></td>
                        <td class="px-6 py-4 whitespace-nowrap">Namespace: <code>App\DataFixtures</code></td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap"><code>php artisan migrate:fresh --seed</code></td>
                        <td class="px-6 py-4 whitespace-nowrap">doctrine:database:drop/create + fixtures:load</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- FOOTER: Sostituisce .mt-4.text-center (è già stato convertito prima, lo includo pulito) --}}
    <footer class="mt-8 pt-4 border-t border-gray-200 text-center text-gray-500 text-sm">
        <small>© 2025 Marco Cerilli — PHP, Symfony &amp; Laravel Specialist</small>
    </footer>
</div>
