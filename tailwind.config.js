import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                serif: ["Fraunces", ...defaultTheme.fontFamily.serif],
            },
        },
    },

    safelist: [
        ...[...Array(10).keys()].flatMap((i) => [
            `lg:translate-x-[${6 * i}rem]`,
        ]),
        ...[...Array(10).keys()].flatMap((i) => [`lg:z-[-${i}]`]),
    ],

    plugins: [forms],
};
