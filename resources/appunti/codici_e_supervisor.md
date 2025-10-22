Riepilogo Modulo Avanzato: Code e Comunicazioni (Lezioni 137-144)

Questo modulo copre le tecniche essenziali per spostare le operazioni lente fuori dal ciclo di richiesta HTTP e per gestire le comunicazioni utente multi-canale.

1. Mailable & Notifiche

Mailable: Classe per incapsulare la logica di una singola email. Perfetta per email "una tantum" (es. "Contattaci").

Notifiche: Strumento multi-canale che usa il tratto Notifiable sui modelli (es. User). Perfette per comunicazioni legate a eventi (es. email, database, Slack).

2. Background Processing (Code/Jobs)

Job: Classe che esegue un task specifico (es. inviare una Mailable, elaborare un file) in background. Generato con php artisan make:job ProcessPodcast.

Messa in Coda (Queue): Metodo dispatch() sul Job per inviarlo alla coda.

Connessione: Default è sync (immediata). In produzione si usa database, redis o SQS.

Failed Jobs: I Job che falliscono oltre il limite di tentativi ($tries) vengono spostati nella tabella failed_jobs.

3. Worker e Supervisor

Worker: Il processo che "ascolta" la coda ed esegue i Job. Avviato con php artisan queue:work.

Worker Resilienza: Deve essere avviato con flag come --tries=3 (tentativi) e --timeout=60 (tempo massimo per Job).

Supervisor: Un demone di sistema Linux (essenziale in produzione) che ha due compiti fondamentali:

Mantenere il Worker Attivo: Avvia il comando queue:work in background.

Riavvio Automatico: Monitora costantemente il Worker e, in caso di crash/terminazione, lo riavvia immediatamente, garantendo lo zero downtime per l'elaborazione delle code.

Setup Critico di Supervisor:
Il file di configurazione (.conf) richiede:

Il percorso assoluto al comando PHP (es. command=/usr/bin/php ...).

La direttiva directory= (il percorso assoluto della radice dell'app) per risolvere i problemi di contesto.

L'utente di sistema corretto (es. user=marco).
