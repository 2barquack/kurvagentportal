/**
 * Post-build script to create style.min.css from style.css
 * WordPress expects both style.css and style.min.css
 */

import { readFileSync, writeFileSync } from 'fs';
import { resolve, dirname } from 'path';
import { fileURLToPath } from 'url';
import postcss from 'postcss';
import cssnano from 'cssnano';

const __filename = fileURLToPath(import.meta.url);
const __dirname = dirname(__filename);
const themeRoot = resolve(__dirname, '..');
const styleCss = resolve(themeRoot, 'style.css');

try {
	const css = readFileSync(styleCss, 'utf8');
	
	// Process with cssnano to create minified version
	postcss([cssnano()])
		.process(css, { from: styleCss, to: resolve(themeRoot, 'style.min.css') })
		.then(result => {
			writeFileSync(resolve(themeRoot, 'style.min.css'), result.css);
			console.log('✓ Created style.min.css');
		})
		.catch(err => {
			console.error('Error minifying CSS:', err);
			process.exit(1);
		});
} catch (err) {
	console.error('Error reading style.css:', err);
	process.exit(1);
}
