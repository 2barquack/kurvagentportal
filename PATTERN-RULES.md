# Pattern Development Rules – WordPress Gutenberg Block Theme

## Theme Context
- **Block-based theme (FSE)** - Full Site Editing architecture
- **Templates** live in `/templates`
- **Template parts** live in `/parts`
- **Custom blocks** compiled via `@wordpress/scripts` (Vite build system)
- **Styles** generated via SCSS → `assets/css`

## Output Requirements
- Always generate **VALID WordPress Gutenberg block markup**
- Use block comments (`<!-- wp:block -->`) exactly as WordPress expects
- Never output JSX unless explicitly requested
- Assume **Full Site Editing (FSE)** block theme architecture
- Do **NOT** use the `wp:html` block unless explicitly asked. Always prefer valid core Gutenberg blocks:
  - `wp:group` - Container blocks
  - `wp:columns` / `wp:column` - Column layouts
  - `wp:heading` - Headings
  - `wp:paragraph` - Text content
  - `wp:image` - Images
  - `wp:list` - Lists
  - Custom blocks: `kurv-knowledgebase-2026/card-manager`, `kurv-knowledgebase-2026/card-item`

## Pattern Category
- **All custom patterns** must use the category: `kb-patterns`
- Pattern header format:
  ```php
  /**
   * Title: Pattern Name
   * Slug: kurv-knowledgebase-2026/pattern-slug
   * Categories: kb-patterns
   * Description: Pattern description
   */
  ```

## Frontend & Backend Validation
Before finalizing any pattern output:

### Frontend Rendering
- ✅ Reason about layout issues (grid, flexbox, spacing)
- ✅ Reason about responsiveness (mobile, tablet, desktop)
- ✅ Verify spacing doesn't collapse inside constrained layouts
- ✅ Check for Safari mobile layout bugs
- ✅ Watch for iOS zoom-on-input issues

### Backend/Editor Issues
- ✅ Verify block registration is correct
- ✅ Check all block attributes are defined in `block.json`
- ✅ Ensure custom blocks are registered in `functions.php`
- ✅ Verify pattern category is registered
- ✅ Check for missing InnerBlocks configuration

### Error Checking
- ✅ Explicitly check JavaScript console for errors
- ✅ Explicitly check for PHP warnings/notices
- ✅ Verify no missing file errors
- ✅ Check for block registration warnings

## Styling Rules
- **Do NOT use Tailwind CSS** unless explicitly instructed
- **Prefer `theme.json` variables** and CSS custom properties
- **Check `styleguide.scss`** for variables (if exists)
- **Assume SCSS is compiled externally** (Vite in this theme)
- **Prefer CSS Grid** for layouts wherever possible
- **Use Flexbox** only when Grid is not suitable
- **Always write styles in SCSS syntax**
- **Verify file output** is explicitly requested before generating a file
- If an MCP connection is available and a Figma link is provided, read and follow Figma layout properties accurately

## WordPress Conventions
- Assume **WordPress 6.x+**
- Use **semantic HTML**
- Ensure **accessibility** (aria-labels where relevant)
- Do **NOT** use deprecated block APIs
- Use **Block API v3** (`apiVersion: 3` in `block.json`)

## Known Issues to Watch
- **Safari mobile layout bugs** - Test thoroughly on Safari iOS
- **iOS zoom-on-input issues** - Ensure proper viewport meta tags
- **Block spacing collapsing** inside constrained layouts - Use proper spacing utilities
- **InnerBlocks rendering** - Ensure proper save function for static blocks

## Block Structure Rules

### Custom Blocks Available
1. **Card Manager** (`kurv-knowledgebase-2026/card-manager`)
   - Attributes: `heading`, `headingLevel`, `columns`, `introParagraph`
   - Supports InnerBlocks with `card-item` children
   - Full Gutenberg editor options available

2. **Card Item** (`kurv-knowledgebase-2026/card-item`)
   - Attributes: `icon`, `title`, `titleLevel`
   - Parent: `kurv-knowledgebase-2026/card-manager`
   - Supports InnerBlocks for content (paragraphs, headings, lists)
   - Full Gutenberg editor options available

### Pattern Structure Template
```php
<?php
/**
 * Title: Pattern Name
 * Slug: kurv-knowledgebase-2026/pattern-slug
 * Categories: kb-patterns
 * Description: Pattern description
 *
 * @package Kurv_Knowledgebase_2026
 * @since 1.0.0
 */

?>

<!-- wp:group {"style":{"spacing":{"padding":{"top":"4rem","bottom":"4rem","left":"2rem","right":"2rem"}},"color":{"background":"#f0f7f0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="background-color:#f0f7f0;padding-top:4rem;padding-right:2rem;padding-bottom:4rem;padding-left:2rem">
	<!-- wp:kurv-knowledgebase-2026/card-manager {"heading":"Heading Text","headingLevel":2,"columns":4,"introParagraph":"Optional intro paragraph text"} -->
	<!-- Pattern content here -->
	<!-- /wp:kurv-knowledgebase-2026/card-manager -->
</div>
<!-- /wp:group -->
```

