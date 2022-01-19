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
        variants: ['hover','focus','sm','md'],
      },
    ]
  },
  
  darkMode: false, // or 'media' or 'class'



  theme: {
    // colors: {
    //   transparent: 'transparent',
    //   current: 'currentColor',
    //   black: '#000000',
    //   night: '#242424',
    //   fog: '#424242',
    //   smoke: '#757575',
    //   mist: '#e0e0e0',
    //   ghost: '#f5f5f5',
    //   halo: '#fafafa',
    //   white: '#ffffff',
    // },

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
