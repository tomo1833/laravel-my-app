import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            boxShadow: {
                clay: '5px 5px 10px rgba(0, 0, 0, 0.2), -5px -5px 10px rgba(255, 255, 255, 0.5)',
            },
            transitionProperty: {
                'box-shadow': 'box-shadow',
            },
            transitionProperty: {
                'box-shadow': 'box-shadow',
            },
            transitionDuration: {
                '200': '200ms',
            },
            transitionTimingFunction: {
                'ease': 'ease',
            }
        },
    },
    plugins: [forms],
};
