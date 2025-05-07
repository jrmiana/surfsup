# Surf's Up 

Wordpress site


## 🔧 Requirements

- WordPress 6.8
- PHP 8.2+
- Node.js & npm 

---

### 1. Setup

go to `/wp-content/themes/custom-theme`

```
npm install
```

go to `/wp-content/plugins/myblocks`

```
npm install
```

### 2. REST API Endpoint (`/wp-json/wp/v2/events/next`)

Returns the 5 closest upcoming events.

### 2. Custom Gutenberg Blocks

#### a. Hero with CTA
- Image upload (via sidebar controls)
- Editable heading and text
- Call-to-action button (text + URL)
#### b. Event Grid
- Queries the `event` CPT and displays them in a responsive grid
- Accepts parameters:
  - Limit (number of events)
  - Category filter (by slug)
  - Sort order (ASC/DESC)