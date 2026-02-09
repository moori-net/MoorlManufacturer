---
description: {var:description_en_gb}
tags:
  - Parts list
  - Fence configurator
  - Shopware 6.7
---

# {var:label_en_gb}

{var:description_en_gb}

![Preview](images/storefront-manufacturer-detail.png)

---

{file:snippets/docs_demo_plugin.en.md}

{file:snippets/docs_buy_plugin.en.md}

{file:snippets/docs_foundation_note.en.md}

{file:snippets/docs_quickstart.en.md}

---

## Initial Setup

### Plugin Configuration

![Plugin Configuration](images/admin-1.png)

1. Main page with manufacturer overview: The category in which all manufacturers are listed
2. Advanced search: [Foundation | Advanced Search](../MoorlFoundation/advanced-search.md)

### General Overview

Via the main navigation in the admin panel: `Catalogues` → `Advanced Manufacturers`, you get an overview of all created entries. Here you can create new entries or duplicate or delete existing ones.

![General Overview](images/admin-2.png)

## Add a new Manufacturer

This plugin is based on the manufacturers that already exist in Shopware and can optionally extend them. To create an extended manufacturer, at least one manufacturer must already be created in Shopware.

First, create a manufacturer in Shopware:  
`Catalogues` → `Manufacturers` → `Add manufacturer`.

After that, you can create a new extended manufacturer:  
`Catalogues` → `Advanced Manufacturers` → `Add`.

### Input Form

![General and Visibility](images/admin-3.png)

General:

- Product manufacturer: The manufacturer that is extended by the plugin
- Name: Name of the manufacturer
- Teaser / short description
- Description in HTML format
- Keywords

Visibility:

- Active
- Categories: Product listings in the storefront in which the manufacturer appears. You can jump directly from the manufacturer page to the category via a link, with the manufacturer already preselected in the filter.
- Tags: Appear in the CMS meta area of the manufacturer page. Manufacturers can also be filtered by tags.

![Media](images/admin-4.png)

Media:

- Avatar: The manufacturer logo can be overridden by this image
- Banner: A banner for the manufacturer page in the storefront

Contact: General contact options

![Address](images/admin-7.png)

Address: Address and geocoordinates of the manufacturer

SEO: Meta information for the manufacturer

CMS Page: Assignment and configuration of the manufacturer's CMS page

## CMS Pages

![CMS Pages](images/admin-8.png)

With the installation of the plugin, two CMS pages are created automatically: one page for the overview of all manufacturers and one for the manufacturer detail page. To customize the CMS pages, the existing pages can be duplicated and edited.

### Advanced Manufacturers (List)

![Advanced Manufacturers (List)](images/admin-6.png)

### Advanced Manufacturers (Standard)

![Advanced Manufacturers (Standard)](images/admin-5.png)
