import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: '#f0f5f0',
                    100: '#dce8dc',
                    200: '#b8d1b8',
                    300: '#8fb78f',
                    400: '#6a9d6a',
                    500: '#4a7c4a',
                    600: '#3d6b3d',
                    700: '#2d4f2d',
                    800: '#1e3a1e',
                    900: '#1a2e1a',
                    950: '#0f1f0f',
                },
                accent: {
                    50: '#fdf8e8',
                    100: '#faefc5',
                    200: '#f5df8e',
                    300: '#efc94d',
                    400: '#e8b822',
                    500: '#d4a017',
                    600: '#b07c12',
                    700: '#8c5c13',
                    800: '#744a16',
                    900: '#633e18',
                },
            },
        },
    },

    plugins: [forms],
};
