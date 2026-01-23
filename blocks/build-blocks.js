/**
 * Build script for custom blocks
 * Compiles JS and SCSS for each block
 *
 * @package Kurv_Knowledgebase_2026
 * @since 1.0.0
 */

import { build } from 'vite';
import { resolve, dirname } from 'path';
import { fileURLToPath } from 'url';
import { readdirSync, statSync } from 'fs';

const __filename = fileURLToPath(import.meta.url);
const __dirname = dirname(__filename);
const blocksDir = __dirname;

// Get all block directories
const blocks = readdirSync(blocksDir).filter((file) => {
	const filePath = resolve(blocksDir, file);
	return statSync(filePath).isDirectory() && file !== 'node_modules';
});

// Build each block
for (const block of blocks) {
	const blockPath = resolve(blocksDir, block);
	const srcPath = resolve(blockPath, 'src');
	
	try {
		await build({
			configFile: false,
			build: {
				lib: {
					entry: resolve(srcPath, 'index.js'),
					name: block,
					fileName: 'index',
					formats: ['es'],
				},
				outDir: resolve(blockPath),
				emptyOutDir: false,
				rollupOptions: {
					external: [
						'@wordpress/blocks',
						'@wordpress/block-editor',
						'@wordpress/components',
						'@wordpress/element',
						'@wordpress/i18n',
					],
					output: {
						entryFileNames: 'index.js',
						assetFileNames: (assetInfo) => {
							if (assetInfo.name && assetInfo.name.endsWith('.css')) {
								return 'style-index.css';
							}
							return assetInfo.name;
						},
					},
				},
				cssCodeSplit: false,
			},
			css: {
				preprocessorOptions: {
					scss: {
						additionalData: `@import "${resolve(srcPath, 'scss/style.scss')}";`,
					},
				},
			},
			resolve: {
				alias: {
					'@': srcPath,
				},
			},
		});
		
		console.log(`✓ Built block: ${block}`);
	} catch (error) {
		console.error(`✗ Error building block ${block}:`, error);
	}
}

console.log('Block build complete!');
