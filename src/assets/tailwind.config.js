module.exports = {

  purge: {
    // enabled: true,
    content: [
      './css/file_scans/files/*.html',
    ],

    // https://github.com/tailwindlabs/tailwindcss/discussions/6256
    safelist: [
      {
        pattern: /./,
        variants: ['hover','focus','target','sm','md','lg','group-target'],
      },
    ]
  },
  
  darkMode: false, // or 'media' or 'class'



  theme: {
    fontFamily: {
      sans: ['Gill Sans', 'Gill Sans MT', 'sans-serif'],
      mono: ['Monaco', 'Consolas', 'Andale Mono', 'DejaVu Sans Mono', 'monospace' ],
    },

    backgroundSize: {
      'auto': 'auto',
      'cover': 'cover',
      'contain': 'contain',
      'fifty': '50%',
    },

    extend: {
      height: {
        "128": "32rem;",
        "192": "47rem;",
      },
      
    },
  },

  variants: {
    extend: {
      display: ['hover'],
      fill:    ['hover', 'focus'],
      backgroundColor: ['checked'], 
    },
  },



  plugins: [],
}
