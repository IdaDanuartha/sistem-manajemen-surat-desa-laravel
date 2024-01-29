/** @type {import('tailwindcss').Config} */
export default {
	content: [
		"./resources/**/*.blade.php",
		"../resources/**/*.js",
		"./resources/**/*.vue",
	],

	theme: {
		extend: {
			colors: {
				'main':'#5F84E9',
				'second': '#282421',
				// 'third' : '#EFF3F4',
				'desc' : '#28242185',
				'font' : '#282421'
			},
		},
		container: {
			padding: {
				DEFAULT: '1rem',
				sm: '2rem',
				lg: '4rem',
				xl: '4rem',
				'2xl': '6rem',
			},
		},
		fontFamily:{
			'urbanist' : ['Urbanist'],
			'signika' : ['Signika'],
			'bebasNeue' : ['Bebas Neue']
		}
	},
	plugins: [
		// require('flowbite/plugin')
	],
}
