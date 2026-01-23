import { defineConfig } from 'vite';
import { resolve } from 'path';
import { fileURLToPath } from 'url';
import { dirname } from 'path';

const __filename = fileURLToPath(import.meta.url);
const __dirname = dirname(__filename);

export default defineConfig({
	// Root directory for source files
	root: resolve(__dirname, 'src'),
	
	// Base public path
	base: './',
	
	// Build configuration
	build: {
		// Output directory (theme root)
		outDir: resolve(__dirname),
		emptyOutDir: false, // Don't empty the theme directory
		
		// Manifest file for WordPress asset handling
		manifest: false,
		
		// Rollup options
		rollupOptions: {
			input: {
				// Main stylesheet entry - outputs to style.css and style.min.css
				style: resolve(__dirname, 'src/css/style.css'),
				// Editor stylesheet entry
				'editor-style': resolve(__dirname, 'src/css/editor-style.css'),
				// JavaScript entry
				main: resolve(__dirname, 'src/js/main.js'),
			},
			output: {
				// JavaScript files
				entryFileNames: (chunkInfo) => {
					if (chunkInfo.name === 'main') {
						return 'assets/js/main.js';
					}
					return 'assets/js/[name].js';
				},
				chunkFileNames: 'assets/js/[name]-[hash].js',
				assetFileNames: (assetInfo) => {
					// CSS files - WordPress expects style.css and style.min.css in theme root
					if (assetInfo.name && assetInfo.name.endsWith('.css')) {
						const name = assetInfo.name.replace('.css', '');
						// Always output as .css (Vite will handle minification)
						if (name === 'style') {
							return 'style.css';
						}
						if (name === 'editor-style') {
							return 'assets/css/editor-style.css';
						}
						return `${name}.css`;
					}
					// Other assets go to assets directory
					return 'assets/[name]-[hash][extname]';
				},
			},
		},
		
		// Source maps for development
		sourcemap: process.env.NODE_ENV === 'development',
		
		// Minification
		minify: process.env.NODE_ENV === 'production' ? 'terser' : false,
		
		// CSS code splitting - disabled to keep CSS in single files
		cssCodeSplit: false,
		
		// CSS minification
		cssMinify: process.env.NODE_ENV === 'production',
	},
	
	// Development server configuration
	server: {
		port: 3000,
		strictPort: false,
		// Proxy to WordPress if needed
		proxy: {
			'/': {
				target: 'http://localhost:10004', // Adjust to your Local by Flywheel port
				changeOrigin: true,
			},
		},
		// CORS for development
		cors: true,
	},
	
	// CSS configuration
	css: {
		devSourcemap: true,
		postcss: './postcss.config.js',
		preprocessorOptions: {
			scss: {
				additionalData: '',
			},
		},
	},
	
	// Resolve configuration
	resolve: {
		alias: {
			'@': resolve(__dirname, 'src'),
			'@css': resolve(__dirname, 'src/css'),
			'@js': resolve(__dirname, 'src/js'),
			'@assets': resolve(__dirname, 'src/assets'),
		},
	},
});
