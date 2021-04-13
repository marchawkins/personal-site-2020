module.exports = {
  purge: [],
  theme: {
    fontFamily: {
      'title': ['Helvegen','Arial'],
      'mono': ['VT323','Arial'],
      'hand': ['PermanentMarker-Regular','Arial'],
    },
    extend: {
      colors: {
        'terminal': '#02c618',
      },
      backgroundImage: theme => ({
        'vhs-spine-1': "url('/assets/img/bg-vhs-spine-001.jpg')",
        //'footer-texture': "url('/img/footer-texture.png')",
      }),
      variants: {
        margin: ['responsive','even','odd','first','last','hover','focus'],
        padding: ['responsive','even','odd','first','last','hover','focus'],
        backgroundColor:  ['responsive','even','odd','first','last','hover','focus'],
      }
    }
  }
}
