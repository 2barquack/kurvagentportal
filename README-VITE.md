# Vite Development Setup

This theme uses [Vite](https://vitejs.dev/) for fast development and optimized production builds.

## Quick Start

1. **Install dependencies:**
   ```bash
   npm install
   ```

2. **Start development server:**
   ```bash
   npm run dev
   ```
   This starts Vite's dev server with hot module replacement (HMR).

3. **Build for production:**
   ```bash
   npm run build
   ```
   This creates optimized, minified files in the theme root.

## Available Scripts

- `npm run dev` - Start development server with HMR
- `npm run build` - Build for production (minified)
- `npm run watch` - Watch mode (rebuilds on file changes)
- `npm run preview` - Preview production build locally

## File Structure

```
kurv-knowledgebase-2026/
├── src/                    # Source files (edit these)
│   ├── css/
│   │   ├── style.css       # Main stylesheet source
│   │   └── editor-style.css # Editor stylesheet source
│   ├── js/
│   │   └── main.js         # Main JavaScript source
│   └── assets/             # Source assets
├── assets/                 # Compiled assets
│   ├── css/
│   └── js/
├── style.css               # Compiled main stylesheet
├── style.min.css           # Compiled minified stylesheet (production)
└── vite.config.js          # Vite configuration
```

## Development Workflow

1. Edit files in the `src/` directory
2. Run `npm run dev` for development with HMR
3. Changes are automatically reflected in the browser
4. Run `npm run build` before committing changes

## Production Build

The production build generates:
- `style.css` - Unminified stylesheet (for SCRIPT_DEBUG mode)
- `style.min.css` - Minified stylesheet (default)
- `assets/css/editor-style.css` - Editor stylesheet
- `assets/js/main.js` - Minified JavaScript

## Configuration

Edit `vite.config.js` to customize:
- Build output paths
- Development server port
- PostCSS plugins
- Asset optimization

## Notes

- Always edit source files in `src/`, not the compiled output
- The theme's `functions.php` automatically enqueues the built files
- Source maps are generated in development mode
- CSS is processed with PostCSS (autoprefixer, nested, etc.)
