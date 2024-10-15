module.exports = {
  content: [
    './*.html', // Match all HTML files in the root directory
    './assets/**/*.png', // Watch for images (if Tailwind applies styles based on file types)
    './assets/**/*.jpg',
    './assets/**/*.webp',
    './assets/**/*.svg',
    './blogs/*.html', // Watch blog files
    './events.html',
    './contact-us.html',
    './work-with-noopur.html',
    './sound-healing.html',
    './meditation-training-courses.html',
    './reiki-initiation-courses.html',
    './script.js', // Watch any JS files using Tailwind
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
