---
description: {var:description_de_de}
tags:
  - Hersteller
  - CMS
  - Shopware 6.7
---

# {var:label_de_de}

{var:description_de_de}

![Vorschau](images/storefront-manufacturer-detail.png)

---

{file:snippets/docs_demo_plugin.md}

{file:snippets/docs_buy_plugin.md}

{file:snippets/docs_foundation_note.md}

{file:snippets/docs_quickstart.md}

---

## Ersteinrichtung

### Plugin Konfiguration

![Plugin Konfiguration](images/admin-1.png)

1. Hauptseite mit Herstellerübersicht: Die Kategorie auf der alle Hersteller gelistet sind
2. Erweiterte Suche: [Foundation | Erweiterte Suche](../MoorlFoundation/advanced-search.md)

### Allgemeine Übersicht

Über die Hauptnavigation im Admin: `Kataloge` → `Erweiterte Hersteller` gibt es eine Übersicht für alle angelegten Einträge. Hier kann man neue Einträge anlegen, oder bestehende Einträge duplizieren oder löschen.

![Allgemeine Übersicht](images/admin-2.png)

## Neuen Hersteller hinzufügen

Dieses Plugin basiert auf die Hersteller, die es bereits in Shopware gibt, diese können optional erweitert werden. Um einen erweiterten Hersteller zu erstellen, muss mindestens ein Hersteller in Shopware angelegt sein.

Legen Sie zuerst einen Hersteller in Shopware an: `Kataloge` → `Hersteller` → `Hersteller hinzufügen`.

Anschließend können Sie einen neuen erweiterten Hersteller erstellen: `Kataloge` → `Erweiterte Hersteller` → `hinzufügen`.

### Eingabemaske

![Allgemeine und Sichtbarkeit](images/admin-3.png)

Allgemein:

- Produkt Hersteller: Der Hersteller, der durch das Plugin erweitert wird
- Name: Name des Herstellers
- Teaser/Kurzbeschreibung
- Beschreibung im HTML Format
- Schlüsselwörter

Sichtbarkeit:

- Aktiv
- Kategorien: Produktlisten im Storefront, in denen der Hersteller vertreten ist. Man kann durch einen Link von der Herstellerseite direkt in die Kategorie springen und der Hersteller ist bereits im Filter ausgewählt.
- Tags: Erscheinen im CMS-Metabereich der Herstellerseite. Hersteller können auch nach Tags gefiltert werden.

![Medien](images/admin-4.png)

Medien:

- Avatar: Das Herstellerlogo kann durch dieses Bild überschrieben werden
- Banner: Ein Banner für die Herstellerseite im Storefront

Kontakt: Allgemeine Kontaktmöglichkeiten

![Adresse](images/admin-7.png)

Adresse: Adresse und Geokoordinaten des Herstellers

SEO: Meta Angaben zum Hersteller

CMS Seite: Zuweisung und Konfiguration der CMS Seite des Herstellers

## CMS Seiten

![CMS Seiten](images/admin-8.png)

Mit der Installation des Plugins werden bereits zwei CMS Seiten erstellt. Eine Seite für die Übersicht aller Hersteller und eine für die Herstellerseite. Um die CMS Seiten anzupassen, können die bestehenden Seiten dupliziert und bearbeitet werden.

### Erweiterte Hersteller (Liste)

![Erweiterte Hersteller (Liste)](images/admin-6.png)

### Erweiterte Hersteller (Standard)

![Erweiterte Hersteller (Standard)](images/admin-5.png)
