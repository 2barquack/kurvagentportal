# WordPress Block & Pattern Testing Checklist

## Pre-Testing Validation ✅

### Code Structure Validation
- [x] All patterns use valid WordPress block markup (`<!-- wp:block -->`)
- [x] All patterns use core Gutenberg blocks (wp:group, wp:heading, wp:paragraph)
- [x] Block registration in `functions.php` is correct
- [x] Pattern category "KB-Patterns" is registered
- [x] All 4 custom patterns use "kb-patterns" category
- [x] Block JSON files are valid (block.json schema)
- [x] No deprecated block APIs used
- [x] SCSS files exist and are properly structured

### Block Registration
- [x] Card Manager block registered: `kurv-knowledgebase-2026/card-manager`
- [x] Card Item block registered: `kurv-knowledgebase-2026/card-item`
- [x] Blocks use WordPress 6.x+ block API v3
- [x] Static blocks (save function returns JSX with InnerBlocks.Content)

## Backend Testing (WordPress Admin)

### Block Availability
1. Navigate to: `wp-admin` → Pages → Add New
2. Click "+" to open block inserter
3. Search for "Card Manager"
   - [ ] Block appears in "Design" category
   - [ ] Block icon displays correctly
   - [ ] Block description is visible
4. Search for "Card Item"
   - [ ] Block appears (should only be available inside Card Manager)
   - [ ] Parent relationship works correctly

### Pattern Availability
1. In block editor, click "+" → Go to "Patterns" tab
2. Look for "KB-Patterns" category
   - [ ] Category appears in pattern categories
   - [ ] All 4 patterns are visible:
     - [ ] Core Platform Capabilities
     - [ ] Application & Pipeline Management
     - [ ] Portfolio Navigation & Monitoring
     - [ ] Residual Projection & Revenue Tracking

### Block Editor Functionality
1. Insert "Card Manager" block
   - [ ] Block renders in editor
   - [ ] Inspector Controls panel appears
   - [ ] Can edit heading text
   - [ ] Can change heading level (H1-H6)
   - [ ] Can adjust number of columns (1-4)
   - [ ] Can add intro paragraph
   - [ ] Can add Card Item blocks inside
   - [ ] Can remove Card Item blocks
   - [ ] All Gutenberg editor options available:
     - [ ] Color controls (background, text, gradients)
     - [ ] Spacing controls (margin, padding)
     - [ ] Typography controls
     - [ ] Border controls
     - [ ] Dimensions controls
     - [ ] Alignment options

2. Insert "Card Item" block (inside Card Manager)
   - [ ] Block renders in editor
   - [ ] Inspector Controls panel appears
   - [ ] Can edit icon (emoji/character)
   - [ ] Can edit title text
   - [ ] Can change title level (H1-H6)
   - [ ] Can add content via InnerBlocks (paragraphs, headings, lists)
   - [ ] All Gutenberg editor options available

### Pattern Insertion
1. Insert "Core Platform Capabilities" pattern
   - [ ] Pattern inserts correctly
   - [ ] All blocks are editable
   - [ ] Icons display correctly (⚡, 📊, 🏆)
   - [ ] 3-column layout visible in editor

2. Insert "Application & Pipeline Management" pattern
   - [ ] Pattern inserts correctly
   - [ ] Intro paragraph is visible and editable
   - [ ] 4-column layout visible
   - [ ] No icons on cards (as intended)

3. Insert "Portfolio Navigation & Monitoring" pattern
   - [ ] Pattern inserts correctly
   - [ ] Intro paragraph is visible and editable
   - [ ] 4-column layout visible
   - [ ] All 4 cards render correctly

4. Insert "Residual Projection & Revenue Tracking" pattern
   - [ ] Pattern inserts correctly
   - [ ] Intro paragraph is visible and editable
   - [ ] 4-column layout visible
   - [ ] All 4 cards render correctly

### JavaScript Console Check
1. Open browser DevTools (F12)
2. Go to Console tab
3. Check for errors:
   - [ ] No JavaScript errors
   - [ ] No block registration warnings
   - [ ] No missing dependency errors
   - [ ] No React/WordPress component errors

### PHP Error Check
1. Check WordPress debug log (if WP_DEBUG is enabled)
2. Check browser console for PHP warnings
3. Verify:
   - [ ] No PHP warnings or notices
   - [ ] No block registration errors
   - [ ] No missing file errors

## Frontend Testing (Public Site)

### Pattern Rendering
1. Create a test page with all 4 patterns
2. View page on frontend
3. Check each pattern:
   - [ ] Core Platform Capabilities:
     - [ ] Heading displays with decorative lines
     - [ ] 3 cards in grid layout
     - [ ] Icons display correctly
     - [ ] Responsive: 2 columns on tablet, 1 on mobile
   
   - [ ] Application & Pipeline Management:
     - [ ] Light green background (#e3f5e3)
     - [ ] Heading with lines
     - [ ] Intro paragraph displays
     - [ ] 4 cards in grid
     - [ ] No icons on cards
     - [ ] Responsive layout works
   
   - [ ] Portfolio Navigation & Monitoring:
     - [ ] Light green background (#f0f7f0)
     - [ ] Heading with lines
     - [ ] Intro paragraph displays
     - [ ] 4 cards render correctly
     - [ ] Responsive layout works
   
   - [ ] Residual Projection & Revenue Tracking:
     - [ ] Light green background (#f0f7f0)
     - [ ] Heading with lines
     - [ ] Intro paragraph displays
     - [ ] 4 cards render correctly
     - [ ] Responsive layout works

### Responsive Design
1. Test on different screen sizes:
   - [ ] Desktop (>1024px): Full column layout
   - [ ] Tablet (768px-1024px): 2 columns for 3/4-column layouts
   - [ ] Mobile (<768px): 1 column layout
   - [ ] Cards stack vertically on mobile
   - [ ] Spacing adjusts appropriately
   - [ ] Text remains readable

### CSS/Styling
1. Check compiled CSS files exist:
   - [ ] `blocks/card-manager/style-index.css`
   - [ ] `blocks/card-manager/index.css` (editor)
   - [ ] `blocks/card-item/style-index.css`
   - [ ] `blocks/card-item/index.css` (editor)
2. Verify styles apply:
   - [ ] Card hover effects work
   - [ ] Grid layout displays correctly
   - [ ] Heading lines display
   - [ ] Colors match design
   - [ ] Typography is correct

### Accessibility
- [ ] Semantic HTML structure
- [ ] Proper heading hierarchy
- [ ] Color contrast meets WCAG standards
- [ ] Interactive elements are keyboard accessible

## Build System Testing

### Vite Build
1. Navigate to theme directory
2. Run: `npm install` (if not done)
3. Run: `npm run build`
   - [ ] Build completes without errors
   - [ ] CSS files are generated
   - [ ] JavaScript files are generated
   - [ ] Block assets are compiled

### Block Build
1. Run: `npm run build:blocks`
   - [ ] All blocks compile successfully
   - [ ] No build errors
   - [ ] Compiled files are in correct locations

## Issues Found

### Critical Issues
- None found in code review

### Warnings
- None found in code review

### Recommendations
- Test with Playwright when WordPress site is accessible
- Verify block registration in WordPress admin
- Test pattern insertion in block editor
- Verify responsive behavior on actual devices

## Next Steps

1. Start WordPress site (Local by Flywheel)
2. Navigate to WordPress admin
3. Follow testing checklist above
4. Document any issues found
5. Fix issues and re-test
