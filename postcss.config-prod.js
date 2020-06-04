const purgecss = require('@fullhuman/postcss-purgecss')
const cssnano = require('cssnano')

module.exports = {
    plugins: [
      require('tailwindcss'),
      process.env.NODE_ENV === 'production' ? require('autoprefixer') : null,
      process.env.NODE_ENV === 'production'
        ? cssnano({ preset: 'default' })
        : null,
      purgecss({
        content: ['./site/snippets/**/*.html', './site/snippets/**/*.php', './site/themes/**/*.html','./site/themes/**/*.php'],
        defaultExtractor: content => content.match(/[\w-/:]+(?<!:)/g) || []
      })
    ]
  }