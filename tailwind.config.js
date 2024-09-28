module.exports = {
  content: [
    "./**/*.{js,ts,jsx,tsx,html}", // Make sure your paths are correct
  ],
  theme: {
    extend: {
      colors: {
        primary: "var(--primary)", // Add this line to use the CSS variable
      },
    },
  },
  plugins: [],
};
