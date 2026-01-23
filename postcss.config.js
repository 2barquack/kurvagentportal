export default {
	plugins: {
		'postcss-import': {},
		'postcss-nested': {},
		'autoprefixer': {},
		'cssnano': process.env.NODE_ENV === 'production' ? {} : false,
	},
	// Enable SCSS support via Vite's CSS preprocessor
	parser: false,
};
