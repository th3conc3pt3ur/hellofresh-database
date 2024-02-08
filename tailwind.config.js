const defaultTheme = require('tailwindcss/defaultTheme.js')
// const colors = require('tailwindcss/colors.js')

/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  content: ['./resources/views/app/**/*.blade.php', './resources/**/*.js', './resources/**/*.vue'],
  theme: {
    container: {
      padding: {
        DEFAULT: '2rem',
        sm: '1.5rem'
      }
    },
    extend: {
      fontFamily: {
        sans: ['Inter var', ...defaultTheme.fontFamily.sans]
      }
    }
  },
  plugins: [require('@tailwindcss/forms'), require('tailwind-scrollbar')({ nocompatible: true })]
}
