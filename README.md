# Kurv Knowledgebase 2026 Theme

A custom WordPress theme for the Kurv Agent Portal used for information on how Kurv Agents work on their sales training.

## Features

### Custom Gutenberg Blocks

#### Card Manager Block (`kurv-knowledgebase-2026/card-manager`)
A flexible card container block that manages multiple card items in a responsive grid layout.

**Features:**
- Configurable heading with decorative lines
- Optional introductory paragraph
- Responsive column layout (1-4 columns)
- Full Gutenberg editor support (color, spacing, typography, border, dimensions, alignment)
- Mobile-optimized with breakpoints at 1024px, 768px, and 480px

**Attributes:**
- `heading` (string) - Main heading text
- `headingLevel` (number) - Heading level (1-6)
- `columns` (number) - Number of columns (1-4)
- `introParagraph` (string) - Optional introductory paragraph

**SCSS File:** `blocks/card-manager/src/scss/style.scss`

#### Card Item Block (`kurv-knowledgebase-2026/card-item`)
Individual card block that displays an icon, title, and content using InnerBlocks.

**Features:**
- Optional icon (emoji or character)
- Configurable title with heading level control
- InnerBlocks for flexible content (paragraphs, headings, lists)
- Hover effects with smooth transitions
- Full Gutenberg editor support
- Mobile-optimized spacing and typography

**Attributes:**
- `icon` (string) - Icon/emoji (optional, hidden when empty)
- `title` (string) - Card title
- `titleLevel` (number) - Title heading level (1-6)

**SCSS File:** `blocks/card-item/src/scss/style.scss`

### Block Patterns

#### Core Platform Capabilities
**Slug:** `kurv-knowledgebase-2026/core-platform-capabilities`

A three-column card layout showcasing core platform capabilities with icons, titles, and descriptions.

**Features:**
- 3-column responsive grid
- Cards with icons (⚡, 📊, 🏆)
- Light green background (#f0f7f0)
- Mobile-responsive: 2 columns on tablets, 1 column on mobile

**Pattern File:** `patterns/core-platform-capabilities.php`

#### Application & Pipeline Management
**Slug:** `kurv-knowledgebase-2026/application-pipeline-management`

A four-column card layout showcasing application and pipeline management features with an introductory paragraph.

**Features:**
- 4-column responsive grid
- Introductory paragraph between heading and cards
- Cards without icons (clean, text-focused design)
- Light green background (#e3f5e3) via core/group block
- Mobile-responsive: 2 columns on tablets, 1 column on mobile

**Pattern File:** `patterns/application-pipeline-management.php`

## Mobile Optimization

Both patterns and blocks are fully mobile-optimized with:

- **Responsive Grid Layout:**
  - 4 columns → 2 columns (tablets ≤1024px) → 1 column (mobile ≤768px)
  - 3 columns → 2 columns (tablets ≤1024px) → 1 column (mobile ≤768px)
  - 2 columns → 1 column (mobile ≤768px)

- **Mobile-Specific Adjustments:**
  - Reduced padding on small screens
  - Smaller icon sizes on mobile
  - Heading lines hidden on very small screens (≤480px)
  - Optimized font sizes using `clamp()` for fluid typography
  - Improved spacing and gaps for touch interfaces

- **Breakpoints:**
  - Desktop: > 1024px
  - Tablet: 768px - 1024px
  - Mobile: 480px - 768px
  - Small Mobile: ≤ 480px

## SCSS Files

### Block Styles
- **Card Manager:** `blocks/card-manager/src/scss/style.scss`
  - Main stylesheet for card manager block
  - Includes responsive grid, heading styles, intro paragraph styles
  - Compiled to: `blocks/card-manager/style-index.css`

- **Card Item:** `blocks/card-item/src/scss/style.scss`
  - Main stylesheet for card item block
  - Includes card styling, icon, title, and content styles
  - Compiled to: `blocks/card-item/style-index.css`

### Editor Styles
- **Card Manager Editor:** `blocks/card-manager/src/scss/editor.scss`
- **Card Item Editor:** `blocks/card-item/src/scss/editor.scss`

## Build System

### Vite Configuration
- **Main Config:** `vite.config.js`
- **PostCSS Config:** `postcss.config.js`
- **Build Scripts:** See `package.json`

### Build Commands
```bash
npm install          # Install dependencies
npm run dev          # Development server with HMR
npm run build        # Production build (includes CSS minification and block compilation)
npm run build:blocks # Build individual Gutenberg blocks
npm run watch        # Watch mode for development
```

### Build Process
1. Vite compiles main theme assets (`src/css/style.css`, `src/js/main.js`)
2. PostCSS processes CSS with plugins (import, nested, autoprefixer, cssnano)
3. Custom script (`scripts/minify-css.js`) creates `style.min.css`
4. Custom script (`blocks/build-blocks.js`) compiles individual blocks

## Gutenberg Editor Support

All blocks support the full range of Gutenberg editor options:

- **Color:** Background, text, gradients, links
- **Spacing:** Margin and padding controls
- **Typography:** Font size, line height, font family, weight, style, text transform, decoration, letter spacing
- **Border:** Color, radius, style, width
- **Dimensions:** Minimum height
- **Alignment:** Wide and full width support
- **Anchor:** Custom anchor links

## Recent Changes

### Version 1.0.0

#### Added
- **Card Manager Block:** Custom block with heading, intro paragraph, and responsive grid
- **Card Item Block:** Custom block with icon, title, and InnerBlocks content
- **Core Platform Capabilities Pattern:** 3-column card layout with icons
- **Application & Pipeline Management Pattern:** 4-column card layout with intro paragraph
- **Intro Paragraph Support:** Added optional intro paragraph to Card Manager block
- **Mobile Optimization:** Enhanced responsive breakpoints and mobile-specific styling
- **Vite Build System:** Replaced PostCSS CLI with Vite for better development experience

#### Updated
- Repository URLs updated from `kurvknowledgebase` to `kurvagentportal`
- Build script path resolution fixed
- Card item icon container now hides when empty
- Card Manager background becomes transparent when inside a group block

#### Technical Details
- All blocks use `block.json` for configuration
- SCSS source files compiled to CSS during build
- Full WordPress block API v3 support
- ES modules for JavaScript
- PostCSS with nested rules and autoprefixer

## Development

See `contributing.txt` and `README-VITE.md` for development setup instructions.

## Repository

- **GitHub:** https://github.com/2barquack/kurvagentportal
- **Branches:** `main`, `agentwilliam`
