const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    darkMode: "class",
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/js/**/*.js",
        "app/Http/Livewire/**/*.php"
    ],

    presets: [
        require("./vendor/power-components/livewire-powergrid/tailwind.config.js"),
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Inter", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                dark: {
                    bg: "#151823",
                    "eval-1": "#222738",
                    "eval-2": "#2A2F42",
                    "eval-3": "#2C3142",
                },
            },
        },
    },

    plugins: [
        require("@tailwindcss/forms"),
        require('tailwind-scrollbar')({ nocompatible: true }),
        require('tailwindcss-plugins/pagination'),
    ],
};
