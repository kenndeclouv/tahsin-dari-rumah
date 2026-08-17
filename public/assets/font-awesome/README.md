# Font Awesome Pro 7.2.0 — Self-Hosted Assets

> Static CSS + webfont assets for Font Awesome Pro 7.2.0, self-hosted for local development reference.

---

## ⚠️ IMPORTANT DISCLAIMER ⚠️

> [!CAUTION]
> **This repository is for EDUCATIONAL PURPOSES ONLY.**
>
> Font Awesome Pro is a **commercially licensed product** owned by [Fonticons, Inc.](https://fontawesome.com). The assets in this repository (CSS files and webfonts) are protected by the [Font Awesome Pro Commercial License](https://fontawesome.com/license).
>
> - ❌ **Do NOT use this in any production application without a valid Font Awesome Pro license.**
> - ❌ **Do NOT redistribute these assets commercially.**
> - ❌ **Do NOT use this to bypass purchasing a Font Awesome Pro subscription.**
> - ✅ This repository exists solely to document and study the structure of Font Awesome Pro's self-hosted asset distribution for educational/learning purposes.
>
> **If you intend to use Font Awesome Pro in a real project, please purchase a valid license at [fontawesome.com/plans](https://fontawesome.com/plans).**
>
> The author of this repository takes no responsibility for any misuse of these assets. Use at your own risk and in compliance with Fonticons, Inc.'s terms of service.

---

## 📦 What's Included

```
v7.2.0/
├── css/
│   ├── all.css                     # Master import (includes all styles)
│   ├── fontawesome.css             # Core FA styles
│   ├── brands.css                  # Brand icons (fab)
│   ├── solid.css                   # Solid style (fas)
│   ├── regular.css                 # Regular style (far)
│   ├── light.css                   # Light style (fal)
│   ├── thin.css                    # Thin style (fat)
│   ├── duotone.css                 # Duotone style (fad)
│   ├── duotone-light.css           # Duotone Light
│   ├── duotone-regular.css         # Duotone Regular
│   ├── duotone-thin.css            # Duotone Thin
│   ├── sharp-solid.css             # Sharp Solid
│   ├── sharp-regular.css           # Sharp Regular
│   ├── sharp-light.css             # Sharp Light
│   ├── sharp-thin.css              # Sharp Thin
│   ├── sharp-duotone-solid.css     # Sharp Duotone Solid
│   ├── sharp-duotone-regular.css   # Sharp Duotone Regular
│   ├── sharp-duotone-light.css     # Sharp Duotone Light
│   ├── sharp-duotone-thin.css      # Sharp Duotone Thin
│   └── ...                         # Additional experimental styles
└── webfonts/
    ├── fa-brands-400.woff2
    ├── fa-solid-900.woff2
    ├── fa-regular-400.woff2
    ├── fa-light-300.woff2
    ├── fa-thin-100.woff2
    ├── fa-duotone-900.woff2
    └── ...                         # All other font variants
```

---

## 🚀 How to Use

### Option 1 — CDN via jsDelivr (recommended)

Include the master stylesheet from the jsDelivr CDN:

```html
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/kenndeclouv/font-awesome@main/v7.2.0/css/all.css" />
```

Then use icons with the appropriate class:

```html
<!-- Solid -->
<i class="fa-solid fa-house"></i>

<!-- Regular -->
<i class="fa-regular fa-heart"></i>

<!-- Light -->
<i class="fa-light fa-star"></i>

<!-- Thin -->
<i class="fa-thin fa-bell"></i>

<!-- Brands -->
<i class="fa-brands fa-github"></i>

<!-- Duotone -->
<i class="fa-duotone fa-shield-halved"></i>

<!-- Sharp Solid -->
<i class="fa-sharp fa-solid fa-circle-check"></i>
```

---

### Option 2 — CDN, cherry-pick only what you need

For a lighter footprint, import only the styles you use:

```html
<!-- Core (required) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/kenndeclouv/font-awesome@main/v7.2.0/css/fontawesome.css" />

<!-- Pick your styles -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/kenndeclouv/font-awesome@main/v7.2.0/css/solid.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/kenndeclouv/font-awesome@main/v7.2.0/css/brands.css" />
```

---

### Available Icon Styles & Their Classes

| Style              | CSS File                    | Class Prefix         |
|--------------------|-----------------------------|----------------------|
| Solid              | `solid.css`                 | `fa-solid` / `fas`   |
| Regular            | `regular.css`               | `fa-regular` / `far` |
| Light              | `light.css`                 | `fa-light` / `fal`   |
| Thin               | `thin.css`                  | `fa-thin` / `fat`    |
| Duotone            | `duotone.css`               | `fa-duotone` / `fad` |
| Sharp Solid        | `sharp-solid.css`           | `fa-sharp fa-solid`  |
| Sharp Regular      | `sharp-regular.css`         | `fa-sharp fa-regular`|
| Sharp Light        | `sharp-light.css`           | `fa-sharp fa-light`  |
| Sharp Thin         | `sharp-thin.css`            | `fa-sharp fa-thin`   |
| Brands             | `brands.css`                | `fa-brands` / `fab`  |

---

### Sizing

```html
<!-- Named sizes -->
<i class="fa-solid fa-house fa-xs"></i>   <!-- Extra small -->
<i class="fa-solid fa-house fa-sm"></i>   <!-- Small -->
<i class="fa-solid fa-house fa-lg"></i>   <!-- Large -->
<i class="fa-solid fa-house fa-xl"></i>   <!-- Extra large -->
<i class="fa-solid fa-house fa-2xl"></i>  <!-- 2x Extra large -->

<!-- Numeric sizes (1x–10x) -->
<i class="fa-solid fa-house fa-2x"></i>
<i class="fa-solid fa-house fa-5x"></i>
```

### Fixed Width

```html
<i class="fa-solid fa-house fa-fw"></i>
```

### Animations

```html
<i class="fa-solid fa-spinner fa-spin"></i>
<i class="fa-solid fa-heart fa-beat"></i>
<i class="fa-solid fa-bell fa-shake"></i>
<i class="fa-solid fa-star fa-flip"></i>
<i class="fa-solid fa-ghost fa-bounce"></i>
<i class="fa-solid fa-sun fa-fade"></i>
```

### Duotone Color Customization

```html
<i class="fa-duotone fa-shield-halved" style="
  --fa-primary-color: #4a90e2;
  --fa-secondary-color: #2c5282;
  --fa-primary-opacity: 1;
  --fa-secondary-opacity: 0.4;
"></i>
```

---

## 🔗 Official Resources

- [Font Awesome Documentation](https://docs.fontawesome.com)
- [Icon Search](https://fontawesome.com/icons)
- [Licensing Info](https://fontawesome.com/license)
- [Purchase a Pro Plan](https://fontawesome.com/plans)

---

## 📄 License

The Font Awesome Pro assets in this repository are copyright **© 2026 Fonticons, Inc.** and are subject to the [Font Awesome Pro Commercial License](https://fontawesome.com/license). This repository itself is shared for **educational reference only** — see the disclaimer at the top of this file.
