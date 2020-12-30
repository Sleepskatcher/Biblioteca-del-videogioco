-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 26, 2020 alle 18:03
-- Versione del server: 10.4.10-MariaDB
-- Versione PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tecweb`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `console`
--

CREATE TABLE `console` (
  `nome` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `console`
--

INSERT INTO `console` (`nome`) VALUES
('PlayStation3'),
('PlayStation4'),
('Switch'),
('Wii'),
('WiiU'),
('Xbox360'),
('XboxOne');

-- --------------------------------------------------------

--
-- Struttura della tabella `disponibili`
--

CREATE TABLE `disponibili` (
  `videogioco` int(11) NOT NULL,
  `console` varchar(40) NOT NULL,
  `copie` int(3) NOT NULL,
  `noleggiati` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `disponibili`
--

INSERT INTO `disponibili` (`videogioco`, `console`, `copie`, `noleggiati`) VALUES
(1, 'Wii', 10, 0),
(1, 'WiiU', 5, 0),
(2, 'PlayStation3', 10, 1),
(2, 'Xbox360', 10, 0),
(3, 'Xbox360', 4, 1),
(4, 'PlayStation3', 15, 0),
(4, 'Xbox360', 4, 0),
(5, 'Switch', 5, 0),
(5, 'WiiU', 2, 0),
(6, 'PlayStation3', 10, 1),
(6, 'Xbox360', 15, 0),
(7, 'PlayStation4', 20, 0),
(7, 'XboxOne', 10, 0),
(8, 'PlayStation3', 4, 0),
(8, 'PlayStation4', 5, 0),
(9, 'WiiU', 4, 0),
(10, 'WiiU', 6, 1),
(11, 'PlayStation3', 5, 0),
(12, 'XboxOne', 5, 0),
(13, 'PlayStation4', 3, 0),
(13, 'Switch', 7, 0),
(13, 'XboxOne', 6, 0),
(14, 'PlayStation4', 3, 0),
(14, 'XboxOne', 2, 0),
(15, 'PlayStation4', 10, 1),
(15, 'XboxOne', 10, 1),
(16, 'PlayStation4', 7, 0),
(17, 'PlayStation3', 5, 0),
(17, 'Switch', 4, 0),
(17, 'WiiU', 2, 0),
(17, 'Xbox360', 12, 0),
(17, 'XboxOne', 10, 0),
(18, 'PlayStation3', 20, 0),
(18, 'Wii', 8, 0),
(18, 'WiiU', 6, 1),
(18, 'Xbox360', 17, 0),
(19, 'PlayStation3', 5, 0),
(19, 'WiiU', 3, 1),
(19, 'Xbox360', 6, 0),
(20, 'PlayStation3', 4, 0),
(20, 'Wii', 3, 1),
(20, 'Xbox360', 4, 0),
(21, 'Xbox360', 2, 0),
(22, 'PlayStation3', 4, 0),
(22, 'Xbox360', 5, 0),
(23, 'PlayStation3', 3, 0),
(23, 'Xbox360', 3, 0),
(24, 'PlayStation3', 4, 0),
(24, 'Xbox360', 4, 0),
(25, 'Wii', 4, 0),
(26, 'Switch', 3, 1),
(27, 'PlayStation4', 5, 0),
(27, 'Switch', 4, 0),
(27, 'XboxOne', 3, 0),
(28, 'PlayStation3', 4, 0),
(28, 'Xbox360', 2, 0),
(29, 'PlayStation3', 4, 1),
(29, 'Wii', 2, 1),
(29, 'Xbox360', 5, 0),
(30, 'PlayStation3', 6, 0),
(30, 'Xbox360', 6, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `prenotazione`
--

CREATE TABLE `prenotazione` (
  `id` int(11) NOT NULL,
  `utente` varchar(40) NOT NULL,
  `videogioco` int(11) DEFAULT NULL,
  `nome_videogioco` varchar(100) NOT NULL,
  `console` varchar(40) DEFAULT NULL,
  `data_prenotazione` date NOT NULL,
  `data_ritiro` date DEFAULT NULL,
  `data_restituzione` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `prenotazione`
--

INSERT INTO `prenotazione` (`id`, `utente`, `videogioco`, `nome_videogioco`, `console`, `data_prenotazione`, `data_ritiro`, `data_restituzione`) VALUES
(1, 'utente', 20, 'NBA 2K12', 'Wii', '2020-01-17', NULL, NULL),
(2, 'utente', 6, 'The Elder Scrolls V: Skyrim ', 'PlayStation3', '2020-01-17', NULL, NULL),
(3, 'utente', 29, 'Call of Duty: Black Ops', 'Wii', '2020-01-17', NULL, NULL),
(4, 'stefano30', 26, 'Super Smash Bros. Ultimate', 'Switch', '2020-01-17', NULL, NULL),
(5, 'stefano30', 10, 'Mario Kart 8', 'WiiU', '2020-01-17', NULL, NULL),
(6, 'stefano30', 3, 'Halo 2', 'Xbox360', '2020-01-17', NULL, NULL),
(7, 'margherita09', 19, 'Mass Effect 3', 'WiiU', '2020-01-17', NULL, NULL),
(8, 'margherita09', 29, 'Call of Duty: Black Ops', 'PlayStation3', '2020-01-17', NULL, NULL),
(9, 'margherita09', 2, 'Grand Theft Auto IV', 'PlayStation3', '2020-01-17', NULL, NULL),
(10, 'daniele75', 11, 'God of War III', 'PlayStation3', '2020-01-17', '2020-01-18', '2020-01-23'),
(11, 'daniele75', 15, 'The Witcher 3: Wild Hunt', 'PlayStation4', '2020-01-17', NULL, NULL),
(12, 'daniele75', 30, 'Dark Souls II', 'Xbox360', '2020-01-17', NULL, NULL),
(13, 'anna21', 7, 'Red Dead Redemption 2', 'XboxOne', '2020-01-17', '2020-01-18', '2020-01-24'),
(14, 'anna21', 18, 'FIFA 13', 'WiiU', '2020-01-17', NULL, NULL),
(15, 'anna21', 15, 'The Witcher 3: Wild Hunt', 'XboxOne', '2020-01-17', NULL, NULL),
(16, 'utente', 13, 'Civilization VI ', 'Switch', '2020-01-17', '2020-01-20', '2020-02-28');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`username`, `password`, `nome`, `cognome`, `email`) VALUES
('admin', 'admin', 'adminnome', 'admincognome', 'admin@gmail.com'),
('anna21', 'anna21', 'Anna', 'Cisotto', 'anna@gmail.com'),
('daniele75', 'daniele75', 'Daniele', 'Larosa', 'daniele@gmail.com'),
('margherita09', 'margherita09', 'Margherita', 'Mitillo', 'margherita@gmail.com'),
('stefano30', 'stefano30', 'Stefano', 'Cavaliere', 'stefano@gmail.com'),
('utente', 'utente', 'utentenome', 'utentecognome', 'utente@gmail.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `videogioco`
--

CREATE TABLE `videogioco` (
  `codice` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `copertina` varchar(100) NOT NULL,
  `data_uscita` date NOT NULL,
  `pegi` int(2) NOT NULL,
  `genere` varchar(40) NOT NULL,
  `descrizione` varchar(10000) NOT NULL,
  `prezzo_noleggio` double NOT NULL,
  `bestseller` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `videogioco`
--

INSERT INTO `videogioco` (`codice`, `nome`, `copertina`, `data_uscita`, `pegi`, `genere`, `descrizione`, `prezzo_noleggio`, `bestseller`) VALUES
(1, '<span xml:lang=\"en\" lang=\"en\">Super Mario Galaxy</span> 2', 'Super_Mario_Galaxy_2.jpg', '2010-06-11', 3, 'Platform', '<span xml:lang=\"en\" lang=\"en\">Super Mario Galaxy</span> 2 &egrave; il seguito del celebre <span xml:lang=\"en\" lang=\"en\">platform</span> con protagonista l\'idraulico pi&ugrave; longevo della storia dei videogiochi.\r\nSua maest&agrave; Miyamoto decide di non seppellire la marea di idee che il primo <span xml:lang=\"en\" lang=\"en\">Super Mario Galaxy</span> aveva creato, promettendo un gioco pi&ugrave; difficile e adatto agli appassionati, ma anche un mondo diverso al 95%, e anche dove ci saranno luoghi gi&agrave; visti, bisogner&agrave; fare cose completamente diverse.\r\nMario dovr&agrave; raccogliere le Stelle spostandosi tra una galassia e l\'altra. Ogni livello &egrave; nuovo, ma il gioco mantiene il fascino, il senso di stupore e di bellezza che caratterizzano da sempre la fortunata storia della serie. Mario percorrer&agrave; i livelli in vari modi, a volte a testa in gi&ugrave;, altre volte galleggiando.\r\nIn alcuni livelli, Mario pu&ograve; trovare un uovo, aprirlo e saltare sul dorso di <span xml:lang=\"en\" lang=\"en\">Yoshi</span>. Il simpatico dinosauro pu&ograve; usare la lingua per afferrare gli oggetti e scagliarli contro i nemici oppure per agganciarsi agli appigli e superare le voragini, dondolando fino all\'altro lato. <span xml:lang=\"en\" lang=\"en\">Yoshi</span> ha un\'alimentazione interessante: quando mangia un <span xml:lang=\"en\" lang=\"en\">Dash Pepper</span>, gli vengono un caldo e una frenesia tremendi e pu&ograve; scalare pendii ripidissimi e pareti verticali. Quando invece mangia un <span xml:lang=\"en\" lang=\"en\">Blimp Fruit</span>, si gonfia come un palloncino e vola in alto galleggiando.\r\nI nuovi potenziamenti includono una trivella che Mario usa per scavare tunnel passando da una parte all\'altra del pianeta, un costume roccia che permette a Mario di tramutarsi in una roccia rotolante ed un costume nuvola che permette a Mario di creare un certo numero di piattaforme aeree; inoltre, i giocatori pi&ugrave; esperti vorranno collezionare i nuovi Metalli cometa, che consentono di sbloccare livelli ancora pi&ugrave; difficili e ricchi di sfide.', 0.5, 1),
(2, '<span xml:lang=\"en\" lang=\"en\">Grand Theft Auto</span> 4', 'grand-theft-auto-iv-cover.jpg', '2008-04-29', 18, 'Azione', 'I primi passi lungo le strade di <span xml:lang=\"en\" lang=\"en\">Liberty City</span>, il nome fittizio della citt&agrave; che come da tradizione riproduce <span xml:lang=\"en\" lang=\"en\">New York</span>, sono stati abbastanza chiarificatori riguardo l\'impegno profuso per dare vita ad un mondo credibile: il traffico gode di maggior imprevedibilit&agrave; e gli automobilisti reagiscono in modo realistico ad incidenti o ingorghi, mentre i pedoni si intrattengono tra di loro sui marciapiedi discutendo e, qualora il giocatore dovesse compiere qualche azione degna di nota, ricordandosi di Nico e riconoscendolo nelle occasioni successive.\r\nImpressiona, in positivo, il design degli edifici ed in generale della citt&agrave;, ora molto pi&ugrave; complesso che in passato con case ben distinguibili l\'una dalle altre, anche grazie a graffiti e cartelli pubblicitari, e strutture architettoniche come ponti e sopraelevate ricche di dettagli. \r\n<span xml:lang=\"en\" lang=\"en\">Liberty City</span> sar&agrave; pi&ugrave; vasta di tutte le altre citt&agrave; sinora riprodotte, ma senza gli spazi aperti che aumentavano l’area esplorabile di San Andreas, ad esempio, senza migliorarne la giocabilit&agrave;. In altre parole, il <span xml:lang=\"en\" lang=\"en\">team</span> sembra essersi concentrato sul tentativo di ricreare un mondo pi&ugrave; vivo e pieno di dettagli, piuttosto che su un ambiente pi&ugrave; vasto, ma sterile.', 0.5, 1),
(3, '<span xml:lang=\"en\" lang=\"en\">Halo</span> 2', 'halo2.jpeg', '2004-11-09', 16, 'Sparatutto', '<span xml:lang=\"en\" lang=\"en\">Halo 2</span>: <span xml:lang=\"en\" lang=\"en\">Halo 2</span> è il nuovo capitolo del famosissimo <span xml:lang=\"en\" lang=\"en\">Halo: Combat Evolved</span>, unanimemente acclamato da tutta la critica. In <span xml:lang=\"en\" lang=\"en\">Halo 2</span>, la saga vede sempre come protagonista il Capo, un supersoldato geneticamente potenziato, che da solo si frappone tra i <span xml:lang=\"en\" lang=\"en\">Covenant</span> e la distruzione del genere umano.', 0.25, 1),
(4, '<span xml:lang=\"en\" lang=\"en\">Grand Theft Auto</span>: San Andreas', 'grand-theft-auto-san-andreas-cover.jpg', '2004-10-29', 18, 'Azione', 'Cinque anni fa <span xml:lang=\"en\" lang=\"en\">Carl Johnson</span> fugg&igrave; da Los Santos, San Andreas... Una citt&agrave; che si stava autodistruggendo a causa delle guerre fra bande, della droga e della corruzione. Una citt&agrave; dove le star del cinema e i milionari fanno di tutto per evitare gli spacciatori e gli stupratori.\r\nOra, all\'inizio degli anni 90, <span xml:lang=\"en\" lang=\"en\">Carl</span> deve ritornare a casa. Sua madre &egrave; stata uccisa, la sua famiglia si &egrave; sfasciata e i suoi amici d\'infanzia stanno andando incontro alla rovina. Al suo ritorno nel quartiere una coppia di poliziotti corrotti lo incastrano con l\'accusa di omicidio. <span xml:lang=\"en\" lang=\"en\">CJ</span> &egrave; costretto ad iniziare un viaggio che lo porta ad attraversare l\'intero stato di San Andreas, per salvare la sua famiglia e per prendere il controllo delle strade.\r\n<span xml:lang=\"en\" lang=\"en\">Liberty City</span>. <span xml:lang=\"en\" lang=\"en\">Vice City</span>. Ora San Andreas, un nuovo capitolo nella serie leggendaria. <span xml:lang=\"en\" lang=\"en\">Grand Theft Auto</span> ritorna su <span xml:lang=\"en\" lang=\"en\">PlayStation</span>2 a ottobre, e divertir&agrave; pi&ugrave; che mai!', 0.15, 1),
(5, '<span xml:lang=\"en\" lang=\"en\">The Legend of Zelda: Breath of the Wild</span>', 'zelda1.jpg', '2017-03-03', 12, 'Avventura', 'Dimentica tutto quello che sai sui giochi di <span xml:lang=\"en\" lang=\"en\">The Legend of Zelda</span> e immergiti in un mondo di scoperte, esplorazione e avventura in <span xml:lang=\"en\" lang=\"en\">The Legend of Zelda: Breath of the Wild</span>, il nuovo capitolo di questa amatissima serie. Attraversa campi, foreste e montagne mentre cerchi di capire cosa &egrave; successo al regno di <span xml:lang=\"en\" lang=\"en\">Hyrule</span> in questa enorme, straordinaria avventura.\r\n\r\nScala torri e montagne in cerca di nuove destinazioni, poi scegli un percorso per raggiungerle e parti all\'avventura. Lungo la strada affronterai nemici giganteschi, caccerai animali selvatici e raccoglierai il cibo e le pozioni che ti servono per sopravvivere.\r\n\r\nIl mondo cela tanti sacrari, che potrai esplorare nell\'ordine che preferisci. Al loro interno troverai enigmi di vario tipo. Supera le trappole e le sorprese che ti aspettano al varco per ottenere oggetti speciali e altre ricompense che ti aiuteranno nei tuoi viaggi.\r\n\r\nCon un intero mondo da esplorare, avrai certamente bisogno di varie tenute e dell\'equipaggiamento adatto. Potresti dover indossare degli abiti caldi per proteggerti dal freddo o dei vestiti pi&ugrave; leggeri quando sei nel deserto. Alcuni abiti hanno anche effetti speciali che possono renderti, per esempio, pi&ugrave; veloce e furtivo.\r\n\r\nIncontrerai nemici di tutti i tipi e le dimensioni. Ognuno avr&agrave; attacchi e armi diverse, quindi devi pensare rapidamente e sviluppare le tattiche giuste per sconfiggerli.', 0.4, 1),
(6, '<span xml:lang=\"en\" lang=\"en\">The Elder Scrolls</span> 5: <span xml:lang=\"en\" lang=\"en\">Skyrim</span> ', 'the-elder-scrolls-v-skyrim-cover.jpg', '2011-11-11', 16, 'Gioco di ruolo', '<span xml:lang=\"en\" lang=\"en\">The Elder Scrolls V: Skyrim</span> &egrave; il nuovo capitolo della serie di <span xml:lang=\"en\" lang=\"en\">Bethesda</span>, ambientato nella regione di <span xml:lang=\"en\" lang=\"en\">Skyrim</span>, la patria dei Nord e la prima regione di <span xml:lang=\"en\" lang=\"en\">Tamriel</span> a essere popolata, ben due secoli dopo i fatti di <span xml:lang=\"en\" lang=\"en\">Oblivion</span>, il quarto capitolo della saga.\r\n\r\nNei panni del <span xml:lang=\"en\" lang=\"en\">\"Dovahkiin\"</span>, ultimo discendente rimasto della dinastia imperiale, nelle cui vene scorre il Sangue di Drago, siamo chiamati a sconfiggere la minaccia del malvagio <span xml:lang=\"en\" lang=\"en\">Alduin</span>, drago antico e potente, apprendendo gli Urli pi&ugrave; potenti, antico e terribile potere, per affrontarlo in combattimento.\r\n\r\nMa non solo. <span xml:lang=\"en\" lang=\"en\">Skyrim</span> &egrave; piagata da una guerra civile che insanguina i feudi e impegna l\'Impero e i Nord puri in una guerra fratricida per la conquista del territorio. &egrave; il giocatore che dovr&agrave; decidere se <span xml:lang=\"en\" lang=\"en\">Skyrim</span> otterr&agrave; la sua indipendenza o se rimarr&agrave; parte dell\'impero. Come &egrave; sempre il giocatore che sar&agrave; chiamato a scegliere quale gilda o fazione aiutare, o se essere un temuto criminale o un eroe amato in tutti i feudi.', 0.03, 1),
(7, '<span xml:lang=\"en\" lang=\"en\">Red Dead Redemption</span> 2', 'red-dead-redemption-2-standard-edition-cover.jpg', '2018-10-26', 18, 'Azione', 'America, 1899. L\'era del selvaggio <span xml:lang=\"en\" lang=\"en\">West</span> &egrave; agli sgoccioli: la legge sta catturando le ultime bande di criminali. Chi rifiuta di arrendersi, viene ucciso senza piet&agrave;.\r\n\r\nDopo un colpo andato storto nella citt&agrave; di <span xml:lang=\"en\" lang=\"en\">Blackwater</span>, <span xml:lang=\"en\" lang=\"en\">Arthur Morgan</span> e la banda di <span xml:lang=\"en\" lang=\"en\">Van der Linde</span> sono costretti alla fuga. Con gli agenti federali e i migliori cacciatori di taglie alle costole, la banda deve rapinare, combattere e rubare per farsi strada e cercare di sopravvivere nel cuore di un\'America dura e selvaggia.', 1, 1),
(8, 'Persona 5', 's-l1600.jpg', '2017-04-04', 16, 'Gioco di ruolo giapponese', 'Scoprite la picaresca storia di una giovane squadra di ladri fantasma in questa ultima aggiunta all\'acclamatissima serie Persona. Di giorno vi godete la vita da studenti di scuola superiore nella grande citt&agrave;, passando il tempo come pi&ugrave; vi aggrada.\r\n\r\nI legami che instaurerete con le persone che incontrerete diventeranno sempre pi&ugrave; forti e vi aiuteranno a perseguire il vostro destino! Dopo la scuola usate la vostra app Navigatore <span xml:lang=\"en\" lang=\"en\">Metaverse</span> per infiltrarvi nei palazzi,mondi surreali creati dai cuori di adulti corrotti, e sgattaiolate verso la vostra seconda vita come dei ladri fantasma', 0.02, 0),
(9, '<span xml:lang=\"en\" lang=\"en\">Xenoblade Chronicles</span> X', '220px-Xenoblade_Chronicles_X_-_Boxart.jpg', '2015-12-04', 12, 'Gioco di ruolo', '<span xml:lang=\"en\" lang=\"en\">Xenoblade Chronicles</span> X &egrave; un videogioco di ruolo <span xml:lang=\"en\" lang=\"en\">open world</span> che pone molta enfasi sull\'esplorazione. Gli spostamenti possono essere effettuati a piedi o a bordo di enormi robot umanoidi chiamati \"<span xml:lang=\"en\" lang=\"en\">Skell</span>\", alti circa quattro volte il personaggio giocabile medio e capaci di volare, navigare sull\'acqua e trasformarsi in veicoli come motociclette o carri armati. Tramite di essi, il <span xml:lang=\"en\" lang=\"en\">gameplay</span> offre anche combattimenti aerei.', 0.06, 0),
(10, '<span xml:lang=\"en\" lang=\"en\">Mario Kart</span> 8', '5b50d0e4ae653a55ce1b52a5.jpeg', '2014-05-30', 3, 'Simulatore di guida', 'Mario <span xml:lang=\"en\" lang=\"en\">Kart</span> 8 &egrave; il nuovo episodio della serie per <span xml:lang=\"en\" lang=\"en\">Wii U</span>.\r\nL\'ultimo capitolo dell\'acclamata serie di corse a tutta velocit&agrave; introduce opzioni che sfidano la forza di gravit&agrave;: i <span xml:lang=\"en\" lang=\"en\">kart</span> possono ora sfrecciare su pareti verticali, e correre a testa in gi&ugrave; su piste capovolte. \r\nTornano anche elementi dai giochi precedenti della serie, come i deltaplani e le motociclette.', 0.07, 1),
(11, '<span xml:lang=\"en\" lang=\"en\">God of War</span> 3', 'god-of-war-3-pick-up-i8496.jpg', '2010-04-10', 18, 'Avventura', 'La lotta contro gli dei dell\'Olimpo continua:se nel primo capitolo il nostro eroe spartano era occupato a sfidare <span xml:lang=\"en\" lang=\"en\">Ares</span>, in <span xml:lang=\"en\" lang=\"en\">God of War</span> III,avr&agrave; l\'intero olimpo contro, dal dio dei morti, Ade, fino a Zeus, capo degli dei. \r\nL\'azione di gioco sar&agrave; ancora pi&ugrave; spettacolare di quella, gi&agrave; perfetta sotto molti aspetti, degli scorsi capitoli, con un numero a schermo di nemici impressionante ed una gestione delle telecamere decisamente ben applicata, che trasportano il giocatore in un\'esperienza epica ed emozionante. Per quanto riguarda la quantit&agrave; di combo, ci si trova di fronte ad una quantit&agrave; ben superiore, grazie alle molte armi e magie, che durante lo svolgimento della storia potranno immancabilmente essere potenziate a scelta del giocatore.', 0.08, 1),
(12, 'Forza <span xml:lang=\"en\" lang=\"en\">Horizon</span> 4 ', 'forza-horizon-4-pc-xbox-one-cover.jpg', '2018-10-02', 3, 'Gioco di guida', '<span xml:lang=\"en\" lang=\"en\">Forza Horizon</span> 4 &egrave; il nuovo capitolo del racing game arcade di <span xml:lang=\"en\" lang=\"en\">Playground Games</span> in collaborazione con <span xml:lang=\"en\" lang=\"en\">Turn</span> 10.\r\n\r\nAmbientato nel Regno Unito, <span xml:lang=\"en\" lang=\"en\">Forza Horizon</span> 4 si caratterizza per una grande variet&agrave; di ambientazioni, come da tradizione, anche grazie alle possibilit&agrave; offerte dalla location scelta. Non solo, il motore grafico rinnovato consente ulteriori variazioni: l\'ambientazione aperta viene sottoposta a una notevole variazione grazie al succedersi delle stagioni, che introduce diversi elementi di cambiamento sugli scenari e sui tracciati, influendo anche sulla guida con pioggia, neve, nebbia e quant\'altro.', 0.03, 1),
(13, '<span xml:lang=\"en\" lang=\"en\">Civilization</span> 6 ', 'Sid-Meier-Civilization-VI.jpg', '2016-10-21', 12, 'Strategia', '<span xml:lang=\"en\" lang=\"en\">Sid Meier\'s Civilization</span> VI &egrave; il nuovo capitolo dell\'acclamata serie <span xml:lang=\"en\" lang=\"en\">Civilization</span>, che ha venduto in tutto il mondo quasi 33 milioni di copie, tra cui pi&ugrave; di 8 milioni solo del precedente <span xml:lang=\"en\" lang=\"en\">Civilization</span> V.\r\n\r\n<span xml:lang=\"en\" lang=\"en\">Civilization</span> &egrave; un gioco strategico a turni in cui l\'obiettivo &egrave; costruire un impero in grado di superare la prova del tempo. Diventa il dominatore del mondo, conducendo la tua civilt&agrave; dall\'et&agrave; della pietra a quella dell\'informazione! Combatti, tratta con diplomazia, sviluppa la tua cultura e sfida i pi&ugrave; grandi <span xml:lang=\"en\" lang=\"en\">leader</span> della storia per dare vita alla civilt&agrave; pi&ugrave; grandiosa che il mondo abbia mai conosciuto.\r\n\r\n<span xml:lang=\"en\" lang=\"en\">Civilization</span> VI offre nuove modalit&agrave; di interazione con il mondo: le citt&agrave; ora si espandono fisicamente sulla mappa, mentre le ricerche attive in campo tecnologico e culturale sbloccano nuove potenzialit&agrave;. Intanto i <span xml:lang=\"en\" lang=\"en\">leader</span> avversari portano avanti i loro programmi, basati sulle caratteristiche dei personaggi storici: il risultato &egrave; una corsa per raggiungere una delle cinque diverse condizioni di vittoria del gioco.\r\n\r\n<span xml:lang=\"en\" lang=\"en\">Civilization</span> VI offre nuovi modi per interagire con il mondo, espandere il proprio impero sulla mappa, sviluppare la propria cultura e competere con i pi&ugrave; grandi <span xml:lang=\"en\" lang=\"en\">leader</span> della storia per plasmare una civilt&agrave; in grado di superare la prova del tempo.', 1.05, 1),
(14, '<span xml:lang=\"en\" lang=\"en\">Batman: Arkham Knight</span> ', '91yCSSbAi2L.jpg', '2015-06-23', 16, 'Azione', '<span xml:lang=\"en\" lang=\"en\">Batman: Arkham Knight</span> &egrave; il finale esplosivo della serie <span xml:lang=\"en\" lang=\"en\">Arkham</span>, con la possibilit&agrave; non solo di volare tra i tetti, ma guidare la mitica <span xml:lang=\"en\" lang=\"en\">Batmobile</span>, con la presenza di tutti gli storici nemici dell\'uomo pipistrello, compreso lo Spaventapasseri. Il gioco &egrave; programmato da <span xml:lang=\"en\" lang=\"en\">Rocksteady Studios</span>.', 0.04, 0),
(15, '<span xml:lang=\"en\" lang=\"en\">The Witcher</span> 3: <span xml:lang=\"en\" lang=\"en\">Wild Hunt</span>', '510RHE9vePL.jpg', '2015-05-19', 18, 'Gioco di ruolo', 'Il terzo capitolo dell\'apprezzata serie prende la strada del <span xml:lang=\"en\" lang=\"en\">free roaming</span> e lo fa in grande stile con una mappa 40 volte pi&ugrave; grande di quella del capitolo precedente.\r\n\r\nMolte migliorie sono state implementate in <span xml:lang=\"en\" lang=\"en\">The Witcher</span> 3: <span xml:lang=\"en\" lang=\"en\">Wild Hunt</span>, tra cui la completa esplorazione del mondo di gioco resa possibile con i viaggi a cavallo e la navigazione. In vista del totale cambio di rotta verso il <span xml:lang=\"en\" lang=\"en\">free roaming</span> &egrave; sparita la conformazione della storia in capitoli, inoltre non vi sar&agrave; alcuna schermata di caricamento durante l\'esplorazione\r\n\r\nLe regioni disponibili sono <span xml:lang=\"en\" lang=\"en\">Skellige, Novigrad</span> e <span xml:lang=\"en\" lang=\"en\">No Mans Land</span>. Un ciclo notte/giorno influir&agrave; sul comportamento e sull\'aspetto dei mostri tuttavia una buona conoscenza delle varie creature presenti nel gioco consentirà di rendere pi&ugrave; efficaci gli attacchi (attraverso libri reperibili nel mondo di gioco). Il livello dei nemici &egrave; indipendente da quello del giocatore.\r\n\r\n&Egrave; possibile inoltre interagire con alcuni elementi dell\'ambientazione che potranno rivelarsi utili negli scontri, in vista di tutto ci&ograve; l\'intelligenza artificiale &egrave; stata completamente riscritta. Una completa rivisitazione dei segni magici consente nuovi effetti e un albero di avanzamento per ciascuno di essi conferir&agrave; ulteriori potenziali aggiunte. Negli alberi delle abilit&agrave; sono presenti nuovi poteri. &Egrave; stata aggiunta la possibilit&agrave; di personalizzare il proprio equipaggiamento attraverso un sistema di <span xml:lang=\"en\" lang=\"en\">crafting</span>, rendendo così fondamentale potenziare il proprio <span xml:lang=\"en\" lang=\"en\">witcher</span>.\r\n\r\nDi non poca importanza, quello che ha contraddistinto pi&ugrave; di tutto i precedenti capitoli, &egrave; ancora una volta l\'importanza di compiere delle scelte. Persino abbandonare la trama principale per dedicarsi alle quest secondarie avrà ripercussioni sul mondo di gioco.', 0.9, 1),
(16, '<span xml:lang=\"en\" lang=\"en\">Bloodborne</span>', '51PKyWkczuL.jpg', '2015-05-25', 18, 'Gioco di ruolo', 'Un viandante solitario. Una citt&agrave; maledetta. Un mistero letale che annienta tutto ci&ograve; con cui entra in contatto.\r\n\r\nAffronta le tue paure addentrandoti nella desolata citt&agrave; di <span xml:lang=\"en\" lang=\"en\">Yharnam</span>, un luogo dimenticato, flagellato da una terribile piaga.\r\n\r\nEsplora le sue ombre pi&ugrave; cupe, combatti per la tua vita con spade e armi e scopri segreti che ti geleranno il sangue... e ti garantiranno la salvezza...', 0.8, 0),
(17, '<span xml:lang=\"en\" lang=\"en\">Bayonetta</span>', '81qgVfB5xRL._SY445_.jpg', '2014-10-24', 18, 'Azione', '<span xml:lang=\"en\" lang=\"en\">Bayonetta</span> è un cinematografico gioco di azione, diretto dal creatore di <span xml:lang=\"en\" lang=\"en\">Devil May Cry</span>.\r\nUna strega con poteri che vanno oltre la comprensione dei mortali di nome Bayonetta si trova a combattere contro innumerevoli nemici dalle sembianze angeliche, alcuni di proporzioni epiche, in un gioco di azione pura al 100%.\r\nI numerosi combattimenti di <span xml:lang=\"en\" lang=\"en\">Bayonetta</span> sono caratterizzati da mosse letali eseguite con una grazia senza pari. \r\nDopo la uscita <span xml:lang=\"en\" lang=\"en\">Bayonetta</span> è diventato un titolo di culto tra gli amanti dei giochi di azione!', 0.05, 0),
(18, 'FIFA 13', 'fifa-13-copertina-ufficiale.jpg', '2012-09-28', 3, 'Sportivo', 'FIFA 13 riproduce tutto l\'entusiasmo e l\'imprevedibilit&agrave; del vero calcio giocato e si basa su cinque fantastiche innovazioni che rivoluzioneranno l\'intelligenza artificiale, il dribbling, il controllo di palla e il gioco fisico. Si tratta della pi&ugrave; estesa e approfondita serie di caratteristiche mai introdotta nella storia di questo serie. Queste novit&agrave; daranno vita a veri e propri scontri per il possesso palla sull\'intero campo di gioco, introducendo un nuovo livello di libert&agrave; e creativit&agrave; in attacco e riproducendo tutto l\'entusiasmo e l\'imprevedibilit&agrave; del vero calcio giocato.\r\nIntelligenza in attacco:\r\n\r\nI giocatori sono in grado di analizzare gli spazi, lavorare in maniera pi&ugrave; intensa ed efficace per penetrare la difesa e possono pensare in anticipo alla giocata da eseguire. Inoltre i giocatori effettuano inserimenti per costringere i difensori fuori posizione e aprono varchi per i passaggi a beneficio dei compagni.\r\n<span xml:lang=\"en\" lang=\"en\">Dribbling</span> totale:\r\n\r\nAffronta l\'avversario usando tocchi precisi, uniti al movimento reale a 360° per dribblare i difensori. Potrai dare pi&ugrave; spazio alla fantasia ed essere pi&ugrave; incisivo negli uno contro uno.\r\nTocco di prima:\r\n\r\nUn nuovo sistema ridefinisce il modo di controllare la palla da parte dei giocatori, eliminando il controllo quasi perfetto per ogni calciatore e permettendo ai difensori di approfittare delle palle vaganti e dei tocchi sbagliati per riconquistare palla.', 0.9, 1),
(19, '<span xml:lang=\"en\" lang=\"en\">Mass Effect</span> 3', 'mass3.jpg', '2012-04-09', 18, 'Gioco di ruolo', '<span xml:lang=\"en\" lang=\"en\">Mass Effect</span> 3 &egrave; il capitolo conclusivo della trilogia fantascientifica creata da <span xml:lang=\"en\" lang=\"en\">BioWare</span>, che vede tutti i nodi venire al pettine e concludersi le vicende legate al comandante <span xml:lang=\"en\" lang=\"en\">Shepard</span>, finora il protagonista assoluto di tutti i capitoli.\r\n\r\n<span xml:lang=\"en\" lang=\"en\">Christina Norman</span> di <span xml:lang=\"en\" lang=\"en\">BioWare</span> ha affermato che se con <span xml:lang=\"en\" lang=\"en\">Mass Effect</span> 2 il team si &egrave; concentrato di pi&ugrave; sull\'aspetto action del gioco, col terzo capitolo il focus &egrave; finito sulla componente ruolistica e <span xml:lang=\"en\" lang=\"en\">adventure</span>, moltiplicando in numero e in longevit&agrave; le fasi esplorative e al tempo stesso perfezionando l\'intelligenza artificiale dei nemici. Inoltre, grazie ai consigli dei <span xml:lang=\"en\" lang=\"en\">fan</span> &egrave; stata rivista anche la fase esplorativa dei vari pianeti, eliminando la necessit&agrave; di ricercare le materie prime.\r\n\r\nPresente anche un\'inedita modalit&agrave; <span xml:lang=\"en\" lang=\"en\">multiplayer</span>, che permette a pi&ugrave; giocatori di affrontarsi in appassionanti modalit&agrave;, anch\'esse legate all\'universo di <span xml:lang=\"en\" lang=\"en\">Mass Effect</span>.', 0.8, 1),
(20, '<span xml:lang=\"en\" lang=\"en\">NBA 2K12</span>', 'nba-2k12-fob_pegi_bird.jpg', '2011-10-07', 3, 'Sportivo', '<span xml:lang=\"en\" lang=\"en\">NBA 2K12</span> rappresenta l\'ultimo capitolo del gioco <span xml:lang=\"en\" lang=\"en\">NBA</span> pi&ugrave; venduto e pi&ugrave; votato in assoluto, un titolo che anno dopo anno ha saputo guadagnarsi la stima della critica e dei <span xml:lang=\"en\" lang=\"en\">fan</span> grazie a continui e costanti miglioramenti su tutti i fronti: grafica, <span xml:lang=\"en\" lang=\"en\">gameplay, signature styles</span> e modalit&agrave; di gioco.', 0.08, 1),
(21, '<span xml:lang=\"en\" lang=\"en\">Gears of War</span> 3', 'gears-of-war-3-copertina-gioco.jpg', '2011-09-20', 18, 'Sparatutto', '<span xml:lang=\"en\" lang=\"en\">Gears of War</span> 3 &egrave; il nuovo capitolo dell\'epica serie esclusiva che conclude l\'epica trilogia. Il protagonista <span xml:lang=\"en\" lang=\"en\">Marcus Fenix</span> e i propri compagni dell\'esercito COG, 18 mesi dopo l\'epilogo del precedente capitolo, arrivano allo scontro finale nella lotta contro le locuste, perfida razza di creature che vivono nel sottosuolo del pianeta <span xml:lang=\"en\" lang=\"en\">Sera</span>, ma a rovinare la festa ci pensano anche le nuove creature, locuste geneticamente modificate dall\'<span xml:lang=\"en\" lang=\"en\">Imulsion</span>, una sostanza che le render&agrave; molto pi&ugrave; forti.<span xml:lang=\"en\" lang=\"en\">Gears of war</span> 3 usa l\'ultima versione dell\'<span xml:lang=\"en\" lang=\"en\">Unreal Engine</span>3 che porta ad un livello di eccellenza totale la grafica che si rivel&ograve; mastodontica fin dal primo capitolo. Non dimentichiamo che <span xml:lang=\"en\" lang=\"en\">Gears o War</span> &egrave; stato IL gioco che ha scaraventato tutti nella <span xml:lang=\"en\" lang=\"en\">next-gen</span> grafica per primo. &egrave; possibile affrontare una specie di Orda, ma al rovescio, questa volta infatti si vestono i panni delle temibili Locuste, dai piccoli e fastidiosi <span xml:lang=\"en\" lang=\"en\">Ticker</span> ai giganteschi <span xml:lang=\"en\" lang=\"en\">Boomer</span> senza nessuna esclusione, il nostro obiettivo &egrave; dunque quello di attaccare gruppi di COG che sono costretti a difendersi per evitare la disfatta. Inoltre &egrave; presente una campagna coop con la possibilit&agrave; di giocare fino in 4 giocatori umani.', 0.09, 0),
(22, '<span xml:lang=\"en\" lang=\"en\">Dragon Age: Origins</span>', 'dragonage.jpeg', '2009-11-20', 18, 'Gioco di ruolo', '<span xml:lang=\"en\" lang=\"en\">Dragon Age: Origins</span> &egrave; considerato a tutti gli effetti da <span xml:lang=\"en\" lang=\"en\">BioWare</span> come l\'erede spirituale di <span xml:lang=\"en\" lang=\"en\">Baldur\'s Gate</span>, quindi un gioco di ruolo dall\'approccio piuttosto classico e dall\'ambientazione schiettamente <span xml:lang=\"en\" lang=\"en\">fantasy</span> ma che, a differenza proprio di <span xml:lang=\"en\" lang=\"en\">Baldur\'s Gate</span>, legato a doppia mandata con la licenza <span xml:lang=\"en\" lang=\"en\">Dungeons aNd Dragons</span> e il mondo dei <span xml:lang=\"en\" lang=\"en\">Forgotten Realms</span>, propone un universo completamente inedito e creato a tavolino da <span xml:lang=\"en\" lang=\"en\">BioWare</span>.\r\nIl gioco all\'inizio &egrave; ambientato in una delle cittadelle controllate dai <span xml:lang=\"en\" lang=\"en\">Grey Wardens</span>, una societ&agrave; militare composta dalla migliore elite di guerrieri, immersa nei preparativi per affrontare uno scontro imminente con i <span xml:lang=\"en\" lang=\"en\">Blight</span>, creature demoniache dai chiari intenti distruttivi evocate e, probabilmente comandate, da un <span xml:lang=\"en\" lang=\"en\">archdemon</span> in procinto di portare morte e distruzione attraverso tutta la regione.', 0.08, 0),
(23, '<span xml:lang=\"en\" lang=\"en\">Fallout</span> 3 <abbr title=\"Game of the year\">GOTY</abbr> <span xml:lang=\"en\" lang=\"en\">edition</span>', 'fallout-3-goty-edition-cover.jpg', '2009-10-01', 12, 'Gioco di ruolo', '<span xml:lang=\"en\" lang=\"en\">Fallout</span> 3 <span xml:lang=\"en\" lang=\"en\">Game of the Year Edition</span> &egrave; una <span xml:lang=\"en\" lang=\"en\">compilation</span> che contiene il gioco completo <span xml:lang=\"en\" lang=\"en\">Fallout</span> 3 pi&ugrave; 5 contenuti esclusivi: \r\n•<span xml:lang=\"en\" lang=\"en\">Operation Achorage</span>, una simulazione militare di combattimento in una delle pi&ugrave; grandi battaglie dell\'universo di <span xml:lang=\"en\" lang=\"en\">Fallout</span>: la liberazione di <span xml:lang=\"en\" lang=\"en\">Anchorage, Alaska</span>, dall\'invasione comunista.\r\n•<span xml:lang=\"en\" lang=\"en\">The Pitt</span> rivivr&agrave; una degradata <span xml:lang=\"en\" lang=\"en\">Pittsburg, Pennsylvania</span> post nucleare.\r\n•<span xml:lang=\"en\" lang=\"en\">Broken Steel</span> espande la <span xml:lang=\"en\" lang=\"en\">quest</span> principale, aumentando il livello massimo a 30 con armi e abilit&agrave; mai viste.\r\n•<span xml:lang=\"en\" lang=\"en\">Point Lookout</span>: una gigantesca area paludosa da esplorare piena di nuove missioni e contenuti.\r\n•<span xml:lang=\"en\" lang=\"en\">Mothership Zeta</span>: gli alieni prenderanno il sopravvento nell\'ultima espansione di questo capolavoro.', 0.08, 1),
(24, '<span xml:lang=\"en\" lang=\"en\">BioShock</span>', 'jrpib8t74zhaapqq2idi_390x400_1x-0.jpg', '2008-10-17', 18, 'Sparatutto', 'La storia di <span xml:lang=\"en\" lang=\"en\">Bioshock</span> racconta che, in seguito a un tragico incidente aereo, il giocatore si ritrova solo in acque gelide e sconosciute. Nel disperato tentativo di raggiungere la salvezza scopre una batisfera arrugginita che lo conduce a <span xml:lang=\"en\" lang=\"en\">Rapture</span>, una citt&agrave; sommersa situata nelle profondit&agrave; del mare. Costruita come societ&agrave; ideale da un piccolo gruppo di scienziati, artisti e industriali, <span xml:lang=\"en\" lang=\"en\">Rapture</span> &egrave; poi crollata sotto il peso del suo stesso idealismo. Ora la citt&agrave; &egrave; cosparsa di cadaveri, popolata da possenti guardiani, i <span xml:lang=\"en\" lang=\"en\">Big Daddy</span>, che vagano nei corridoi accompagnati da bambine mutanti che saccheggiano i corpi dei morti e con gli abitanti geneticamente modificati che cercano di tendere agguati al giocatore ad ogni angolo.\r\n\r\nUno degli elementi cardine di <span xml:lang=\"en\" lang=\"en\">Bioshock</span> &egrave; l\'atmosfera che permea il gioco fin dai primissimi istanti: una forte carica <span xml:lang=\"en\" lang=\"en\">horror</span> sottolineata peraltro da un\'ambientazione incredibilmente suggestiva e da un comparto sonoro impressionante per la qualit&agrave; degli effetti e delle musiche.\r\nIl gioco &egrave; graficamente molto avanzato, grazie all\'<span xml:lang=\"en\" lang=\"en\">Unreal Engine</span> 3: il dettaglio delle ambientazioni &egrave; stupefacente, cos&igrave; come il sapiente utilizzo degli effetti luce e del motore fisico.\r\nOgni oggetto dello scenario, oltre ad avere delle specifiche propriet&agrave; fisiche, &egrave; quasi sempre esaminabile ed utilizzabile dall\'utente. Le interazioni possibili sono moltissime.', 0.05, 0),
(25, '<span xml:lang=\"en\" lang=\"en\">The Legend of Zelda: Twilight Princess</span> ', '81qDqktk1uL.jpg', '2006-12-15', 12, 'Gioco di ruolo', 'Quando un\'oscurit&agrave; malvagia circonda la terra di <span xml:lang=\"en\" lang=\"en\">Hyrule</span>, un giovane di nome <span xml:lang=\"en\" lang=\"en\">Link</span> deve tirare fuori l\'eroe, e l\'animale, che c\'&egrave; in lui.', 0.08, 0),
(26, '<span xml:lang=\"en\" lang=\"en\">Super Smash Bros. Ultimate</span>', 'SQ_NSwitch_SuperSmashBrosUltimate_02.jpg', '2018-12-07', 12, 'Arcade', 'Mondi e personaggi leggendari si incontrano per la sfida definitiva su <span xml:lang=\"en\" lang=\"en\">Nintendo Switch</span> in un nuovo <span xml:lang=\"en\" lang=\"en\">Super Smash Bros</span>.!\r\n\r\nNuovi personaggi, come l\'<span xml:lang=\"en\" lang=\"en\">Inkling</span> di <span xml:lang=\"en\" lang=\"en\">Splatoon</span> e <span xml:lang=\"en\" lang=\"en\">Ridley</span> di <span xml:lang=\"en\" lang=\"en\">Metroid</span> fanno il loro debutto nella serie, insieme a tutti i lottatori dei capitoli precedenti!\r\n\r\nCombattimenti pi&ugrave; veloci, nuovi oggetti, nuovi attacchi, nuove opzioni difensive e molto altro garantiscono un divertimento senza fine a casa o in mobilit&agrave;.', 0.06, 0),
(27, '<span xml:lang=\"en\" lang=\"en\">Divinity: Original Sin II - Definitive Edition</span>', 'divinity.jpg', '2018-08-31', 18, 'Gioco di ruolo', '<span xml:lang=\"en\" lang=\"en\">Divinity: Original Sin</span> II &egrave; il nuovo capitolo della serie creata da <span xml:lang=\"en\" lang=\"en\">Larian Studios</span>.\r\n\r\nNella nuova avventura &egrave; possibile esplorare il mondo di <span xml:lang=\"en\" lang=\"en\">Rivellon</span> da soli o in compagnia di altri tre giocatori, attraverso la modalit&agrave; cooperativa <span xml:lang=\"en\" lang=\"en\">drop-in/drop-out</span>. A fianco della campagna principale sono disponibili la modalit&agrave; PvP e la modalit&agrave; <span xml:lang=\"en\" lang=\"en\">Game Master</span>.\r\n\r\nIl gioco permette di scegliere tra otto razze, quattordici classi e varie origini che influenzano lo svolgimento dell’avventura dando scelte di dialogo differenti a seconda della situazione.', 0.9, 1),
(28, '<span xml:lang=\"en\" lang=\"en\">Max Payne</span> 3', 'max-payne-3-cover.jpg', '2012-06-01', 18, 'Sparatutto', '<span xml:lang=\"en\" lang=\"en\">Max Payne</span> 3 consente al giocatore di vestire ancora una volta i panni del detective <span xml:lang=\"en\" lang=\"en\">hard-boiled</span> di <span xml:lang=\"en\" lang=\"en\">New York City</span> con un debole per la violenza, per vendicare la morte della sua famiglia. \r\n\r\nQuest\'ultima avventura offrir&agrave pi&ugrave dei classici elementi e dell\'intensa iper-azione che i fan hanno imparato ad amare indirizzando la storia di <span xml:lang=\"en\" lang=\"en\">Max</span> in una nuova ed inaspettata direzione. Da quando si &egrave lasciato il NYPD e la stessa citt&agrave di <span xml:lang=\"en\" lang=\"en\">New York, Max</span> &egrave caduto dalla padella alla brace. Tanto lontano da casa, Max &egrave ora intrappolato in una citt&agrave piena di violenza e di sangue, potr&agrave affidarsi alle sole sue armi e al suo istinto alla disperata ricerca della verit&agrave e di una maledetta via d\'uscita.', 0.05, 0),
(29, '<span xml:lang=\"en\" lang=\"en\">Call of Duty: Black Ops</span>', 'call-of-duty-black-ops-cover.jpg', '2010-11-09', 18, 'Sparatutto', 'Il brand che capeggia la categoria degli sparatutto degli ultimi anni, il <span xml:lang=\"en\" lang=\"en\">Call of Duty</span> che molti seguono, gi&agrave; si rivela nel suo settimo capitolo.\r\nTorna la serie d\'azione pi&ugrave; famosa di sempre. <span xml:lang=\"en\" lang=\"en\">Call of Duty: Black Ops</span> &egrave; un\'esperienza d\'intrattenimento che ti porter&agrave; a combattere in tutto il mondo nei panni di un soldato scelto (<span xml:lang=\"en\" lang=\"en\">Mason</span> il nome del protagonista) <span xml:lang=\"en\" lang=\"en\">Black Ops</span> in una serie di operazioni segrete durante la Guerra Fredda.\r\nInfondendo nuova linfa alla modalit&agrave; multigiocatore, <span xml:lang=\"en\" lang=\"en\">Call of Duty: Black Ops</span> porta il gioco competitivo a un nuovo livello. I combattimenti rapidi e brutali vedono l\'aggiunta di nuove modalit&agrave;:\r\nGuadagna i punti COD durante le partite da usare per comprare equipaggiamento, accessori, specialit&agrave; e nuove opzioni di personalizzazione. La libert&agrave; di comprare ci&ograve; che vuoi quando vuoi. \r\nNuove serie di uccisioni come Attacco al napalm, il mezzo esplosivo radiocomandato e gli elicotteri controllabili.', 0.8, 1),
(30, '<span xml:lang=\"en\" lang=\"en\">Dark Souls</span> 2', 'Dark_Souls_II_cover.jpg', '2014-04-25', 18, 'Gioco di ruolo', '<span xml:lang=\"en\" lang=\"en\">Dark Souls</span> II &egrave; il nuovo capitolo dell\'action RPG ad ambientazione <span xml:lang=\"en\" lang=\"en\">dark fantasy</span> di <span xml:lang=\"en\" lang=\"en\">From Software</span>.', 1, 1);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `console`
--
ALTER TABLE `console`
  ADD PRIMARY KEY (`nome`);

--
-- Indici per le tabelle `disponibili`
--
ALTER TABLE `disponibili`
  ADD PRIMARY KEY (`videogioco`,`console`),
  ADD KEY `console` (`console`,`videogioco`) USING BTREE;

--
-- Indici per le tabelle `prenotazione`
--
ALTER TABLE `prenotazione`
  ADD PRIMARY KEY (`id`),
  ADD KEY `videogioco` (`videogioco`),
  ADD KEY `console` (`console`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`username`);

--
-- Indici per le tabelle `videogioco`
--
ALTER TABLE `videogioco`
  ADD PRIMARY KEY (`codice`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `prenotazione`
--
ALTER TABLE `prenotazione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT per la tabella `videogioco`
--
ALTER TABLE `videogioco`
  MODIFY `codice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `disponibili`
--
ALTER TABLE `disponibili`
  ADD CONSTRAINT `disponibili_ibfk_1` FOREIGN KEY (`videogioco`) REFERENCES `videogioco` (`codice`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `disponibili_ibfk_2` FOREIGN KEY (`console`) REFERENCES `console` (`nome`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `prenotazione`
--
ALTER TABLE `prenotazione`
  ADD CONSTRAINT `prenotazione_ibfk_1` FOREIGN KEY (`videogioco`) REFERENCES `videogioco` (`codice`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `prenotazione_ibfk_2` FOREIGN KEY (`console`) REFERENCES `console` (`nome`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
