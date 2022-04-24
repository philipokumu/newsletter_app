const colors = require("tailwindcss/colors");

module.exports = {
    content: [
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        colors: {
            transparent: "transparent",
            current: "currentColor",
            white: colors.white,
            black: colors.black,
            gray: colors.slate,
            primary: colors.purple,
            secondary: colors.amber,
            blue: colors.blue,
            green: colors.green,
            yellow: colors.amber,
            red: colors.red,
        },
        extend: {},
    },
    plugins: [],
};
