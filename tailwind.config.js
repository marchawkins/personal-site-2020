module.exports = {
  purge: [],
  theme: {
    fontFamily: {
      'title': ['NeilvardOne','Arial'],
      'mono': ['VT323','Arial'],
      'hand': ['PermanentMarker-Regular','Arial'],
    },
    extend: {
      colors: {
        'terminal': '#02c618',
      },
      variants: {
        margin: ['responsive','even','odd','first','last','hover','focus'],
        padding: ['responsive','even','odd','first','last','hover','focus'],
        backgroundColor:  ['responsive','even','odd','first','last','hover','focus'],
      }
    }
  }
}
