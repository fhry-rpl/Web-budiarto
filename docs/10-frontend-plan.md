# Frontend Implementation Plan — Website Resmi RENPRO UPBU Budiarto

## Stack

| Komponen | Teknologi |
|---|---|
| Templating | Blade |
| CSS | Tailwind CSS v4 |
| Bahasa | TypeScript |
| Interaktivitas | Alpine.js |
| Ikon | Lucide Icons |
| Chart | ApexCharts |
| Animasi | Motion One |
| Build | Vite 8 |

## File Structure

```
resources/
├── css/app.css              # Tailwind v4 + custom utilities
├── js/
│   ├── app.ts               # Entry: Alpine, Lucide, Motion, ApexCharts init
│   ├── types/               # TypeScript type definitions
│   ├── components/          # Alpine.js data components
│   │   ├── navigation.ts
│   │   ├── lightbox.ts
│   │   ├── form-handler.ts
│   │   ├── count-up.ts
│   │   ├── chart-component.ts
│   │   └── sidebar.ts
│   └── utils/
│       ├── animations.ts    # Motion One helpers
│       └── lucide.ts        # Lucide re-init helper
└── views/
    ├── layouts/
    │   ├── app.blade.php    # Layout publik
    │   └── admin.blade.php  # Layout admin
    ├── components/          # Blade components
    ├── home.blade.php       # Landing page
    ├── pages/               # Profil, visi-misi, struktur
    ├── posts/               # Berita index + detail
    ├── documents/           # Dokumen index + detail
    ├── services/            # Layanan index + detail
    ├── galleries/           # Galeri index + detail
    ├── contact.blade.php
    ├── search.blade.php
    └── admin/
        ├── dashboard.blade.php
        ├── posts/
        ├── documents/
        └── ...
```

## Alpine.js Components

| Component | File | Function |
|---|---|---|
| `navigation` | `navigation.ts` | Mobile nav toggle, dropdown, active link |
| `lightbox` | `lightbox.ts` | Gallery lightbox with keyboard nav |
| `formHandler` | `form-handler.ts` | Contact form AJAX + validation |
| `countUp` | `count-up.ts` | Animated stat counter |
| `chartComponent` | `chart-component.ts` | ApexCharts init/destroy |

## Motion One Animations

| Element | Animation | Duration |
|---|---|---|
| Hero title | fadeIn + slideUp | 0.7s |
| Cards stagger | opacity + y: 30 | 0.5s |
| Stat counter | count-up | 1.8s |
| Page content | fadeIn + y: 15 | 0.5s |
| Modal | scale + opacity | 0.25s |

## Lucide Icons

Icons di-render via `<i data-lucide="icon-name" class="w-5 h-5"></i>` dan diinisialisasi ulang setiap kali Alpine.js mengubah DOM.

## Accessibility

- Skip to content link
- Focus visible (keyboard only)
- ARIA labels on icon buttons
- Alt text on all images
- Semantic HTML (nav, main, article, aside, footer)
- Color contrast WCAG AA
- prefers-reduced-motion
