# 🎓 MC-EMS – Exam Management System

*Dal tuo WordPress a un centro esami professionale. In meno di un'ora.*

---

## Cosa fa

MC-EMS è il plugin WordPress per la **gestione completa degli esami** su piattaforme Tutor LMS. Trasforma il tuo LMS in un sistema professionale dove i candidati si prenotano online, i supervisori vengono assegnati automaticamente e l'accesso ai corsi è controllato in base alla prenotazione.

**Ideale per:** scuole, università, centri di formazione, provider di certificazioni.

---

## 🔵 Funzionalità Base

### 📅 Generazione sessioni (Bulk)

Crea le sessioni d'esame in blocco:

- Seleziona corso, data e fascia oraria
- Genera sessioni su più giorni in un'unica operazione
- Imposta la capienza massima per sessione
- Limite Base: max 5 sessioni attive future, max 5 posti, 1 orario per giorno

### 🗓️ Prenotazioni candidati

Shortcode: `[mcems_book_exam]`

Calendario interattivo per prenotarsi all'esame:

- Disponibilità per corso con codice colore (🟢 libero → 🔴 pieno)
- **Finestra di anticipo**: blocca prenotazioni troppo ravvicinate all'esame (es. "non puoi prenotarti a meno di 48 ore dall'esame", configurabile)
- **Prenotazione per-corso**: il candidato può prenotarsi a più corsi in modo indipendente
- **Google Calendar**: dopo la prenotazione, aggiungi l'esame al tuo calendario in 1 click
- Caricamento AJAX, zero refresh di pagina

### 🗑️ Cancellazione controllata

Shortcode: `[mcems_manage_booking]`

- Il candidato vede tutte le sue prenotazioni attive
- **Cancellazione limitata nel tempo**: configurabile in ore (es. "cancellazione non consentita nelle 24h prima dell'esame")
- Possibilità di disabilitare completamente la cancellazione
- Email automatica di conferma alla cancellazione

### 🔒 Accesso corsi (Gate Tutor LMS)

Blocca l'accesso ai corsi senza una prenotazione valida:

- **Lead time**: sblocca il corso X minuti prima dell'esame (accesso anticipato al materiale)
- **Expiry**: l'accesso rimane valido per X ore/minuti dopo il termine dell'esame
- Gate selettivo: scegli quali corsi richiedono prenotazione, lascia gli altri liberi
- Admin e docenti bypassano il gate automaticamente

### 📋 Lista prenotazioni con export CSV

Shortcode: `[mcems_bookings_list]`

- Filtri per data singola e per corso
- Export CSV compatibile con Excel
- Visibile agli utenti con capability dedicata

### 👤 Calendario supervisori

Shortcode: `[mcems_sessions_calendar]`

- Assegna, riassegna o rimuovi il proctor da ogni sessione
- Notifiche email automatiche all'assegnazione/rimozione
- Alert automatici (cron notturno) per sessioni ancora senza supervisore a 24h dall'esame

### 📧 Email automatiche

7 template completamente personalizzabili con placeholder dinamici:

- Conferma / cancellazione prenotazione → Candidato
- Nuova prenotazione / cancellazione → Admin
- Assegnazione / rimozione proctor → Supervisore
- Alert sessioni senza supervisore → Admin (cron notturno)

Placeholder disponibili: `{site_name}`, `{candidate_name}`, `{candidate_email}`, `{course_title}`, `{session_date}`, `{session_time}`, `{session_id}`, `{manage_booking_url}`, `{booking_page_url}`, `{proctor_name}`

---

## 🟡 Funzionalità Premium

### ♾️ Sessioni illimitate

- Nessun limite al numero di sessioni attive future
- Nessun limite di capienza per sessione
- **Più orari per giorno**: crea mattina + pomeriggio (o più slot) nello stesso giorno per lo stesso corso (Base: max 1 orario/giorno)

### ♿ Sessioni speciali (Accessibilità)

- Sessioni 1-on-1 per candidati con esigenze speciali
- Assegnazione manuale del candidato tramite ricerca per email
- Capienza fissa = 1, sessione non visibile nel calendario pubblico
- Indicatore ♿ visibile nella lista prenotazioni e nei report

### 📊 Lista prenotazioni avanzata

