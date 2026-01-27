# Pattern Troubleshooting Guide

## Issue: Patterns Not Showing in WordPress Backend

### Solution Applied
Added explicit pattern registration in `functions.php` to ensure patterns are registered even if auto-discovery fails.

### What Was Fixed
1. ✅ Added `kurv_knowledgebase_2026_register_patterns()` function
2. ✅ Function explicitly registers all 4 custom patterns
3. ✅ Patterns are registered with priority 20 (after category registration)
4. ✅ Pattern category "KB-Patterns" is registered
5. ✅ All patterns use "kb-patterns" category

### How to Verify Patterns Are Working

#### Step 1: Clear WordPress Cache
1. If using a caching plugin, clear all caches
2. Hard refresh browser (Ctrl+Shift+R or Cmd+Shift+R)
3. Clear browser cache if needed

#### Step 2: Check Pattern Registration
1. Go to WordPress Admin → Tools → Site Health → Info
2. Check if theme is active
3. Verify `functions.php` is loading (check for PHP errors)

#### Step 3: Test Pattern Visibility
1. Go to Pages → Add New (or edit existing page)
2. Click "+" button to open block inserter
3. Click "Patterns" tab
4. Look for "KB-Patterns" category in the category filter
5. All 4 patterns should appear:
   - Core Platform Capabilities
   - Application & Pipeline Management
   - Portfolio Navigation & Monitoring
   - Residual Projection & Revenue Tracking

#### Step 4: Check Browser Console
1. Open DevTools (F12)
2. Go to Console tab
3. Look for any JavaScript errors
4. Check for pattern registration errors

#### Step 5: Check PHP Error Log
1. Enable `WP_DEBUG` in `wp-config.php` (if not already)
2. Check `wp-content/debug.log` for PHP errors
3. Look for pattern registration errors

### Debug Code (Add to functions.php temporarily)
If patterns still don't appear, add this debug code:

```php
// Debug: Check if patterns are registered
add_action( 'admin_footer', function() {
	if ( current_user_can( 'edit_posts' ) ) {
		$registry = WP_Block_Patterns_Registry::get_instance();
		$all_patterns = $registry->get_all_registered();
		
		echo '<script>console.log("Registered patterns:", ' . json_encode( array_keys( $all_patterns ) ) . ');</script>';
		
		// Check our specific patterns
		$our_patterns = array(
			'kurv-knowledgebase-2026/core-platform-capabilities',
			'kurv-knowledgebase-2026/application-pipeline-management',
			'kurv-knowledgebase-2026/portfolio-navigation-monitoring',
			'kurv-knowledgebase-2026/residual-projection-revenue-tracking',
		);
		
		foreach ( $our_patterns as $pattern_slug ) {
			$is_registered = $registry->is_registered( $pattern_slug );
			echo '<script>console.log("Pattern ' . $pattern_slug . ' registered: ' . ( $is_registered ? 'YES' : 'NO' ) . '");</script>';
		}
	}
} );
```

### Common Issues and Fixes

#### Issue 1: Patterns Not Appearing
**Possible Causes:**
- WordPress cache needs clearing
- Theme not active
- PHP errors preventing registration
- Pattern files not readable

**Fixes:**
- Clear all caches
- Verify theme is active
- Check PHP error log
- Verify file permissions on pattern files

#### Issue 2: Category Not Appearing
**Possible Causes:**
- Category registration failed
- Category slug mismatch

**Fixes:**
- Verify category is registered in `functions.php`
- Check category slug matches pattern headers (`kb-patterns`)

#### Issue 3: Patterns Appear But Can't Insert
**Possible Causes:**
- Block registration issue
- Invalid block markup in patterns
- Missing block dependencies

**Fixes:**
- Verify blocks are registered
- Check pattern markup is valid
- Verify block files exist and are compiled

### Files to Check
1. `functions.php` - Pattern registration function
2. `patterns/*.php` - Pattern files with correct headers
3. `blocks/card-manager/block.json` - Block registration
4. `blocks/card-item/block.json` - Block registration

### Pattern Registration Function Location
- File: `functions.php`
- Function: `kurv_knowledgebase_2026_register_patterns()`
- Hook: `init` with priority 20
- Line: ~163-227

### Next Steps
1. Clear WordPress cache
2. Hard refresh browser
3. Check patterns in block inserter
4. If still not working, check browser console and PHP error log
5. Use debug code above to verify registration