## Gutenberg Editor Options
All blocks and patterns must ensure **ALL** Gutenberg editor options are available:

### Color
- Background color
- Text color
- Gradients
- Link color

### Spacing
- Margin controls
- Padding controls

### Typography
- Font size
- Line height
- Font family
- Font weight
- Font style
- Text transform
- Text decoration
- Letter spacing

### Border
- Border color
- Border radius
- Border style
- Border width

### Dimensions
- Minimum height

### Alignment
- Wide alignment (for container blocks)
- Full width alignment (for container blocks)

### Other
- Anchor links
- Block-specific controls (columns, heading levels, etc.)

## Responsive Design Rules
- **Desktop (>1024px)**: Full column layout
- **Tablet (768px-1024px)**: 2 columns for 3/4-column layouts
- **Mobile (<768px)**: 1 column layout
- Use CSS Grid with responsive breakpoints
- Test on Safari iOS for mobile layout bugs
- Ensure proper spacing on all screen sizes

## QA Testing Requirements
- **Use Playwright MCP server** to test code backend and frontend after integration
- Test block registration in WordPress admin
- Test pattern insertion in block editor
- Verify responsive behavior on actual devices
- Check JavaScript console for errors
- Check PHP error logs
- Verify CSS is loading correctly
- Test accessibility features

## File Structure
```
kurv-knowledgebase-2026/
├── blocks/                    # Custom blocks
│   ├── card-manager/
│   │   ├── block.json        # Block configuration
│   │   ├── index.js          # Compiled editor script
│   │   ├── index.css         # Compiled editor styles
│   │   ├── style-index.css   # Compiled frontend styles
│   │   ├── index.php         # PHP render callback (if dynamic)
│   │   └── src/
│   │       ├── index.js      # Source editor script
│   │       └── scss/
│   │           ├── style.scss    # Frontend styles
│   │           └── editor.scss   # Editor styles
│   └── card-item/
│       └── [same structure]
├── patterns/                  # Block patterns
│   ├── core-platform-capabilities.php
│   ├── application-pipeline-management.php
│   ├── portfolio-navigation-monitoring.php
│   └── residual-projection-revenue-tracking.php
├── templates/                 # FSE templates
├── parts/                     # Template parts
├── assets/
│   ├── css/                   # Compiled CSS
│   └── js/                    # Compiled JavaScript
└── src/                       # Source files
    ├── css/
    └── js/
```

## Build System
- **Vite** for main theme assets
- **Custom build script** (`blocks/build-blocks.js`) for individual blocks
- **PostCSS** with plugins: import, nested, autoprefixer, cssnano
- **SCSS** preprocessor via Vite

## Pattern Development Checklist
Before finalizing any pattern:

- [ ] Uses valid WordPress block markup
- [ ] Uses core Gutenberg blocks (no `wp:html` unless necessary)
- [ ] Category is `kb-patterns`
- [ ] All custom blocks are properly registered
- [ ] All Gutenberg editor options are available
- [ ] Responsive design is implemented
- [ ] SCSS styles are properly structured
- [ ] No JavaScript console errors
- [ ] No PHP warnings/notices
- [ ] Tested with Playwright (backend and frontend)
- [ ] Accessibility considerations met
- [ ] Safari mobile layout tested
- [ ] Block spacing doesn't collapse in constrained layouts

## Common Pattern Patterns

### 4-Column Card Layout with Intro
```php
<!-- wp:group {"style":{"spacing":{"padding":{"top":"4rem","bottom":"4rem","left":"2rem","right":"2rem"}},"color":{"background":"#f0f7f0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="background-color:#f0f7f0;padding-top:4rem;padding-right:2rem;padding-bottom:4rem;padding-left:2rem">
	<!-- wp:kurv-knowledgebase-2026/card-manager {"heading":"Heading","headingLevel":2,"columns":4,"introParagraph":"Intro text"} -->
	<!-- Card items here -->
	<!-- /wp:kurv-knowledgebase-2026/card-manager -->
</div>
<!-- /wp:group -->
```

### 3-Column Card Layout with Icons
```php
<!-- wp:kurv-knowledgebase-2026/card-manager {"heading":"Heading","headingLevel":2,"columns":3} -->
<!-- Card items with icons here -->
<!-- /wp:kurv-knowledgebase-2026/card-manager -->
```

## Notes
- Patterns are static HTML representations of block markup
- Custom blocks use static save functions (JSX) - no PHP render callbacks needed
- InnerBlocks are handled via `InnerBlocks.Content` in save functions
- All patterns must be fully editable in the Gutenberg editor
- Always test patterns after creation with Playwright
