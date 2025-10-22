<div class="p-6 lg:p-8 bg-white shadow-xl rounded-lg border border-gray-100">
    {{-- HEADLINE per la lezione --}}
    <h1 class="text-3xl font-bold mb-8 text-gray-800 border-b pb-4">
        📧 Notifiche e Comunicazioni Avanzate in Laravel
    </h1>

    <div class="space-y-12">

        {{-- SEZIONE 1: MAILABLES (Email) --}}
        <div class="border-l-4 border-indigo-500 pl-4">
            <h2 class="text-2xl font-extrabold text-indigo-700 mb-4">
                Parte 1: Costruire le Email con le Mailable
            </h2>
            <p class="text-lg text-gray-600 mb-4">
                Le **Mailable** sono classi che incapsulano la logica per l'invio di una specifica email, rendendo il
                codice pulito e riutilizzabile.
                Si generano con: <code>php artisan make:mail NewProjectNotification</code>.
            </p>

            <div class="mt-6 space-y-4">
                <h3 class="text-xl font-semibold text-gray-700">Configurazione e Personalizzazione</h3>
                <ul class="list-disc list-inside space-y-2 ml-4 text-gray-700">
                    <li>
                        <strong class="text-indigo-600">Template Personalizzato (View):</strong> Definito nel metodo
                        <code>build()</code>:
                        <pre class="bg-gray-700 text-yellow-300 p-2 mt-1 rounded-md text-sm"><code>


public function build()
{
return $this->view('emails.project-notification') // Il template Blade
->subject('Nuovo Progetto Creato!');
}
</code></pre>
                    </li>
                    <li>
                        <strong class="text-indigo-600">Dati e Metodo with():</strong> Usato per passare dati alla vista
                        (template):
                        <pre class="bg-gray-700 text-yellow-300 p-2 mt-1 rounded-md text-sm"><code>
// Nella Mailable:
public function build()
{
return $this->view('emails.project-notification')
->with([
'projectName' => $this->project->name,
'projectUrl' => route('projects.show', $this->project),
]);
}
</code></pre>
                    </li>
                    <li>
                        <strong class="text-indigo-600">Allegati:</strong> Si usa il metodo <code>attach()</code>,
                        specificando il percorso del file:
                        <pre class="bg-gray-700 text-yellow-300 p-2 mt-1 rounded-md text-sm"><code>
$this->view('...')
->attach('/percorso/documento.pdf', [
'as' => 'report.pdf',
'mime' => 'application/pdf',
]);
</code></pre>
                    </li>
                </ul>
            </div>
        </div>

        <hr class="my-10">

        {{-- SEZIONE 2: NOTIFICHE E MARKDOWN (133-136) --}}
        <div class="border-l-4 border-green-500 pl-4">
            <h2 class="text-2xl font-extrabold text-green-700 mb-4">
                Parte 2: Notifiche, Markdown e Canali
            </h2>
            <p class="text-lg text-gray-600 mb-4">
                Le **Notifiche** incapsulano la logica di invio attraverso diversi **canali** (mail, database, SMS,
                Slack, ecc.) per i *Notifiable Entities* (solitamente il modello User).
                Si generano con: <code>php artisan make:notification NewMessageNotification</code>.
            </p>

            <div class="mt-6 space-y-4">
                <h3 class="text-xl font-semibold text-gray-700">Canali e Markdown</h3>
                <ul class="list-disc list-inside space-y-2 ml-4 text-gray-700">
                    <li>
                        <strong class="text-green-600">Markdown Mailable:</strong> Per template email rapidi e
                        puliti, si può usare <code>->markdown('emails.progetto-md')</code> nel metodo
                        <code>toMail()</code> della Notifica.
                    </li>
                    <li>
                        <strong class="text-green-600">Canali :</strong> Il metodo <code>via()</code> definisce
                        i canali.
                        <pre class="bg-gray-700 text-yellow-300 p-2 mt-1 rounded-md text-sm"><code>


// Nella Notifica:
public function via(object $notifiable): array
{
// Invia via email E salva nel database
return ['mail', 'database'];
}

// Chiamata all'invio (nel controller o service):
$user->notify(new NewMessageNotification($message));
</code></pre>
                    </li>
                    <li>
                        <strong class="text-green-600">Canale Database:</strong> Per salvare la notifica
                        direttamente in una tabella <code>notifications</code>. Si usa il metodo
                        <code>toDatabase()</code> che restituisce un array di dati:
                        <pre class="bg-gray-700 text-yellow-300 p-2 mt-1 rounded-md text-sm"><code>
public function toDatabase(object $notifiable): array
{
return [
'message_id' => $this->message->id,
'title' => 'Nuovo Messaggio Ricevuto',
'action_url' => route('messages.show', $this->message),
];
}
</code></pre>
                    </li>
                </ul>
            </div>
        </div>

        <hr class="my-10">

        {{-- SEZIONE 3: TEST E DEBUGGING --}}
        <div class="border-l-4 border-red-500 pl-4">
            <h2 class="text-2xl font-extrabold text-red-700 mb-4">
                Parte 3: Testing Unitari e Debugging
            </h2>

            <div class="mt-6 space-y-4">
                <h3 class="text-xl font-semibold text-gray-700">Test Unitari per le Notifiche</h3>
                <p class="text-gray-700">
                    Laravel fornisce la Facade <code>Notification::fake()</code> per simulare l'invio durante i test,
                    garantendo che i metodi di notifica vengano chiamati senza inviare realmente email o scrivere sul
                    DB.
                </p>
                <pre class="bg-gray-700 text-yellow-300 p-3 rounded-md overflow-x-auto text-sm"><code>


use Illuminate\Support\Facades\Notification;
use Tests\TestCase;
use App\Models\User;
use App\Notifications\NewProjectNotification;

class ProjectTest extends TestCase
{
/** @test */
public function un_utente_viene_notificato_quando_crea_un_progetto()
{
// 1. Simula la Facade Notification
Notification::fake();

    $user = User::factory()->create();
    $this->actingAs($user);

    // ... logica per creare il progetto ...

    // 2. Asserzione che la notifica è stata inviata
    Notification::assertSentTo(
        $user,
        NewProjectNotification::class,
        // (Opzionale) Asserzione su specifici dati nella notifica
        function ($notification, $channels) use ($project) {
            return $notification->project->id === $project->id;
        }
    );
}


}
</code></pre>
            </div>

            <div class="mt-6 space-y-4">
                <h3 class="text-xl font-semibold text-gray-700">Debugging con Mailpit</h3>
                <p class="text-gray-700">
                    Per visualizzare le email inviate in un ambiente di sviluppo, si utilizza un *Mail Catcher* come
                    **Mailpit** (o Mailhog). Invece di inviare realmente le email, Laravel le reindirizza a questo
                    strumento che le cattura e le mostra in una semplice interfaccia web. Questo è essenziale per
                    verificare il layout, gli allegati e i link.
                </p>
                <p class="text-gray-700">
                    Di solito, è sufficiente impostare <code>MAIL_MAILER=smtp</code> e <code>MAIL_HOST=mailpit</code>
                    nel file <code>.env</code> (se si usa Sail o un container Docker).
                </p>
            </div>
        </div>

    </div>


</div>
