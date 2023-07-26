/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      fontFamily: {
        "victor-mono" : "'Victor Mono', monospace"
      },
      colors: {
        'base': '#1d1d1f'
      },
      screens: {
        'semi-md': '850px'
      }
    },
  },
  daisyui: {
    themes: [
      {
        mytheme: {
          "primary": "#b91c1c",
          "secondary": "#d1d5db",
          "accent": "#1d1d1f",
          "neutral": "#2b3440",
          "info": "#3abff8",
          "base-100": "#f5f5f5",
          "success": "#36d399",
          "warning": "#fbbd23",
          "error": "#f87272",
        },
      },
    ],
  },
  plugins: [require("daisyui")],
}

