const purgecss = require('@fullhuman/postcss-purgecss')
const cssnano = require('cssnano')

module.exports = {
    plugins:    [
        require('tailwindcss'),
        require('autoprefixer'),
        cssnano({
          preset: 'default'
        }),
        purgecss({
            content: ['./site/snippets/**/*.html', './site/snippets/**/*.php', './site/themes/**/*.html','./site/themes/**/*.php'],
            defaultExtractor: content => content.match(/[\w-/:]+(?<!:)/g) || []
        })
    ]
}