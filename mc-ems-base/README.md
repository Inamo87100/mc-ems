# MC-EMS – Exam Session Management for WordPress & Tutor LMS

MC-EMS è un plugin WordPress completo per gestire sessioni di esame, prenotazioni degli studenti e controllo dell'accesso agli esami nelle piattaforme e-learning che utilizzano Tutor LMS.

Il plugin introduce un sistema integrato per organizzare esami programmati attraverso sessioni di esame, un calendario di prenotazione intuitivo, gestione centralizzata delle prenotazioni e controllo accesso ai corsi tramite prenotazione valida.

MC-EMS è particolarmente utile per:
- Enti di formazione e certificazione
- Accademie e università
- Piattaforme LMS basate su Tutor LMS
- Scuole e centri di formazione professionale
- Sistemi di certificazione digitale

## Funzionalità principali

### Gestione Sessioni di Esame
Il plugin introduce un Custom Post Type dedicato alle sessioni di esame (mcems_exam_session). Ogni sessione include data, orario, corso associato, capienza, configurazioni speciali e altre impostazioni. Le sessioni sono completamente gestibili dal pannello WordPress con un'interfaccia intuitiva e un calendario amministrativo.

### Prenotazione Esami tramite Calendario
Gli studenti possono prenotare una sessione di esame utilizzando il calendario di prenotazione interattivo direttamente dal frontend del sito.

**Shortcode**: `[mcems_book_exam]`

Questo shortcode mostra le sessioni disponibili filtrate per data e permette allo studente di prenotare uno slot di esame in modo semplice e veloce.

### Gestione della Propria Prenotazione
Gli utenti possono visualizzare, gestire e annullare la propria prenotazione tramite una pagina dedicata.

**Shortcode**: `[mcems_manage_booking]`

Questa pagina consente allo studente di:
- Visualizzare i dettagli della prenotazione
- Controllare data e ora dell'esame
- Visualizzare il corso associato
- Annullare la prenotazione (se consentito)

### Lista Prenotazioni con Ricerca Avanzata ed Export CSV
Il plugin include una schermata amministrativa completa per la gestione delle prenotazioni con funzionalità avanzate.

**Shortcode**: `[mcems_bookings_list]`

Funzioni disponibili:
- Elenco completo delle prenotazioni
- Ricerca avanzata per data (singolo giorno o intervallo)
- Filtri per corso, candidato e stato
- Esportazione dati in CSV con separatore personalizzato
- Visualizzazione delle esigenze speciali
- Informazioni proctor assegnato

### Calendario Amministrativo delle Sessioni
MC-EMS include un calendario per la gestione operativa delle sessioni di esame e l'assegnazione dei supervisori (proctor).

**Shortcode**: `[mcems_sessions_calendar]`

Questo calendario permette agli amministratori di:
- Visualizzare tutte le sessioni in un'unica vista
- Controllare la capienza e i posti disponibili
- Assegnare e gestire i proctor
- Monitorare le prenotazioni per sessione

### Controllo Accesso ai Corsi con Tutor LMS
Il plugin integra un Tutor LMS access gate che blocca automaticamente l'accesso ai corsi e ai contenuti (lezioni, quiz, materiali) degli studenti che non hanno una prenotazione valida per quella sessione.

Quando l'accesso è bloccato:
- Il corso rimane completamente inaccessibile
- Viene visualizzato il messaggio "Exam locked"
- Tutto il contenuto del corso viene nascosto
- Lo studente può vedere solo il messaggio di blocco con istruzioni su come prenotare

### Sistema di Impostazioni Configurabili
MC-EMS include una sezione di configurazione avanzata nel pannello WordPress dove è possibile:
- Configurare le pagine utilizzate per il booking e la gestione prenotazioni
- Impostare il comportamento del sistema di prenotazione (anticipo ore, cancellazioni, ecc.)
- Configurare l'integrazione con Tutor LMS
- Personalizzare i messaggi e i testi del sistema
- Gestire i permessi di accesso e visualizzazione

## Versione Base vs Versione Premium

| Funzionalità | Base | Premium |
|---|---|---|
| Sessioni di esame (CPT) | ✓ | ✓ |
| Prenotazione esami | ✓ | ✓ |
| Calendario prenotazioni | ✓ | ✓ |
| Gestione prenotazione utente | ✓ | ✓ |
| Lista prenotazioni | ✓ | ✓ |
| Ricerca prenotazioni | ✓ | ✓ |
| Export CSV prenotazioni | ✓ | ✓ |
| Calendario amministrativo sessioni | ✓ | ✓ |
| Assegnazione proctor | ✓ | ✓ |
| Integrazione Tutor LMS | ✓ | ✓ |
| **Sessioni illimitate** | — | ✓ |
| **Capienza fino a 500 posti** | 5 max | ✓ |
| **Multipli slot per giorno** | 1 max | ✓ |
| **Ricerca avanzata con toggle** | Base | ✓ |
| **Supporto prioritario** | — | ✓ |

## Requisiti

- WordPress 6.0 o superiore
- PHP 7.0 o superiore
- Tutor LMS attivo per l'integrazione

Per utilizzare la versione Premium è obbligatorio avere il plugin Base attivo.

## Ideale per

MC-EMS è perfetto per:
- Enti certificatori che gestiscono esami programmati
- Piattaforme e-learning con Tutor LMS
- Università e accademie con corsi online
- Scuole e centri di formazione con esami a sessioni
- Sistemi di certificazione digitale
- Organizzazioni che richiedono controllo rigido dell'accesso agli esami

## Installazione

1. Scarica il plugin dal WordPress Repository
2. Attiva il plugin nella sezione Plugin di WordPress
3. (Opzionale) Attiva la versione Premium se hai l'add-on
4. Configura le impostazioni nella sezione MC-EMS
5. Crea le sessioni di esame
6. Aggiungi i shortcode alle pagine desiderate