Shortcode: `[mcems_bookings_list]` (versione Premium)

- **Ricerca avanzata**: toggle per attivare filtri aggiuntivi
- **Range date**: cerca prenotazioni in un intervallo di date (da → a)
- **Totale prenotazioni**: counter aggiornato in tempo reale sui risultati filtrati
- Export CSV UTF-8 con nome file dinamico (data + slug corso)
- Colonne complete: cognome, nome, email, ID sessione, data, ora, corso, proctor, ♿

### 📈 Report e statistiche

- Panoramica sessioni: totali, tasso di occupazione medio, sessioni senza proctor
- Report per corso: prenotazioni totali, candidati distinti, trend nel tempo
- Esportazione report

---

## 📊 Base vs Premium – Confronto

| Feature | Base | Premium |
|---|---|---|
| Creazione sessioni d'esame (bulk) | ✅ | ✅ |
| Calendario prenotazioni candidati | ✅ | ✅ |
| Google Calendar integration | ✅ | ✅ |
| Finestra anticipo prenotazione (ore) | ✅ | ✅ |
| Cancellazione controllata (ore) | ✅ | ✅ |
| Gate accesso corsi + lead time + expiry | ✅ | ✅ |
| Email automatiche (7 template) | ✅ | ✅ |
| Calendario supervisori + alert cron | ✅ | ✅ |
| Lista prenotazioni + CSV | ✅ | ✅ |
| **Sessioni attive future max** | **5** | **Illimitate** |
| **Posti per sessione max** | **5** | **Illimitati** |
| **Orari per giorno** | **1** | **Illimitati** |
| Sessioni speciali accessibilità (♿) | ❌ | ✅ |
| Lista prenotazioni avanzata (range date, totali) | ❌ | ✅ |
| Report e statistiche | ❌ | ✅ |

---

## 💡 Casi d'uso

**Centro di formazione – più corsi, più sessioni**
Il candidato sceglie il corso, vede il calendario, si prenota. Il gate Tutor LMS sblocca il materiale del corso X minuti prima dell'esame e lo mantiene accessibile per le ore configurate dopo. Zero intervento manuale.

**Scuola con esami mattina e pomeriggio**
Con Premium, crei più slot orari nello stesso giorno per lo stesso corso. I candidati scelgono l'orario preferito. Le sessioni extra si gestiscono senza limiti.

**Candidato con esigenze speciali**
L'admin crea una sessione speciale 1-on-1 con l'apposito tool (Premium), assegna il candidato per email. La sessione non appare nel calendario pubblico e viene tracciata separatamente nella lista prenotazioni con il badge ♿.

**Report mensile per il direttore**
Con Premium, filtra la lista prenotazioni per range di date e corso → esporta CSV → apertura in Excel in 10 secondi. Tutti i dati: nome, email, sessione, proctor, eventuali esigenze speciali.

---

## ✅ Vantaggi chiave

- ⏱️ **Meno burocrazia** – Prenotazioni, notifiche e gate accesso completamente automatici
- 🔒 **Accesso controllato** – Lead time + expiry configurabili per ogni scenario
- 📱 **Esperienza fluida** – Calendario AJAX ottimizzato per desktop e mobile
- 📧 **Brand coerente** – 7 template email personalizzabili con placeholders
- ♾️ **Scalabile** – Inizia con Base, passa a Premium quando cresci
- 📊 **Dati sempre pronti** – Export CSV e report completi (Premium)

---

## ⚙️ Setup (15 minuti)

1. **Installa** MC-EMS Base (+ Premium opzionale)
2. **Crea 2 pagine** in WordPress:
   - "Prenota esame" → inserisci `[mcems_book_exam]`
   - "Gestisci prenotazione" → inserisci `[mcems_manage_booking]`
3. **Settings → MC-EMS → Pages** → seleziona le pagine create
4. **Configura** prenotazioni (anticipo ore, cancellazione), accesso corsi (lead time, expiry) e template email
5. **Crea le prime sessioni** dalla voce "Crea Sessioni" nel menu admin

---

## 📦 Requisiti

- WordPress 6.0+
- PHP 7.0+
- Tutor LMS (per gate accesso corsi e integrazione calendario)

---

*MC-EMS – Esami organizzati. Candidati informati. Admin tranquilli.*
